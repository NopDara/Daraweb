<?php include('includes/header.php'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Student Course
                    <a href="student-create.php" class="btn btn-primary float-end">Add Student</a>
                </h4>
            </div>
            <div class="card-body">

                <?= alertMessage(); ?>
                <table  class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $courses = getStudentData('student');

                        if (mysqli_num_rows($courses)) {
        
                            foreach ($courses as $index=> $userItem) {
                            
                                ?>
                                <tr>
                                    <td>
                                    <?= $invID = str_pad($index +1, 4, '0', STR_PAD_LEFT); ?>
                                    </td>
                                    <td>
                                        <?= $userItem['name']; ?>
                                    </td>
                               
                                    <td>
                                        <?= $userItem['email']; ?>
                                    </td>
                                                                                                                     
                                </tr>
                                <?php
                            }

                        } else {
                            ?>
                            <tr>
                                <td colspan="7">No Record Found</td>
                            </tr>
                            <?php
                        }
                        ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




<?php include('includes/footer.php'); ?>