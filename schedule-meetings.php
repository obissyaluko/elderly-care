<?php
include "header.php";
if(!isset($_SESSION["userid"])){
	header("Location:login.php");
 }
include "connection.php";
$elder_user_id = $_SESSION['userid'];
$query = "SELECT m.*, u.* 
FROM meeting m 
JOIN users u ON m.carer_id = u.id 
WHERE m.elder_person_id = '$elder_user_id' 
ORDER BY m.created_date DESC";
$result1=mysqli_query($conn,$query);

?>
<div class="container my-5">
    <div class='d-flex justify-content-between align-items-start'>
        <h2 class='mb-3'>Scheduled Meetings</h2>
        <a class='btn btn-success' href="add-meeting.php">Add Meeting</a>
    </div>

    <?php
            if ($result1 && $result1->num_rows > 0) { 
            ?>

    <table class="table table-striped table-bordered">
        <thead>
            
            <tr>
                <th>Meeting Name</th>
                <th>Meeting Purpose</th>
                <th>Meeting Date</th>
                <th>Meeting Time</th>
                <th>Carer Name</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($row = mysqli_fetch_array($result1)){
                    $unix_timestamp = strtotime($row['meeting_date']);
                    $formatted_date = date("M d, Y", $unix_timestamp);
                    $current_unix_timestamp = time();
          ?>
            <tr>
                <td><?=$row['meeting_name']?></td>
                <td><?=$row['meeting_purpose']?></td>
                <td><?=$formatted_date?></td>
                <td><?=$row['meeting_time']?></td>
                <td><?=$row['first_name']." ".$row['last_name']?></td>
                <td><?php if($unix_timestamp < $current_unix_timestamp){
                    ?>
                    <span class="badge badge-pill badge-success">Completed</span>
                    <?php
                }else{
                    ?>
                     <span class="badge badge-pill badge-warning">Pending</span>
                    <?php
                }
                ?></td>
            </tr>
            <?php
                }
            ?>

        </tbody>
    </table>
    <?php
            }
            else{
                ?>
            <div class="alert alert-danger alert-dismissible">
                <strong></strong> No Meeting Found!
            </div>
            <?php
            }
            ?>
</div>

<?php
include "footer.php";
?>