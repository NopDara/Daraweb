<?php
require '../config/function.php';

if (isset($_POST['saveUser'])) {
    $name = validate($_POST['name']);
    $sex = validate($_POST['sex']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $address = validate($_POST['address']);
    $phone = validate($_POST['phone']);
    $is_ban = isset($_POST['is_ban']) ? 1 : 0;

    $url = 'student.php';

    if ($email != '') {
        $query = "SELECT id FROM users WHERE email = '$email' ";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            echo "Email Already Exist";
            die();
        }
    }

    $folder = '../img/'; 

    // Handle the photo upload
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
        $photoName = preg_replace("/[^\w.]/", "_", $_FILES['photo']['name']);
        $photoPath = $folder . $photoName;

        if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath)) {
            $em = "Failed to upload photo.";
            header("Location: student-create.php?error=$em");
            exit;
        }
    } else {
        $em = "Photo is required";
        header("Location: student-create.php?error=$em");
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if ($name != '' || $sex != '' || $email != '' || $password != '' || $address != '' || $phone != '') {

        //insert user 

        $insert_user_query = "INSERT INTO users(name,sex,email,password,address,phone,photo,role) 
        VALUES ('$name','$sex','$email','$hashed_password','$address','$phone','$photoPath','student')";
        $user_result = mysqli_query($conn, $insert_user_query);

        if ($user_result) {

            $users_id = mysqli_insert_id($conn);
            $query = "INSERT INTO student(users_id,name,sex,address,phone,photo,is_ban)
            VALUES ($users_id,'$name','$sex','$address','$phone','$photoPath','$is_ban')";
            $results = mysqli_query($conn, $query);
            if ($results) {
                redirect($url, 'Student Added Successfully');
            } else {
                redirect('student-create.php', 'Something Went Wrong');
            }
        } else {
            redirect('student-create.php', 'Something Went Wrong');
        }
    } else {
        redirect('student-create.php', 'Please fill all the input fields');
    }
}

if (isset($_POST['updateUser'])) {
    $name = validate($_POST['name']);
    $sex = validate($_POST['sex']);
    $email = validate($_POST['email']);
    // $password = validate($_POST['password']);
    $address = validate($_POST['address']);
    $phone = validate($_POST['phone']);
    $is_ban = isset($_POST['is_ban']) ? 1 : 0;
    $student_id = validate($_POST['userId']);
    $user = getById('student', $student_id);

    if ($user['status'] != 200) {
        redirect('student-edit.php?id=' . $student_id, 'No such id found');
    }
    $folder = '../img/';
    $photoPath = '';

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

    if ($name != '' || $sex != '' || $email != '' || $password != '' || $address != '' || $phone != '' ) {
        $query = "UPDATE student SET
         name='$name',
         sex='$sex',
         photo= '$photoPath',
         address='$address',
         phone='$phone',
         is_ban = '$is_ban'
         WHERE id = '$student_id' ";
        $results = mysqli_query($conn, $query);


        $users_id = $_POST['users_id'];
        $query = "UPDATE users  
            SET email='$email',
            name = '$name',
            sex = '$sex',
            photo= '$photoPath',
            -- password='$hashed_password',
            address='$address',
            phone='$phone',
            is_ban='$is_ban'
            WHERE id = '$users_id'";
        $results = mysqli_query($conn, $query);

        if ($results) {
            redirect('student.php', 'Updated Successfully');
        } else {
            redirect('student-edit.php', 'Something Went Wrong');
        }

    } else {
        redirect('student-edit.php', 'Please fill all the input fields');

    }

}


?>
