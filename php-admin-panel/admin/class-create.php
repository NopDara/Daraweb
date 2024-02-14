<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Add Class
                    <a href="class.php" class="btn btn-danger float-end">Discard</a>
                </h4>
                <div class="card-body">

                    <?= alertMessage(); ?>

                    <form action="class-code.php" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Class Name</label>
                                    <input type="text" name="class" class="form-control">
                                </div>
                            </div>
<!-- 
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Subject</label>
                                    <input type="text" name="subject" class="form-control">
                                </div>
                            </div> -->
                            <!-- <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Teacher</label>
                                    <select name="name" class="form-select">
                                        <?php
                                        $teachers = getAll('teacher'); // Assuming getAll('teacher') fetches the list of teachers
                                        $selectedTeacher = $user['data']['name'];
                                        foreach ($teachers as $teacher) {
                                            // Assuming 'name' is the key for the teacher's name in each nested array
                                            $teacherName = isset($teacher['name']) ? $teacher['name'] : '';
                                            $selected = ($selectedTeacher == $teacherName) ? 'selected' : '';
                                            echo "<option value=\"$teacherName\" $selected>$teacherName</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div> -->

                            <div class="col-md-6">
                                <div class="mb-3 ">
                                    <br />
                                    <button type="submit" name="saveUser" class="btn btn-primary px-5 ">Save</button>
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