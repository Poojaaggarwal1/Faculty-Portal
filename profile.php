<?php include "static/header.php"?>
<?php
    require 'vendor/autoload.php';

    $client = new MongoDB\Client("mongodb://localhost:27017");
    $collection = $client->facultyProfileDB->profile;
    session_start();
    $user_id = $_SESSION['id'];

    $document = $collection->findOne(['userid' => $user_id]);
?>

<?php if($document['PictureLink']){ ?>
<div class="mt-5 ml-3">
    <img class="profile-pic" src="<?php echo $document['PictureLink'] ?>" alt="Profile Picture">
</div>
<?php }else{ ?>
    <div class="mt-5 ml-3">
    <img class="profile-pic" src="img/profile_picture.png" alt="Profile Picture">
</div>
<?php } ?>

<div class="container shadow-lg border mt-5 p-4 bg-dark text-white w-50">
    <div class="row">
        <div class="col">Name</div>
        <div class="col"><?php echo $document['Name'] ?></div>
        <div class="w-100"></div>
        <div class="col">Email</div>
        <div class="col"><?php echo $document['Email'] ?></div>
        <div class="w-100"></div>
        <div class="col">Position</div>
        <div class="col"><?php echo $document['Position'] ?></div>
        <div class="w-100"></div>
        <div class="col">Department</div>
        <div class="col"><?php echo $document['Department'] ?></div>
        <div class="w-100"></div>
        <div class="col">Research Interests</div>
        <div class="col"><?php echo $document['ResearchInterests'] ?></div>
        
    </div>
    <form action="update_info.php" method="post">
        <button class="btn btn-primary mt-2" type="submit" name="edit">Edit Info</button>
    </form>
</div>




<div class="container shadow border mt-5 p-3 w-75"> 
        <h3>Biography</h3>
        <p><?php echo $document['Biography'] ?></p>
    <form action="update_bio.php" method="post">
        <button class="btn btn-dark" type="submit" name="submit">Edit Bio</button>
    </form>
</div>

<div class="container shadow border mt-5 p-3 w-75"> 
    <h3>Research Publications</h3>
    <?php
        foreach ($document["Researches"] as $research) {
    ?>
        <h5><a href=<?php echo $research["Link"]; ?>><?php echo $research["Title"]; ?></a></h5>
        <p style="display:inline;"><?php echo $research["Description"]; ?></p>
        <form action="delete_tdl.php" method="post">
            <button class="btn btn-outline-danger btn-sm mb-2" type="submit" name="Researches" value="<?php echo $research['Title'] ?>">X</button>
        </form>
    <?php        
        }
    ?>
    <form action="insert_tdl.php" method="post">
        <button class="btn btn-dark" type="submit" name="add" value="Researches" >Add Publication</button>
    </form>
</div>

<div class="container shadow border mt-5 p-3 w-75"> 
    <h3>Achievements</h3>
    <?php
        foreach ($document["Achievements"] as $achievement) {
    ?>
        <h5><a href=<?php echo $achievement["Link"]; ?>><?php echo $achievement["Title"]; ?></a></h5>
        <p style="display:inline;"><?php echo $achievement["Description"]; ?></p>
        <form action="delete_tdl.php" method="post">
            <button class="btn btn-outline-danger btn-sm mb-2" type="submit" name="Achievements" value="<?php echo $achievement['Title'] ?>">X</button>
        </form>
    <?php        
        }
    ?>
    <form action="insert_tdl.php" method="post">
        <button class="btn btn-dark" type="submit" name="add" value="Achievements" >Add Achievement</button>
    </form>
</div>

<div class="container shadow border mt-5 p-3 w-75"> 
    <h3>Courses Taught</h3>
    <?php
        foreach ($document["CoursesTaught"] as $course) {
    ?>
        <li><?php echo $course; ?></li>
            <form action="delete_li.php" method="post">
                <button class="btn btn-outline-danger btn-sm mb-2" type="submit" name="CoursesTaught" value="<?php echo $course ?>">X</button>
            </form>
        
    <?php        
        }
    ?>
    <form action="insert_li.php" method="post">
        <button class="btn btn-dark mt-3" type="submit" name="add" value="CoursesTaught" >Add Course</button>
    </form>
</div>



<div class="container shadow border mt-5 p-3 w-75"> 
    <h3>Education / Academic Qualifications </h3>
    <?php
        foreach ($document["Academics"] as $academic) {
    ?>
        <h6><?php echo $academic["Title"]; ?></a></h6>
        <p style="display:inline;"><?php echo $academic["Description"].", "; ?> <span class="acad-date"><?php echo $academic["Date"];?></span></p>
        <form action="delete_tdd.php" method="post">
            <button class="btn btn-outline-danger btn-sm mb-2" type="submit" name="Academics" value="<?php echo $academic['Title'] ?>">X</button>
        </form>
    <?php        
        }
    ?>

    <form action="insert_tdd.php" method="post">
            <button class="btn btn-dark" type="submit" name="add" value="Academics" >Add Academics</button>
    </form>
</div>


<?php include "static/footer.php" ?>