<?php
include "header.php";
include "connection.php";
$error_message = "";
if(isset($_POST['login'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    if(isset($_POST["remember"])) {
        setcookie ("elderly_email",$email,time()+ (10 * 365 * 24 * 60 * 60));
        setcookie ("elderly_password",$password,time()+ (10 * 365 * 24 * 60 * 60));
    }
    $sql="SELECT * FROM users WHERE email='".$email."' limit 1 ";  
    $result = mysqli_query($conn, $sql);
    $count=mysqli_num_rows($result);
    if($count && $count == 1){
        $row=mysqli_fetch_array($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['userid']=$row['id'];
            $_SESSION['Fullname']=$row['first_name']." ".$row['last_name'];
            $_SESSION['Email']=$row['email'];
            $_SESSION['Phone']=$row['phone'];
            $_SESSION['Role']=$row['role'];
            echo "<script>location.href='profile.php';</script>";
        }
        else{
            $error_message='Incorrect Password';
        } 
    } 
    else{
        $error_message='Incorrect Email';
    }
}
?>
<!-- LOGIN FORM SECTION -->
<section class="login-form d-flex align-items-center">
    <div class="container">
        <div class="login-form-title text-center">
            
            <h2>Welcome Back !</h2>
        </div>
        <div class="login-form-box">
            <div class="login-card">
                <form method="post">
                    <div class="form-group">
                        <input class="input-field form-control" name='email' type="email" id="exampleInputEmail1" placeholder="Email" value="<?php if(isset($_COOKIE["elderly_email"])) { echo $_COOKIE["elderly_email"]; } ?>"
                            required>
                    </div>
                    <div class="form-group">
                        <input class="input-field form-control" value="<?php if(isset($_COOKIE["elderly_password"])) { echo $_COOKIE["elderly_password"]; } ?>" name='password' type="password" id="exampleInputPassword1"
                            placeholder="Password" required>
                    </div>
                    <button type="submit" name='login' class="btn btn-primary hover-effect">Login</button>
                    <div>
                        <label class="font-weight-normal mb-0" style="cursor: pointer;">
                            <input class="checkbox" type="checkbox" name="userRememberMe" <?php if(isset($_COOKIE["elderly_email"])) { ?> checked <?php } ?>>
                            Remember me
                        </label>
                    
                    </div>
                </form>
            </div>
            <div class="join-now-outer text-center">
                <a href="signup.php">Join now, create your FREE account</a>
            </div>
        </div>
    </div>
</section>
<?php
include "footer.php";
?>