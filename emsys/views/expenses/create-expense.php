<?php
session_start();
require_once '../../database/CategoryController.php';
require_once '../../database/ExpenseController.php';

$category = new CategoryController();
$expense = new ExpenseController();

$cats = $category->index();

if (isset($_POST['submit'])) {
    $expense->store($_POST['category_id'], $_POST['date'], $_POST['amount'], $_POST['description']);
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
            <h1>Expense New</h1>
        </div>
        <form style="width: 500px;" method="POST">
            <?php if (!empty($expense->error)): ?>
                <p class="form-error">
                    <?php echo $expense->error ?>
                </p>
            <?php endif; ?>
            <div class="form-group">
                <label for="category" class="form-label">Category</label>
                <select id="category" name="category_id" class="form-select">
                    <option value="">Select category</option>
                    <?php foreach ($cats as $cat): ?>
                        <option value="<?php echo $cat['id'] ?>"><?php echo $cat['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="" class="form-label">Date</label>
                <input type="date" class="form-input" name="date">
            </div>
            <div class="form-group">
                <label for="" class="form-label">Amount</label>
                <input type="number" class="form-input" name="amount">
            </div>
            <div class="form-group">
                <label for="" class="form-label">description</label>
                <textarea class="form-textarea" name="description"></textarea>
            </div>
            <button class="form-button" type="submit" name="submit">Save</button>
        </form>
    </div>
</body>

</html>