<?php
require "controller/config.php";
include "components".DS."header.php";
?>

<body>
    <?php require "components".DS."nav_bar.php"; ?>
    <div class="container">
    <?php echo "<h1>Test database</h1>"; ?>

    <?php

    $conn = mysqli_connect('db', 'root', 'test', "insa_db");

    $query = 'SELECT * From Users';
    $result = mysqli_query($conn, $query);
    echo "<table border='1'>";
    if ( !$result ) {
        echo "No res";
    }
    else{
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['nom'] . "</td>";
            echo "<td>" . $row['prenom'] . "</td>";
            echo "</tr>";
    }}
    
    echo "</table>";
    // echo $_SESSION['user_id'];
    // $result->close();
    var_dump($_SESSION['user']);
    mysqli_close($conn);

    ?>
    
    </div>
</body>
</html>