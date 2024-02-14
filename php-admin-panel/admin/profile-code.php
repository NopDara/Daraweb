<?php
require '../config/function.php';

if (isset($_POST['updateUser'])) {

    $userId = validate($_POST['userId']);
    $user = getById('users', $userId);

    if ($user['status'] != 200) {
        redirect('prf-edit.php?id=' . $userId, 'No such id found');
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
            header("Location: prf-edit.php?error=$em&user_id=$user_id&photoPath=$photoPath");
            exit;
        }
    } else {
        // No new photo uploaded, so keep the existing photo path
        $photoPath = $user['data']['photo']; // Assuming 'photo' is the column name in the database
    }

    $name = validate($_POST['name']);
    $sex = validate($_POST['sex']);
    $email = validate($_POST['email']);
    $password = $_POST['password']; // No need to validate password here, as we're handling it separately
    $address = validate($_POST['address']);
    $phone = validate($_POST['phone']);
    $is_ban = isset($_POST['is_ban']) ? 1 : 0;
    $role = validate($_POST['role']);

    // Initialize variable for password update
    $passwordUpdate = "";

    // Check if a new password is provided and not empty
    if (!empty($password)) {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // Include the password update in the query
        $passwordUpdate = ", password='$hashedPassword'";
    }

    // Update user details
    $query = "UPDATE users SET
        name='$name',
        photo='$photoPath',
        sex='$sex',
        email='$email',
        address='$address',
        phone='$phone',
        is_ban='$is_ban',
        role='$role'
        $passwordUpdate
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

        redirect('profile.php', 'Updated Successfully');
    } else {
        redirect('prf-edit.php?id=' . $userId, 'Something went wrong while updating user');
    }
}
?>

