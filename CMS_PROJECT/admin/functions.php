<?php


function escape($string) {
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}


function users_online(){


    if(isset($_GET['onlineusers'])){

    

    global $connection;

    if(!$connection){
        session_start();
        require '../connection.php';
        $session = session_id();
        $time = time();
        $time_out_in_seconds = 05;
        $time_out = $time - $time_out_in_seconds;


        $query = "SELECT * FROM users_online WHERE session = '$session'";
        $send_query = mysqli_query($connection, $query);
        $count = mysqli_num_rows($send_query);

        if($count == NULL){
            mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session','$time')");
        }else{
            mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
        }
        $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
        echo $count_user = mysqli_num_rows($users_online_query);

        }
    
 
        }   //Get Isset()
}

users_online();



function confirm($result){
    global $connection;
    if(!$result){
        die("QUERY FAILED . " . mysqli_error($connection));
    }

}





function insert_categories()
{
    global $connection;
    if(isset($_POST['submit']))
    {
        if(isset($_SESSION['user_role'])){
            if($_SESSION['user_role'] == 'admin'){
                $cat_title = $_POST['cat_title'];
                if($cat_title == "" || empty($cat_title))
                {
                echo "This feild should not be empty";
                }
                else
                {
                $query = "INSERT INTO categories(cat_title)";
                $query .="VALUES('$cat_title')";
                $create_category_query = mysqli_query($connection, $query);
                if(!$create_category_query)
                    {
                        die('QUERY FAILED' . mysqli_error($connection));
                    }
                }
            }
        }
    }
}
function findAllCategories()
{
    global $connection;
    ///QUERY FOR ALL CATEGORIES
        $query = "SELECT * FROM categories";
        $result = mysqli_query($connection, $query);
        
        while($row = mysqli_fetch_assoc($result))
        {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        

        ?>

        <tr>

            <td><?php echo $cat_id ?></td>
            <td><?php echo $cat_title ?></td>
            <td><?php echo "<a href='categories.php?delete={$cat_id}'>Delete</a>" ?></td>
            <td><?php echo "<a href='categories.php?edit={$cat_id}'>Edit</a>" ?></td>
        </tr>
        <?php
        }
        
            
}

function deleteCategories(){
    if(isset($_GET['delete']))
    {
        if(isset($_SESSION['user_role'])){
            if($_SESSION['user_role'] == 'admin'){
            global $connection;
            $the_cate_id = $_GET['delete'];
            $query = "DELETE FROM categories WHERE cat_id = $the_cate_id ";
            $delete_query = mysqli_query($connection, $query);
            header("location: categories.php");
            exit();
            }
        }
    } 
}





?>