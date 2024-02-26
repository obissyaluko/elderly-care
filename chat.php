<?php
error_reporting();
ob_start();
include "header.php";
if(!isset($_SESSION["userid"])){
	header("Location:login.php");
 }
include "connection.php";
$userId = $_GET["userId"];
$receiverId = @$_GET["receiverId"];
$receiver_name = "";
$sender_name = (isset($_SESSION["Fullname"]) && $_SESSION["Fullname"] !== "")?$_SESSION["Fullname"]: "";
if(isset($receiverId) && $receiverId !== ""){
    $sql="SELECT * FROM users WHERE id=$receiverId";
    $res=mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($res);
    $receiver_name = $row["first_name"]." ".$row['last_name'];
    
}
$attach_image="";
$has_image = 0;
if(isset($_POST["send"])){
     $message = $_POST["message"];
     $sql1="SELECT * FROM chat WHERE (first_user='$userId' AND second_user='$receiverId') OR (first_user='$receiverId' AND second_user='$userId')";
     $res1=mysqli_query($conn,$sql1);
     $count=mysqli_num_rows($res1);
     $chat_id = "";
     if($count > 0){
        $row = mysqli_fetch_assoc($res1);
        $chat_id = $row["id"];
        $date = date("Y-m-d h:i:s");
        $sql5= "UPDATE chat SET created_date ='$date' WHERE id='$chat_id'";
        mysqli_query($conn,$sql1);
     }
     else{
        $sql3 = "INSERT INTO chat (first_user,second_user) VALUES ('$userId', '$receiverId')";
        mysqli_query($conn,$sql3);
        $chat_id = $conn->insert_id;
     }
     if(isset($_FILES['attach-image']) && !empty($_FILES['attach-image']['name'])) { 
         $has_image = 1;
		$attach_image="assets/images/message/".$_FILES["attach-image"]["name"];
        move_uploaded_file($_FILES["attach-image"]["tmp_name"], $attach_image);
	}
     $sql2 = "INSERT INTO messages (chat_id, senderId, receiverId, sender_name, text, image, has_image) VALUES ('$chat_id', '$userId', '$receiverId', '$sender_name', '$message', '$attach_image', '$has_image')";
     if(mysqli_query($conn,$sql2) == TRUE){
        $type= "message";
        $purpose = "has sent you a new message!";
        $notification_query = 'INSERT INTO notifications (sender_id, receiver_id, purpose, notification_type) VALUES ("'.$userId.'", "'.$receiverId.'", "'.$purpose.'", "'.$type.'")';
        mysqli_query($conn,$notification_query);
     }
     else{
         echo "<script>alert('Message couldn,t sent!')</script>";
     }
    
}
?>

<div class="container mb-5">
    <div style=" width:80%"
        class="d-flex justify-content-between align-items-stretch chat-container border border-muted mx-auto">
        <div class="w-25 border-right">
            <div style="background:#f6f6f6;" class="d-flex align-items-center py-1 px-2">
                <img style="width:40px; height:40px; border-radius:50%;"
                    src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                <p style="padding-top:10px; font-weight:500;" class="text-dark ml-5"><?=$sender_name?>
                </p>
            </div>
            <div style="height:460px; overflow-y:auto;" class=" bg-white">
                <?php
                $sql4="SELECT * FROM chat WHERE first_user='$userId' OR second_user='$userId'";
                $res4=mysqli_query($conn,$sql4);
                $receiverChatId = "";
                if($res4 && $res4->num_rows > 0){
                    while($row4 = mysqli_fetch_array($res4)){
                        if($userId == $row4["first_user"]){
                            $receiverChatId = $row4["second_user"];
                        }
                        else{
                            $receiverChatId = $row4["first_user"];
                        }
                        $sql5="SELECT * FROM users WHERE id='$receiverChatId'";
                        $res5=mysqli_query($conn,$sql5);
                        $row5 = mysqli_fetch_assoc($res5);

                ?>
                <a class="text-decoration-none " href="chat.php?userId=<?=$userId?>&receiverId=<?=$receiverChatId?>">
                    <div style="<?=(isset($receiverId) && $receiverId == $receiverChatId)?'background-color:#E7F5FF':''?>"
                        class="d-flex align-items-center p-2 ">
                        <div class="w-25">
                            <img style="width:40px; height:40px; border-radius:50%;"
                                src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                        </div>
                        <div class="border-bottom w-75 ml-3">
                            <p style="margin:0px 0px 10px 0px;" class="text-dark font-weight-600">
                                <?=$row5["first_name"]." ".$row5['last_name']?></p>
                            <!-- <p style="margin:0px 0px 10px 0px;" class="text-body">Hello</p> -->
                        </div>
                    </div>
                </a>
                <?php
                    }
                }else{
                    ?>
                <p class="text-dark text-center font-italic pt-2 font-weight-bold">No Chat Here!</p>
                <?php
                }
                    ?>


            </div>
        </div>
        <div class="w-75 bg-white">
            <?php
                if(isset($receiverId) && $receiverId !== ""){
                ?>
            <div style="background:#f6f6f6;" class="d-flex align-items-center py-1 px-2">
                <img style="width:40px; height:40px; border-radius:50%;"
                    src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                <p style="padding-top:10px; font-weight:500;" class="text-dark ml-5">
                    <?=$receiver_name?>

            </div>

            <div class="chat-section"
                style="overflow-y:auto; height: 400px; background-image: url('assets/images/super_hero_whatsapp_background_by_x_ama_d8fr7iz-fullview.jpg'); background-size: cover;">
                <div class="inbox" id="text">

                </div>
            </div>
            <section class="send-section">

                <form id="chat-form" method="POST" enctype="multipart/form-data">
                    <div class="message-send">
                        <input class="d-none file-upload" type="file" name="attach-image">
                        <i class="fa fa-paperclip upload-button" aria-hidden="true"></i>
                        <input type="text" name="message" placeholder="Type message...">
                        <button type="submit" name="send"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                    </div>
                </form>

            </section>
            <?php
                }
                else{
                ?>
            <img class="img-fluid" style="margin-top:70px;" src="assets/images/chat.png" alt="">
            <?php
                }
                ?>

        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $(".upload-button").on('click', function() {
        $(".file-upload").click();
    });
});
</script>
<script>
function loadDoc() {
    var sender = "<?php echo $userId; ?>";
    var receiver = "<?php echo $receiverId; ?>";
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("text").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "messages.php?senderID=" + sender + "&receiverID=" + receiver, true);
    xhttp.send();
}
setInterval(() => {
    loadDoc()

}, 1000);
</script>
<script>
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
</script>
<?php
include 'footer.php';
?>