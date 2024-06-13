<?php 

    declare(strict_types=1);

    // controller
    function fields_areEmpty_signup(string $username, string $password, string $email) : bool {
        if (empty($username) || empty($password) || empty($email)) {
            return true;
        }
        return false;
    }

    function username_isTaken(object $pdo, string $username) : bool {
        if (get_username($pdo, $username)) {
            return true;
        }
        return false;
    }

    function email_isTaken(object $pdo, string $email) : bool {
        if (get_email($pdo, $email)) {
            return true;
        }
        return false;
    }

    function email_isValid(string $email) : bool {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    function create_user(object $pdo, string $username, string $pwd, string $email) : void {
        set_user($pdo, $username, $pwd, $email);
    }

    // model
    function get_username(object $pdo, string $username) : array|false {
        $query = "SELECT username FROM users WHERE username = :username;";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":username", $username);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;

        return $result;
    }

    function get_email(object $pdo, string $email) : array|false {
        $query = "SELECT email FROM users WHERE email = :email;";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":email", $email);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;

        return $result;
    }

    function set_user(object $pdo, string $username, string $pwd, string $email) : void {
        $query = "INSERT INTO users (username, pwd, email) VALUES (:username, :pwd, :email);";

        $stmt = $pdo->prepare($query);

        $options = [
            'cost' => 10,
        ];

        $hashPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':pwd', $hashPwd);
        $stmt->bindParam(':email', $email);

        $stmt->execute();

        $stmt = null;
    }

    // view
    function check_signup_errors() : void {
        if (isset($_SESSION['signup_errors'])) {
            $errors = $_SESSION['signup_errors'];

            echo "<br>";
            foreach ($errors as $error) {
                echo "<p class='form-errors'>" . $error . "</p>";
            }
        }
        unset($_SESSION['signup_errors']);
    }