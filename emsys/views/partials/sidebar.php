<aside class="sidebar">
    <h2>EMS</h2>
    <a class="<?php echo (basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'primary' : '') ?>" href="/views/dashboard.php">Dashboard</a>
    <a class="<?php echo (basename($_SERVER['PHP_SELF']) == 'category.php' ? 'primary' : '') ?>" href="/views/expenses/category.php">Category</a>
    <a class="<?php echo (basename($_SERVER['PHP_SELF']) == 'expense.php' ? 'primary' : '') ?>" href="/views/expenses/expense.php">Expenses</a>
    <a href="/views/auth/logout.php">Logout</a>
</aside>