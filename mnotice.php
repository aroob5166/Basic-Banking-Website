<?php
session_start();
if(!isset($_SESSION['managerId'])){ header('location:login.php');}
?>
<!DOCTYPE html>
<html>

<head>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <title>Online-Banking</title>
    <?php require 'assets/autoloader.php'; ?>
    <?php require 'assets/db.php'; ?>
    <?php require 'assets/function.php'; ?>
    <?php if (isset($_GET['delete'])) 
  {
    if ($con->query("delete from useraccounts where id = '$_GET[id]'"))
    {
      header("location:mindex.php");
    }
  } ?>
</head>

<body style="background:#96D678;background-size: 100%">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round"
                stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full"
                viewBox="0 0 24 24">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
            </svg>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a class="nav-link active" href="mindex.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item "> <a class="nav-link" href="maccounts.php">Accounts</a></li>
                <li class="nav-item "> <a class="nav-link" href="maddnew.php">Add New Account</a></li>
                <li class="nav-item "> <a class="nav-link" href="mfeedback.php">Feedback</a></li>
                <!-- <li class="nav-item ">  <a class="nav-link" href="transfer.php">Funds Transfer</a></li> -->
                <!-- <li class="nav-item ">  <a class="nav-link" href="profile.php">Profile</a></li> -->


            </ul>
            <?php include 'msideButton.php'; ?>

        </div>
    </nav><br><br><br>
    <?php 
  $array = $con->query("select * from useraccounts where id = '$_GET[id]'");
  $row = $array->fetch_assoc();


 ?>
    <div class="container">
        <div class="card w-100 text-center shadowBlue">
            <div class="card-header">
                Send Notice to <?php echo $row['name'] ?>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="alert alert-success w-50 mx-auto">
                        <h5>Write notice for <?php echo $row['name'] ?></h5>
                        <input type="hidden" name="userId" value="<?php echo $row['id'] ?>">
                        <textarea class="form-control" name="notice" required
                            placeholder="Write your message"></textarea>
                        <button type="submit" name="send" class="btn btn-primary btn-block btn-sm my-1">Send</button>
                    </div>
                </form><?php
    if (isset($_POST['send']))
    {
      if ($con->query("insert into notice (notice,userId) values ('$_POST[notice]','$_POST[userId]')")) {
        echo "<div class='alert alert-success'>Successfully send</div>";
      }else
      echo "<div class='alert alert-danger'>Not sent Error is:".$con->error."</div>";
    }
    
    ?>
            </div>
            <div class="card-footer text-muted">
                <?php echo bankName; ?>
            </div>
        </div>

</body>

</html>