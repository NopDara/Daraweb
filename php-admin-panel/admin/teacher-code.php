<?php
require '../config/function.php';

if (isset($_POST['saveUser'])) {
    $name = validate($_POST['name']);
    $sex = validate($_POST['sex']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']); // Assuming this is the password from the form
    $address = validate($_POST['address']);
    $phone = validate($_POST['phone']);
    $is_ban = isset($_POST['is_ban']) ? 1 : 0;

    $url = 'teacher.php';

    if ($email != '') {
        $query = "SELECT id FROM users WHERE email = '$email' ";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            echo "Email Already Exist";
            die();
        }
    }

    $folder = '../img/'; // Make sure this folder exists and has write permissions
    $photoPath = '';

    // Handle the photo upload
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
        $photoName = preg_replace("/[^\w.]/", "_", $_FILES['photo']['name']);
        $photoPath = $folder . $photoName;

        if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath)) {
            $em = "Failed to upload photo.";
            header("Location: ../teacher-create.php?error=$em");
            exit;
        }
    } else {
        $em = "Photo is required";
        header("Location: ../teacher-create.php?error=$em");
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if ($name != '' || $sex != '' || $email != '' || $password != '' || $address != '' || $phone != '') {
        //insert user 
        $insert_user_query = "INSERT INTO users(name,sex,email,password,address,phone,photo,role) 
        VALUES ('$name','$sex','$email','$hashed_password','$address','$phone','$photoPath','teacher')";
        $user_result = mysqli_query($conn, $insert_user_query);

        //insert into teacher
        if ($user_result) {
            $users_id = mysqli_insert_id($conn);
            $query = "INSERT INTO teacher(users_id,name,sex,address,phone,photo,is_ban)
            VALUES ($users_id,'$name','$sex','$address','$phone','$photoPath','$is_ban')";
            $results = mysqli_query($conn, $query);
        }

        if ($results) {
            redirect($url, 'Teacher Added Successfully');
        } else {
            redirect('teacher-create.php', 'Something Went Wrong');
        }
    } else {
        redirect('teacher-create.php', 'Please fill all the input fields');
    }
}

if (isset($_POST['updateUser'])) {
    $name = validate($_POST['name']);
    $sex = validate($_POST['sex']);
    $email = validate($_POST['email']);
    // $password = validate($_POST['password']); // Assuming this is the new password
    $address = validate($_POST['address']);
    $phone = validate($_POST['phone']);
    $is_ban = isset($_POST['is_ban']) ? 1 : 0;
    $teacher_info = validate($_POST['userId']);
    $user = getById('teacher', $teacher_info);

    if ($user['status'] != 200) {
        redirect('teacher-edit.php?id=' . $teacher_info, 'No such id found');
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
            header("Location: student-edit.php?error=$em&user_id=$user_id&photoPath=$photoPath");
            exit;
        }
    } else {
        // No new photo uploaded, so keep the existing photo path
        $photoPath = $user['data']['photo'];  // Assuming 'photo' is the column name in the database
    }

    // Hash the password
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if ($name != '' || $sex != '' || $email != '' || $password != '' || $address != '' || $phone != '') {
        // Update teacher
        $query = "UPDATE teacher SET
            name='$name',
            photo= '$photoPath',
            sex='$sex',
            address='$address',
            phone='$phone',
            is_ban='$is_ban'
            WHERE id='$teacher_info' ";
        $results_teacher = mysqli_query($conn, $query);

        // Update users
        $users_id = $_POST['users_id'];
        $query = "UPDATE users  
            SET email='$email',
            -- password='$hashed_password', // Update hashed password
            photo= '$photoPath',
            name='$name',
            sex='$sex',
            address='$address',
            phone='$phone',
            is_ban='$is_ban'
            WHERE id='$users_id' ";
        $results_users = mysqli_query($conn, $query);

        if ($results_teacher && $results_users) {
            redirect('teacher.php', 'Updated Successfully');
        } else {
            redirect('teacher-edit.php', 'Something went wrong');
        }
    } else {
        redirect('teacher-edit.php', 'Please fill all the input fields');
    }
}
?>
