<?php
include("session.php");
    $userid=$_GET["uid"];
     $datastr="\t\t\t\tExpenses\n\n";
     $count=1;
     $record = mysqli_query($con, "SELECT * FROM expenses WHERE user_id='$userid'");
        while ($row = mysqli_fetch_array($record)) { 
            $expenseamount = $row['expense'];
            $expensedate = $row['expensedate'];
            $expensecategory = $row['expensecategory'];
            $expensenote=$row['expensenote'];
            $datastr=$datastr."Expense No.: ".$count."\nAmount: ".$expenseamount."\nNote: ".$expensenote."\nDate: ".$expensedate."\nCategory: ".$expensecategory."\n\n";
            $count++;
        }
                            
    $record = mysqli_query($con, "SELECT * FROM Transactions WHERE user_id='$userid'");
        $count=1;
        $datastr=$datastr."\n\n\t\t\t\tTransactions\n\n\n";
        while ($row = mysqli_fetch_array($record)) { 
            $Transaction = $row['Transaction'];
            $transactiondate = $row['transactiondate'];
            $transactioncategory = $row['transactioncategory'];
            $transactionnote=$row['transactionnote'];
            $toaccount=$row['ToAccount'];
            $holdername=$row['AcholderName'];
            $datastr=$datastr."Transaction No.: ".$count."\nAmount: ".$Transaction."\nTo Account: ".$toaccount."\nAC Holder Name: ".$holdername."\nNote: ".$transactionnote."\nDate: ".$transactiondate."\nCategory: ".$transactioncategory."\n\n\n\n\t\t\tEnd File";                        
            $count++;
        }
       
            $myfile = fopen("./Bakupeddata.txt", "w") or die("Unable to open file!");
            fwrite($myfile, $datastr);
            fclose($myfile);
            $_SESSION["message-bakup"]="File genetated Successfully Now you can Download";
            header('location: profile.php');
        ?>