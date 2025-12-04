<?php
session_start();
require_once '../../database/ExpenseController.php';

$expense = new ExpenseController();

if (isset($_GET['delete_id'])) {
    $expense->destroy(intval($_GET['delete_id']));
    exit();
}

$result = $expense->index();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Management | Dashboard</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>
    <?php include('../partials/sidebar.php') ?>


    <!-- Main content -->
    <div class="main">
        <div class="header">
            <h1>Expenses</h1>
            <a class="primary" href="/views/expenses/create-expense.php">Create Expense</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $exp): ?>
                    <tr>
                        <td><?php echo $exp['date'] ?></td>
                        <td><?php echo $exp['category_name'] ?></td>
                        <td><?php echo $exp['description'] ?></td>
                        <td>&#8377; <?php echo number_format($exp['amount'], 2) ?></td>
                        <td>
                            <a class="primary" href="update-expense.php?id=<?php echo $exp['id'] ?>">Edit</a>
                            <a class="danger" onclick="return confirm('Are you sure you want to delete this expense?');" href="expense.php?delete_id=<?php echo $exp['id'] ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>