<?php
 require('Ketnoi.php');

    
    $rating = isset($_POST['rating']) ? $_POST['rating'] : '';
    $ID = isset($_POST['productID']) ? $_POST['productID'] : '';
    echo $ID;
    $updateQuery = "UPDATE oder_deltail SET vote = $rating,value =2 WHERE ID = $ID";
    mysqli_query($conn, $updateQuery);

    $sql1 = "SELECT * FROM oder_deltail WHERE value = 2 AND ID = $ID ";
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_assoc();
    $productID = $row1["productID"];

    $sql = "SELECT COUNT(*) as total_rows, SUM(vote) as total_votes, SUM(quantity) as total_quantity, productID FROM oder_deltail WHERE value = 2 and ProductID = $productID ";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $totalRows = $row["total_rows"];
    $totalVotes = $row["total_votes"];
    $totalQuantity = $row["total_quantity"];
    $total =  $totalVotes/$totalRows;
   
    echo $totalQuantity;
        $updateQuery1 = "UPDATE products SET vote = $total,Totalbuy =$totalQuantity  WHERE ProductID = $productID";
        mysqli_query($conn, $updateQuery1);  
        
    ?>