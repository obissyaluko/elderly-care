<?php
include "connection.php"; 
$senderId = $_GET["senderID"]; 
$receiverId = $_GET["receiverID"];   
$sql = "SELECT * FROM messages WHERE (senderId=$senderId  AND receiverId=$receiverId) OR (senderId=$receiverId AND receiverId=$senderId) ORDER BY id ASC";
$result=mysqli_query($conn,$sql);
if ($result && $result->num_rows > 0) { 
    while($row = mysqli_fetch_array($result)){
        
?>
<div class="message">
<p class="name"><?php echo $row["sender_name"]; ?> <span class="pull-right">  <?php echo formatDate($row["created_date"]); ?></span></p>
<p class="content"><?=($row["has_image"] == 0)?$row["text"]:'<img style="width:150px; height:150px; border-radius:3px;" src="'.$row["image"].'" > <p>'.$row["text"].'</p>'?>&nbsp; &nbsp; &nbsp;</p>
</div>
<?php
     }
 }
 function formatDate($date){
    return date('g:i a',strtotime($date));
  }
 
?>