<?php 
require '../config/function.php';

if(isset($_POST['saveUser'])){
    $class = validate($_POST['class']);
    $name = validate($_POST['name']);
 
   
  
    if($class != ''|| $subject !=''|| $name !='' ){
        $query = "INSERT INTO class (class,subject,name)
        VALUES ('$class','$subject','$name')";
        $results = mysqli_query($conn, $query);
        if($results){
            redirect('class.php','Added Successfully');
        }else{
            redirect('class-create.php','something When Wrong');
        }

    }
    else{
        redirect('class-create.php','Please fill all the input fields');
    
    }
}

if(isset($_POST['updateUser']))
{

    $class = validate($_POST['class']);
    $teacher = validate($_POST['name']);
   

    $userId = validate($_POST['userId']);
    $user = getById('class',$userId);
    if($user['status'] != 200){
        redirect('class-edit.php?id'.$userId,'No such id found');
    }


    if($class != ''|| $teacher !=''){
        $query = "UPDATE class SET
         class = '$class',
         name = '$teacher'
         WHERE id = '$userId' ";
        $results = mysqli_query($conn, $query);

        // $teacher_id = $teacher['id'];
        // $query = "UPDATE teacher SET
        // name='$teacher',
        // class='$class',
        // -- grade='grade',
        // is_ban = '$is_ban'
        // WHERE id = '$teacher_id' ";
        // $results = mysqli_query($conn, $query);


        if($results){
            redirect('class.php','Updated Successfully');
        }else{
            redirect('class-create.php','something When Wrong');
        }

    }
    else{
        redirect('class-create.php','Please fill all the input fields');
    
    }

}

?>