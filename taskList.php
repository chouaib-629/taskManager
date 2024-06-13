<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset= UTF-8 >
    <meta name="viewport"  content="width=device-width, initial-scale=1.0" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="css/taskList_style.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Task List</title>
</head>
<body>
    <!-- for the forms i should replace all the values with the php func -->

    <ul>
        <!-- start foreach loop -->
        <li class='task-item'>
            <div class="container-p">
                <p>Title: <strong class='title'>title</strong></p>   
                <p>description</p> 
                <div class='container-ligne'>
                    <p><strong>Category:</strong> categoryName</p> 
                    <p><strong>Deadline:</strong> deadline</p>
                    <p><strong>Status:</strong> status</p>
                </div>
            </div>
            <div class='container-btn'>
                <button id='update-btn'>Update</button>
                <button id='delete-btn' class='delete-btn'>Delete</button>
            </div>
        </li>
        <li class='task-item'>
            <div class="container-p">
                <p>Title: <strong class='title'>title</strong></p>   
                <p>description</p> 
                <div class='container-ligne'>
                    <p><strong>Category:</strong> categoryName</p> 
                    <p><strong>Deadline:</strong> deadline</p>
                    <p><strong>Status:</strong> status</p>
                </div>
            </div>
            <div class='container-btn'>
                <button id='update-btn'>Update</button>
                <button id='delete-btn' class='delete-btn'>Delete</button>
            </div>
        </li>

        <!-- The update container -->
        <div id='update-container'>
            <!-- The update content -->
            <div id='update-content'>
                <div class='form-container update-form'>  
                    <form action='includes/updateTask.inc.php' method='post'>
                        <h1>Update Task</h1>
                        <input type='text' name='id' value='id' hidden> <!-- replace --> 

                        <label for='title'>Title:</label>
                        <input type='text' name='title' placeholder='Title' id='title' value='title'> <!-- replace --> 

                        <label for='description'>Description:</label>
                        <textarea name='description' placeholder='Description' rows='5' cols='40'  id= 'description' value='description'>description</textarea>  <!-- replace --> 

                        <label for='category-list'>Category:</label>
                        <select name='category' id='category-list'>
                            <option value='category_id' selected>category</option>  <!-- replace --> 
                            <!-- replace -->
                        </select>   

                        <label for='deadline'>Deadline:</label>
                        <input type='date' name='deadline' id='deadline' value='deadline'>  <!-- replace --> 
                            
                        <label for='status'>Status:</label>
                        <select name='status' id='status'>
                            <option value='status' selected>status</option> <!-- replace -->
                            <option value='not started'>not started</option>
                            <option value='in progress'>in progress</option>
                            <option value='completed'>completed</option>
                        </select>

                        <button type='submit'>Update</button>  
                    </form>   
                </div>
            </div>
        </div>

        <!-- The delete container -->
        <div id='delete-container'>
            <!-- The delete content -->
            <div id='delete-content'>
                <div class='form-container delete-form'> 
                    <form action='includes/deleteTask.inc.php' method='post'>  
                        <h1>Delete Task</h1>
                        <input type='text' name='id' value='id' hidden>  <!-- replace -->
                        <label for='title'>Title:</label>
                        <input type='text' name='title' id='title' value='title' disabled> <!-- replace -->
                        <button type='submit' class='delete-btn'>Delete</button>  
                    </form>  
                </div>
            </div>
        </div>
    <!-- end of the foreach loop -->
    </ul>

    <script type='module' src='js/taskList.js'></script>
</body>
</html>
<!-- <?php get_category_name($pdo, $category_id); ?>-->
<!-- <?php show_categories($pdo); ?> -->