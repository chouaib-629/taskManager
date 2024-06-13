<?php
    declare(strict_types=1);

    // controller
    function fields_areEmpty_addTask(string $title, string $description, string $category, string $deadline, string $status) : bool {
        if (empty($title) || empty($description) || empty($category) || empty($deadline) || empty($status)) {
            return true;
        }
        return false;
    }
    
    function create_task(object $pdo, int $user_id, string $title, string $description, string $category, string $deadline, string $status) : void {
        echo $user_id;
        set_task($pdo, $user_id, $title, $description, $category, $deadline, $status);
    }

    // model
    function get_categories(object $pdo) : array|false {
        $query = "SELECT id, title FROM categories;";

        $stmt = $pdo->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;

        return $result;
    }

    function set_task(object $pdo, int $user_id, string $title, string $description, string $category, string $deadline, string $status) : void {
        $query = "INSERT INTO tasks (user_id, title, description, category_id, deadline, status) VALUES (:user_id, :title, :description, :category, :deadline, :status);";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':title', ucfirst($title));
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':deadline', $deadline);
        $stmt->bindParam(':status', $status);

        $stmt->execute();

        $stmt = null;
    }

    function get_tasks(object $pdo, int $user_id) : array|false {
        $query = "SELECT id, title, description, category_id, deadline, status FROM tasks WHERE user_id = :user_id;";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(':user_id', $user_id);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;

        return $result; 
    }

    function get_category_name(object $pdo, int $category_id) : string{
        $query = "SELECT title FROM categories WHERE id = :category_id;";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(':category_id', $category_id);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;

        return $result['title'];  
    }

    // view
    function show_categories(object $pdo) : void {
        $categories = get_categories($pdo);

        if ($categories) {
            foreach ($categories as $category) {
                echo "<option value='" . $category['id'] . "'>" . $category['title'] . "</option>";
            }
        } else {
            echo "<option value=''>Select Category</option>";
        }   
    }

    function show_categories_printedInString(object $pdo) : string {
        $categories = get_categories($pdo);

        if ($categories) {
            $options_string = '';
            foreach ($categories as $category) {
                $options_string =  $options_string . "<option value='" . $category['id'] . "'>" . $category['title'] . "</option><br>";
            }
            return $options_string;
        } else {
            return "<option value=''>Select Category</option>";
        }   
    }

    function check_addTask_errors() : void {
        if (isset($_SESSION['addTask_errors'])) {
            $errors = $_SESSION['addTask_errors'];

            echo "<br>";
            foreach ($errors as $error) {
                echo "<p class='form-error'>" . $error . "</p>";
            }
            unset($_SESSION['addTask_errors']);
        }
    }

    // TODO: get back taped data if there is an error
    function addTask_fields() : void {

    }

    function show_tasks(object $pdo, int $user_id) : void {
    $tasks = get_tasks($pdo, $user_id);
        if ($tasks) {
            require_once 'taskHandler.inc.php';
            require_once 'addCategory_func.inc.php';
            
            echo "<ul>";
            foreach ($tasks as $task) {
                $categoryName = htmlspecialchars(get_category_name($pdo, $task['category_id']));
                $title = htmlspecialchars($task['title']);
                $description = htmlspecialchars($task['description']);
                $deadline = htmlspecialchars($task['deadline']);
                $status = htmlspecialchars($task['status']);
                $options_string = show_categories_printedInString($pdo);
                
                echo "
                <li class='task-item'>
                    <div class='container-p'>
                        <p><strong>Title</strong>: <strong class='title'>" .  $title . "</strong></p>   
                        <p>" .  $description . "</p> 
                        <div class='container-ligne'>
                            <p><strong>Category:</strong> " . $categoryName . "</p> 
                            <p><strong>Deadline: </strong>" .  $deadline . "</p>
                            <p><strong>Status: </strong>" . $status . "</p>
                        </div>
                    </div>
                    <div class='container-btn'>
                        <button id='update-btn' class='update-btn-form'>Update</button>
                        <button id='delete-btn' class='delete-btn delete-btn-form'>Delete</button>
                    </div>
                </li>
                
                <div id='update-container' class='update-container'>
                    <div id='update-content'>
                        <div class='update-form'>  
                            <form action='includes/updateTask.inc.php' method='post'>
                                <h1>Update Task</h1>
                                <input type='text' name='id' value='" . $task['id'] . "' hidden>   

                                <label for='title'>Title:</label>
                                <input type='text' name='title' placeholder='Title' id='title' value='" .  $title . "'>

                                <label for='description'>Description:</label>
                                <textarea name='description' placeholder='Description' rows='3' cols='40'  id='description' value='" .  $description . "'>" .  $description . "</textarea>    

                                <label for='category-list'>Category:</label>
                                <select name='category' id='category-list'>
                                    <option value='" . $task['category_id'] . "' selected>" . $categoryName . "</option> 
                                    " . $options_string . "
                                </select>   

                                <label for='deadline'>Deadline:</label>
                                <input type='date' name='deadline' id='deadline' value='" .  $deadline . "'>    
                                    
                                <label for='status'>Status:</label>
                                <select name='status' id='status'>
                                    <option value='" . $status . "' selected>" . $status . "</option>  
                                    <option value='not started'>not started</option>
                                    <option value='in progress'>in progress</option>
                                    <option value='completed'>completed</option>
                                </select>

                                <button type='submit'>Update</button>  
                            </form>
                        </div>
                    </div>
                </div>

                <div id='delete-container' class='delete-container'>
                    <div id='delete-content'>
                        <div class='delete-form'> 
                            <form action='includes/deleteTask.inc.php' method='post'>  
                                <h1>Delete Task</h1>
                                <input type='text' name='id' value='" . $task['id'] . "' hidden>   
                                <label for='title'>Title:</label>
                                <input type='text' name='title' id='title' value='" .  $title . "' disabled>  
                                <button type='submit' class='delete-btn'>Delete</button>  
                            </form>  
                        </div>
                    </div>
                </div>
                
                <script type='module' src='js/taskList.js'></script>";
            }  
            echo "</ul>";      
        } else {
            echo "<p class='empty-list'>There is no tasks yet!<br>Fill free to add some. :)</p>";
        }
    }