<?php
session_start();
require_once '../../database/CategoryController.php';

$catgeory = new CategoryController();

if (isset($_POST['submit'])) {
    $catgeory->store($_POST['name']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Management | Expense Category</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>
    <?php include('../partials/sidebar.php') ?>


    <!-- Main content -->
    <div class="main">
        <div class="header">
            <h1>Expense Category New</h1>
        </div>
        <form style="width: 500px;" method="POST">
            <?php if (!empty($catgeory->error)): ?>
                <p class="form-error">
                    <?php echo $catgeory->error ?>
                </p>
            <?php endif; ?>
            <div class="form-group">
                <label for="" class="form-label">Name</label>
                <input type="text" class="form-input" name="name">
            </div>
            <button class="form-button" type="submit" name="submit">Save</button>
        </form>
    </div>
</body>

</html>