<?php
    require("mysqlConnect.php");
    $mysqli->select_db("bookstore");
    $sql = "SELECT * FROM books";
    $res = $mysqli->query($sql);
    echo "<table>";
    while($row = $res->fetch_assoc()) {
        echo "<tr>";
        echo "<td><img src=showImage.php?book_id=".$row['book_id']."/></td>";
        echo "<td><b>".$row['title']."</b>:<br/>".$row['introduction']."</td>";
        echo "</tr>";
    }
    echo "</table>";
?>
