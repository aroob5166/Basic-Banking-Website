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
    if ($con->query("delete from useraccounts where id = '$_GET[delete]'"))
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
            </ul>
            <?php include 'msideButton.php'; ?>

        </div>
    </nav><br><br><br>
    <div class="container">
        <div class="card w-100 text-center shadowBlue">
            <div class="card-header">
                All accounts
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Holder Name</th>
                            <th scope="col">Account No.</th>
                            <th scope="col">Branch Name</th>
                            <th scope="col">Current Balance</th>
                            <th scope="col">Account type</th>
                            <th scope="col">Contact</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i=0;
                            $array = $con->query("select * from useraccounts,branch where useraccounts.branch = branch.branchId");
                            if ($array->num_rows > 0)
                            {
                                while ($row = $array->fetch_assoc())
                                {$i++;
                        ?>
                        <tr>
                            <th scope="row"><?php echo $i ?></th>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['accountNo'] ?></td>
                            <td><?php echo $row['branchName'] ?></td>
                            <td>Rs.<?php echo $row['balance'] ?></td>
                            <td><?php echo $row['accountType'] ?></td>
                            <td><?php echo $row['number'] ?></td>
                            <td>
                                <a href="show.php?id=<?php echo $row['id'] ?>" class='btn btn-success btn-sm'
                                    data-toggle='tooltip' title="View More info">View</a>
                                <a href="mnotice.php?id=<?php echo $row['id'] ?>" class='btn btn-primary btn-sm'
                                    data-toggle='tooltip' title="Send notice to this">Send Notice</a>
                                <a href="mindex.php?delete=<?php echo $row['id'] ?>" class='btn btn-danger btn-sm'
                                    data-toggle='tooltip' title="Delete this account">Delete</a>
                            </td>

                        </tr>
                        <?php
        }
      }
     ?>
                    </tbody>
                </table>
                <div class="card-footer text-muted">
                    <?php echo bankName; ?>
                </div>
            </div>
</body>

</html>