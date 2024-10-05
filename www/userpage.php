<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    
    <link rel="stylesheet" href="css/userpage.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <h1>User Profile</h1>

        <div class="user-info">
            <?php
                ini_set("display_errors", 0);


                $servername = "localhost";
                $username = "root";        
                $password = "root";        
                $dbname = "user_database"; 


                $conn = new mysqli($servername, $username, $password, $dbname);

 
                if ($conn->connect_error) {
                    die("connection failed: " . $conn->connect_error);
                }


                $str = $_GET["name"];


                $sql = "SELECT * FROM users WHERE name = '$str'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {

                    while($row = $result->fetch_assoc()) {
                        echo "<h2>Username: " . $row["name"] . "</h2>";
                        echo "<div class='avatar'><img src='" . $row["avatar_url"] . "' alt='User Avatar'></div>";
                        echo "<div class='details'>";
                        echo "<div><p>Full Name: <span>" . $row["full_name"] . "</span></p></div>";
                        echo "<div><p>Grade: <span>" . $row["grade"] . "</span></p></div>";
                        echo "<div><p>Gender: <span>" . $row["gender"] . "</span></p></div>";
                        echo "<div><p>Phone Number: <span>" . $row["phone_number"] . "</span></p></div>";
                        
                        echo "<div><p>Birthdate: <span>" . $row["birthdate"] . "</span></p></div>";
                        
                        echo "<div><p>Address: <span>" . $row["address"] . "</span></p></div>";
                        echo "</div>";
                    }
                } else {
                    echo "<h2>No user found with name: " . $str . "</h2>";
                }


                $conn->close();
            ?>
        </div>
    </div>

</body>
</html>
