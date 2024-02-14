<?php
require '../config/function.php';

$paramResult = getParam('id');

if (is_numeric($paramResult)) {
    $userId = validate($paramResult);

    $user = getById('users', $userId);

    if ($user['status'] == 200) {
        $userDeleteRes = deleteQuery('users', $userId);

        if ($userDeleteRes) {
            redirect('student.php', 'Student Deleted Successfully');
        } else {
            // Log the error
            error_log("Error deleting user with ID: $userId");
            redirect('student.php', 'Something Went Wrong');
        }

    } else {
        redirect('student.php', $user['message']);
    }

} else {
    redirect('student.php', $paramResult);
}
?>
