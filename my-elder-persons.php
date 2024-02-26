<?php
include "header.php";
if(!isset($_SESSION["userid"])){
	header("Location:login.php");
 }
include "connection.php";
$elder_user_id = $_SESSION['userid'];
$query = "SELECT m.*, u.* , u.id AS receiver_id
FROM meeting m 
JOIN users u ON m.elder_person_id = u.id 
WHERE m.carer_id = '$elder_user_id' 
ORDER BY m.created_date DESC";
$result1=mysqli_query($conn,$query);

?>
<div class="container my-5">
    <h2 class='mb-3'>Elder Relationship</h2>


    <?php
            if ($result1 && $result1->num_rows > 0) { 
            ?>

    <table class="table table-striped table-bordered">
        <thead>

            <tr>
                <th>Elder Person</th>
                <th>Email Address</th>
                <th>Phone Number</th>
                <th>Meeting Scheduled</th>
                <th>Chat</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($row = mysqli_fetch_array($result1)){
                    $unix_timestamp = strtotime($row['meeting_date']);
                    $formatted_date = date("M d, Y", $unix_timestamp);
          ?>
            <tr>
                <td><?=$row['first_name']." ".$row['last_name']?></td>
                <td><?=$row['email']?></td>
                <td><?=$row['phone']?></td>
                <td><?=$formatted_date?></td>
                <td><a title='chat' class='btn btn-warning' href="chat.php?userId=<?=$elder_user_id?>&receiverId=<?=$row['receiver_id']?>"><i class="fa fa-commenting-o" aria-hidden="true"></i></a>
                </td>
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
        <strong></strong> No Elder Found!
    </div>
    <?php
            }
            ?>
</div>

<?php
include "footer.php";
?>