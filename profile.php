<?php
include "header.php";
if(!isset($_SESSION["userid"])){
	header("Location:login.php");
 }
include "connection.php";
$id = $_SESSION['userid'];
$sql = "SELECT * FROM users WHERE id = '$id'" ;
$result=mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);
?>
<!-- SIGN UP FORM SECTION -->
<section class="login-form sign-up-form d-flex align-items-center">
    <div class="container">
        <div class="login-form-title text-center">
            
            <h2>My Profile</h2>
           
        </div>
        <div class="login-form-box">
            <div class="login-card">
                <form>
                    <div class="form-group">
                        <input class="input-field form-control" value='<?=$row['first_name']?>' name='first-name' type="text" id="exampleInputName1" placeholder="First Name"
                            readonly>
                    </div>
                    <div class="form-group">
                        <input class="input-field form-control" value='<?=$row['last_name']?>' name='last-name' type="text" id="exampleInputName2" placeholder="Last Name"
                        readonly>
                    </div>
                    <div class="form-group">
                        <input class="input-field form-control" value='<?=$row['email']?>' type="email" id="exampleInputEmail1" placeholder="Email Address"
                        readonly>
                    </div>
                    <div class="form-group">
                        <input class="input-field form-control" value='<?=$row['phone']?>' name='phone' type="text" id="phone" placeholder="Phone Number"
                        readonly>
                    </div>
                    <div class="form-group">
                        <input class="input-field form-control" value='<?=$row['role']?>' name='role' type="text" id="exampleInputPassword1"
                            placeholder="Role" readonly>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</section>
<?php
include "footer.php";
?>