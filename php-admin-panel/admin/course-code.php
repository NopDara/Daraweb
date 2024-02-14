<?php
require '../config/function.php';

if (isset($_POST['saveUser'])) {
    $teacher = validate($_POST['name']);
    $class = validate($_POST['class']);
    $subject = validate($_POST['subject']);
    $start_at = validate($_POST['start_at']);
    $end_at = validate($_POST['end_at']);

    if ($teacher != '' || $class != '' || $subject != '' || $start_at != '' || $end_at != '') {
        // Check if the combination already exists in the course table
        $checkQuery = "SELECT id FROM course 
                       WHERE teacher_id = '$teacher' 
                       AND class_id = '$class' 
                       AND subject_id = '$subject' 
                       AND start_at = '$start_at' 
                       AND end_at = '$end_at'";

        $checkResult = mysqli_query($conn, $checkQuery);

        if ($checkResult && mysqli_num_rows($checkResult) > 0) {
            // The combination already exists, so you might want to handle this case (e.g., show an error message)
            redirect('course-create.php', 'Class already exists with the same details');
        } else {
            // The combination doesn't exist, proceed to insert the new course
            $insertQuery = "INSERT INTO course (teacher_id, class_id, subject_id, start_at, end_at)
                            VALUES ('$teacher', '$class', '$subject', '$start_at', '$end_at')";

            $insertResult = mysqli_query($conn, $insertQuery);

            $course_id = mysqli_insert_id($conn);
            $student_ids = $_POST['student'] ?? [];

            foreach ($student_ids as $student_id) {
                $checkExistingStudent = fnCheckExistingClassStudent($course_id, $student_id);
                if (!$checkExistingStudent) {
                    // If false = New student
                    $query = "INSERT INTO student_course (course_id, student_id)
                              VALUES ('$course_id', '$student_id')";
                    $results = mysqli_query($conn, $query);
                }
            }

            if ($insertResult) {
                redirect('course.php', 'Added Successfully');
            } else {
                redirect('course-create.php', 'Something went wrong while adding the course');
            }
        }
    } else {
        redirect('course-create.php', 'Please fill all the input fields');
    }
}


function fnCheckExistingClassStudent($course_id, $student_id)
{
    global $conn;
    $query = "Select * from student_course where course_id = $course_id AND student_id = $student_id";
    $results = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($results);
    if ($rows > 0) {
        return true;
    }
    return false;
}

if (isset($_POST['UpdateUser'])) {
    $class = validate($_POST['class']);
    $subject = validate($_POST['subject']);
    $teacher = validate($_POST['name']);
    $start_at = validate($_POST['start_at']);
    $end_at = validate($_POST['end_at']);

    $course_id = validate($_POST['course_id']);

    if ($teacher != '' || $class != '' || $subject != '' || $start_at != '' || $end_at != '' || $course_id != '') {

        // Check if the combination already exists in the course table
        $checkQuery = "SELECT id FROM course 
                       WHERE teacher_id = '$teacher' 
                       AND class_id = '$class' 
                       AND subject_id = '$subject' 
                       AND start_at = '$start_at' 
                       AND end_at = '$end_at'
                       AND id != '$course_id'";  // Exclude the current course being updated

        $checkResult = mysqli_query($conn, $checkQuery);

        if ($checkResult && mysqli_num_rows($checkResult) > 0) {
            // The combination already exists, redirect to the edit page again
            redirect('course-edit.php?id=' . $course_id, 'Course already exists with the same details');
        } else {
            // The combination doesn't exist, proceed to update the course
            $updateQuery = "UPDATE course SET
                            class_id = '$class',
                            subject_id = '$subject',
                            teacher_id = '$teacher',
                            start_at = '$start_at',
                            end_at = '$end_at'
                            WHERE id = '$course_id'";

            $updateResult = mysqli_query($conn, $updateQuery);

            $student_ids = $_POST['student'] ?? [];

            foreach ($student_ids as $student_id) {
                $checkExistingStudent = fnCheckExistingClassStudent($course_id, $student_id);
                if (!$checkExistingStudent) {
                    // If false = New student 
                    $query = "INSERT INTO student_course (course_id, student_id)
                              VALUES ('$course_id', '$student_id')";
                    $results = mysqli_query($conn, $query);
                }
            }

            if ($updateResult) {
                redirect('course.php', 'Updated Successfully');
            } else {
                redirect('course-edit.php?id=' . $course_id, 'Something went wrong while updating the course');
            }
        }
    } else {
        redirect('course-edit.php?id=' . $course_id, 'Please fill all the input fields');
    }
}


?>