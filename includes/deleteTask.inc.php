<?php
    declare(strict_types=1);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];

        try {
            require_once 'dbHandler.inc.php';
            require_once 'deleteTask_func.inc.php';

            delete_task($pdo, $id);

            $pdo = null;
            header('Location: ../dashboard.php?deleteTask=true');
            die();

        } catch (PDOException $error) {
            die('Query failed: ' . $error->getMessage());
        }
    } else {
        header('Location: ../dashboard.php');
        die();
    } 