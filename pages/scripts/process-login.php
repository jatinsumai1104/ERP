<?php
   require_once("../includes/db.php");
   require_once("../includes/functions.php");
   session_start();
   if(isset($_POST["submit"]))
      {
         $username=$_POST["username"];
         $password =$_POST["password"];
         $username= mysqli_real_escape_string($connection,$username);
         $password=mysqli_real_escape_string($connection,$password);
         $query = "SELECT * FROM employee WHERE  employee_email = '$username'";
      $select_user_details = mysqli_query($connection,$query);
      //Proceed if there is data
      checkQueryResult($select_user_details);
      //proceed only if the data is returned...
      if(mysqli_num_rows($select_user_details)>1)
      {
         die("how");
         //Later we would create the page in a user friendly manner..
         //header();
      }
      //if i m coming here that means i have exactly 0/1 rows
      //$db_password =""
      //There are two methods to handle password...
      
      if($row= mysqli_fetch_assoc($select_user_details)){
         //i have 1 row
         $db_password =$row['employee_password'];
         $employee_id = $row['employee_id'];
         
      }else{
         $db_password="";
      }
      
      if(password_verify($password,$db_password)){
         $_SESSION['employee_id']= $employee_id;
         header("location:../index.php");
         
      }else{
         die("Kya baat hai!!");
         //header()
      }
   }
   else{
      echo "The page was not submitted";
   }
?>