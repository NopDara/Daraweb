<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Add Class
                    <a href="course.php" class="btn btn-danger float-end">Discard</a>
                </h4>
                <div class="card-body">

                    <?= alertMessage(); ?>

                    <form action="course-code.php" method="POST">
                        <div class="row">
                            <!-- <div class="col-md-6">
                                <div class="mb-3">
                                    <label>course Name</label>
                                    <input type="text" name="course" class="form-control">
                                </div>
                            </div> -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Class</label>
                                    <select name="class" class="form-select">
                                        <?php
                                        $classes = getAll('class'); // Assuming getAll('class') fetches the list of classes
                                        $selectedClass = $user['data']['class'];
                                        foreach ($classes as $class) {
                                            $class_id = $class['id'];
                                            $className = $class['class'];
                                            $selected = ($selectedClass == $className) ? 'selected' : '';
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
                                            $selected = ($selectedSubject == $subjectName) ? 'selected' : '';
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
                                            $selected = ($selectedTeacher == $teacherName) ? 'selected' : '';
                                            echo "<option value=\"$teacher_info\" $selected>$teacherName</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="startAt">Start Time</label>
                                    <select id="startAt" name="start_at" class="form-select">
                                        <option>7:00 am</option>
                                        <option>8:00 am</option>
                                        <option>9:00 am</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="endAt">End Time</label>
                                    <select id="endAt" name="end_at" class="form-select">
                                        <option>10:00 am</option>
                                        <option>11:00 am</option>
                                        <option>12:00 am</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>
                                            Student Enrolled
                                            <a class="btn btn-primary float-end" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop">Add Student</a>
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped" id="course-student-list">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table-tbody">

                                                <tbody>
                                            </table>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3 ">
                                <br />
                                <button type="submit" name="saveUser" class="btn btn-primary px-5 ">Save</button>
                            </div>
                        </div>

                    </form>
                  
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" >
                        <div class="modal-dialog modal-dialog-scrollable "  >
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Student Name</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Add search input field -->
                                    <input type="text" id="searchInput" class="form-control mb-3"
                                        placeholder="Search student...">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <!-- <th>No.</th> -->
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="studentTableBody">
                                                <!-- Student list rows will be dynamically populated here -->
                                                <?php
                                                $courses = getStudentData('student');


                                                if (mysqli_num_rows($courses)) {

                                                    foreach ($courses as $index => $userItem) {
                                                        $obj_student = json_encode($userItem);

                                                        ?>
                                                        <tr>
                                                            <!-- <td>
                                                                <?= $invID = str_pad($index + 1, 2, '0', STR_PAD_LEFT); ?>
                                                            </td> -->
                                                            <td>
                                                                <?= $userItem['name']; ?>
                                                            </td>

                                                            <td>
                                                                <?= $userItem['email']; ?>
                                                            </td>

                                                            <td>
                                                                <button type="button" id="btn_student<?= $index; ?>"
                                                                    onclick='fnAddStudent(<?= $obj_student ?>, <?= $index ?>)'
                                                                    class="btn btn-primary">
                                                                    Add to class
                                                                </button>
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
    function filterStudents() {
        // Get search input value
        var searchInput = document.getElementById("searchInput").value.toLowerCase();
        // Get table rows
        var rows = document.getElementById("studentTableBody").getElementsByTagName("tr");

        // Loop through all rows and hide those that don't match the search query
        for (var i = 0; i < rows.length; i++) {
            var nameColumn = rows[i].getElementsByTagName("td")[0];
            if (nameColumn) {
                var name = nameColumn.textContent.toLowerCase();
                if (name.includes(searchInput)) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    }

    // Event listener for search input
    document.getElementById("searchInput").addEventListener("input", filterStudents);


</script>



</div>

<?php include('includes/footer.php'); ?>