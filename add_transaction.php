<?php
include("session.php");
$update = false;
$del = false;
$Transaction = "";
$toaccount="";
$holdername="";
$transactionnote="";
$transactiondate = date("Y-m-d");
$transactioncategory = "Entertainment";
if (isset($_POST['add'])) {
    $Transaction = $_POST['Transaction'];
    $transactiondate = $_POST['transactiondate'];
    $transactioncategory = $_POST['transactioncategory'];
    $transactionnote=$_POST['transactionnote'];
    $toaccount=$_POST['toaccount'];
    $holdername=$_POST['Holdername'];

    $Transactions = "INSERT INTO Transactions (user_id, Transaction,transactiondate,transactioncategory,transactionnote,ToAccount,AcholderName) VALUES ('$userid', '$Transaction','$transactiondate','$transactioncategory','$transactionnote','$toaccount','$holdername')";
    $result = mysqli_query($con, $Transactions) or die("Something Went Wrong!");
    header('location: index.php');
}

if (isset($_POST['update'])) {
    $id = $_GET['edit'];
    $Transaction = $_POST['Transaction'];
    $transactiondate = $_POST['transactiondate'];
    $transactioncategory = $_POST['transactioncategory'];
    $transactionnote=$_POST['transactionnote'];
    $toaccount=$_POST['toaccount'];
    $holdername=$_POST['Holdername'];

    $sql = "UPDATE Transactions SET Transaction='$Transaction', transactiondate='$transactiondate', transactioncategory='$transactioncategory',transactionnote='$transactionnote',ToAccount='$toaccount',AcholderName='$holdername' WHERE user_id='$userid' AND t_id='$id'";
    if (mysqli_query($con, $sql)) {
        echo "Records were updated successfully.";
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
    }
    header('location: manage_expanses.php');
}

if (isset($_POST['update'])) {
    $id = $_GET['edit'];
    $Transaction = $_POST['Transaction'];
    $transactiondate = $_POST['transactiondate'];
    $transactioncategory = $_POST['transactioncategory'];
    $transactionnote=$_POST['transactionnote'];
    $toaccount=$_POST['toaccount'];
    $holdername=$_POST['Holdername'];

    $sql = "UPDATE Transactions SET Transaction='$Transaction', transactiondate='$transactiondate', transactioncategory='$transactioncategory',transactionnote='$transactionnote',ToAccount='$toaccount',AcholderName='$holdername' WHERE user_id='$userid' AND t_id='$id'";
    if (mysqli_query($con, $sql)) {
        echo "Records were updated successfully.";
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
    }
    header('location: manage_expense.php');
}

if (isset($_POST['delete'])) {
    $id = $_GET['delete'];
    $Transaction = $_POST['Transaction'];
    $transactiondate = $_POST['transactiondate'];
    $transactioncategory = $_POST['transactioncategory'];
    $transactionnote=$_POST['transactionnote'];
    $toaccount=$_POST['toaccount'];
    $holdername=$_POST['Holdername'];

    $sql = "DELETE FROM Transactions WHERE user_id='$userid' AND t_id='$id'";
    if (mysqli_query($con, $sql)) {
        echo "Records were updated successfully.";
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
    }
    header('location: manage_expense.php');
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($con, "SELECT * FROM Transactions WHERE user_id='$userid' AND t_id=$id");
    if (mysqli_num_rows($record) == 1) {
        $n = mysqli_fetch_array($record);
        $Transaction = $n['Transaction'];
        $transactiondate = $n['transactiondate'];
        $transactioncategory = $n['transactioncategory'];
        $transactionnote=$n['transactionnote'];
        $toaccount=$n['ToAccount'];
        $holdername=$n['AcholderName'];
        
    } else {
        echo ("WARNING: AUTHORIZATION ERROR: Trying to Access Unauthorized data");
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $del = true;
    $record = mysqli_query($con, "SELECT * FROM Transactions WHERE user_id='$userid' AND t_id=$id");

    if (mysqli_num_rows($record) == 1) {
        $n = mysqli_fetch_array($record);
        $Transaction = $n['Transaction'];
        $transactiondate = $n['transactiondate'];
        $transactioncategory = $n['transactioncategory'];
        $transactionnote=$n['transactionnote'];
        $toaccount=$n['ToAccount'];
        $holdername=$n['AcholderName'];
    } else {
        echo ("WARNING: AUTHORIZATION ERROR: Trying to Access Unauthorized data");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Add Transactions - D.E.M.S.</title>
    <link rel="icon" type="image/x-icon" href="./icon/budget.ico"/>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Feather JS for Icons -->
    <script src="js/feather.min.js"></script>

</head>

<body>

    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="border-right" id="sidebar-wrapper">
            <div class="user">
                <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="120">
                <h5><?php echo $username ?></h5>
                <p><?php echo $useremail ?></p>
            </div>
            <div class="sidebar-heading">Management</div>
            <div class="list-group list-group-flush">
                <a href="index.php" class="list-group-item list-group-item-action"><span data-feather="home"></span> Dashboard</a>
                <a href="add_expense.php" class="list-group-item list-group-item-action "><span data-feather="plus-square"></span> Add Expenses</a>
                <a href="add_transaction.php" class="list-group-item list-group-item-action sidebar-active"><span data-feather="plus-square"></span> Add Transaction</a>
                <a href="manage_expense.php" class="list-group-item list-group-item-action"><span data-feather="dollar-sign"></span> Manage Expenses </a>
                  
            </div>
            <div class="sidebar-heading">Settings </div>
            <div class="list-group list-group-flush">
                <a href="profile.php" class="list-group-item list-group-item-action "><span data-feather="user"></span> Profile</a>
                <a href="logout.php" class="list-group-item list-group-item-action "><span data-feather="power"></span> Logout</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light  border-bottom">


                <button class="toggler" type="button" id="menu-toggle" aria-expanded="false">
                    <span data-feather="menu"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="25">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="profile.phcol-mdp">Your Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container">
                <h3 class="mt-4 text-center">Add Your Transactions</h3>
                <hr>
                <div class="row ">

                    <div class="col-md-3"></div>

                    <div class="col-md" style="margin:0 auto;">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label for="Transaction" class="col-sm-6 col-form-label"><b>Enter Amount(Rs.)</b></label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control col-sm-12" value="<?php echo $Transaction; ?>" id="Transaction" name="Transaction" required/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="toaccount" class="col-sm-6 col-form-label"><b>To Account</b></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control col-sm-12" value="<?php echo $toaccount; ?>" id="toaccount" name="toaccount" required/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Holdername" class="col-sm-6 col-form-label"><b>Account Holder Name</b></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control col-sm-12" value="<?php echo $holdername; ?>" id="Holdername" name="Holdername" required/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="transactionnote" class="col-sm-6 col-form-label"><b>Note</b></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control col-sm-12" value="<?php echo $transactionnote; ?>" id="transactionnote" name="transactionnote" required/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="transactiondate" class="col-sm-6 col-form-label"><b>Date</b></label>
                                <div class="col-md-6">
                                    <input type="date" class="form-control col-sm-12" value="<?php echo $transactiondate; ?>" name="transactiondate" id="transactiondate" required/>
                                </div>
                            </div>
                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-6 pt-0"><b>Category</b></legend>
                                    <div class="col-md">

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="transactioncategory" id="transactioncategory4" value="Medicine" <?php echo ($transactioncategory == 'Medicine') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="transactioncategory4">
                                                Medicine
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="transactioncategory" id="transactioncategory3" value="Food" <?php echo ($transactioncategory == 'Food') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="transactioncategory3">
                                                Food
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="transactioncategory" id="transactioncategory2" value="Bills & Recharges" <?php echo ($transactioncategory == 'Bills & Recharges') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="transactioncategory2">
                                                Bills and Recharges
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="transactioncategory" id="transactioncategory1" value="Entertainment" <?php echo ($transactioncategory == 'Entertainment') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="transactioncategory1">
                                                Entertainment
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="transactioncategory" id="transactioncategory7" value="Clothings" <?php echo ($transactioncategory == 'Clothings') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="transactioncategory7">
                                                Clothings
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="transactioncategory" id="transactioncategory6" value="Rent" <?php echo ($transactioncategory == 'Rent') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="transactioncategory6">
                                                Rent
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="transactioncategory" id="transactioncategory8" value="Household Items" <?php echo ($transactioncategory == 'Household Items') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="transactioncategory8">
                                                Household Items
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="transactioncategory" id="transactioncategory5" value="Others" <?php echo ($transactioncategory == 'Others') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="transactioncategory5">
                                                Others
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group row">
                                <div class="col-md-12 text-right">
                                    <?php if ($update == true) : ?>
                                        <button class="btn btn-lg btn-block btn-warning"  type="submit" name="update">Update</button>
                                    <?php elseif ($del == true) : ?>
                                        <button class="btn btn-lg btn-block btn-danger" style="border-radius: 0%;" type="submit" name="delete">Delete</button>
                                    <?php else : ?>
                                        <button type="submit" name="add" class="btn btn-lg btn-block btn-success" style="border-radius: 0%;">Add Transaction</button>
                                    <?php endif ?>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-3"></div>
                    
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    <script src="js/jquery.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    <script>
        feather.replace();
    </script>
    <script>

    </script>
</body>
</html>