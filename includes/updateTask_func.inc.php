<?php
    declare(strict_types=1);

    // controller
    function fields_areEmpty_updateTask(string $id, string $title, string $description, string $category, string $deadline, string $status) : bool {
        if (empty($id) || empty($title) || empty($description) || empty($category) || empty($deadline) || empty($status)) {
            return true;
        }
        return false;
    }

    // model 
    function update_task(object $pdo, string $task_id, string $title, string $description, string $category, string $deadline, string $status) : void {
        $query = "UPDATE tasks SET title = :title, description = :description, category_id = :category, deadline = :deadline, status = :status WHERE id = :id;";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(':id', $task_id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':deadline', $deadline);
        $stmt->bindParam(':status', $status);

        $stmt->execute();

        $stmt = null;
    }

    // view
    function check_updateTask_errors() : void {
        if (isset($_SESSION['updateTask_errors'])) {
            $errors = $_SESSION['updateTask_errors'];

            echo "<br>";
            foreach ($errors as $error) {
                echo "<p class='form-error'>" . $error . "</p>";
            }
            unset($_SESSION['updateTask_errors']);
        }
    }