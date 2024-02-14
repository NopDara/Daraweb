<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Add
                    <a href="users.php" class="btn btn-danger float-end">Discard</a>
                </h4>
                <div class="card-body">

                    <?= alertMessage(); ?>

                    <form action="users-code.php" method="POST" enctype="multipart/form-data">
                        <div class="row " id="user-info">
                            <h5>User Info </h5>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Photo</label>
                                    <input type="file" name="photo" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Sex</label>
                                    <select name="sex" class="form-select" id="select-role">
                                        <option value="male" selected>Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Password</label>
                                    <input type="text" name="password" class="form-control" id="passInput" placeholder="Enter password">
                                    <a href="#" class="text-danger" id="gBtn">
                                        <i class="fas fa-random"></i> Generate
                                    </a>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control" placeholder="Enter address">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Phone Number</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Enter phone number">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label>Select Role</label>
                                    <select name="role" class="form-select" id="select-role">
                                        <option value="admin" selected>Admin</option>
                                        <option value="teacher">Teacher</option>
                                        <option value="student">Student</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- add student  -->
                        <div class="row d-none" id="show-student-info">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Class</label>
                                    <input type="text" name=" " class="form-control" placeholder="Enter class">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Grade</label>
                                    <input type="text" name="grade" class="form-control" placeholder="Enter grade">
                                </div>
                            </div>

                        </div>

                        <!-- add teacher  -->
                        <div class="row  d-none" id="show-teacher-info">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Class</label>
                                    <input type="text" name="class" class="form-control" placeholder="Enter class">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>subject</label>
                                    <input type="text" name="subject" class="form-control" placeholder="Enter subject">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <br />
                                    <button type="submit" name="saveUser" class="btn btn-primary px-5">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>


</div>
<script>

    $(document).ready(function () {

        $("#select-role").change(function (e) {
            let val = $(this).val();
            if (val == 'student') {
                $("#show-student-info").removeClass("d-none");

            } else {
                $("#show-student-info").addClass("d-none");
            }
        });

        $("#select-role").change(function (e) {
            let val = $(this).val();
            if (val == 'teacher') {
                $("#show-teacher-info").removeClass("d-none");

            } else {
                $("#show-teacher-info").addClass("d-none");
            }
        });

        function makePass(length) {
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            var passInput = document.getElementById('passInput');
            passInput.value = result;
        }
        var gBtn = document.getElementById('gBtn');
        gBtn.addEventListener('click', function (e) {
            e.preventDefault();
            makePass(8);
        });
    });
</script>
<?php include('includes/footer.php'); ?>
