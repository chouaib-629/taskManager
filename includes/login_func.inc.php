<?php
    declare(strict_types=1);

    // conroller
    function fields_areEmpty_login(string $username, string $pwd) : bool {
        if (empty($username) || empty($pwd)) {
            return true;
        }
        return false;
    }

    function username_isWrong(array|false $result) : bool {
        if (!$result) {
            return true;
        }
        return false;
    }
    
    function password_isWrong(string $pwd, string $hashPwd) : bool {
        if (!password_verify($pwd, $hashPwd)) {
            return true;
        }
        return false;
    }

    // model
    function get_user(object $pdo, string $username) : array|false {
        $query = "SELECT * FROM users WHERE username = :username;";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":username", $username);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    // view
    function check_login_errors() : void {
        if ($_SESSION['login_errors']) {
            $errors = $_SESSION['login_errors'];

            echo "<br>";
            foreach ($errors as $error) {
                echo "<p class='form-errors'>" . $error . "</p>";
            }
        }
        print_r($_SESSION);
        unset($_SESSION['login_errors']);
    }

    // TODO: if an error accord we save the username if passed the check error
    function login_fields() : void {
        
    }