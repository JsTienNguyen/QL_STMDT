<?php
 require('Ketnoi.php');
 $ID_hd = isset($_POST['ID_HD']) ? $_POST['ID_HD'] : '';
 $updateQuery = "UPDATE oder SET Status = 1 WHERE ID = $ID_hd";
 mysqli_query($conn, $updateQuery);
 ?>