<?php 
require '../config/function.php';
$paraResult= getParam('id');
if(is_numeric($paraResult)){

    $userId = validate($paraResult);

    $user = getById('users',$userId);   
    if($user['status']==200){
        $userDeleteRes = deleteQuery('users',$userId);
        if($userDeleteRes){
            redirect('teacher.php','teacher Deleted Successfully');
        }else{
            redirect('teacher.php','Something Went Wrong');
        }
        
    }else{
        redirect('teacher.php',$user['message']);
    }
    $user = getById('teacher');   
    if($user['status']==200){
        $userDeleteRes = deleteQuery('teacher');
        if($userDeleteRes){
            redirect('teacher.php','teacher Deleted Successfully');
        }else{
            redirect('teacher.php','Something Went Wrong');
        }
        
    }else{
        redirect('teacher.php',$user['message']);
    }

    
}else{
    redirect('teacher.php',$paramResult);
}

?>