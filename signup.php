<?php
include "header.php";
include "connection.php";

$error_message = "";
$success_message = "";

if(isset($_POST['register'])){
    $first_name = $_POST["first-name"];
    $last_name = $_POST["last-name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password=$_POST['password'];
    $role = $_POST['role'];
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    $sql="SELECT * FROM users WHERE email='$email'";
    $res = mysqli_query($conn,$sql);
    if ($res->num_rows > 0) {
        $error_message = "Email Already Exist!";
    } else {
        // Insert user data into the database
        $sql1 = "INSERT INTO users (first_name, last_name, email, phone, role, password) VALUES ('$first_name', '$last_name', '$email', '$phone', '$role','$hashed_password')";
        
        if(mysqli_query($conn,$sql1)){
            // Send confirmation email
            $to = $email;
            $subject = 'Registration Confirmation';
            $message = 'Thank you for registering with us!' . "\r\n";
            $message .= 'Your registration details:' . "\r\n";
            $message .= 'First Name: ' . $first_name . "\r\n";
            $message .= 'Last Name: ' . $last_name . "\r\n";
            $message .= 'Phone: ' . $phone . "\r\n";
            $message .= 'Email: ' . $email . "\r\n";
            $message .= 'Role: ' . $role . "\r\n";

            $headers = 'From: info@topazconsult.com'; 
            
            if (mail($to, $subject, $message, $headers)) {
                $success_message = "Your account has been created successfully! Please check your email for confirmation.";
            } else {
                $error_message ="There was an error sending the email.";
            }
        } else {
            $error_message ="Your account couldn't be created successfully!";
        }                
    }
}
?>

<!-- SIGN UP FORM SECTION -->
<section class="login-form sign-up-form d-flex align-items-center">
    <div class="container">
        <div class="login-form-title text-center">
            <h2>Create Your FREE Account</h2>
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
                        <input class="input-field form-control" name='first-name' type="text" id="exampleInputName1" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <input class="input-field form-control" name='last-name' type="text" id="exampleInputName2" placeholder="Last Name" required>
                    </div>
                    <div class="form-group">
                        <input class="input-field form-control" name='email' type="email" id="exampleInputEmail1" placeholder="Email Address" required>
                    </div>
                    <div class="form-group">
                        <input class="input-field form-control" name='phone' type="text" id="phone" placeholder="Phone Number" required>
                    </div>
                    <div class="form-group">
                        <input class="input-field form-control" name='password' type="password" id="exampleInputPassword1" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <select id="inputNoncorehub" name='role' class="input-field form-control select-option" required>
                            <option selected disabled>Please Select Role...</option>
                            <option value="Elderly Person">Elderly Person</option>
                            <option value="Carer">Carer</option>
                        </select>
                    </div>
                    
                    <button type="submit" name="register" class="hover-effect btn btn-primary mb-0">Register Now</button>
                </form>
            </div>
            <div class="join-now-outer text-center">
                <a href="login.php">Already have an account?</a>
            </div>
        </div>
    </div>
</section>
<?php
include "footer.php";
?>
