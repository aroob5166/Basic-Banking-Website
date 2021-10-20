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
                    <a class="nav-link " href="mindex.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item "> <a class="nav-link" href="maccounts.php">Accounts</a></li>
                <li class="nav-item active"> <a class="nav-link" href="maddnew.php">Add New Account</a></li>
                <li class="nav-item "> <a class="nav-link" href="mfeedback.php">Feedback</a></li>

            </ul>
            <?php include 'msideButton.php'; ?>

        </div>
    </nav><br><br><br>
    <?php
if (isset($_POST['saveAccount']))
{
  if (!$con->query("insert into useraccounts (name,cnic,accountNo,accountType,city,address,email,password,balance,source,number,branch) values ('$_POST[name]','$_POST[cnic]','$_POST[accountNo]','$_POST[accountType]','$_POST[city]','$_POST[address]','$_POST[email]','$_POST[password]','$_POST[balance]','$_POST[source]','$_POST[number]','$_POST[branch]')")) {
    echo "<div claass='alert alert-success'>Failed. Error is:".$con->error."</div>";
  }
  else
    echo "<div class='alert alert-info text-center'>Account added Successfully</div>";

}
if (isset($_GET['del']) && !empty($_GET['del']))
{
  $con->query("delete from login where id ='$_GET[del]'");
}
  
  
 ?>
    <div class="card text-center container bbb " style="width:60%">
        <div class="card text-center "
            style="font-weight: 700;font-family:Arial;font-size: xx-large;background-color: rgb(58, 56, 54);color:white">
            Create Account Here
        </div>
        <form method="POST" style="margin: 5px;padding: 5px;">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="text" name="name" class="form-control" id="inputEmail4" placeholder="Name" required>
                </div>
                <div class="form-group col-md-6">
                    <input type="number" name="cnic" class="form-control" id="inputPassword4" placeholder="CNIC"
                        required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="" name="accountNo" readonly value="<?php echo time() ?>" class="form-control input-sm"
                        required></td>
                </div>
                <div class="form-group col-md-6">
                    <select class="form-control input-sm" name="accountType" required>
                        <option value="current" selected>Current</option>
                        <option value="saving" selected>Saving</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="text" name="city" class="form-control" id="inputEmail4" placeholder="City" required>
                </div>
                <div class="form-group col-md-6">
                    <input type="text" name="address" class="form-control" id="inputPassword4" placeholder="Address"
                        required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="Email" required>
                </div>
                <div class="form-group col-md-6">
                    <input type="password" name="password" class="form-control" id="inputPassword4"
                        placeholder="Password" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="number" name="balance" class="form-control" id="inputEmail4" placeholder="Deposit"
                        required>
                </div>
                <div class="form-group col-md-6">
                    <input type="text" name="source" class="form-control" id="inputPassword4"
                        placeholder="Source of Income" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="number" name="number" class="form-control" id="inputEmail4"
                        placeholder="Contact number" required>
                </div>
                <div class="form-group col-md-6">
                    <div class="input-group">
                        <select name="branch" required class="form-control input-sm">
                            <option selected value="">Branch</option>
                            <?php 
                $arr = $con->query("select * from branch");
                if ($arr->num_rows > 0)
                {
                  while ($row = $arr->fetch_assoc())
                  {
                    echo "<option value='$row[branchId]'>$row[branchName]</option>";
                  }
                }
                else
                  echo "<option value='1'>Main Branch</option>";
               ?>
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit" name="saveAccount" class="btn btn-primary">Save
                Account</button>
            <button type="Reset" class="btn btn-primary">Reset</button>
        </form>

        </form>
    </div>


    </div>
    <div class="card-footer text-muted">
        <?php echo bankName; ?>
    </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Cashier Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        Enter Details
                        <input class="form-control w-75 mx-auto" type="email" name="email" required placeholder="Email">
                        <input class="form-control w-75 mx-auto" type="password" name="password" required
                            placeholder="Password">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="saveAccount" class="btn btn-primary">Save Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>