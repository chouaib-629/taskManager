<?php
    require_once 'includes/dbHandler.inc.php';
    require_once 'includes/addCategory_func.inc.php';
    require_once 'includes/addTask_func.inc.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard_style.css">
    <link rel="stylesheet" href="css/taskList_style.css">
    <title>Task Manager | Dashboard</title>
</head>
<body>
    <header>
        <h1>Welcome to Your Dashboard</h1>
        <div class="user">
            <?php
                session_start();
                if (isset($_SESSION['user_username'])) {
                    echo "<h4>" . $_SESSION['user_username'] . "</h4>";
            ?>
                <a class="btn" href="logout.php">Logout</a>
            <?php
                } else {
                    header('Location: index.php');
                    die();
                }
            ?>
        </div>
    </header>

    <div class="global-container">
        <div class="add-forms-section">
            
            <div class="container" id="add-category-container">
                <div class="form-container" id="add-category-content">
                    <form action="includes/addCategory.inc.php" method="post">
                        <h1>Crate Category</h1>
                        <label for="category-title">Category Title: </label>
                        <input type="text" name="category-title" placeholder="Category Title" id="category-title">
                        <button>Crate</button>
                    </form>
                    <?php
                        check_addCategory_errors();
                    ?>
                </div>
            </div>
        
            <div class="container" id="add-task-container">
                <div class="form-container" id="add-task-content">
                    <form action="includes/addTask.inc.php" method="post">
                        <h1>Crate Task</h1>
                        <label for="title">Title: </label>
                        <input type="text" name="title" placeholder="Title" id="title">
                        <label for="description">Description: </label>
                        <textarea name="description" placeholder="Description" rows="3" cols="40" id="description"></textarea>
                        <label for="category-list">Category: </label>
                        <select name="category" id="category-list">
                            <?php
                                echo "<option value=''>Select Category</option>";
                                show_categories($pdo);
                            ?>
                        </select>
                        <label for="deadline">Deadline: </label>
                        <input type="date" name="deadline" id="deadline">
                        <label for="status">Status: </label>
                        <select name="status" id="status">
                            <option value=''>Select Status</option>
                            <option value="not started">not started</option>
                            <option value="in progress">in progress</option>
                            <option value="completed">completed</option>
                        </select>
                        <button>Create</button>
                    </form>
                    <?php
                        check_addTask_errors();
                    ?>
                </div>
            </div>
        </div>
        
        <div class="container">
            <div class="task-list-container">
                <div class="task-list-header">
                    <h1>List of Tasks</h1>
                    <div class="container-btn">
                        <button id="add-category-btn">Add Category</button>
                        <button id="add-task-btn">Add Task</button>
                    </div>
                </div>
                <?php
                    show_tasks($pdo, $_SESSION['user_id']);
                ?>
            </div>  
        </div>
    </div>

    <footer>
        <h4>All Rights Reserved © Created By <strong>Chouaib</strong></h4>
    </footer>

    <script src="js/addTask.js"></script>  
    <script src="js/addCategory.js"></script>  
</body>
</html>