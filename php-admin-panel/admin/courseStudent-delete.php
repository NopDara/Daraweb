<?php 
require '../config/function.php';
// $paraResult = getParam('id');
// $paraStudent = getParam('student_id') 
// if(is_numeric($paraResult)){

    $course_id = validate($_POST["course_id"]);
    $student_id = validate($_POST["student_id"]);

    $data = getStudentCourseId($course_id, $student_id);

    if($data['status']==200){
        $userDeleteRes = deleteQuery('student_course',$data['data']['id']);
        if($userDeleteRes){
            redirect("course-edit.php?id=$course_id",'User Deleted Successfully');
        }else{
            redirect("course-edit.php?id=$course_id",'Something Went Wrong');
        }
        
    }else{
        redirect("course-edit.php?id=$course_id",$user['message']);
    }

    
// }else{
//     redirect("course-edit.php?id=$course_id",$paramResult);
// }

?>