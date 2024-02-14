<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Student Enrolled
                    <a href="class.php" class="btn btn-danger float-end">Back</a>
                </h4>
                <div class="card-body">
                    <form action="score-code.php" method="POST">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Student Name</th>
                                        <th>Email</th>
                                        <th>Score</th>
                                        <th>Grade</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table-tbody">
                                    <?php

                                    $course_id = $_GET['id'];


                                    $courses = getStuCourse(intval($course_id));

                                    if (mysqli_num_rows($courses)) {
                                        foreach ($courses as $index => $userItem) {
                                            $obj = json_encode($userItem);
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
                                                <td>
                                                    <?= $userItem['score'] ?? ""; ?>
                                                </td>
                                                <td>
                                                    <?php if ($userItem['score'] == null) {
                                                        echo "";
                                                    } else {
                                                        echo getGrade($userItem['score']);
                                                    } ?>
                                                </td>
                                                <td>
                                                    <button id="editBtn<?= $index ?>" type="button"
                                                        class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#staticBackdrop<?= $index ?>"
                                                        data-student-id="<?= $userItem['student_id']; ?>">
                                                        Edit
                                                    </button>

                                                    <div class="modal fade" id="staticBackdrop<?= $index ?>"
                                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                        aria-labelledby="staticBackdropLabel<?= $index ?>" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="staticBackdropLabel<?= $index ?>">Student Score
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- Form for editing student score -->
                                                                    <form action="score-code.php" method="POST">
                                                                        <input type="hidden" name="student_id"
                                                                            id="student_id<?= $index ?>"
                                                                            value="<?= $userItem['student_id']; ?>">
                                                                        <div class="col">
                                                                            <div class="row">
                                                                                <h5 id="f-name<?= $index ?>">Name:
                                                                                    <?= $userItem['student_name']; ?>
                                                                                </h5>
                                                                            </div>
                                                                            <div class="row">
                                                                                <h5 id="f-email<?= $index ?>">Email:
                                                                                    <?= $userItem['student_email']; ?>
                                                                                </h5>
                                                                            </div>
                                                                            <input type="hidden" name="student_id"
                                                                                value="<?= $userItem['student_id']; ?>">
                                                                            <input type="hidden" name="course_id"
                                                                                value="<?= $course_id ?>">
                                                                            <div class="row">
                                                                                <div class="col-9">
                                                                                    <label for="f-score<?= $index ?>"
                                                                                        class="form-label">Score</label>
                                                                                    <input type="number" name="score"
                                                                                        class="form-control"
                                                                                        id="f-score<?= $index ?>"
                                                                                        placeholder="score..."
                                                                                        value="<?= $userItem['score'] ?? ''; ?>"
                                                                                        max="100" oninput="checkScore(this)">
                                                                                    <!-- Adding the max attribute with a value of 100 and calling the checkScore function -->
                                                                                </div>
                                                                                <div class="col">
                                                                                    <label for="f-grade<?= $index ?>"
                                                                                        class="form-label">Grade</label>
                                                                                    <input type="text" class="form-control"
                                                                                        id="f-grade<?= $index ?>"
                                                                                        value="<?= getGrade($userItem['score'] ?? ''); ?>"
                                                                                        disabled>
                                                                                </div>
                                                                                <!-- Save button inside the form -->
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit" name="saveScore"
                                                                                        class="btn btn-primary">Save</button>
                                                                                </div>
                                                                            </div>

                                                                        </div>

                                                                    </form>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
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
                                <tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function setStudentId(index, studentId) {
        $('#student_id' + index).val(studentId);
    }
    $(document).ready(function () {
        <?php foreach ($courses as $index => $userItem) { ?>
                (function (studentId, score, index) {
                    $('#editBtn<?= $index ?>').click(function () {
                        $('#student_id<?= $index ?>').val(studentId);
                        $('#f-score<?= $index ?>').val(score);
                        $('#f-grade<?= $index ?>').val(getGrade(score));
                    });
                })(<?= $userItem['student_id'] ?>, <?= $userItem['score'] ?? '' ?>, <?= $index ?>);
        <?php } ?>
    });
    function checkScore(input) {
        // Convert the input value to a number
        var score = parseInt(input.value);

        // Check if the score is greater than 100
        if (score > 100) {
            // If so, set the input value to 100
            input.value = 100;
        }
    }





</script>

<?php include('includes/footer.php'); ?>