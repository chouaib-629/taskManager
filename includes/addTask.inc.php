<?php
    declare(strict_types=1);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        $deadline = $_POST['deadline'];
        $status = $_POST['status'];

        try {
            require_once 'dbHandler.inc.php';
            require_once 'addTask_func.inc.php';

            // errors handler
            $updateTask_errors = [];
            if (fields_areEmpty_addTask($title, $description, $category, $deadline, $status)) {
                $updateTask_errors['empty_fields'] = 'Please fill in all the fields!';
            }

            session_start();
            if ($updateTask_errors) {
                $_SESSION['addTask_errors'] = $updateTask_errors;

                $updateTask_data = [
                    'title' => $title,
                    'description' => $description,
                    'category' => $category,
                    'deadline' => $deadline,
                    'status' => $status,
                ];

                $_SESSION['addTask_data'] = $updateTask_data;

                header('Location: ../dashboard.php?addTask=error');
                die();
            }

            $user_id = $_SESSION['user_id'];
            create_task($pdo, $user_id, $title, $description, $category, $deadline, $status);

            $pdo = null;
            header('Location: ../dashboard.php?addTask=true');
            die();

        } catch (PDOException $error) {
            die('Query failed: ' . $error->getMessage());
        }
    } else {
        header('Location: ../dashboard.php');
        die();
    }