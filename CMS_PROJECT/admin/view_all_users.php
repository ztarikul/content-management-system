<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>

        </tr>
    </thead>
    <tbody>
    <?php
    $query = "SELECT * FROM users";
    $select_users = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_users))
    {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
      
    ?>


        <tr>
            <td><?php echo $user_id ?></td>
            <td><?php echo $username ?></td>
            <td><?php echo $user_firstname ?></td>

            <?php
                // $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
                // $select_categories_id = mysqli_query($connection, $query);
                
                // while($row = mysqli_fetch_assoc($select_categories_id))
                // {
                // $cat_id = $row['cat_id'];
                // $cat_title = $row['cat_title'];
              
            ?>
            
            <td><?php echo $user_lastname; ?></td>
            <td><?php echo $user_email; ?></td>
            <td><?php echo $user_role; ?></td>
            
            <?php
            // $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
            // $select_post_id_query = mysqli_query($connection, $query);
            // while($row = mysqli_fetch_assoc($select_post_id_query)){
            //     $post_id = $row['post_id'];
            //     $post_title = $row['post_title'];

            ?>
            
            
            
            <?php// } ?>    
            <td><?php echo "<a href='users.php?changed_to_admin={$user_id}'>Admin</a>" ?></td>
            <td><?php echo "<a href='users.php?changed_to_sub={$user_id}'>Subscriber</a>" ?></td>
            <td><?php echo "<a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a>" ?></td>
            <td><?php echo "<a href='users.php?delete={$user_id}'>Delete</a>" ?></td>
            
            
        </tr>

    <?php } ?>
    </tbody>
    </table>

    <?php
        if(isset($_GET['changed_to_admin'])){
            $the_user_id = $_GET['changed_to_admin'];
            $query = "UPDATE users SET user_role= 'admin' WHERE user_id = $the_user_id ";
            $change_to_admin_query = mysqli_query($connection, $query);
            header("location: users.php");
            exit();
        }
    ?>


    <?php
        if(isset($_GET['changed_to_sub'])){
            $the_user_id = $_GET['changed_to_sub'];
            $query = "UPDATE users SET user_role= 'subscribe' WHERE user_id = $the_user_id";
            $change_to_sub_query = mysqli_query($connection, $query);
            header("location: users.php");
            exit();
        }
    ?>



    <?php
        if(isset($_GET['delete'])){
            $the_user_id = $_GET['delete'];
            $query = "DELETE FROM users WHERE user_id = {$the_user_id}";
            $delete_user_query = mysqli_query($connection, $query);
            header("location: users.php");
            exit();
        }
    ?>