<?php
session_start();
if(!isset($_SESSION['userId'])){ header('location:login.php');}
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <title>Online-Banking</title>
    <style>
    .bbb {
        box-shadow: 0px 7px 10px 1px black;
    }
    </style>
    <?php require 'assets/autoloader.php'; ?>
    <?php require 'assets/db.php'; ?>
    <?php require 'assets/function.php'; ?>

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
                <li class="nav-item active "> <a class="nav-link" href="accounts.php">Accounts</a></li>
                <li class="nav-item "> <a class="nav-link" href="statements.php">Account Statements</a></li>
                <li class="nav-item "> <a class="nav-link" href="transfer.php">Funds Transfer</a></li>
                <!-- <li class="nav-item ">  <a class="nav-link" href="profile.php">Profile</a></li> -->
            </ul>
            <?php include 'sideButton.php'; ?>

        </div>
    </nav>

    <div class="card text-center" style="font-weight: 700;font-family:Arial;font-size: xx-large">
        Account Details
    </div>
    <div class="container mx-auto flex flex-wrap items-center">
        <table class="table table-hover table-dark bbb">
            <thead>

                <tr>
                    <th scope="col">Account Number</th>
                    <th scope="col"><?php echo $userData['accountNo']; ?></th>


                </tr>
            </thead>
            <tbody>
                <tr class="bg-info">
                    <th scope="row">Branch</th>
                    <td><?php echo $userData['branchName']; ?></td>

                </tr>
                <tr class="bg-info">
                    <th scope="row">Branch Code</th>
                    <td><?php echo $userData['branchNo']; ?></td>

                </tr>
                <tr class="bg-info">
                    <th scope="row">Account type</th>
                    <td colspan="2"><?php echo $userData['accountType']; ?></td>

                </tr>
                <tr class="bg-info">
                    <th scope="row">Account Created</th>
                    <td colspan="2"><?php echo $userData['date']; ?></td>

                </tr>

            </tbody>

        </table>
    </div>


    </div>
    </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>