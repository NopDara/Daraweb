<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Class 
                    <a href="course.php" class="btn btn-danger float-end">Back</a>
                </h4>
                <div class="card-body">

                    <?= alertMessage(); ?>

                    <form action="course-code.php" method="POST">

                        <?php
                        $course_id = getParam('id');

                        if (!is_numeric($course_id)) {
                            echo '</h5>' . $course_id . '</h5>';
                            return false;
                        }

                        $course = getCourseDetail($course_id);

                    
                        $editClassId = $course['class_id'];
                        $editSubjectId = $course['subject_id'];
                        $editTeacherId = $course['teacher_id'];

                        // var_dump($class_id)
                        
                        ?>
                        <input type="hidden" name="course_id" value="<?= $course_id ?>">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Class</th>
                                    <th>Subject</th>
                                    <th>Teacher</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                </tr>
                            </thead>            
                            <tbody>  

                                <tr>       
                                    <td>
                                        <?php echo htmlspecialchars($course['class_name']); ?>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($course['subject_name']); ?>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($course['teacher_name']); ?>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($course['start_at']); ?>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($course['end_at']); ?>
                                    </td>                               
                                </tr>
                            </tbody>
                        </table>

                        <?php
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>
                                            Student Enrolled
                                            <!-- <a class="btn btn-primary float-end" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop">Add </a> -->
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table  class="table table-bordered table-striped" id="course-student-list">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Student Name</th>
                                                        <th>Email</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table-tbody">
                                                    <?php
                                                    $id = $_GET['id'];

                                                    $courses = getStuCourse(intval($id));

                                                    if (mysqli_num_rows($courses)) {

                                                        foreach ($courses as $index => $userItem) {
                                                            $obj_student = json_encode($userItem);

                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <?= $invID = str_pad($index + 1, 2, '0', STR_PAD_LEFT); ?>
                                                                </td>
                                                                <td>
                                                                    <?= $userItem['student_name']; ?>
                                                                </td>

                                                                <td>
                                                                    <?= $userItem['student_email']; ?>
                                                                </td>
                                                                <!-- <td>
                                                                    <a href="student-delete.php?id=<?= $userItem['student_id']; ?>"
                                                                        class="btn btn-danger btn-sm mx-1"
                                                                        onclick="return confirm('Are you sure you want to delete data?')">
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

                                                <tbody>
                                            </table>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>


            </div>

        </div>

    </div>

</div>


<?php include('includes/footer.php'); ?>