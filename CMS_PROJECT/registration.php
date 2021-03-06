<?php  require "header.php"; ?>


<?php

if(isset($_POST['submit'])){
    $username = escape($_POST['username']);
    $email = escape($_POST['email']);
    $password = escape($_POST['password']);

    if(!empty($username) && !empty($email) && !empty($password)){

        $username = mysqli_real_escape_string($connection, $username);
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);

        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
    
        // $query = "SELECT randSalt FROM users";
        // $select_randSalt_query = mysqli_query($connection, $query);
        // if(!$select_randSalt_query){
        //     die('QUERY FAILED' . mysqli_error($connection));
        // }
    
        // $row = mysqli_fetch_array($select_randSalt_query);
        // $salt = $row['randSalt'];

        // $password = crypt($password, $salt);

        $match_query = "SELECT * FROM users";
        $validation_reg = mysqli_query($connection, $match_query);
        while($row = mysqli_fetch_assoc($validation_reg)){
            $db_username = $row['username'];
            $db_email = $row['user_email'];

            if($db_username == $username || $db_email == $email)
            {
                $validation = 'False';
                break;
            }
            else{
                $validation = 'True';
            }
        }


        if($validation == 'True'){
            $query = "INSERT INTO users (username, user_email, user_password, user_role)";
            $query .= "VALUES('{$username}', '{$email}', '{$password}', 'subscriber')" ;
            $register_user_query = mysqli_query($connection, $query);
            if(!$register_user_query){
                die("QUERY FAILED" . mysqli_error($connection));
            }  
            $message = "Your Registration has been submitted";
        }
        else{
            $message = "Username or Email is not available";
        }
    
      

       

    }else{
        $message = "Fields cannot be empty";
    }

}else{
    $message = "";
}



?>

    <!-- Navigation -->
    
    <?php  include "nav.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">

                        <h6 class="text-center"><?php echo $message  ?></h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "footer.php";?>
