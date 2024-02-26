<?php
include "header.php";
if(!isset($_SESSION["userid"])){
	header("Location:login.php");
 }
include "connection.php";
$elder_user_id = $_SESSION['userid'];
$query = "SELECT n.*, u.* , u.id AS receiver_id
FROM notifications n 
JOIN users u ON n.sender_id = u.id 
WHERE n.receiver_id = '$elder_user_id' 
ORDER BY n.created_date DESC";
$result1=mysqli_query($conn,$query);

?>
<div class="container my-5">
    <div class='d-flex justify-content-between align-items-start'>
        <h2 class='mb-3'>Notifications</h2>
    </div>

    <?php
            if ($result1 && $result1->num_rows > 0) { 
                while($row = mysqli_fetch_array($result1)){
                    $unix_timestamp = strtotime($row['created_date']);
                    $formatted_date = date("M d, Y h:iA", $unix_timestamp);
                   
          ?>
    <div class="notification">
        <img src="assets/images/user.png" alt="Avatar" style="width:100%;">
        <p><?=$row['first_name']." ".$row['last_name']?> <?=$row['purpose']?>. Go to <a href="chat.php?userId=<?=$elder_user_id?>&receiverId=<?=$row['receiver_id']?>">Chat</a> </p>
        <span class="time-right"><?=$formatted_date?></span>
    </div>
    <?php
                }
            }
            else{
                ?>
    <div class="alert alert-danger alert-dismissible">
        <strong></strong> No Notification Found!
    </div>
    <?php
            }
            ?>
</div>

<?php
include "footer.php";
?>