<?php
include_once ROOT_PATH . DS . "functions" . DS . "admin" . DS . "admin_functions.php";
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $user = a_getUserById($user_id); // 在 admin_user_info.php 中定义的函数
}
$success = true;
// echo "<h2>". $success . "</h2>";
if (isset($_POST['save_btn'])) {
    $updated_user = [
        "id" => $_POST["id"],
        "nom" => $_POST["nom"],
        "prenom" => $_POST["prenom"],
        "email" => $_POST["email"],
        "password" => $_POST["password"],  // 确保包括 password 字段
        "role" => $_POST["role"],
        "sexe" => $_POST["sexe"],
        "date_naissance" => $_POST["date_naissance"],
        "adresse" => $_POST["adresse"],
        "telephone" => $_POST["telephone"],
        "image_path" => $_POST["image_path"]  // 确保包括 image_path 字段
    ];
    // Update user in database
    $success = updateUser($updated_user); // updateUser() 是 api 中的函数，用于更新用户数据
    echo "<h2>". $success . "</h2>";
    if ($success) {
        header("Location: admin_user.php");
        exit;
    } else {
        $error_message = "Failed to update user information.";
    }
}
?>