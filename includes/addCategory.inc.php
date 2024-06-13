<?php
    declare(strict_types=1);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $categoryTitle = $_POST['category-title'];
        try {
            require_once 'dbHandler.inc.php';
            require_once 'addCategory_func.inc.php';
            
            // errors handler
            $addCategory_errors = [];
            if (fields_areEmpty_addCategory($categoryTitle)) {
                $addCategory_errors['empty_fields'] = "Please fill in all fields!";
            }

            if (category_exist($pdo, $categoryTitle)) {
                $addCategory_errors['category_exist'] = 'Category already exists!';
            }

            session_start();
            if ($addCategory_errors) {
                $_SESSION['addCategory_errors'] = $addCategory_errors;

                header('Location: ../dashboard.php?addCategory=error');
                die();
            }

            create_category($pdo, $categoryTitle);

            $pdo = null;
            header('Location: ../dashboard.php?category=added');
            die();
            
        } catch (PDOException $error) {
            die("Query failed: " . $error->getMessage());
        }
    } else {
        header('Location: ../dashboard.php');
        die();
    }