<?php
    session_start();
    include "../../config/database.php";

        //validation for admin access only. This check to avoid bypassing the system
    if(!isset($_SESSION["role"]) || $_SESSION["role"] != "admin"){
        header("Location: ../../index.php");
        exit;
    }

    $message = "";
    if(isset($_POST["save"])){
        //get the data na ininput ni user sa form.
        $student_no = $_POST["student_no"];
        $ful_name = $_POST["full_name"];
        $username = $_POST["username"];
        //PASSWORDDEF means gagamitin yung default form ni php
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        //sql comman to insert record
       $sql = "INSERT INTO users (`student_no`, `full_name`, `username`, `password`, `role`) 
        VALUES ('$student_no','$ful_name','$username','$password','student')";

        if(mysqli_query($conn, $sql)){
            header("Location: index.php?message=Student Record Added Successfully");
            exit;
        }
        else{
            $message = "Could not save student record";
        }
    }

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>Student Form</title>

    <!-- Bootstrap CSS -->
    <link
        href="../../assets/vendor/bootstrap/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">
     <!-- Navigation Bar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">

            <a
                class="navbar-brand"
                href="dashboard.html"
            >
                Student Portal Admin
            </a>

        </div>
    </nav>
    <!-- Main Container -->
    <div
        class="container py-5"
        style="max-width: 700px;"
    >


        <!-- Student Form Card -->
        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <h2>Student Account Form</h2>
                <?php if($message != ""){  
                ?> <div class="alert alert-danger"><?php echo $message?></div><?php }?>

                <form method="POST">

                    <!-- Student Number -->
                    <div class="mb-3">
                        <label class="form-label">
                            Student Number
                        </label>

                        <input class="form-control" name="student_no">
                    </div>

                    <!-- Full Name -->
                    <div class="mb-3">
                        <label class="form-label">
                            Full Name
                        </label>

                        <input class="form-control"  name="full_name">
                    </div>

                    <!-- Username -->
                    <div class="mb-3">
                        <label class="form-label">
                            Username
                        </label>

                        <input class="form-control"  name="username">
                    </div>

                    <!-- Password -->
                    <!-- Kailangan sa soon system na gagawin need ng password confirmation-->
                    <div class="mb-3">
                        <label class="form-label">
                            Password
                        </label>

                        <input
                            type="password"
                            class="form-control"
                            name="password"
                        >
                    </div>

                    <!-- Form Actions -->
                    <button
                        type="submit"
                        class="btn btn-primary"
                        name="save"
                    >
                        Save Student
                    </button>

                    <a
                        href="index.php"
                        class="btn btn-secondary"
                    >
                        Cancel
                    </a>

                </form>

            </div>

        </div>

    </div>

</body>

</html>