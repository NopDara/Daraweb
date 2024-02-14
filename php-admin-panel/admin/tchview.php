<?php include('includes/header.php'); ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        Teacher Information
                        <a href="teacher.php" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?= alertMessage(); ?>
                    <form action="teacher-code.php" method="POST">
                        <?php
                        $paramResult = getParam('id');
                        if (!is_numeric($paramResult)) {
                            echo '<h5>' . $paramResult . '</h5>';
                            return false;
                        }
                        $user = getTeacherById(getParam('id'));

                        if ($user['status'] == 200) {
                            ?>
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <?php if (!empty($user['data']['photo'])): ?>
                                        <img src="<?= $user['data']['photo'] ?>" class="img-fluid mt-3"
                                            style="max-width: 180px;" alt="">
                                    <?php else: ?>
                                        <p class="m-0">No photo available</p>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-title">@<?= htmlspecialchars($user['data']['name']) ?></h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Name: <?= htmlspecialchars($user['data']['name']) ?></li>
                                        <li class="list-group-item">Gender: <?= htmlspecialchars($user['data']['sex']) ?></li>
                                        <li class="list-group-item">Email: <?= htmlspecialchars($user['data']['email']) ?></li>
                                        <li class="list-group-item">Mobile: <?= htmlspecialchars($user['data']['phone']) ?></li>
                                        <li class="list-group-item">Address: <?= htmlspecialchars($user['data']['address']) ?></li>
                                        <li class="list-group-item">Joining Date: <?= htmlspecialchars($user['data']['created_at']) ?></li>
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
