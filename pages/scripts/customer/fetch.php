<?php
 require_once("../../includes/db.php");
session_start();
if(isset($_POST["customer_id"])){
   $customer_id = $_POST['customer_id'];
   $query = "SELECT customer_id,customer_name,customer_address,customer_contact, customer_email,gst_no FROM customer HAVING customer.customer_id = $customer_id";
   $result = mysqli_query($connection,$query);
   $row = mysqli_fetch_assoc($result);
   echo json_encode($row);
}
?>