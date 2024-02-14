<?php include('includes/header.php'); ?>


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Edit User
                    <a href="stuprofile.php" class="btn btn-danger float-end">Discard</a>
                </h4>
                <div class="card-body">

                    <?= alertMessage(); ?>

                    <form action="stuprofile-code.php" method="POST" enctype="multipart/form-data">

                        <?php
                        $paramResult = getParam('id');
                        if (!is_numeric($paramResult)) {
                            echo '</h5>' . $paramResult . '</h5>';
                            return false;
                        }
                        $user = getById('users', getParam('id'));
                        if ($user['status'] == 200) {
                            ?>
                            <input type="hidden" name="userId" value="<?= $user['data']['id']; ?>" required>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Name</label>
                                        <input type="text" name="name" value="<?= $user['data']['name']; ?>" required
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Current Photo</label>
                                        <?php
                                        if (!empty($user['data']['photo'])) {
                                            echo "<img src='" . $user['data']['photo'] . "' style='max-width: 150px; max-height: 150px;' alt='Current Photo'>";
                                        } else {
                                            echo "No photo available";
                                        }
                                        ?>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label>Upload New Photo</label>
                                        <input type="file" name="photo" accept="image/*" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Gender</label>
                                        <select name="sex" required class="form-select">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" name="email" value="<?= $user['data']['email']; ?>" required
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Password</label>
                                        <input type="text" name="password" value="<?= $user['data']['password']; ?>"
                                            required class="form-control" id="passInput">
                                            <a href="#" class="text-danger" id="gBtn">
                                            <i class="fas fa-random"></i> Generate
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Address</label>
                                        <input type="text" name="address" value="<?= $user['data']['address']; ?>" required
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Phone Number</label>
                                        <input type="text" name="phone" value="<?= $user['data']['phone']; ?>" required
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label>Select Role</label>
                                        <select name="role" required class="form-select">
                                            <option value="">Select Role</option>
                                            <option value="admin" <?= $user['data']['role'] == 'admin' ? 'selected' : ''; ?>>Admin
                                            </option>
                                            <option value="teacher" <?= $user['data']['role'] == 'teacher' ? 'selected' : ''; ?>>
                                                Teacher</option>
                                            <option value="student" <?= $user['data']['role'] == 'student' ? 'selected' : ''; ?>>
                                                Student</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3 ">
                                        <br />
                                        <button type="submit" name="updateUser" class="btn btn-primary px-5">Update
                                            User</button>
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
</script>

<?php include('includes/footer.php'); ?>