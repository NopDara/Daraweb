<?php include('includes/header.php');
 ?>


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Edit Subject
                    <a href="subject.php" class="btn btn-danger float-end">Discard</a>
                </h4>
                <div class="card-body">

                    <?= alertMessage(); ?>

                    <form action="subject-code.php" method="POST">

                        <?php
                        $paramResult = getParam('id');
                        if (!is_numeric($paramResult)) {
                            echo '</h5>' . $paramResult . '</h5>';
                            return false;
                        }
                        $user = getById('subject', getParam('id'));
                        if ($user['status'] == 200) {
                            ?>
                            <input type="hidden" name="userId" value="<?= $user['data']['id']; ?>" required>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Subject</label>
                                        <input type="text" name="subject" value="<?= $user['data']['subject']; ?>" required
                                            class="form-control">
                                    </div>
                                </div>

                                <!-- <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Subject</label>
                                        <input type="text" name="subject" value="<?= $user['data']['subject']; ?>" required
                                            class="form-control">
                                    </div>
                                </div> -->
                                <!-- <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Teacher</label>
                                        <select name="name" class="form-select"id="teacherSelect">
                                            <?php
                                            $teachers = getAll('teacher'); // Assuming getAll('teacher') fetches the list of teachers
                                            $selectedTeacher = $user['data']['name'];

                                            // Add an empty option for the first select
                                            echo "<option value='' selected disabled>Select a teacher</option>";

                                            foreach ($teachers as $teacher) {
                                                // Assuming 'name' is the key for the teacher's name in each nested array
                                                $teacherName = isset($teacher['name']) ? $teacher['name'] : '';
                                                $selected = ($selectedTeacher == $teacherName) ? 'selected' : '';

                                                // Skip adding an option for the teacher's name in the first select
                                                if (!empty($teacherName)) {
                                                    echo "<option value=\"$teacherName\" $selected>$teacherName</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="col-md-6">
                                    <div class="mb-3 ">
                                        <br />
                                        <button type="submit" name="updateUser" class="btn btn-primary">Update
                                            Subject</button>
                                    </div>
                                </div>
                            </div>

                            <?php

                        } else {
                            echo '<h5>' . $user['message'] . '</h5>';
                        }
                        ?>


                    </form>

                </div>

            </div>

        </div>

    </div>


</div>
<script>
    document.getElementById('teacherSelect').addEventListener('change', function() {
        // Enable all options in the select
        var options = this.options;
        for (var i = 0; i < options.length; i++) {
            options[i].disabled = false;
        }
    });
</script>

<?php include('includes/footer.php'); ?>