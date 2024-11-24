<?php
require "controller/config.php";
include "components".DS."header.php";
?>

<body>
    <?php require "components".DS."nav_bar.php"; ?>
    <div class="container">
    <?php echo "<h1>Test database</h1>"; ?>

    <?php

    $conn = mysqli_connect('localhost', 'root', 'root', "insa_db");

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
    // var_dump($_SESSION['user_id']);
    mysqli_close($conn);

    ?>
    <h1>Test FTP connection</h1>
    <?php
        $ftp_conn = ftp_connect(FTP_HOST) or die("Could not connect to localhost");
        ftp_login($ftp_conn, FTP_USER, FTP_PASS) or die("Could not login");
        ftp_pasv($ftp_conn, true);
        $files = scandir(LOCAL_PATH);
        var_dump($files);
        $files_on_ftp = ftp_nlist($ftp_conn, REMOTE_PATH);
        var_dump($files_on_ftp);
        if ( ftp_put($ftp_conn, REMOTE_PATH . "/files/abc.txt", LOCAL_PATH . "/abc.txt", FTP_BINARY) ) {
            var_dump("File uploaded successfully") ;
        } else {
            var_dump("Error uploading file") ;
        }
    ?>
    
    </div>
</body>
</html>