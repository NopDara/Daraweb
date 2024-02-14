<?php include('includes/header.php'); ?>

<?php

$users_id = isset($_SESSION['users_id']) ? $_SESSION['users_id'] : null;
$user = getById('users', $users_id);

// Additional user information
$name = isset($user['data']['name']) ? htmlspecialchars($user['data']['name']) : '';
$email = isset($user['data']['email']) ? htmlspecialchars($user['data']['email']) : '';
$address = isset($user['data']['address']) ? htmlspecialchars($user['data']['address']) : '';
$phone = isset($user['data']['phone']) ? htmlspecialchars($user['data']['phone']) : '';
$photo = isset($user['data']['photo']) ? htmlspecialchars($user['data']['photo']) : '';
$role= isset($user['data']['role']) ? htmlspecialchars($user['data']['role']) : '';
$sex = isset($user['data']['sex']) ? htmlspecialchars($user['data']['sex']) : '';
$joining_at = isset($user['data']['create_at']) ? htmlspecialchars($user['data']['create_at']) : '';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Add your CSS links or styles here -->
</head>

<body>
    <header>
        <h4>User Profile</h4>
    </header>
    <main class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <div class="d-flex align-items-center justify-content-center mb-3 mt-3">
                <img src="<?= $photo ?>" class="img-fluid rounded-circle" style="max-width: 230px; border-radius: 5px;" alt="User Photo">
            </div>
        </div>
        <div class="col-md-6">
            <div class="user-details">
                <h2 class="mb-4">Welcome, <?= $name; ?>!</h2>
                <ul class="list-unstyled">
                    <li><strong>Role:</strong> <?= $role; ?></li>
                    <li><strong>Email:</strong> <?= $email; ?></li>
                    <li><strong>Mobile:</strong> <?= $phone; ?></li>
                    <li><strong>Gender:</strong> <?= $sex; ?></li>
                    <li><strong>Address:</strong> <?= $address; ?></li>
                    <li><strong>Joining Date:</strong> <?= $joining_at; ?></li>
                </ul>
                <a href="prf-edit.php?id=<?= $user['data']['id']; ?>" class="btn btn-secondary btn-sm">Edit Profile</a>
            </div>
        </div>
    </div>
</main>






    <?php include('includes/footer.php'); ?>
</body>

</html>