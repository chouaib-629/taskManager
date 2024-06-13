<?php
    declare(strict_types=1);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $pwd = $_POST['pwd'];

        try {
            require_once 'dbHandler.inc.php';
            require_once 'login_func.inc.php';

            // errors handler
            $login_errors = [];
            if (fields_areEmpty_login($username, $pwd)) {
                $login_errors['empty_fields'] = 'Please fill in all the fields!';
            }

            $result = get_user($pdo, $username);
            
            if ($result) {
                if (username_isWrong($result)) {
                    $login_errors['username_wrong'] = 'wrong username!';
                }

                if (password_isWrong($pwd, $result['pwd'])) {
                    $login_errors['password_wrong'] = 'password wrong!';
                }

                session_start();
                if ($login_errors) {
                    $_SESSION['login_errors'] = $login_errors;

                    $login_data = [
                        'username' => $username,
                    ];

                    $_SESSION['login_data'] = $login_data;

                    header("Location: ../index.php?login=error");
                    die();
                }

                $_SESSION['user_id'] = $result['id'];
                $_SESSION['user_username'] = $result['username'];
            } else {
                header('Location: ../index.php?user=error');
                die();
            }

            $pdo = null;
            header('Location: ../index.php?login=true');
            header("Location: ../dashboard.php");
            die();
            
        } catch (PDOException $error ) {
            die("Query failed: " . $error->getMessage());
        }
    } else {
        header("Location: ../index.php");
        die();
    }