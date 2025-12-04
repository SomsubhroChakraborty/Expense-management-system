<?php
session_start();
require_once '../../database/CategoryController.php';

$category = new CategoryController();

if (isset($_GET['delete_id'])) {
    $category->destroy(intval($_GET['delete_id']));
    exit();
}

$result = $category->index();
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
            <h1>Expense Category</h1>
            <a class="primary" href="create-category.php">Create Category</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $cat): ?>
                    <tr>
                        <td><?php echo $cat['name'] ?></td>
                        <td>
                            <a class="primary" href="update-category.php?id=<?php echo $cat['id'] ?>">Edit</a>
                            <a class="danger" onclick="return confirm('Are you sure you want to delete this category?');" href="category.php?delete_id=<?php echo $cat['id'] ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>