<?php
    declare(strict_types=1);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        $deadline = $_POST['deadline'];
        $status = $_POST['status'];

        
        try {
            require_once 'dbHandler.inc.php';
            require_once 'updateTask_func.inc.php';
            
            // errors handler
            $updateTask_errors = [];
            if (fields_areEmpty_updateTask($id, $title, $description, $category, $deadline, $status)) {
                $updateTask_errors['empty_fields'] = 'Please fill in all the fields!';
            }

            session_start();
            if ($updateTask_errors) {
                $_SESSION['updateTask_errors'] = $updateTask_errors;

                $updateTask_data = [
                    'title' => $title,
                    'description' => $description,
                    'category' => $category,
                    'deadline' => $deadline,
                    'status' => $status,
                ];

                $_SESSION['updateTask_data'] = $updateTask_data;

                header('Location: ../dashboard.php?updateTask=error');
                die();
            }
            
            update_task($pdo, $id, $title, $description, $category, $deadline, $status);

            $pdo = null;
            header('Location: ../dashboard.php?updateTask=true');
            die();

        } catch (PDOException $error) {
            die('Query failed: ' . $error->getMessage());
        }
        
    } else {
        header('Location: ..dashboard.php');
        die();
    }
    