<?php
session_start();



require 'dbcon.php';

function validate($inputData)
{
    global $conn;

    $validateData = mysqli_escape_string($conn, $inputData);
    return trim($validateData);

}

function logoutSession()
{

    unset($_SESSION['auth']);
    unset($_SESSION['loggedInUserRole']);
    unset($_SESSION['loggedInUser']);
    unset($_SESSION['users_id']);


}
function redirect($url, $status)
{
    $_SESSION['status'] = $status;
    header("Location:" . $url);
    exit(0);
}
function alertMessage()
{
    if (isset($_SESSION["status"])) {
        echo '<div class="alert alert-success">
        <h4>' . $_SESSION['status'] . '</h4>
        </div>';
        unset($_SESSION['status']);
    }
}

function getParam($paramType)
{
    if (isset($_GET[$paramType])) {
        if ($_GET[$paramType] != null) {
            return $_GET[$paramType];
        } else {
            return '';
        }
    } else {
        return '';
    }
}
function getAll($tableName, $role = '')
{
    global $conn;

    $table = validate($tableName);

    $where = '';
    if (!empty($role)) {

        $where .= "where role='" . $role . "'";
    }

    $query = "SELECT * FROM $table " . $where . " order by id desc";
    $result = mysqli_query($conn, $query);
    return $result;
}

function getAllCourse()
{
    global $conn;
    $query = "SELECT course.*, 
    teacher.name as teacher_name,
    subject.subject as subject_name,
    class.class as class_name
    FROM `course` 
    JOIN teacher on teacher.id = course.teacher_id
    JOIN subject on subject.id = course.subject_id
    JOIN class on class.id = course.class_id
    order by id desc; ";
    $result = mysqli_query($conn, $query);
    return $result;

}

function getAllCourseOfTeacher($teacher_id)
{
    global $conn;
    $query = "SELECT course.*, 
    teacher.name as teacher_name,
    subject.subject as subject_name,
    class.class as class_name
    FROM `course` 
    LEFT JOIN teacher on teacher.id = course.teacher_id
    LEFT JOIN subject on subject.id = course.subject_id
    LEFT JOIN class on class.id = course.class_id
    WHERE teacher.id = '$teacher_id'
    order by id desc; ";
    $result = mysqli_query($conn, $query);
    return $result;
}

function getCourseDetail($id)
{
    global $conn;
    $query = "SELECT course.*, 
    teacher.name as teacher_name,
    subject.subject as subject_name,
    class.class as class_name
    FROM `course` 
    JOIN teacher on teacher.id = course.teacher_id
    JOIN subject on subject.id = course.subject_id
    JOIN class on class.id = course.class_id
    where course.id = $id ";
    $result = mysqli_query($conn, $query);
    if ($result) {
        return mysqli_fetch_assoc($result);
    }
    return [];

}
function getStuCourse($courseId)
{
    global $conn;
    $query = "SELECT
    student.name AS student_name,
    users.email AS student_email,
    student_course.score,
    course.*,
    student.id AS student_id
FROM
    student
JOIN
    student_course ON student.id = student_course.student_id
JOIN
    course ON course.id = student_course.course_id
JOIN
    users ON student.users_id = users.id
WHERE
    course.id = $courseId
ORDER BY
    student_course.id;
";

    $result = mysqli_query($conn, $query);
    return $result;


}

function getStudentData($role = "student")
{
    global $conn;

    $table = validate("users");
    $query = "SELECT stu.*,users.email,users.password FROM student as stu 
    join users as users  on users.id = stu.users_id
    where users.role = 'student'
    order by id desc";
    $result = mysqli_query($conn, $query);
    return $result;
}
function getTeacherData($role = "teacher")
{
    global $conn;

    $table = validate("users");
    $query = "SELECT tch.*, users.email,users.password FROM teacher as tch 
    join users as users on users.id = tch.users_id
    where users.role = 'teacher'
    order by id desc";
    $result = mysqli_query($conn, $query);
    return $result;
}
function getById($tableName, $id)
{
    global $conn;
    $table = validate($tableName);
    $id = validate($id);

    $query = "SELECT * FROM $table WHERE id= '$id'LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $response = [
                "status" => 200,
                'message' => 'Fected data',
                'data' => $row
            ];
            return $response;
        } else {
            $response = [
                "status" => 404,
                "message" => "No Data Record"
            ];
            return $response;
        }
    } else {
        $response = [
            "status" => 500,
            "message" => "Something Went Wrong"
        ];
        return $response;

    }
}

function getStudentCourseId($course_id, $student_id)
{
    global $conn;
    $table = validate('student_course');
    $course_id = validate($course_id);
    $student_id = validate($student_id);

    $query = "SELECT id FROM student_course WHERE course_id = '$course_id' AND student_id = '$student_id';";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = $result->fetch_assoc();
            $response = [
                "status" => 200,
                "message" => "Fetched data",
                "data" => $row
            ];
            return $response;
        } else {
            $response = [
                "status" => 404,
                "message" => "No Data Record"
            ];
            return $response;
        }
    } else {
        $response = [
            "status" => 500,
            "message" => "Something Went Wrong"
        ];
        return $response;

    }
}

function getStudentById($id)
{
    global $conn;
    $table = validate('student');
    $id = validate($id);

    $query = "SELECT stu.*,users.email,users.password FROM $table as stu 
    join users on users.id=stu.users_id
    
     WHERE stu.id= '$id'LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $response = [
                "status" => 200,
                'message' => 'Fected data',
                'data' => $row
            ];
            return $response;
        } else {
            $response = [
                "status" => 404,
                "message" => "No Data Record"
            ];
            return $response;
        }
    } else {
        $response = [
            "status" => 500,
            "message" => "Something Went Wrong"
        ];
        return $response;

    }
}

function getTeacherById($id)
{
    global $conn;
    $table = validate('teacher');
    $id = validate($id);

    $query = "SELECT tch.*,users.email,users.password FROM $table as tch 
    join users on users.id=tch.users_id
    
     WHERE tch.id= '$id'LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $response = [
                "status" => 200,
                'message' => 'Fetched data',
                'data' => $row
            ];
            return $response;
        } else {
            $response = [
                "status" => 404,
                "message" => "No Data Record"
            ];
            return $response;
        }
    } else {
        $response = [
            "status" => 500,
            "message" => "Something Went Wrong"
        ];
        return $response;

    }
}


function getCourseDetailByTeacherId($teacher_id)
{
    global $conn;
    $table = validate('course');
    $teacher_id = validate($teacher_id);

    $query = "SELECT * FROM $table AS co
    LEFT JOIN class AS cl ON co.class_id = cl.id
    LEFT JOIN teacher AS t ON co.teacher_id = t.id
    LEFT JOIN subject AS s ON co.subject_id = s.id
    WHERE teacher_id = '$teacher_id';";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $response = [
                "status" => 200,
                'message' => 'Fetched data',
                'data' => $row
            ];
            return $response;
        } else {
            $response = [
                "status" => 404,
                "message" => "No Data Record"
            ];
            return $response;
        }
    } else {
        $response = [
            "status" => 500,
            "message" => "Something Went Wrong"
        ];
        return $response;
    }
}
function getCourseDetailByStudentId($student_id)
{
    global $conn;
    $table = validate('course');
    $student_id = validate($student_id);

    $query = "SELECT co.*, cl.*, t.*, s.*
    FROM course AS co
    LEFT JOIN class AS cl ON co.class_id = cl.id
    LEFT JOIN student_course AS sc ON co.id = sc.course_id
    LEFT JOIN student AS t ON sc.student_id = t.id
    LEFT JOIN subject AS s ON co.subject_id = s.id
    WHERE t.id = '$student_id';
    ";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $response = [
                "status" => 200,
                'message' => 'Fetched data',
                'data' => $row
            ];
            return $response;
        } else {
            $response = [
                "status" => 404,
                "message" => "No Data Record"
            ];
            return $response;
        }
    } else {
        $response = [
            "status" => 500,
            "message" => "Something Went Wrong"
        ];
        return $response;
    }
}


function getTeacherInfo($user_id)
{
    global $conn;
    $user_id = validate($user_id);

    $query = "SELECT teacher.id FROM teacher
    LEFT JOIN users ON teacher.users_id = users.id
    WHERE users_id = '$user_id'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $response = [
                "status" => 200,
                'message' => 'Fetched data',
                'data' => $row
            ];
            return $response;
        } else {
            $response = [
                "status" => 404,
                "message" => "No Data Record"
            ];
            return $response;
        }
    } else {
        $response = [
            "status" => 500,
            "message" => "Something Went Wrong"
        ];
        return $response;
    }
}
function getStudentInfo($user_id)
{
    global $conn;
    $user_id = validate($user_id);

    $query = "SELECT student.id FROM student
    LEFT JOIN users ON student.users_id = users.id
    WHERE users_id = '$user_id'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $response = [
                "status" => 200,
                'message' => 'Fetched data',
                'data' => $row
            ];
            return $response;
        } else {
            $response = [
                "status" => 404,
                "message" => "No Data Record"
            ];
            return $response;
        }
    } else {
        $response = [
            "status" => 500,
            "message" => "Something Went Wrong"
        ];
        return $response;
    }
}
function getAllCourseOfStudent($student_id)
{
    global $conn;

    $query = "SELECT 
                class.class, 
                subject.subject, 
                users.name,
                course.start_at,
                course.end_at,
                student_course.score
            FROM student_course
            LEFT JOIN course ON student_course.course_id = course.id
            LEFT JOIN class ON course.class_id = class.id
            LEFT JOIN subject ON course.subject_id = subject.id
            LEFT JOIN teacher ON course.teacher_id = teacher.id
            LEFT JOIN users ON teacher.users_id = users.id
            WHERE student_course.student_id = '$student_id'";

    $result = mysqli_query($conn, $query);
    return $result;
}




function deleteQuery($tableName, $id)
{
    global $conn;
    $table = validate($tableName);
    $id = validate($id);

    $query = "DELETE FROM $table 
    WHERE id='$id' LIMIT 1 ";
    $result = mysqli_query($conn, $query);
    return $result;
}
function getCount($tableName)
{
    global $conn;
    $table = validate($tableName);
    $query = "SELECT * FROM $table";
    $result = mysqli_query($conn, $query);
    $totalCount = mysqli_num_rows($result);
    return $totalCount;

}
function getClassCountForTeacher($teacherId)
{
    global $conn;

    // Validate the teacher ID to prevent SQL injection
    $teacherId = mysqli_real_escape_string($conn, $teacherId);

    // Query to count the number of classes the teacher has enrolled in
    $query = "SELECT COUNT(*) AS class_count FROM course WHERE teacher_id = '$teacherId'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['class_count'];
    } else {
        return 0; // Return 0 if no classes are enrolled or if there's an error
    }
}




function getCountEnrolledClasses()
{
    global $conn;

    $query = "SELECT COUNT(DISTINCT class_id) as count FROM course";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['count'];
    }

    return 0;
}

function getGrade($score)
{
    if ($score >= 96) {
        return "A+";
    } else if ($score >= 90) {
        return "A";
    } else if ($score >= 86) {
        return "B+";
    } else if ($score >= 80) {
        return "B";
    } else if ($score >= 76) {
        return "C+";
    } else if ($score >= 70) {
        return "C";
    } else if ($score >= 60) {
        return "D";
    } else if ($score >= 50) {
        return "E";
    } else {
        return "F";
    }
}





function ndd($x)
{
    echo "<pre>";
    var_dump($x);
    echo "</pre>";
}

function dd($x)
{
    echo "<pre>";
    var_dump($x);
    echo "</pre>";
    die();
}
?>