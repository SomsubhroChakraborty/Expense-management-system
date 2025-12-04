<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
    header("Location: ../dashboard.php");
}

if (isset($_POST['submit'])) {
    require_once '../../database/AuthController.php';
    $auth = new AuthController();
    if ($auth->register($_POST['name'], $_POST['email'], $_POST['password'], $_POST['cpassword'])) {
        header("Location: index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Management || Register</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>
    <div class="hero-section">
        <form class="form" method="POST">
            <h1 class="form-heading">Register</h1>
            <?php if (!empty($auth->error)): ?>
                <p class="form-error">
                    <?php echo $auth->error ?>
                </p>
            <?php endif; ?>
            <div class="form-group">
                <label for="" class="form-label">Name</label>
                <input type="text" class="form-input" name="name">
            </div>
            <div class="form-group">
                <label for="" class="form-label">Email</label>
                <input type="email" class="form-input" name="email">
            </div>
            <div class="form-group">
                <label for="" class="form-label">Password</label>
                <input type="password" class="form-input" name="password">
            </div>
            <div class="form-group">
                <label for="" class="form-label">Confirm Password</label>
                <input type="password" class="form-input" name="cpassword">
            </div>
            <p class="form-subtext">Already have an account? <a href="login.php">Login</a></p>
            <button class="form-button" type="submit" name="submit">Register</button>
        </form>
    </div>
</body>

</html>