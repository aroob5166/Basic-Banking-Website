<?php
session_start();
if(!isset($_SESSION['userId'])){ header('location:login.php');}
?>
<!DOCTYPE html>
<html>

<head>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <title>Banking</title>
    <?php require 'assets/autoloader.php'; ?>
    <?php require 'assets/db.php'; ?>
    <?php require 'assets/function.php'; ?>
    <?php
    $error = "";
    if (isset($_POST['userLogin']))
    {
      $error = "";
        $user = $_POST['email'];
        $pass = $_POST['password'];
       
        $result = $con->query("select * from userAccounts where email='$user' AND password='$pass'");
        if($result->num_rows>0)
        { 
          session_start();
          $data = $result->fetch_assoc();
          $_SESSION['userId']=$data['id'];
          $_SESSION['user'] = $data;
          header('location:index.php');
         }
        else
        {
          $error = "<div class='alert alert-warning text-center rounded-0'>Username or password wrong try again!</div>";
        }
    }

   ?>
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
                    <a class="nav-link " href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item "> <a class="nav-link" href="accounts.php">Accounts</a></li>
                <li class="nav-item active"> <a class="nav-link" href="statements.php">Account Statements</a></li>
                <li class="nav-item "> <a class="nav-link" href="transfer.php">Funds Transfer</a></li>
                <!-- <li class="nav-item ">  <a class="nav-link" href="profile.php">Profile</a></li> -->


            </ul>
            <?php include 'sideButton.php'; ?>
        </div>
    </nav><br><br><br>
    <div class="container">
        <div class="card  w-75 mx-auto">
            <div class="card-header text-center">
                Transaction made against you account
            </div>
            <div class="card-body">
                <?php 
      $array = $con->query("select * from transaction where userId = '$userData[id]' order by date desc");
      if ($array ->num_rows > 0) 
      {
         while ($row = $array->fetch_assoc()) 
         {
            if ($row['action'] == 'withdraw') 
            {
              echo "<div class='alert alert-secondary'>You withdraw Rs.$row[debit] from your account at $row[date]</div>";
            }
            if ($row['action'] == 'deposit') 
            {
              echo "<div class='alert alert-success'>You deposit Rs.$row[credit] in your account at $row[date]</div>";
            }
            if ($row['action'] == 'deduction') 
            {
              echo "<div class='alert alert-danger'>Deduction have been made for  Rs.$row[debit] from your account at $row[date] in case of $row[other]</div>";
            }
            if ($row['action'] == 'transfer') 
            {
              echo "<div class='alert alert-warning'>Transfer have been made for  Rs.$row[debit] from your account at $row[date] in  account no.$row[other]</div>";
            }

         }
      } 
    ?>
            </div>
            <div class="card-footer text-muted">
                <?php echo bankName ?>
            </div>
        </div>

    </div>
</body>

</html>