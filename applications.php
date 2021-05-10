<?php include("static/header.php"); ?>

<?php
	session_start();
	$id = $_SESSION["id"];
    $query_for_view_application = "SELECT appid, status,startdate,enddate,isretrospective FROM applications WHERE applicantid='$id' order by timing";
    $result = pg_query($db_connection, $query_for_view_application);
    $applications = pg_fetch_all($result);

    for($i=0;$i<count($applications);$i++)
    {
        $applicationid= $applications[$i]['appid'];
?>
    <div class="container border shadow mt-5 p-4">
        <div class="row">
            <div class="col">Application id</div>
            <div class="col"><?php echo $applications[$i]['appid'];?></div>
            <div class="w-100"></div>
            <div class="col">Status</div>
            <div class="col"><?php echo $applications[$i]['status'];?></div>
            <div class="w-100"></div>
            <div class="col">Leave start date </div>
            <div class="col"><?php echo $applications[$i]['startdate'];?></div>
            <div class="w-100"></div>
            <div class="col">Leave end date</div>
            <div class="col"><?php echo $applications[$i]['enddate'];?></div>
            <div class="w-100"></div>
<?php if($applications[$i]['isretrospective'] == 1){ ?>
            <div class="col"><strong>NOTE : Retrospective Leaves</strong></div>
            <div class="col"></div>
            <div class="w-100"></div>
<?php } ?>

            <div class="text-centre">
            <form action="application_details.php" method="POST">

            <button type="submit" name="comments" value="<?php echo $applicationid ?>" class="btn btn-dark mt-3 ml-2">View Application</button>

            </form>
            </div>
        </div>
    </div>
<?php } 

if(count($applications) == 0){
?>
    <div class="jumbotron">
        <h3>No applications till date</h3>
    </div>

<?php
}


?>
<?php include("static/footer.php"); ?>