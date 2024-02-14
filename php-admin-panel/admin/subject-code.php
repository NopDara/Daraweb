<?php 
require '../config/function.php';

if(isset($_POST['saveUser'])){
    $subject = validate($_POST['subject']);
    $teacher = validate($_POST['name']);

  
    if($subject != ''|| $teacher !='' ){
        $query = "INSERT INTO subject (subject,name)
        VALUES ('$subject','$teacher')";
        $results = mysqli_query($conn, $query);
        if($results){
            redirect('subject.php','Added Successfully');
        }else{
            redirect('subject-create.php','something When Wrong');
        }
    }
    else{
        redirect('subject-create.php','Please fill all the input fields');
    
    }
}

if(isset($_POST['updateUser']))
{
    
    $subject = validate($_POST['subject']);
    $teacher = validate($_POST['name']);


    $userId = validate($_POST['userId']);
    $user = getById('subject',$userId);
    if($user['status'] != 200){
        redirect('subject-edit.php?id'.$userId,'No such id found');
    }


    if($subject != ''||  $teacher !='' ){
        $query = "UPDATE subject SET
         subject = '$subject',
         name = '$teacher'      
         WHERE id = '$userId' ";

        $results = mysqli_query($conn, $query);

        if($results){
            redirect('subject.php','Updated Successfully');
        }else{
            redirect('subject-create.php','something When Wrong');
        }

    }
    else{
        redirect('subject-create.php','Please fill all the input fields');
    
    }

}

?>