<?php 
require '../config/function.php';
$paraResult= getParam('id');
if(is_numeric($paraResult)){

    $course_id = validate($paraResult);

    $course = getById('course', $course_id);   

    if($course['status']==200){
        $userDeleteRes = deleteQuery('course',$course_id);
        if($userDeleteRes){
            redirect('course.php','User Deleted Successfully');
        }else{
            redirect('course.php','Something Went Wrong');
        }
        
    }else{
        redirect('course.php',$user['message']);
    }

    
}else{
    redirect('course.php',$paramResult);
}

?>