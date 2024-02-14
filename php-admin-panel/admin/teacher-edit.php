<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Edit Teacher
                    <a href="teacher.php" class="btn btn-danger float-end">Discard</a>
                </h4>
                <div class="card-body">

                <?= alertMessage(); ?>
                
                    <form action="teacher-code.php" method="POST" enctype="multipart/form-data">

                    <?php 
                    $paramResult = getParam('id');
                    if(!is_numeric($paramResult)){
                        echo'</h5>'.$paramResult.'</h5>';
                        return false;
                    }
                    $user =  getTeacherById(getParam('id') );
                 

                    if($user['status']==200)
                    {
                        ?>
                     <input type="hidden" name="userId" value="<?=$user['data']['id'];?>" required>
                     <input type="hidden" name="users_id" value="<?=$user['data']['users_id'];?>" required>

                         <div class="row">
                        <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Teacher </label>
                                    <input type="text" name="name" value="<?=$user['data']['name'];?>" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Current Photo</label>
                                        <?php
                                        if (!empty($user['data']['photo'])) {
                                            echo "<img src='" . $user['data']['photo'] . "' style='max-width: 150px; max-height: 150px;' alt='Current Photo'>";
                                        } else {
                                            echo "No photo available";
                                        }
                                        ?>
                                    </div>

                                </div>
                                <div class="col-6" >
                                <div class="mb-3">
                                        <label>Upload New Photo</label>
                                        <input type="file" name="photo" accept="image/*" class="form-control">
                                    </div>
                                </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Gender</label>
                                    <select name="sex"required class="form-select">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>                                        
                                    </select>
                                </div>
                            </div>
                        <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" value="<?=$user['data']['email'];?>" required class="form-control">
                                </div>
                            </div>
                        <!-- <div class="col-md-3">
                                <div class="mb-3">
                                    <label>Password</label>
                                    <input type="password" name="password" value="<?=$user['data']['password'];?>" required class="form-control">
                                </div>
                            </div> -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Address</label>
                                    <input type="text" name="address" value="<?=$user['data']['address'];?>" required class="form-control">
                                </div>
                            </div>    
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Phone Number</label>
                                    <input type="text" name="phone" value="<?=$user['data']['phone'];?>" required class="form-control">
                                </div>
                            </div>      
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label>Is Ban</label>
                                    <br>
                                    <input type="checkbox" name="is_ban"<?=$user['data']['is_ban']==true? 'checked':'';?> style="width:30px;height:30px" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 ">
                                    <br/>
                                    <button type="submit" name="updateUser" class="btn btn-primary">Update Student</button>
                                </div>
                            </div>
                        </div>

                        <?php

                    }
                    else{
                        echo'<h5>'.$user['message'].'</h5>';
                    }
                    ?>
                       

                    </form>

                </div>

            </div>

        </div>

    </div>


</div>

<?php include('includes/footer.php'); ?>