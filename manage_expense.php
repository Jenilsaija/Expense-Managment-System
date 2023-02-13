<?php
include("session.php");
$exp_fetched = mysqli_query($con, "SELECT * FROM expenses WHERE user_id = '$userid'");

$exp_fetched1 = mysqli_query($con, "SELECT * FROM expenses WHERE user_id = '$userid'");

$t_fetched = mysqli_query($con, "SELECT * FROM Transactions WHERE user_id = '$userid'");

$t_fetched1= mysqli_query($con, "SELECT * FROM Transactions WHERE user_id = '$userid'");

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Manage Expense - D.E.M.S.</title>
    <link rel="icon" type="image/x-icon" href="./icon/budget.ico"/>
    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#Transaction").hide();
            $("#select").on('change',function(){
                if($(this).val()=='2'){
                    $("#Expanses").hide();
                    $("#Transaction").show();
                }else if($(this).val()=='1'){
                    $("#Transaction").hide();
                    $("#Expanses").show();
                }
            });
        });
    </script>

    <!-- Feather JS for Icons -->
    <script src="js/feather.min.js"></script>
    <style media="all">
#mobile-display{display:none}
#desktop-display{display:block}
@media (max-width:700px){
#desktop-display {display:none}
#mobile-display {display:block}
}
</style>


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
                <a href="add_transaction.php" class="list-group-item list-group-item-action "><span data-feather="plus-square"></span> Add Transaction</a>
                <a href="manage_expense.php" class="list-group-item list-group-item-action sidebar-active"><span data-feather="dollar-sign"></span> Manage Expenses</a>
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
                                <a class="dropdown-item" href="#">Your Profile</a>
                                <a class="dropdown-item" href="#">Edit Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid">
                <h3 class="mt-4 text-center">Manage Your Money</h3>
                <hr>
                <select class="form-control form-control-lg"name="select"id="select">
                    <option value="1" selected>Expanses</option>
                    <option value="2">Transaction</option>
                </select>
                <hr>
                <div id="Expanses" name="Expanses">
                <h2 class="mt-4 text-center">Expenses</h2>
                    <hr>
                    <div class="row justify-content-center">

                    <div class="col-md-9">
                        
                        <div id="desktop-display">
                            <table class="table table-hover table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Expense Note</th>
                                    <th>Expense Category</th>
                                    <th>Amount(RS.)</th>
                                    <th>Date</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>

                            <?php $count=1; while ($row = mysqli_fetch_array($exp_fetched)) { ?>
                            
                                <tr>
                                    <td><?php echo $count;?></td>
                                    <td><?php echo $row['expensenote']; ?></td>
                                    <td><?php echo $row['expensecategory']; ?></td>
                                    <td><?php echo $row['expense']; ?></td>
                                    <td><?php echo $row['expensedate']; ?></td>
                                    <td class="text-center">
                                        <a href="add_expense.php?edit=<?php echo $row['expense_id']; ?>" class="btn btn-primary btn-sm" style="border-radius:0%;">Edit</a>
                                    </td>
                                    <td class="text-center">
                                        <a href="add_expense.php?delete=<?php echo $row['expense_id']; ?>" class="btn btn-danger btn-sm" style="border-radius:0%;">Delete</a>
                                    </td>
                                </tr>
                            
                                
                            <?php $count++; } ?>
                            </table>
                        </div>
                        <div id="mobile-display">
                            <table class="table table-hover table-bordered">
                            <?php $count=1; while ($row = mysqli_fetch_array($exp_fetched1)) { ?>
                                
                                    <tr>
                                    <td>
                                    <tr>Sr No.: <?php echo $count;?></tr></br>
                                    <tr>Expense Note: <?php echo $row['expensenote']; ?></tr></br>
                                    <tr>Expense Category: <?php echo $row['expensecategory']; ?></tr></br>
                                    <tr>Amount(RS.): <?php echo $row['expense']; ?></tr></br>
                                    <tr>Date: <?php echo $row['expensedate']; ?></tr></br>
                                    <tr>Action:<a href="add_expense.php?edit=<?php echo $row['expense_id']; ?>" class="btn btn-primary btn-sm" style="border-radius:0%;">Edit</a>&nbsp;&nbsp;
                                    <a href="add_expense.php?delete=<?php echo $row['expense_id']; ?>" class="btn btn-danger btn-sm" style="border-radius:0%;">Delete</a></tr></br></br>
                                    </td>
                                    </tr>
                            <?php $count++; } ?>
                            </table>
                        </div>
                    </div>

                </div></div>
                <div id="Transaction" name="Transaction">
                <h2 class="mt-4 text-center">Transactions</h2>
                    <hr>
                    <div class="row justify-content-center">

                    <div class="col-md-9">
                        
                        <div id="desktop-display">
                            <table class="table table-hover table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>To Account</th>
                                    <th>Account Holder Name</th>
                                    <th>Amount(RS.)</th>
                                    <th>Date</th>
                                    <th>Note</th>
                                    <th>Catagory</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>

                            <?php $count=1; while ($row = mysqli_fetch_array($t_fetched)) { ?>
                            
                                <tr>
                                    <td><?php echo $count;?></td>
                                    <td><?php echo $row['ToAccount']; ?></td>
                                    <td><?php echo $row['AcholderName']; ?></td>
                                    <td><?php echo $row['Transaction']; ?></td>
                                    <td><?php echo $row['transactiondate']; ?></td>
                                    <td><?php echo $row['transactionnote']; ?></td>
                                    <td><?php echo $row['transactioncategory']; ?></td>
                                    <td class="text-center">
                                        <a class="btn btn-primary btn-sm" href="add_transaction.php?edit=<?php echo $row['t_id']; ?>" style="border-radius:0%">Edit</a>
                                    </td>
                                    <td class="text-center">
                                        <a href="add_transaction.php?delete=<?php echo $row['t_id']; ?>" class="btn btn-danger btn-sm" style="border-radius:0%;">Delete</a>
                                    </td>
                                </tr>
                            
                                
                            <?php $count++; } ?>
                            </table>
                        </div>
                        <div id="mobile-display">
                            <table class="table table-hover table-bordered">
                            <?php $count=1; while ($row = mysqli_fetch_array($t_fetched1)) { ?>
                                
                                    <tr>
                                    <td>
                                    <tr>Sr No.: <?php echo $count;?></tr></br>
                                    <tr>To Account: <?php echo $row['ToAccount']; ?></tr></br>
                                    <tr>Account Holder Name: <?php echo $row['AcholderName']; ?></tr></br>
                                    <tr>Amount(RS.): <?php echo $row['Transaction']; ?></tr></br>
                                    <tr>Date: <?php echo $row['transactiondate']; ?></tr></br>
                                    <tr>Note: <?php echo $row['transactionnote']; ?></tr></br>
                                    <tr>Catagory: <?php echo $row['transactioncategory']; ?></tr></br>
                                    <tr>Action:<a href="add_transaction.php?edit=<?php echo $row['t_id']; ?>" class="btn btn-primary btn-sm" style="border-radius:0%;">Edit</a>&nbsp;&nbsp;
                                    <a href="add_transaction.php?delete=<?php echo $row['t_id']; ?>" class="btn btn-danger btn-sm" style="border-radius:0%;">Delete</a></tr></br></br>
                                    </td>
                                    </tr>
                            <?php $count++; } ?>
                            </table>
                        </div>
                    </div>

                </div></div>
                                                       

                </div>
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
        feather.replace()
    </script>

</body>

</html>