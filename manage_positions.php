<?php include "static/header.php"?>

<?php           
    if(!isset($_POST['update-position']))
    {
        header("Location: user.php");
        exit;
    }
    $query_to_fetch_all_faculties = "select * from allFaculties()";
?>

<?php
    $all_faculties = pg_query($db_connection,$query_to_fetch_all_faculties);
    $query_to_fetch_position_holders = "select * from facultyAtPosition('Dean AA')";
    $faculty_at_position = pg_fetch_row(pg_query($db_connection, $query_to_fetch_position_holders));
?>

<div class="container mx-auto mt-5 border shadow py-5">
    <div class="form-group col-md-6 mx-auto">
        <label for="dd1">Dean Academic Affairs</label>
        <div class="dropdown">
            <button class="btn btn-dark dropdown-toggle" type="button" id="dd1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $faculty_at_position[1]?></button>
            <div class="dropdown-menu" aria-labelledby="dd1">
                <?php
                while($row=pg_fetch_row($all_faculties))
                {?>
                    <form action="process_position_update.php" method="post">
                        <button class="dropdown-item" type="submit" name="Dean AA" value="<?php echo $row[0]?>"><?php echo $row[1] ?></button>
                    </form>
                <?php
                }?>              
            </div>
        </div>
    </div>

    <?php
    $all_faculties = pg_query($db_connection,$query_to_fetch_all_faculties);
    $query_to_fetch_position_holders = "select * from facultyAtPosition('Dean FA')";
    $faculty_at_position = pg_fetch_row(pg_query($db_connection, $query_to_fetch_position_holders));
    ?>
    <div class="form-group col-md-6 mx-auto">
        <label for="dd2">Dean Faculty Affairs</label>
        <div class="dropdown">
            <button class="btn btn-dark dropdown-toggle" type="button" id="dd2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $faculty_at_position[1]?></button>
            <div class="dropdown-menu" aria-labelledby="dd2">
            <?php
                $all_faculties = pg_query($db_connection,$query_to_fetch_all_faculties);
                while($row=pg_fetch_row($all_faculties))
                {?>
                    <form action="process_position_update.php" method="post">
                        <button class="dropdown-item" type="submit" name="Dean FA" value="<?php echo $row[0]?>"><?php echo $row[1] ?></button>
                    </form>
                <?php
                }?>   
            </div>
        </div>
    </div>

    <?php
    $all_faculties = pg_query($db_connection,$query_to_fetch_all_faculties);
    $query_to_fetch_position_holders = "select * from facultyAtPosition('Dean R')";
    $faculty_at_position = pg_fetch_row(pg_query($db_connection, $query_to_fetch_position_holders));
    ?>
    <div class="form-group col-md-6 mx-auto">
        <label for="dd3">Dean Research</label>
        <div class="dropdown">
            <button class="btn btn-dark dropdown-toggle" type="button" id="dd3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $faculty_at_position[1]?></button>
            <div class="dropdown-menu" aria-labelledby="dd3">
            <?php
                $all_faculties = pg_query($db_connection,$query_to_fetch_all_faculties);
                while($row=pg_fetch_row($all_faculties))
                {?>
                    <form action="process_position_update.php" method="post">
                        <button class="dropdown-item" type="submit" name="Dean R" value="<?php echo $row[0]?>"><?php echo $row[1] ?></button>
                    </form>
                <?php
                }?>   
            </div>
        </div>
    </div>

    <?php
    $all_faculties = pg_query($db_connection,$query_to_fetch_all_faculties);
    $query_to_fetch_position_holders = "select * from facultyAtPosition('Dean SA')";
    $faculty_at_position = pg_fetch_row(pg_query($db_connection, $query_to_fetch_position_holders));
    ?>
    <div class="form-group col-md-6 mx-auto">
        <label for="dd4">Dean Student Affairs</label>
        <div class="dropdown">
            <button class="btn btn-dark dropdown-toggle" type="button" id="dd4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $faculty_at_position[1]?></button>
            <div class="dropdown-menu" aria-labelledby="dd4">
            <?php
                $all_faculties = pg_query($db_connection,$query_to_fetch_all_faculties);
                while($row=pg_fetch_row($all_faculties))
                {?>
                    <form action="process_position_update.php" method="post">
                        <button class="dropdown-item" type="submit" name="Dean SA" value="<?php echo $row[0]?>"><?php echo $row[1] ?></button>
                    </form>
                <?php
                }?>   
            </div>
        </div>
    </div>

    <?php
        $query_to_fetch_dept_faculties = "select * from facultiesFromDept('CSE')";
        $dept_faculties = pg_query($db_connection,$query_to_fetch_dept_faculties);
        $query_to_fetch_position_holders = "select * from hodAt('CSE')";
        $faculty_at_position = pg_fetch_row(pg_query($db_connection, $query_to_fetch_position_holders));
    ?>
    <div class="form-group col-md-6 mx-auto">
        <label for="dd5">HOD Computer Science</label>
        <div class="dropdown">
            <button class="btn btn-dark dropdown-toggle" type="button" id="dd5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $faculty_at_position[1]?></button>
            <div class="dropdown-menu" aria-labelledby="dd5">
            <?php
                $all_faculties = pg_query($db_connection,$query_to_fetch_all_faculties);
                while($row=pg_fetch_row($dept_faculties))
                {?>
                    <form action="process_position_update.php" method="post">
                        <button class="dropdown-item" type="submit" name="HOD CSE" value="<?php echo $row[0]?>"><?php echo $row[1] ?></button>
                    </form>
                <?php
                }?>
            </div>
        </div>
    </div>

    <?php
        $query_to_fetch_dept_faculties = "select * from facultiesFromDept('Electrical')";
        $dept_faculties = pg_query($db_connection,$query_to_fetch_dept_faculties);
        $query_to_fetch_position_holders = "select * from hodAt('Electrical')";
        $faculty_at_position = pg_fetch_row(pg_query($db_connection, $query_to_fetch_position_holders));
    ?>
    <div class="form-group col-md-6 mx-auto">
        <label for="dd6">HOD Electrical Engineering</label>
        <div class="dropdown">
            <button class="btn btn-dark dropdown-toggle" type="button" id="dd6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $faculty_at_position[1]?></button>
            <div class="dropdown-menu" aria-labelledby="dd6">
            <?php
                $all_faculties = pg_query($db_connection,$query_to_fetch_all_faculties);
                while($row=pg_fetch_row($dept_faculties))
                {?>
                    <form action="process_position_update.php" method="post">
                        <button class="dropdown-item" type="submit" name="HOD EE" value="<?php echo $row[0]?>"><?php echo $row[1] ?></button>
                    </form>
                <?php
                }?>  
            </div>
        </div>
    </div>

    <?php
        $query_to_fetch_dept_faculties = "select * from facultiesFromDept('Mechanical')";
        $dept_faculties = pg_query($db_connection,$query_to_fetch_dept_faculties);
        $query_to_fetch_position_holders = "select * from hodAt('Mechanical')";
        $faculty_at_position = pg_fetch_row(pg_query($db_connection, $query_to_fetch_position_holders));
    ?>

    <div class="form-group col-md-6 mx-auto">
        <label for="dd7">HOD Mechanical Engineering</label>
        <div class="dropdown">
            <button class="btn btn-dark dropdown-toggle" type="button" id="dd7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $faculty_at_position[1]?></button>
            <div class="dropdown-menu" aria-labelledby="dd7">
            <?php
                $all_faculties = pg_query($db_connection,$query_to_fetch_all_faculties);
                while($row=pg_fetch_row($dept_faculties))
                {?>
                    <form action="process_position_update.php" method="post">
                        <button class="dropdown-item" type="submit" name="HOD ME" value="<?php echo $row[0]?>"><?php echo $row[1] ?></button>
                    </form>
                <?php
                }?>  
            </div>
        </div>
    </div>

</div>
<?php include "static/footer.php"?>


