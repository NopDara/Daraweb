<?php include('includes/header.php'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Student Lists
                    <a href="student-create.php" class="btn btn-primary float-end">
                        <i class="fas fa-user-plus me-1"></i> Add student
                    </a>
                </h4>
            </div>
            <div class="card-body">

                <?= alertMessage(); ?>
                <div class="table-responsive">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Profile</th>
                                <th>Name</th>
                                <!-- <th>Class</th>
                                <th>Subject</th> -->
                                <th>Gender</th>
                                <th>Email</th>
                                <!-- <th>Password</th> -->
                                <!-- <th>Address</th>
                            <th>Phone Number</th> -->
                                <th>Ban</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $courses = getStudentData('student');


                            if (mysqli_num_rows($courses)) {

                                foreach ($courses as $index => $userItem) {

                                    ?>
                                    <tr>
                                        <td>
                                            <?= $invID = str_pad($index + 1, 2, '0', STR_PAD_LEFT); ?>
                                        </td>
                                        <td>
                                            <?php if (!empty($userItem['photo'])): ?>
                                                <div class="d-flex justify-content-center ">
                                                    <a href="studentview.php?id=<?= $userItem['id']; ?>" class="text-decoration-none">
                                                        <img src="<?= $userItem['photo']; ?>" class="img-fluid  "
                                                            style="width: 50px; height: 50px;" alt="User Photo">
                                                    </a>
                                                </div>
                                            <?php else: ?>
                                                <div class="text-muted">No photo</div>
                                            <?php endif; ?>

                                        </td>

                                        <td>
                                            <?= $userItem['name']; ?>
                                        </td>
                                        <!-- <td>
                                            <?= $userItem['class_id']; ?>
                                        </td>
                                        <td>
                                            <?= $userItem['subject_id']; ?>
                                        </td> -->
                                        <td>
                                            <?= $userItem['sex']; ?>
                                        </td>

                                        <td>
                                            <?= $userItem['email']; ?>
                                        </td>
                                        <!-- <td>
                                        <?= $userItem['password']; ?>
                                    </td> -->
                                        <!-- <td>
                                        <?= $userItem['address']; ?>
                                    </td>
                                    <td>
                                        <?= $userItem['phone']; ?>
                                    </td> -->
                                        <td>
                                            <?= $userItem['is_ban'] == 1 ? 'banned' : 'Active'; ?>
                                        </td>
                                        <td>
                                            <a href="student-edit.php?id=<?= $userItem['id']; ?>"
                                                class="btn btn-success btn-sm">Edit</a>
                                            <a href="student-delete.php?id=<?= $userItem['users_id']; ?>"
                                                class="btn btn-danger btn-sm mx-1"
                                                onclick="return confirm('Are you sure you want to delete data?')">
                                                Delete
                                            </a>
                                            <!-- <a href="studentview.php?id=<?= $userItem['id']; ?>" class="btn btn-link">
                                                <i class="fas fa-eye"></i>View
                                            </a> -->
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