<?php
require '../config/function.php';

$paramResult = getParam('id');

if (is_numeric($paramResult)) {
    $userId = validate($paramResult);

    $class = getById('class', $userId);

    if ($class['status'] == 200) {
        $userDeleteRes = deleteQuery('class', $userId);

        if ($userDeleteRes) {
            redirect('class.php', 'User Deleted Successfully');
        } else {
            redirect('class.php', 'Something Went Wrong');
        }

    } else {
        redirect('class.php', $class['message']);
    }

} else {
    redirect('class.php', $paramResult);
}
?>
