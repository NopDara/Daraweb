<?php
require '../config/function.php';

if (isset($_POST['saveScore'])) {
    $student_id = validate($_POST['student_id']);
    $score = validate($_POST['score']);
    $course_id = validate($_POST['course_id']);


    // Ensure that the student_id is an integer
    $student_id = (int) $student_id;

    // Sanitize inputs
    $score = mysqli_real_escape_string($conn, $score);
    $course_id = mysqli_real_escape_string($conn, $course_id);

    $query = "UPDATE student_course SET score = '$score' WHERE student_id = $student_id AND course_id = $course_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $redirect_url = "viewclass.php?id=$course_id";
        redirect($redirect_url, 'Score updated successfully');
    } else {
        $redirect_url = "viewclass.php?id=$course_id";
        redirect($redirect_url, 'Something went wrong while updating the score');
    }
} else {
    redirect('viewclass.php', 'Please submit the form with valid data');
}
?>