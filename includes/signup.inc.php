<?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $pwd = $_POST['pwd'];
        $email = $_POST['email'];

        try {
            require_once 'dbHandler.inc.php';
            require_once 'signup_func.inc.php';
            
            // errors handler
            $signupErrors = [];
            if (fields_areEmpty_signup($username, $pwd, $email)) {
                $signupErrors['emptyFields'] = 'Please fill in all the fields!';
            }
            
            if (username_isTaken($pdo, $username)) {
                $signupErrors['used_username'] = 'Used username!';
            }
            
            if (email_isTaken($pdo, $email)) {
                $signupErrors['used_email'] = 'Used email!';
            }
            
            if (email_isValid($email)) {
                $signupErrors['invalid_email'] = 'Invalid email!';
            }            

            session_start();
            if ($signupErrors) {
                $_SESSION['signup_errors'] = $signupErrors;

                $signup_data = [
                    'username' => $username,
                    'email' => $email,
                ];

                $_SESSION['signup_data'] = $signup_data;

                header("Location: ../index.php?signup=error");
                die();
            }

            create_user($pdo, $username, $pwd, $email);

            $pdo = null;

            header("Location: ../index.php?singup=true");
            die();

        } catch (PDOException $error) {
            
            die("Query failed: " . $error->getMessage());
        }
    } else {

        header("Location: ../index.php");
        die();
    }