<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Edit</th>
            <th>Delete</th>

        </tr>
    </thead>
    <tbody>
    <?php
    $query = "SELECT * FROM posts";
    $post_query = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($post_query))
    {
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
    
    ?>



        <tr>
            <td><?php echo $post_id ?></td>
            <td><?php echo $post_author ?></td>
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
            <td><?php echo $post_comment_count ?></td>
            <td><?php echo $post_date ?></td>
            <td><?php echo "<a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a>" ?></td>
            <td><?php echo "<a href='posts.php?delete={$post_id}'>Delete</a>" ?></td>
            
        </tr>

    <?php } ?>
    </tbody>
    </table>

    <?php
        if(isset($_GET['delete'])){
            $the_post_id = $_GET['delete'];
            $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
            $delete_query = mysqli_query($connection, $query);
            header("location: posts.php");
            exit();
        }
    ?>