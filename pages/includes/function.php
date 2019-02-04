<?php 

/***

*/
require_once("db.php");
function checkqueryresult($resultset)
{
    global $connection;
    if(!$resultset){
        die("Query Failed : ".mysqli_error($connection));
    }
}
function getLoggedInEmployeeName($LoggedInId){
    global $connection;
    $query = "SELECT * FROM employee WHERE employee_id = $LoggedInId";
    $employee_details = mysqli_query($connection,$query);
    checkqueryresult($employee_details);
    if($row = mysqli_fetch_assoc($employee_details)){
        return ($row['employee_name']);
    }
}
?>