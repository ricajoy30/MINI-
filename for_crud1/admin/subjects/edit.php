<?php
    session_start();
    include "../../config/database.php";

        //validation for admin access only. This check to avoid bypassing the system
    if(!isset($_SESSION["role"]) || $_SESSION["role"] != "admin"){
        header("Location: ../../index.php");
        exit;
    }
        $id= isset($_GET['id']) ? intval([$_GET]):0;
        $result = mysqli_query($conn, "SELECT * FROM subjects WHERE id=$id");
        $subjects = mysqli_fetch_assoc($result);
   
        if(!$subjects){
        die('Subjects not found!');
    }
    $message= "";
    if(isset($_POST ['update'])){
        $subject_code = $_POST ['subject_code'];
        $subject_name = $_POST ['subject_name'];
        $units = $_POST ['units'];
        //if password is blank, keep old password
        if($_POST['password'] == ""){
            $sql= "UPDATE subjects SET students_no = $subject_code, 
            subject_name= '$subject_name', units= '$units' WHERE id=$id";
        }
        if(mysqli_query($conn, $sql)){
            header("Location: index.php");
            exit;
        }
        else{
            $message= "Could not update";
        }
    }
    ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Subject</title>
    <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5" style="max-width:700px">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <h2>Edit Student Account</h2>
               <?php if($message != ""){  
                ?> <div class="alert alert-danger"><?php echo $message?></div><?php }?>

                        <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Code</label>
                    <input type="text" name="subject_code" class="form-control" value="<?php echo htmlspecialchars($subject['subject_code']);?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Subject Name</label>
                    <input type="text" name="subject_name" class="form-control" value="<?php echo htmlspecialchars($subject['subject_name']);?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Units</label>
                    <input type="text" name="units" class="form-control" value="<?php echo htmlspecialchars($subject['units']);?>" required>
                </div>
                <button type="submit" name="update" class="btn btn-primary">Update Subject</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
