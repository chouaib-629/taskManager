<?php
    declare(strict_types=1);

    // model
    function delete_task(object $pdo, string $id) : void {
        $query = "DELETE FROM tasks WHERE id = :id;";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        $stmt = null;
    }