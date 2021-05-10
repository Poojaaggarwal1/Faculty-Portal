<?php include "static/login_header.php"?>
<?php
require 'vendor/autoload.php';

$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->facultyProfileDB->profile;

$user_id = $_GET['name'];

$document = $collection->findOne(['userid' => $user_id]);

?>

<?php if($document['PictureLink']){ ?>
<div class="mt-4 ml-3">
    <img class="profile-pic" src="<?php echo $document['PictureLink'] ?>" alt="Profile Picture">
</div>
<?php }else{ ?>
    <div class="mt-4 ml-3">
    <img class="profile-pic" src="img/profile_picture.png" alt="Profile Picture">
</div>
<?php } ?>

<div class="container border shadow-lg mt-5 p-4 bg-dark text-white w-50">
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
</div>



<?php if($document['Biography'])
{
?>
    <div class="container border shadow mt-5 p-3 w-75"> 
            <h3>Biography</h3>
            <p><?php echo $document['Biography'] ?></p>
    </div>
<?php
}
?>

<?php if(count($document['Researches']))
{
?>
    <div class="container border shadow mt-5 p-3 w-75"> 
        <h3>Research Publications</h3>
        <?php
            foreach ($document["Researches"] as $research) {
        ?>
            <h5><a href=<?php echo $research["Link"]; ?>><?php echo $research["Title"]; ?></a></h5>
            <p><?php echo $research["Description"]; ?></p>
        <?php        
            }
        ?>
    </div>

<?php
}
?>

<?php if(count($document['Achievements']))
{
?>

    <div class="container border shadow mt-5 p-3 w-75"> 
        <h3>Achievements</h3>
        <?php
            foreach ($document["Achievements"] as $achievement) {
        ?>
            <h5><a href=<?php echo $achievement["Link"]; ?>><?php echo $achievement["Title"]; ?></a></h5>
            <p><?php echo $achievement["Description"]; ?></p>
        <?php        
            }
        ?>
    </div>
<?php
}
?>

<?php if(count($document['CoursesTaught']))
{
?>
    <div class="container border shadow mt-5 p-3 w-75"> 
        <h3>Courses Taught</h3>
        <?php
            foreach ($document["CoursesTaught"] as $course) {
        ?>
            <li><?php echo $course; ?></li>
            
        <?php        
            }
        ?>
    </div>
<?php
}
?>

<?php if(count($document['Academics']))
{
?>
    <div class="container border shadow mt-5 p-3 w-75"> 
        <h3>Education / Academic Qualifications </h3>
        <?php
            foreach ($document["Academics"] as $academic) {
        ?>
            <h6><?php echo $academic["Title"]; ?></a></h6>
            <p><?php echo $academic["Description"].", "; ?> <?php echo $academic["Date"]; ?></p>
        <?php        
            }
        ?>
    </div>
<?php
}
?>

<?php include "static/footer.php" ?>