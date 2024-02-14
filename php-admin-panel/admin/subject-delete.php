<?php 
require '../config/function.php';
$paraResult= getParam('id');
if(is_numeric($paraResult)){

    $userId = validate($paraResult);

    $user = getById('subject',$userId);   
    if($user['status']==200){
        $userDeleteRes = deleteQuery('subject',$userId);
        if($userDeleteRes){
            redirect('subject.php','User Deleted Successfully');
        }else{
            redirect('subject.php','Something Went Wrong');
        }
        
    }else{
        redirect('subject.php',$user['message']);
    }

    
}else{
    redirect('subject.php',$paramResult);
}

?>