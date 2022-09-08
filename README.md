    <form class="signup-container" action="login.php" method="POST">
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

    <!-- part 2 -->


    $showAlert = false; 
    $showError = false; 
    $exists=false;
          
        include ("../Includes/D/config.php");
    
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
        
                
        $create_user_select = "SELECT * FROM users WHERE user_uid='$user_uid'";
        $create_user_query = mysqli_query($db_conn, $create_user_select);
        $create_user_count = mysqli_num_rows($create_user_query); 
    
        if($create_user_count == 0) {
            if(($user_pwd == $user_cpwd) && $exists==false) {
        
                $hash = password_hash($user_pwd, PASSWORD_DEFAULT);
    
                $create_user_select2 = "INSERT INTO `users` ( `user_uid`, `first_name`, `last_name`, `suffix`, `user_pwd`, `user_cpwd`, `user_level`, `email_address`, `section`, `department`, `date`) VALUES ('$user_uid', '$first_name', '$last_name', '$suffix', '$hash', '$hash', '$user_level', '$email_address', '$section`, `$department`, current_timestamp())";
        
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