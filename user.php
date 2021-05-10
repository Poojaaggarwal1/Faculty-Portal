<?php include "static/header.php"?>
<?php

    if(isset($_POST["proceed"])) #if user clicked on Initiate/Apply
    {
        if($_POST["proceed"]=="apply")
        {
            header("Location: apply_leave.php");
            exit;
        }
        else if ($_POST["proceed"]=="view")
        {
            header("Location: applications.php");
            exit;
        }
    }

    session_start();
    $id = $_SESSION["id"];
    $query = "SELECT name,email,position,dept FROM users WHERE userid='$id' ";
    $result = pg_query($db_connection, $query);

    $row = pg_fetch_row($result);

    $name=$row[0];
    $email=$row[1];
    $position=$row[2];
    $department=$row[3];

    $_SESSION["user_position"] = $position;
    $_SESSION["user_dept"] = $department;
?>
<div class="container shadow border mt-5 p-4">
    <div class="row">
        <div class="col">Name</div>
        <div class="col"><?php echo $name;?></div>
        <div class="w-100"></div>
        <div class="col">Email</div>
        <div class="col"><?php echo $email;?></div>
        <div class="w-100"></div>
        <div class="col">Position</div>
        <div class="col"><?php echo $position;?></div>
        <div class="w-100"></div>
        <div class="col">Department</div>
        <div class="col"><?php echo $department;?></div>
    </div>
</div>

<?php
    if($position != 'Director') # User's leave application section
    {
?>
        <div class="container shadow mt-5 border p-4">
            <h3 class="mb-4">My Leave Applications</h3>
            <div class="btn-group" role="group">
            <form action="user.php" method="post">
            <button type="submit" class="btn btn-dark border border-white mx-auto" name="proceed" value="view">View Previous Applications</button>
            <button type="submit" class="btn btn-dark border border-white mx-auto" name="proceed" value="apply">Initiate Leave Application</button>
            </form>
            </div>
        </div>
<?php
    }
?>
<?php
    if($position == 'HOD' || $position == 'Dean FA' || $position == 'Director') # Management of other's applications
    {
?>
        <div class="container shadow mt-5 border p-4">
            <h3 class="mb-4">Manage Faculty Applications</h3>
            <div class="btn-group" role="group">
                <form action="manage_applications.php" method="post">
                    <button type="submit" class="btn btn-dark border border-white mx-auto" name="application" value="view">View Applications</button>
                </form>
            </div>
        </div>
<?php
    }
?>

<?php
    if($position == 'Director') # Change positions
    {
?>
        <div class="container shadow mt-5 border p-4">
            <h3 class="mb-4">Faculty Role Management</h3>
            <form action="manage_positions.php" method="post">
                <button type="submit" class="btn btn-dark border border-white mx-auto" name="update-position">Faculty Position Management</button>
            </form>
        </div>
<?php
    }
?>

<?php include "static/footer.php"?>