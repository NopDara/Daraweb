<?php include('includes/header.php'); ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        Student Information
                        <a href="student.php" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?= alertMessage(); ?>
                    <form action="student-code.php" method="POST">
                        <?php
                        $paramResult = getParam('id');
                        if (!is_numeric($paramResult)) {
                            echo '<h5>' . $paramResult . '</h5>';
                            return false;
                        }
                        $user = getStudentById(getParam('id'));
                        if ($user['status'] == 200) {
                            ?>
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <?php if (!empty($user['data']['photo'])): ?>
                                        <img src="<?= $user['data']['photo'] ?>" class="img-fluid "
                                            style="max-width: 180px;" alt="Student Photo">
                                    <?php else: ?>
                                        <p class="m-0">No photo available</p>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-title">@<?= htmlspecialchars($user['data']['name']) ?></h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Name:</strong> <?= htmlspecialchars($user['data']['name']) ?></li>
                                        <li class="list-group-item"><strong>Gender:</strong> <?= htmlspecialchars($user['data']['sex']) ?></li>
                                        <li class="list-group-item"><strong>Email:</strong> <?= htmlspecialchars($user['data']['email']) ?></li>
                                        <li class="list-group-item"><strong>Mobile:</strong> <?= htmlspecialchars($user['data']['phone']) ?></li>
                                        <li class="list-group-item"><strong>Address:</strong> <?= htmlspecialchars($user['data']['address']) ?></li>
                                        <li class="list-group-item"><strong>Joining Date:</strong> <?= htmlspecialchars($user['data']['create_at']) ?></li>
                                    </ul>
                                </div>
                            </div>
                        <?php } else {
                            echo '<h5>' . $user['message'] . '</h5>';
                        } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
