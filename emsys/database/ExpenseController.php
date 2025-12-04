<?php

require_once 'DBController.php';

class ExpenseController extends DBController
{
    public function index()
    {
        $id = $_SESSION['user_id'];
        $query = "SELECT expenses.*, categories.name AS category_name FROM expenses LEFT JOIN categories ON expenses.category_id = categories.id WHERE expenses.user_id = $id ORDER BY expenses.date DESC";
        return $this->executeQuery($query);
    }

    public function store($category_id, $date, $amount, $description)
    {
        if (empty($category_id) || empty($date) || empty($amount) || empty($description)) {
            $this->error = 'Please fill all fields';
            return;
        }
        $id = $_SESSION['user_id'];
        $query = "INSERT INTO expenses (user_id, category_id, amount, description, date) VALUES('$id','$category_id','$amount','$description','$date')";
        $this->executeQuery($query);
        header('Location: expense.php');
    }

    public function show($id)
    {
        $uid = $_SESSION['user_id'];
        $query = "SELECT * FROM expenses WHERE id = $id AND user_id = $uid";
        return $this->executeQuery($query)->fetch_assoc();
    }

    public function update($id, $category_id, $date, $amount, $description)
    {
        if (empty($category_id) || empty($date) || empty($amount) || empty($description)) {
            $this->error = 'Please fill all fields';
            return;
        }
        $uid = $_SESSION['user_id'];
        $query = "UPDATE expenses SET category_id = '$category_id', amount = '$amount', description = '$description', date = '$date' WHERE id = $id AND user_id = $uid";
        $this->executeQuery($query);
        header('Location: expense.php');
    }

    public function destroy($id)
    {
        $uid = $_SESSION['user_id'];
        $query = "DELETE FROM expenses WHERE id = $id AND user_id = $uid";
        $this->executeQuery($query);
        header('Location: expense.php');
    }
}
