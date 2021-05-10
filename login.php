<?php include "static/login_header.php"?>

<?php

if(!$db_connection){
    echo "Couldn't connect to database";
}
else
{
    if(isset($_POST["submit"])){
        $id = $_POST["userid"];
        $password = $_POST["password"];
        $query = "SELECT userid,password FROM users WHERE userid='$id' and password='$password'";
        $result = pg_query($db_connection, $query);
    
        if($row = pg_fetch_row($result)) # User id and password verified 
        {
            session_start();
            $_SESSION['id'] = $id;
            header("Location: user.php");
            exit;
        }
        else # Could not match credentials
        {
?>
            <div class="alert alert-danger" role="alert">
            Please check your User ID and Password and try again.
            </div>
<?php
        }
    }
}
?>

<form class="mx-auto mt-5 border shadow py-5" action="login.php" method="POST" style="width:700px">
    <div class="form-group col-md-6 mx-auto">
    <label for="login-userid"> User ID</label>
    <input class="form-control" type="text" name="userid" id="login-userid" placeholder="Enter user id">
    </div>

    <div class="form-group col-md-6 mx-auto">
    <label for="login-password"> Password</label>
    <input class="form-control" type="password" name="password" id="login-password" placeholder="Enter password">
    </div>
    <div class="text-center">
    <button class="btn btn-dark" name="submit" type="submit">Login</button>
    </div>
</form>

<?php include "static/footer.php"; ?>
