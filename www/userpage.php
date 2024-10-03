<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    
    <script>
        window.alert = function() {
            confirm("well done");
        }
    </script>
</head>
<body>
    <?php include 'header.php'; ?> <!-- Include the header -->

    <div>
        <h1 align="center">Welcome</h1>
    </div>

    <div>
        <?php 
            ini_set("display_errors", 0);
            $str = $_GET["name"];
            echo "<h2 align=center>user:".$str."</h2>";
        ?>
    </div>
</body>
</html>
