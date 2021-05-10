<?php include "static/header.php"?>

<?php         
    if(isset($_POST['Dean_AA'])){
        $new_dean_id = $_POST['Dean_AA'];

        $query_to_remove = "UPDATE users SET position='Faculty' where position='Dean AA'";
        $query_to_appoint = "UPDATE users SET position='Dean AA' where userid='$new_dean_id'";
    }
    elseif(isset($_POST['Dean_FA'])){
        $new_dean_id = $_POST['Dean_FA'];

        $query_to_remove = "UPDATE users SET position='Faculty' where position='Dean FA'";
        $query_to_appoint = "UPDATE users SET position='Dean FA' where userid='$new_dean_id'";
    }
    elseif(isset($_POST['Dean_R'])){
        $new_dean_id = $_POST['Dean_R'];

        $query_to_remove = "UPDATE users SET position='Faculty' where position='Dean R'";
        $query_to_appoint = "UPDATE users SET position='Dean R' where userid='$new_dean_id'";
    }
    elseif(isset($_POST['Dean_SA'])){
        $new_dean_id = $_POST['Dean_SA'];

        $query_to_remove = "UPDATE users SET position='Faculty' where position='Dean SA'";
        $query_to_appoint = "UPDATE users SET position='Dean SA' where userid='$new_dean_id'";
    }
    elseif(isset($_POST['HOD_CSE'])){
        $new_hod_id = $_POST['HOD_CSE'];

        $query_to_remove = "UPDATE users SET position='Faculty' where position='HOD' and dept='CSE'";
        $query_to_appoint = "UPDATE users SET position='HOD' where userid='$new_hod_id'";
    }
    elseif(isset($_POST['HOD_EE'])){
        $new_hod_id = $_POST['HOD_EE'];
        $query_to_remove = "UPDATE users SET position='Faculty' where position='HOD' and dept='Electrical'";
        $query_to_appoint = "UPDATE users SET position='HOD' where userid='$new_hod_id'";
    }
    elseif(isset($_POST['HOD_ME'])){
        $new_hod_id = $_POST['HOD_ME'];

        $query_to_remove = "UPDATE users SET position='Faculty' where position='HOD' and dept='Mechanical'";
        $query_to_appoint = "UPDATE users SET position='HOD' where userid='$new_hod_id'";
    }
    else{
        header('Location: user.php');
    }

    $faculty_at_position = pg_query($db_connection, $query_to_remove);
    $faculty_at_position = pg_query($db_connection, $query_to_appoint);
?>
    <div class="alert alert-success" role="alert">
        The position has been updated.<a href="user.php" class="alert-link">Click here to move back to the user section.</a>
    </div>

<?php include "static/footer.php"?>

