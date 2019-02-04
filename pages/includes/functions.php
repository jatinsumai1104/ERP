<?php
   require_once("db.php");
   function checkQueryResult($resultset){
      if(!$resultset){
         global $connection;
         die("Query failed ".mysqli_error($connection));
      }
   }

   function getLoggedInEmployeeName($LoggedInId){
      global $connection;
      $query = "SELECT * FROM employee WHERE employee_id = $LoggedInId";
      $employee_details = mysqli_query($connection,$query);
      checkQueryResult($employee_details);
      if($row = mysqli_fetch_assoc($employee_details)){
         return $row['employee_name'];
      }
      
   }

function insert($tableName, $columns, $values){
    global $connection;
    $query = "INSERT INTO $tableName($columns) VALUES ($values)";
    
    $resultset = mysqli_query($connection, $query);
    checkQueryResult($resultset);
    return $resultset;
}
function delete($tableName, $primaryKeyColumnName, $primaryKeyValue , $employee_id){
    global $connection;
    $query = "UPDATE $tableName SET deleted = 1, deleted_at=now(), deleted_by = $employee_id WHERE $primaryKeyColumnName =$primaryKeyValue";
    $result = mysqli_query($connection,$query);
    checkQueryResult($result);
}
function redirect($url){
    header("Location: $url");
    exit();
}

?>