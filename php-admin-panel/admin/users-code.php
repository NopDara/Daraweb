<?php
require '../config/function.php';



if (isset($_POST['saveUser'])) {
    $name = validate($_POST['name']);
    $sex = validate($_POST['sex']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $address = validate($_POST['address']);
    $phone = validate($_POST['phone']);
    $role = validate($_POST['role']);
    $is_ban = 0;
    if (isset($_POST['is_ban'])) {
        $is_ban = 1;
    }

    $teacher = null;
    if (isset($_POST['teacher'])) {
        $teacher = validate($_POST['teacher']);
    }

    $url = 'users.php';

    if ($email != '') {
        $query = "SELECT id FROM users WHERE email = '$email' ";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            echo "Email Already Exist";
            die();
        }
    }

    $folder = '../img/'; // Make sure this folder exists and has write permissions

    // Handle the photo upload
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
        $photoName = preg_replace("/[^\w.]/", "_", $_FILES['photo']['name']);
        $photoPath = $folder . $photoName;

        if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath)) {
            $em = "Failed to upload photo.";
            header("Location: ../users-create.php?error=$em");
            exit;
        }
    } else {
        $em = "Photo is required";
        header("Location: ../users-create.php?error=$em");
        exit;
    }

    if ($name != '' || $email != '' || $password != '' || $address != '' || $phone != '') {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users(name,sex,email,password,address,phone,photo,role,is_ban)
        VALUES ('$name','$sex','$email','$hashed_password','$address','$phone','$photoPath','$role','$is_ban')";
        $results = mysqli_query($conn, $query);
        $users_id = mysqli_insert_id($conn);

        if ($role == 'student') {
            $query = "INSERT INTO student(users_id,name,sex,address,phone,photo,is_ban)
            VALUES ($users_id,'$name','$sex','$address','$phone','$photoPath','$is_ban')";
            $results = mysqli_query($conn, $query);

        }
        if ($role == 'teacher') {
            $query = "INSERT INTO teacher(users_id,name,sex,address,phone,photo,is_ban)
            VALUES ($users_id,'$name','$sex','$address','$phone','$photoPath','$is_ban')";
            $results = mysqli_query($conn, $query);

        }

        if ($results) {
            redirect($url, 'Student Added Successfully');
        } else {
            redirect('users-create.php', 'something When Wrong');
        }

    } else {
        redirect('users-create.php', 'Please fill all the input fields');

    }
}


if (isset($_POST['updateUser'])) {
    $userId = validate($_POST['userId']);
    $user = getById('users', $userId);

    if ($user['status'] != 200) {
        redirect('users-edit.php?id=' . $userId, 'No such id found');
    }

    $folder = '../img/';
    $photoPath = null; 

    // Check if a new photo was uploaded
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
        $photoName = basename($_FILES['photo']['name']);
        $photoPath = $folder . $photoName;

        // Move the uploaded file to the target folder
        if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath)) {
            $em = "Failed to upload photo.";
            header("Location: users-edit.php?error=$em&user_id=$user_id&photoPath=$photoPath");
            exit;
        }
    } else {
        // No new photo uploaded, so keep the existing photo path
        $photoPath = $user['data']['photo'];  // Assuming 'photo' is the column name in the database
    }

    $name = validate($_POST['name']);
    $sex = validate($_POST['sex']);
    $email = validate($_POST['email']);
    // $password = validate($_POST['password']); // Assuming this is the new password
    $address = validate($_POST['address']);
    $phone = validate($_POST['phone']);
    $is_ban = isset($_POST['is_ban']) ? 1 : 0;
    $role = validate($_POST['role']);

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Update user details
    $query = "UPDATE users SET
        name='$name',
        photo='$photoPath',
        sex='$sex',
        email='$email',
        -- password='$hashed_password', // Update hashed password
        address='$address',
        phone='$phone',
        is_ban='$is_ban',
        role='$role'
        WHERE id=$userId";

    $results = mysqli_query($conn, $query);

    if ($results) {
        // Update student or teacher details if applicable
        if ($role == 'student') {
            // Update student details
            $query = "UPDATE student SET
                name='$name',
                photo='$photoPath',
                sex='$sex',
                address='$address',
                phone='$phone',
                is_ban='$is_ban'
                WHERE users_id=$userId"; // Assuming 'users_id' is the foreign key in the 'student' table
        } elseif ($role == 'teacher') {
            // Update teacher details
            $query = "UPDATE teacher SET
                name='$name',
                photo='$photoPath',
                sex='$sex',
                address='$address',
                phone='$phone',
                is_ban='$is_ban'
                WHERE users_id=$userId"; // Assuming 'users_id' is the foreign key in the 'teacher' table
        }

        $results = mysqli_query($conn, $query);

        if ($results) {
            redirect('users.php', 'Updated Successfully');
        } else {
            redirect('users-edit.php?id=' . $userId, 'Something went wrong while updating student/teacher');
        }
    } else {
        redirect('users-edit.php?id=' . $userId, 'Something went wrong while updating user');
    }
}




?>