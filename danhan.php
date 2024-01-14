<?php
require('Ketnoi.php');


    $ID = isset($_POST['productID']) ? intval($_POST['productID']) : 0;
   echo $ID;
   $updateQuery = "UPDATE oder_deltail SET value = 1 WHERE ID = $ID";
     mysqli_query($conn, $updateQuery);
     ?>