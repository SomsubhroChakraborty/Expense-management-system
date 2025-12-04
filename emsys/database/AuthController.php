<?php

require_once 'DBController.php';

class AuthController extends DBController
{

    public function login($email, $password)
    {
        session_start();

        if (empty($email) || empty($password)) {
            $this->error = 'Please fill all fields';
            return;
        }

        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = $this->executeQuery($query);
        $user = $result->fetch_assoc();

        if (!password_verify($password, $user['password'])) {
            $this->error = 'Invalid email or password';
            return;
        }
        $_SESSION['loggedin'] = true;
        $_SESSION['name'] = $user['name'];
        $_SESSION['user_id'] = $user['id'];
        header('Location: ../dashboard.php');
    }

    public function register($name, $email, $password, $cpassword)
    {
        session_start();

        if (empty($name) || empty($email) || empty($password) || empty($cpassword)) {
            $this->error = 'Please fill all fields';
            return;
        }

        if ($password != $cpassword) {
            $this->error = 'Password does not match';
            return;
        }
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (name, email, password) VALUES('$name','$email','$hashed')";
        $this->executeQuery($query);
        $this->login($email, $password);
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: login.php");
        exit();
    }
}
