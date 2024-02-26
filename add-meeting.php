<?php
include "header.php";
if(!isset($_SESSION["userid"])){
	header("Location:login.php");
 }
include "connection.php";
$error_message = "";
$success_message = "";
if(isset($_POST['schedule'])){
    $meeting_name = $_POST["meeting-name"];
    $meeting_purpose = $_POST["meeting-purpose"];
    $meeting_date = $_POST["meeting-date"];
    $meeting_time = $_POST["meeting-time"];
    $carer_id=$_POST['carer'];
    $meeting_desc = $_POST['meeting-desc'];
    $elder_person_id = $_SESSION['userid'];
    
    $sql = 'INSERT INTO meeting (meeting_name, meeting_purpose, meeting_time, meeting_date, carer_id, meeting_desc, elder_person_id) VALUES ("'.$meeting_name.'", "'.$meeting_purpose.'", "'.$meeting_time.'", "'.$meeting_date.'", "'.$carer_id.'","'.$meeting_desc.'", "'.$elder_person_id.'")';
    if(mysqli_query($conn,$sql)){
        $type='meeting';
        $purpose = "has scheduled a new event";
        $notification_query = 'INSERT INTO notifications (sender_id, receiver_id, purpose, notification_type) VALUES ("'.$elder_person_id.'", "'.$carer_id.'", "'.$purpose.'", "'.$type.'")';
        mysqli_query($conn,$notification_query);
        $success_message = "Meeting has been created successfully!";
    }
    else{
        $error_message ="Meeting couldn,t created successfully!";
    }
                
        
}
?>
<!-- SIGN UP FORM SECTION -->
<section class="login-form sign-up-form d-flex align-items-center">
    <div class="container">
        <div class="login-form-title text-center">

            <h2>Schedule Meeting</h2>
            <?php
			if(isset($success_message) && $success_message !== ""){
		?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Success!</strong> <?= $success_message?>
                    </div>
                    <?php
			}
		?>
                    <?php
			if(isset($error_message) && $error_message !==""){
		?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Danger!</strong> <?= $error_message?>
                    </div>
                    <?php
		    }
		?>
        </div>
        <div class="login-form-box">
            <div class="login-card">
                <form method='POST'>
                    <div class="form-group">
                        <input class="input-field form-control" name='meeting-name' type="text" id="exampleInputName1"
                            placeholder="Meeting Name" required>
                    </div>
                    <div class="form-group">
                        <input class="input-field form-control" name='meeting-purpose' type="text" id="exampleInputName2"
                            placeholder="Meeting Purpose" required>
                    </div>
                    <div class="form-group">
                        <input class="input-field form-control" name='meeting-date' type="date" id="exampleInputEmail1"
                            placeholder="Meeting Date" required>
                    </div>
                    <div class="form-group">
                        <input class="input-field form-control" name='meeting-time' type="time"
                            placeholder="Meeting Time" required>
                    </div>
                    <div class="form-group">
                        <select id="carer" name='carer' class="input-field form-control select-option" required>
                            <option selected disabled>Please Select Carer...</option>
                            <?php
                                                    $sql1 = "SELECT * FROM users WHERE role='Carer'";
                                                    $result1=mysqli_query($conn,$sql1);
                                                    if ($result1 && $result1->num_rows > 0) { 
                                                        while($row = mysqli_fetch_array($result1)){
                                                ?>
                            <option value="<?=$row['id']?>"><?=$row['first_name']." ".$row['last_name']?></option>
                            <?php
                                                        }}
                           ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea class="input-field form-control" name='meeting-desc' rows='10' cols='5'
                            placeholder="Meeting Description" required></textarea>
                    </div>
                    <button type="submit" name='schedule' class="hover-effect btn btn-primary mb-0">Schedule Now</button>
                </form>
            </div>

        </div>
    </div>
</section>
<?php
include "footer.php";
?>