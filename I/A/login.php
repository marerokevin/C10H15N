<?php
session_start(); 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: /C10H15N/I/indexxxxa.php");
    exit;   
}

include_once ("../Includes/D/config.php");
 
$username = $password = "";
$username_err = $password_err = $login_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
if(empty(trim($_POST["username"]))){
    $username_err = "Please enter username.";
    }else{
        $username = trim($_POST["username"]);
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    }else{
        $password = trim($_POST["password"]);
    }
    
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT id, user_uid, user_pwd, first_name, last_name, user_level, email_address FROM accounts WHERE user_uid = ?";
        
        if($stmt = mysqli_prepare($db_conn, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = $username;
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $last_name, $first_name, $user_level, $email_address);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["user_level"] = $user_level;
                            $_SESSION["email_address"] = $email_address;
                            $_SESSION["username"] = $username;
                            $_SESSION["user_level"] = $user_level;
                            $_SESSION["first_name"] = $first_name;
                            $_SESSION["last_name"] = $last_name;
                            header("location: /C10H15N/I1/indexxxxa.php");
                        }else{
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($db_conn);
} else if ($_SERVER["REQUEST_METHOD"] == "register") {

    $showAlert = false; 
    $showError = false; 
    $exists=false;
          
        include ("/C10H15N/Includes/D/config.php");
    
        $user_uid = $_POST["user_uid"];
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $suffix = $_POST["suffix"];
        $user_pwd = $_POST["user_pwd"]; 
        $user_cpwd = $_POST["user_cpwd"];
        $user_level = $_POST["user_level"];
        $email_address = $_POST["email_address"];
        $section = $_POST["section"];
        $department = $_POST["department"];
        
                
        $create_user_select = "SELECT * FROM accounts WHERE user_uid='$user_uid'";
        $create_user_query = mysqli_query($db_conn, $create_user_select);
        $create_user_count = mysqli_num_rows($create_user_query); 
    
        if($create_user_count == 0) {
            if(($user_pwd == $user_cpwd) && $exists==false) {
        
                $hash = password_hash($user_pwd, PASSWORD_DEFAULT);
    
                $create_user_select2 = "INSERT INTO `accounts` ( `user_uid`, `first_name`, `last_name`, `suffix`, `user_pwd`, `user_cpwd`, `user_level`, `email_address`, `section`, `department`, `date`) VALUES ('$user_uid', '$first_name', '$last_name', '$suffix', '$hash', '$hash', '$user_level', '$email_address', '$section`, `$department`, current_timestamp())";
        
                $result = mysqli_query($db_conn, $create_user_select2);
        
                if ($result) {
                    $showAlert = true; 
                }
            }
            else {
                $showError = "Passwords do not match"; 
            }
        }
       if($create_user_count>0) {
          $exists="Username already taken"; 
       } 
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Employee Directory</title>
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="/C10H15N/S/css/login.css?v=<?php echo time(); ?>">
    <!--FONT-->
</head>
<body>
    <div class="overall-container">
        <div class="titlecontainer-login">
                <a href="/C10H15N/I/A/logind847104.php" class="header_logo">
                    <img src="/C10H15N/S/images/glorylogo.svg" alt="GPI-BCP" class="glory-logo">
                </a>
            <h1 class="company-name">Glory Philippines Inc.</h1>
            <h2 class="system-name">General Services - Inventory System</h2>
        </div>
    </div>
    <div class="dual-function-container" id="login">
        <div name="login_form" class="login-container" id="login">
            <?php 
            if(!empty($login_err)){
                echo '<div class="alert alert-danger 
                alert-dismissible fade show" role="alert">' . $login_err . '</div>';
            }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="login-form">
                <div class="username-container">
                    <input type="text" name="username" class="username-input"<?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" placeholder="Username" required oninvalid="this.setCustomValidity('Enter your username here')"
                    oninput="this.setCustomValidity('')"/><br>
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                </div>
                <div class="password-container">
                    <input type="password" name="password" class="password-input<?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" Placeholder="Password" required oninvalid="this.setCustomValidity('Enter your password here')" oninput="this.setCustomValidity('')"/><br>
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div>
                <div class="login-button-container">
                    <input type="submit" class="login-button" value="Log In">
                </div>

                <label>
                    <input class="remeber" type="checkbox" checked="checked" name="remember"> Remember me
                </label>

                <div class="forgot-container">
                    <a class="forgot" href="#">Forgot password?</a>
                </div>

                <div class="divider"></div>

                <div class="createaccount-container">
                    <a class="createaccount" onclick="register()" href=#>Create new account</a>
                </div>
            </form>
        </div>  
    </div>

<?php
    if($showAlert) {
        echo '
        <div class="alert-success" role="alert">
        <button type="button" class="closebtn-success"
            data-dismiss="alert" aria-label="Close">
            <strong>Success!</strong> Your account is now created and you can login.  
            <span aria-hidden="true">×</span> 
        </button> 
    </div>'; 
    }
    
    if($showError) {
    
        echo '<div class="alert-danger" role="alert"> 
        <button type="button" class="closebtn-error" 
            data-dismiss="alert" aria-label="Close">
            <strong>Error!</strong> '. $showError.'
            <span aria-hidden="true">×</span> 
        </button> 
    </div>'; 
   }
        
    if($exists) {
        echo '<div class="alert-danger" role="alert">
        <button type="button" class="closebtn-error" 
            data-dismiss="alert" aria-label="Close">
            <strong>Error!</strong> '. $exists.' 
            <span aria-hidden="true">×</span> 
        </button>
    </div>'; 
    }
    ?>

    <div class="register-container-hidden" id="register">
    <form class="signup-container" action="signup.php" method="POST">
    <h1 class="title">Sign Up</h1> 

        <div class="input-container"> 
        <input type="text" class="input-main" id="user_uid"
            name="user_uid" aria-describedby="emailHelp" placeholder="ID number" onkeyup="stoppedTyping()" required>    
        </div>

        <div class="input-container"> 
            <select type="text" class="input-main"
            id="user_level" name="user_level" placeholder="Select user level" onkeyup="stoppedTyping()" required>
                <option value="" disabled selected>Select user level</option>
                <option value="Administrator">Administrator</option>
                <option value="Head">Head</option>
                <option value="User">User</option>
            </select>
        </div>
        
        <div class="full-name-container">
        <div class="input-first-name-container"> 
        <input type="text" class="input-name-main" id="first_name"
            name="first_name" aria-describedby="emailHelp" placeholder="First Name" onkeyup="stoppedTyping()" required>    
        </div>

        <div class="input-last-name-container"> 
        <input type="text" class="input-name-main" id="last_name"
            name="last_name" aria-describedby="emailHelp" placeholder="Last Name" onkeyup="stoppedTyping()" required>    
        </div>

        <div class="input-suffix-name-container"> 
        <input type="text" class="input-name-main" id="suffix"
            name="suffix" aria-describedby="emailHelp" placeholder="Suffix (if any)" onkeyup="stoppedTyping()">    
        </div>
        </div>

        <div class="input-container"> 
        <input type="text" class="input-main" id="section"
            name="section" aria-describedby="emailHelp" placeholder="Section" onkeyup="stoppedTyping()">    
        </div>

                <div class="input-container"> 
        <input type="text" class="input-main" id="department"
            name="department" aria-describedby="emailHelp" placeholder="Department" onkeyup="stoppedTyping()">    
        </div>

        <div class="input-container">
            <input type="text" class="input-main"
            id="email_address" name="email_address" placeholder="E-mail Address" onkeyup="stoppedTyping()" required> 
        </div>

        <div class="input-container"> 
            <input type="password" class="input-main"
            id="user_pwd" name="user_pwd" placeholder="Password" onkeyup="stoppedTyping()" required> 
        </div>

        <div class="input-container">
            <input type="password" class="input-main"
                id="user_cpwd" name="user_cpwd" placeholder="Confirm Password" onkeyup="stoppedTyping()" required>
        </div>

            <small id="emailHelp" class="reminder">Make sure to fill up all fields properly <small>      

        <div>
            <input type="submit" class="regbutton" Value="Register"id="reg_btn">
        </div>
        <div class="haveaccount">Already have an account?
            <a href="#" onclick="register()">Login</a>
        </div>
    </form> 
    </div>
</body>
</html>
    <script>
        var x = 0;
    function register() {
        if (x == 1) {
            document.getElementById("register").className = "register-container-hidden";
            document.getElementById("register").style.display = "block";
            document.getElementById("login").className = "dual-function-container";
            document.getElementById("login").style.display = "flex";
            x = 0;
        } else {
            document.getElementById("register").className = "register-container";
            document.getElementById("register").style.display = "block";
            document.getElementById("login").className = "dual-function-container-hidden";
            document.getElementById("login").style.display = "flex";
            x = 1;
        }
    }
    </script>