<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Add Teacher
                    <a href="teacher.php" class="btn btn-danger float-end">Discard</a>
                </h4>
            </div>
            <div class="card-body">

                <?= alertMessage(); ?>

                <form action="teacher-code.php" method="POST" enctype="multipart/form-data">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Teacher Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter teacher's name">
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
                                <input type="password" name="password" class="form-control" placeholder="Enter password">
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
                                <input type="number" name="phone" class="form-control" placeholder="Enter phone number">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <br>
                                <button type="submit" name="saveUser" class="btn btn-primary px-5">Save</button>
                            </div>
                        </div>
                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

<?php include('includes/footer.php'); ?>
