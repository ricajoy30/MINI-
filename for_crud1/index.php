<?php
    session_start(); //Global Variable. Post limit to transfer data from one to another. With this puwede mo pa rin tawagin yung variable sa different pages. Uses para alam sino nag lologin.
    include "config/database.php";

    // if user is already log in, send them tp correct dashboard.
    if(isset($_SESSION["role"])){
        if(isset($_SESSION["role"]) == "admin"){
            header("Location: admin/dashboard.php");
        }
        else{
            header("Location: student/dashboard.php");
        }
        exit;
    }

    $error = "";

    if(isset($_POST["login"])){
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = $_POST["password"];
        
        //Find typed username
        $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1"; //Limit means isa lang seselect even may same inputs.
        
        //Para ma-store yung result, mag declare ng variable.
        $result = mysqli_query($conn, $sql);

        //Number of rows para malaman if may nasearch ba or wala. 1 if meron nag eexists.
        if(mysqli_num_rows($result) == 1){
            $user = mysqli_fetch_assoc($result);
            //assoc means actual record naman kukunin. So if meron nakuha sa result, magchachange yung result into something na nafetch.
            
            //Password naman iconvert muna yung hash into readable. Check muna if yung user is same sa password para ma verify sino nag log in. Then store to session para magamit sa ibang page
            if(password_verify($password, $user["password"])){
                //Global variable para malaman onis naka log in
                $_SESSION["user_id"] = $user["id"]; //kunin naman yung id
                $_SESSION["ful_name"] = $user["ful_name"];
                $_SESSION["role"] = $user["role"];

                if($user["role"] == "admin"){
                    header("Location: admin/dashboard.php");
                }
                else{
                    header("Location: student/dashboard.php");
                }
            }
        }
        $error = "Invalid username or password!";

    }
    
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Student Portal</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="login-box">
        <div class="card"><div class="card-body p-4">
            <h2 class="text-center">Student Portal</h2>
            <p class="text-center text-muted">Admin and Student Login</p>   
           <?php if ($error != ""){?>
           <div class="aler alert-danger"> <?php echo $error; ?></div>
          <?php } ?>
            <form method="POST">
                <div class="mb-3"><label class="form-label">Username</label><input type="text" name="username" class="form-control"></div>
                <div class="mb-3"><label class="form-label">Password</label><input type="password" name="password" class="form-control"></div>
                <button class="btn btn-primary w-100" type="submit" name="login">Login</button>
            </form>
        </div></div>
    </div>
</div>
</body>
</html>
