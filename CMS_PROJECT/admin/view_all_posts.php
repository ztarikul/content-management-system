<?php
if(isset($_POST['checkBoxArray'])){
    foreach($_POST['checkBoxArray'] as $postValueId){
        $bulk_options = $_POST['bulk_options'];

        switch($bulk_options){
            case 'published':
              $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} " ;

              $update_to_published_status = mysqli_query($connection, $query);
              confirm($update_to_published_status);
              break;

            case 'draft':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} " ;

                $update_to_draft_status = mysqli_query($connection, $query);
                confirm($update_to_draft_status);
                break;  
            
            case 'delete':
                $query = "DELETE FROM posts WHERE post_id = {$postValueId}";
                $update_to_delete_status = mysqli_query($connection, $query);
                confirm($update_to_delete_status);
                break;


            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}' ";
                $post_post_query = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($post_post_query))
                {
                    $post_user = $row['post_user'];
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_date = $row['post_date'];
                    $post_content = $row['post_content'];
                    $post_comment_count = $row['post_comment_count'];

                
                }

                $query = "INSERT INTO posts(post_category_id, post_title, post_user, post_date, post_image, post_content, post_tags, post_comment_count, post_status)";
                $query .= "VALUES({$post_category_id},'{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_comment_count}','{$post_status}') ";

                $copy_query = mysqli_query($connection, $query);

                if(!$copy_query){
                    die("QUERY FAILED" . mysqli_error($connection));
                }

                break;

        }
    }
}


?>



<form action="" method="post">
<table class="table table-bordered table-hover">
    <div id="bulkOptionsContainer" class="col-xs-4">
        <select class="form-control" name="bulk_options" id="">
            <option value="">Select Options</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
            <option value="clone">Clone</option>
        </select>
    
    </div>

<div class="col-xs-4">
    <input type="submit" name="submit" class="btn btn-success" value="Apply">
    <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
</div>




    <thead>
        <tr>
            <th><input id="selectAllBoxes" type="checkbox"></th>
            <th>ID</th>
            <th>User</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>View Post</th>         
            <th>Edit</th>
            <th>Delete </th>
            <th>Viewers</th>

        </tr>
    </thead>
    <tbody>
    <?php
    $query = "SELECT * FROM posts ORDER BY post_id DESC ";
    $post_query = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($post_query))
    {
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_user = $row['post_user'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
        $post_views_count = $row['post_views_count'];
    
    ?>



        <tr>
            <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $post_id; ?>"></td>
            <td><?php echo $post_id ?></td>

            <?php
            if(!empty($post_author)) {
                echo "<td>$post_author</td>";
            }elseif(!empty($post_user)){
                echo "<td>$post_user</td>";
            }

            ?>




            <td><?php echo $post_title ?></td> 

            <?php
                $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
                $select_categories_id = mysqli_query($connection, $query);
                
                while($row = mysqli_fetch_assoc($select_categories_id))
                {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                
            ?>
            <td><?php echo $cat_title; ?></td>

            <?php } ?>

            <td><?php echo $post_status ?></td>
            <td><?php echo "<img width='100' src='../image/$post_image' alt='image'>" ?></td>
            <td><?php echo $post_tags ?></td>
            
            <?php
            $query = "SELECT * FROM comments WHERE comment_post_id = $post_id ";
            $send_conmment_query = mysqli_query($connection, $query);
            $row = mysqli_fetch_array($send_conmment_query);
            $comment_id = $row['comment_id'];
            $count_comments = mysqli_num_rows($send_conmment_query);
            
            ?>

            <td><?php echo "<a href='post_comments.php?id=$post_id'>$count_comments</a>" ?></td>


            <td><?php echo $post_date ?></td>
            <td><?php echo "<a href='../posts.php?p_id={$post_id}'>View Post</a>" ?></td>
            <td><?php echo "<a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a>" ?></td>
            <td><?php echo "<a onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='posts.php?delete={$post_id}'>Delete</a>" ?></td>
            <td><?php echo "<a href='posts.php?reset={$post_id}'>{$post_views_count}</a>"?></td>
            
        </tr>

    <?php } ?>
    </tbody>
    </table>
</form>

    <?php
        if(isset($_GET['delete'])){
            if(isset($_SESSION['user_role'])){
                if($_SESSION['user_role'] == 'admin'){
                $the_post_id = $_GET['delete'];
                $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
                $delete_query = mysqli_query($connection, $query);
                header("location: posts.php");
                exit();
                }
            }
        }

        if(isset($_GET['reset'])){
            if(isset($_SESSION['user_role'])){
                if($_SESSION['user_role'] == 'admin'){
                $the_post_id = $_GET['reset'];
                $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = " . mysqli_real_escape_string($connection, $_GET['reset']) . " ";
                $reset_query = mysqli_query($connection, $query);
                header("location: posts.php");
                exit();
                }
            }
        }
    ?>