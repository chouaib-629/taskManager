<?php
    declare(strict_types=1);

    // controller
    function fields_areEmpty_addCategory(string $categoryTitle) : bool {
        if (empty($categoryTitle)) {
            return true;
        }
        return false;
    }

    function category_exist(object $pdo, string $categoryTitle) : bool {
        if (get_category($pdo, $categoryTitle)) {
            return true;
        }
        return false;
    }

    function create_category(object $pdo, string $categoryTitle) : void {
        set_category($pdo, $categoryTitle);
    }

    // model
    function get_category(object $pdo, string $categoryTitle) : array|false {
        $categoryTitle = ucfirst(strtolower($categoryTitle));
        
        $query = "SELECT title FROM categories WHERE title = :categoryTitle;";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(':categoryTitle', $categoryTitle);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null; 

        return $result;
    }

    function set_category(object $pdo, string $categoryTitle) : void {
        $categoryTitle = ucfirst(strtolower($categoryTitle));
        
        $query = "INSERT INTO categories (title) VALUES (:categoryTitle);";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(':categoryTitle', $categoryTitle);

        $stmt->execute();

        $stmt = null;
    }

    // view
    function check_addCategory_errors() : void {
        if (isset($_SESSION['addCategory_errors'])) {
            $errors = $_SESSION['addCategory_errors'];

            echo "<br>";
            foreach ($errors as $error) {
                echo "<p class='form-error'>" . $error . "</p>";
            }
            unset($_SESSION['addCategory_errors']);
        }
    }