<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Search</h4>
        <form action="search.php" method="post">
        <div class="form-group">
            <input name="search" type="text" class="form-control">
        </div>
        <div class="input-group">
            <button class="btn btn-primary" name="submit" type="submit"> Submit
            </button> 
        </div>  
        
        </form>
    </div>
    <div class="well">
        <h4>Login</h4>
        <form action="login.php" method="post">
        <div class="form-group">
            <input name="username" type="text" class="form-control" placeholder="Enter Username">   
        </div>
        <div class="input-group">
            <input name="password" type="password" class="form-control" placeholder="Enter Password">   

            <span class="input-group-btn">
            <button class="btn btn-primary" name="login" type="submit"> Submit
            </button>
            </span>
        </div>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->


<div class="well">
    <?php 
    $query = "SELECT * FROM categories";
    $result = mysqli_query($connection, $query);
    
    ?>
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                <?php
                while($row = mysqli_fetch_assoc($result))
                {
                $cat_title = $row['cat_title'];
                $cat_id = $row['cat_id'];
                echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                }

                ?>
                </ul>
            </div>
        </div>
            
            
    </div>
        <?php require'widget.php' ?>
</div>