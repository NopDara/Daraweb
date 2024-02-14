<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Class edit
                    <a href="course.php" class="btn btn-danger float-end">Discard</a>
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

                        $course = getById('course', $course_id);
                        $course = $course['data'];
                        $editClassId = $course['class_id'];
                        $editSubjectId = $course['subject_id'];
                        $editTeacherId = $course['teacher_id'];

                        // var_dump($class_id)
                        


                        ?>
                        <input type="hidden" name="course_id" value="<?= $course_id ?>">

                        <h5>
                            <? echo (getParam('id')) ?>
                        </h5>

                        <div class="row">
                            <!-- <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Course Name</label>
                                        <input type="text" name="course" value="<?= $user['data']['course']; ?>" required
                                            class="form-select">
                                    </div>
                                </div> -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Class</label>
                                    <select name="class" class="form-select">
                                        <?php
                                        $classes = getAll('class');
                                        foreach ($classes as $class) {
                                            $class_id = $class['id'];
                                            $className = $class['class'];
                                            $selected = ($editClassId == $class_id) ? 'selected' : '';
                                            echo "<option value=\"$class_id\" $selected>$className</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Subject</label>
                                    <select name="subject" class="form-select">
                                        <?php
                                        $subjects = getAll('subject');
                                        $selectedSubject = $user['data']['subject'];
                                        foreach ($subjects as $subject) {
                                            $subject_id = $subject['id'];
                                            $subjectName = $subject['subject'];
                                            $selected = ($editSubjectId == $subject_id) ? 'selected' : '';
                                            echo "<option value=\"$subject_id\" $selected>$subjectName</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Teacher</label>
                                    <select name="name" class="form-select">
                                        <?php
                                        $teachers = getTeacherData('teacher'); // Assuming getAll('teacher') fetches the list of teachers
                                        $selectedTeacher = $user['data']['name'];

                                        foreach ($teachers as $teacher) {
                                            $teacher_info = $teacher['id'];
                                            $teacherName = $teacher['name'];
                                            $selected = ($editTeacherId == $teacher_info) ? 'selected' : '';
                                            echo "<option value=\"$teacher_info\" $selected>$teacherName</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="startAt">Start Time</label>
                                    <select id="startAt" name="start_at" required class="form-select">
                                        <option value="7:00 am" <?php echo ($course['start_at'] === '7:00 am') ? 'selected' : ''; ?>>7:00 am</option>
                                        <option value="8:00 am" <?php echo ($course['start_at'] === '8:00 am') ? 'selected' : ''; ?>>8:00 am</option>
                                        <option value="9:00 am" <?php echo ($course['start_at'] === '9:00 am') ? 'selected' : ''; ?>>9:00 am</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="EndAt">Start Time</label>
                                    <select id="EndAt" name="end_at" required class="form-select">
                                        <option value="10:00 am" <?php echo ($course['end_at'] === '10:00 am') ? 'selected' : ''; ?>>10:00 am</option>
                                        <option value="11:00 am" <?php echo ($course['end_at'] === '11:00 am') ? 'selected' : ''; ?>>11:00 am</option>
                                        <option value="12:00 am" <?php echo ($course['end_at'] === '12:00 am') ? 'selected' : ''; ?>>12:00 am</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>
                            </div>

                        </div>

                        <?php


                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>
                                            Student Enrolled
                                            <a class="btn btn-primary float-end" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop">Add Student </a>
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped" id="course-student-list">
                                                <thead>
                                                    <tr>
                                                        <!-- <th>Id</th> -->
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Action</th> <!-- Added a new column for action -->
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
                                                                    <?= $userItem['student_name']; ?>
                                                                </td>
                                                                <td>
                                                                    <?= $userItem['student_email']; ?>
                                                                </td>
                                                                <td>
                                                                    <form action="courseStudent-delete.php" method="post">
                                                                        <input type="hidden" name="course_id"
                                                                            value="<?= $id; ?>">
                                                                        <input type="hidden" name="student_id"
                                                                            value="<?= $userItem['student_id']; ?>">
                                                                        <button type="submit" class="btn btn-danger btn-sm mx-1"
                                                                            onclick="return confirm('Are you sure you want to delete this student from the course?')">
                                                                            Delete
                                                                        </button>
                                                                    </form>
                                                                </td>

                                                            </tr>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <tr>
                                                            <td colspan="3">No Record Found</td>
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

                        <div class="col-md-6">
                            <div class="mb-3 ">
                                <br />
                                <button type="submit" name="UpdateUser" class="btn btn-primary px-5 ">Save</button>
                            </div>
                        </div>

                    </form>
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Student Name</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $courses = getStudentData('student');
                                                $existingStudentQuery = getStuCourse(intval($id));
                                                $existingStudent = $existingStudentQuery->fetch_all(MYSQLI_ASSOC);
                                                $existingStudentID = array_map(fn($a) => $a['student_id'], $existingStudent);

                                                if (mysqli_num_rows($courses)) {
                                                    $allStudentsAdded = true; // Assume all students are added
                                                
                                                    foreach ($courses as $index => $userItem) {
                                                        if (in_array($userItem["id"], $existingStudentID, $strict = true)) {
                                                            continue;
                                                        }

                                                        $obj_student = json_encode($userItem);
                                                        $allStudentsAdded = false; // Set to false if any student is found
                                                
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <?= $userItem['name']; ?>
                                                            </td>
                                                            <td>
                                                                <?= $userItem['email']; ?>
                                                            </td>
                                                            <td>
                                                                <button type="button" id="btn_student<?= $index ?>"
                                                                    onclick='fnAddStudent(<?= $obj_student ?>, <?= $index ?>)'
                                                                    class="btn btn-primary">
                                                                    Add to class
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }

                                                    // Display error message if all students are added
                                                    if ($allStudentsAdded) {
                                                        echo '<tr><td colspan="3"><div class="alert alert-success text-dark fw-bolder" role="alert"> All students are already added to the class!</div></td></tr>';
                                                    }
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td colspan="3">No Record Found</td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>


                                        </table>

                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>

    </div>

</div>
<script>
    function fnAddStudent(data = {}, index) {
        console.log(data);
        let studentId = data.id;

        // Check if a row with the same student ID already exists
        let existingRow = $(`input[value="${studentId}"]`).closest("tr");

        if (existingRow.length === 0) {
            // Student not added, add a new row
            let name = data.name;
            let email = data.email;
            let btn = `<button class="delete-btn btn btn-danger btn-sm mx-1 " data-id="${studentId}">Delete</button>`;
            let tr = `<tr>
            <td>${name}<input type="hidden" name="student[]" value="${studentId}"></td>
            <td>${email}</td>
            <td>${btn}</td>
        </tr>`;

            $("#table-tbody").append(tr);

            // Attach click event for delete button
            $(".delete-btn").off("click").on("click", function () {
                let studentId = $(this).data("id");
                // Call a function to handle deletion
                fnDeleteStudent(studentId);
            });

            $(`#btn_student${index}`).prop("disabled", true);
        }
    }

    // Function to handle student deletion
    function fnDeleteStudent(studentId) {
        // Perform deletion logic here
        // For example:
        $(`input[value="${studentId}"]`).closest("tr").remove();
    }


</script>

<?php include('includes/footer.php'); ?>