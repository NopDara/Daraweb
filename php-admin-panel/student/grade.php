<?php include('includes/header.php'); ?>
<div class="row">
    <div class="col-md-12 bg-white">
        <div class="card">
            <div class="card-header">
                <h4>
                    My Score
                </h4>
            </div>
            <div class="card-body">

                <?= alertMessage(); ?>
                <div class="table-responsive" >
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Class Name</th>
                            <th>Subject</th> 
                            <th>Teacher</th>                                                                                                                          
                            <th>Start Time</th>                                                              
                            <th>End Time</th>  
                            <th>Score</th>  
                            <th>Grade</th>  
                                                                                      
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // $class = getAll('class');
                        $student_info = getStudentInfo($_SESSION['users_id']);
                        $courses = getAllCourseOfStudent($student_info['data']['id']);

                        if (mysqli_num_rows($courses)) {
                            foreach ($courses as $index=>$courseItem) {
                                ?>
                                <tr>
                                    <td>
                                    <?= $invID = str_pad($index +1, 2, '0', STR_PAD_LEFT); ?>
                                    </td>
                                    <td>
                                        <?= $courseItem['class']; ?>
                                    </td>                                                                 
                                    <td>
                                        <?= $courseItem['subject']; ?>
                                    </td>
                                    <td>
                                        <?= $courseItem['name']; ?>
                                    </td>
                                    <td>
                                        <?= $courseItem['start_at']; ?>
                                    </td>
                                    <td>
                                        <?= $courseItem['end_at']; ?>
                                    </td>
                                    <td>
                                        <?= $courseItem['score']; ?>
                                    </td>
                                    <td>
                                                    <?php if ($courseItem['score'] == null) {
                                                        echo "";
                                                    } else {
                                                        echo getGrade($courseItem['score']);
                                                    } ?>
                                                </td>
                                    
                           
                                    <!-- <td>
                                        <a href="class-edit.php?id=<?= $classItem['id']; ?>"class="btn btn-success btn-sm">Edit</a>
                                        <a href="class-delete.php?id=<?= $classItem['id']; ?>"
                                         class="btn btn-danger btn-sm mx-1"
                                         onclick="return confirm('Are you sure you want to delete data?')"
                                         >
                                         Delete
                                        </a>
                                    </td> -->
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
</div>




<?php include('includes/footer.php'); ?>