<?php
    $showAlert = false; 
    $showError = false; 
    $exists=false;

    if($_SERVER["REQUEST_METHOD"] == "register") {
        
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
            
            $create_user_select2 = "INSERT INTO `accounts` ( `user_uid`, `first_name`, `last_name`, `suffix`, `user_pwd`, `user_cpwd`, `user_level`, `email_address`, `section`, `department`, `date`) VALUES   ('$user_uid', '$first_name', '$last_name', '$suffix', '$hash', '$hash', '$user_level', '$email_address', '$section`, `$department`, current_timestamp())";
            
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