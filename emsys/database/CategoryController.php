<?php
require_once 'DBController.php';

class CategoryController extends DBController
{
    public function index()
    {
        $id = $_SESSION['user_id'];
        $query = "SELECT * FROM categories WHERE user_id = $id";
        return $this->executeQuery($query);
    }

    public function store($name)
    {
        if (empty($name)) {
            $this->error = 'Please fill all fields';
            return;
        }
        $id = $_SESSION['user_id'];
        $query = "INSERT INTO categories (name, user_id) VALUES('$name','$id')";
        $this->executeQuery($query);
        header('Location: category.php');
    }

    public function show($id)
    {
        $uid = $_SESSION['user_id'];
        $query = "SELECT * FROM categories WHERE id = $id AND user_id = $uid";
        return $this->executeQuery($query)->fetch_assoc();
    }

    public function update($id, $name)
    {
        if (empty($name)) {
            $this->error = 'Please fill all fields';
            return;
        }
        $uid = $_SESSION['user_id'];
        $query = "UPDATE categories SET name = '$name' WHERE id = $id AND user_id = $uid";
        $this->executeQuery($query);
        header('Location: category.php');
    }

    public function destroy($id)
    {
        $uid = $_SESSION['user_id'];
        $query = "DELETE FROM categories WHERE id = $id AND user_id = $uid";
        $this->executeQuery($query);
        header('Location: category.php');
    }
}
