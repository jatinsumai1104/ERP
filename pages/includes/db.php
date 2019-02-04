<?php

require_once("constants.php");
$connection = mysqli_connect(SERVER,USER,PASSWORD,DB);
if(!$connection)
{
   echo "Connection falied due to ".mysqli_error($connection);
}
?>