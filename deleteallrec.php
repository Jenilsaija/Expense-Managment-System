<?php 

include("session.php");
$message="";
                $sql = "DELETE FROM expenses";
                if (mysqli_query($con, $sql)) {
                    $message="All Expenses ,";
                }  
                $sql = "DELETE FROM transactions";
                if ( mysqli_query($con, $sql)) {
                    $message=$message."\nAll Transactions ";
                 } 
                 $message=$message."Deleted Successfully";
                 $_SESSION["message"]=$message;
                 header('location: profile.php');
            