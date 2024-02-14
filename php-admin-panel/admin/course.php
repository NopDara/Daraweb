<?php include('includes/header.php'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Class List
                    <a href="course-create.php" class="btn btn-primary float-end">Add Course</a>
                </h4>
            </div>
            <div class="card-body">

                <?= alertMessage(); ?>
                <div class="table-responsive">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <!-- <th>Course</th> -->
                                <th>Class</th>
                                <th>Subject</th>
                                <th>Teacher</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            $courses = getAllCourse();

                            if (mysqli_num_rows($courses)) {
                                foreach ($courses as $index => $courseItem) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?= $invID = str_pad($index + 1, 2, '0', STR_PAD_LEFT); ?>
                                        </td>
                                        <!-- <td>
                                            <?= $courseItem['course']; ?>
                                        </td> -->
                                        <td>
                                            <?= $courseItem['class_name']; ?>
                                        </td>
                                        <td>
                                            <?= $courseItem['subject_name']; ?>
                                        </td>
                                        <td>
                                            <?= $courseItem['teacher_name']; ?>
                                        </td>
                                        <td>
                                            <?= $courseItem['start_at']; ?>
                                        </td>
                                        <td>
                                            <?= $courseItem['end_at']; ?>
                                        </td>

                                        <td>
                                        <a href="courseview.php?id=<?= $courseItem['id']; ?>" class="btn btn-link">
                                                <i class="fas fa-eye"></i>View
                                            </a>
                                            <a href="course-edit.php?id=<?= $courseItem['id']; ?>" class="btn btn-success btn-sm">Edit
                                            </a>
                                            <a href="course-delete.php?id=<?= $courseItem['id']; ?>" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete data?')">
                                                Delete
                                            </a>
                                           
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
</div>





<?php include('includes/footer.php'); ?>