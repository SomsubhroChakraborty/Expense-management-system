<?php
session_start();
require_once '../database/AuthController.php';
require_once '../database/ExpenseController.php';

$auth = new AuthController();
$expenseController = new ExpenseController();

if (!isset($_SESSION['loggedin'])) {
    header("Location: auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$totalExpensesQuery = "SELECT SUM(amount) as total FROM expenses WHERE user_id = $user_id";
$totalExpensesResult = $expenseController->executeQuery($totalExpensesQuery);
$totalExpensesRow = $totalExpensesResult->fetch_assoc();
$totalExpenses = $totalExpensesRow['total'] ?? 0;


$currentMonth = date('Y-m');
$monthlyExpensesQuery = "SELECT SUM(amount) as monthly_total FROM expenses WHERE user_id = $user_id AND DATE_FORMAT(date, '%Y-%m') = '$currentMonth'";
$monthlyExpensesResult = $expenseController->executeQuery($monthlyExpensesQuery);
$monthlyExpensesRow = $monthlyExpensesResult->fetch_assoc();
$monthlyExpenses = $monthlyExpensesRow['monthly_total'] ?? 0;


$pendingRequestsQuery = "SELECT COUNT(*) as pending FROM expenses WHERE user_id = $user_id AND DATE_FORMAT(date, '%Y-%m') = '$currentMonth'";
$pendingRequestsResult = $expenseController->executeQuery($pendingRequestsQuery);
$pendingRequestsRow = $pendingRequestsResult->fetch_assoc();
$pendingRequests = $pendingRequestsRow['pending'] ?? 0;

$recentExpensesQuery = "SELECT expenses.*, categories.name AS category 
                        FROM expenses 
                        LEFT JOIN categories ON expenses.category_id = categories.id 
                        WHERE expenses.user_id = $user_id 
                        ORDER BY expenses.date DESC 
                        LIMIT 10";
$recentExpensesResult = $expenseController->executeQuery($recentExpensesQuery);
$recentExpenses = [];
while ($row = $recentExpensesResult->fetch_assoc()) {
    $recentExpenses[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Management | Dashboard</title>
    <link rel="stylesheet" href="../views/assets/css/dashboard.css">
</head>

<body>
    <?php include('partials/sidebar.php') ?>

    <!-- Main content -->
    <div class="main">
        <div class="header">
            <h1>Dashboard</h1>
            <div class="user-info">Welcome, <?php echo htmlspecialchars($_SESSION['name']) ?></div>
        </div>

        <div class="cards">
            <div class="card">
                <h3>Total Expenses</h3>
                <p>&#8377; <?php echo number_format($totalExpenses, 2) ?></p>
            </div>
           
            <div class="card">
                <h3>This Month's Expenses</h3>
                <p><?php echo $pendingRequests ?></p>
            </div>
        </div>

        <h2 style="margin-bottom:1rem; color:#111827;">Recent Expenses</h2>
        
        <?php if (count($recentExpenses) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentExpenses as $expense): ?>
                        <tr>
                            <td><?= htmlspecialchars(date('M d, Y', strtotime($expense['date']))) ?></td>
                            <td><?= htmlspecialchars($expense['category'] ?? 'Uncategorized') ?></td>
                            <td><?= htmlspecialchars($expense['description']) ?></td>
                            <td>&#8377; <?= number_format($expense['amount'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div style="padding: 2rem; text-align: center; background: #f9fafb; border-radius: 0.5rem; color: #6b7280;">
                <p>No expenses recorded yet. </p>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>