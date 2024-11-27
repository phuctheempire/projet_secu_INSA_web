<?php

function getUserInfo($user_id) {
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $query = "SELECT nom, prenom, email, sexe, date_naissance, adresse, telephone, image_path, role From Users WHERE id = $user_id LIMIT 1";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $user_info = array(
        "nom" => $row['nom'],
        "prenom" => $row['prenom'],
        "email" => $row['email'],
        "sexe" => $row['sexe'],
        "date_naissance" => $row['date_naissance'],
        "adresse" => $row['adresse'],
        "telephone" => $row['telephone'],
        "image_path" => $row['image_path'],
        "role" => $row['role']
    );
    mysqli_close($conn);
    return $user_info;
}


// 获取所有用户信息
function getAllUsers() {
    global $conn;
    $query = "SELECT id, nom, prenom, email, role FROM Users"; // 确保查询语句正确
    $result = mysqli_query($conn, $query);
    $users = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
    } else {
        die("Database Query Failed: " . mysqli_error($conn));
    }
    return $users;
}


function a_getUserById($user_id) {
    global $conn;
    $query = "SELECT id, password, nom, prenom, email, sexe, date_naissance, adresse, telephone, image_path, role FROM Users WHERE id = $user_id;";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query Failed: " . mysqli_error($conn));
    }

    $user = mysqli_fetch_assoc($result); // 获取用户主信息

    if ($user === false) {
        return null; // 用户不存在时返回 null
    }
    // 根据角色查询额外信息
    if ($user['role'] === 'Student') {
        $query = "SELECT departement, promo, group_td, group_tp, group_anglais FROM Students WHERE stu_id = $user_id";
        $result = mysqli_query($conn, $query);
        if ($result && $student_info = mysqli_fetch_assoc($result)) {
            $user = array_merge($user, $student_info); // 合并用户和学生信息
        }
    } elseif ($user['role'] === 'Teacher') {
        $query = "SELECT departement FROM Professeurs WHERE prof_id = $user_id";
        $result = mysqli_query($conn, $query);
        if ($result && $teacher_info = mysqli_fetch_assoc($result)) {
            $user = array_merge($user, $teacher_info); // 合并用户和教师信息
        }
    }

    return $user;
}

// function updateUser($user) {
//     global $db;

//     // 确保在查询中使用了所有字段
//     $query = "UPDATE Users 
//               SET 
//                 nom = :nom, 
//                 prenom = :prenom, 
//                 email = :email, 
//                 password = :password, 
//                 sexe = :sexe, 
//                 date_naissance = :date_naissance, 
//                 adresse = :adresse, 
//                 telephone = :telephone, 
//                 image_path = :image_path, 
//                 role = :role 
//               WHERE id = :id";

//     // 准备语句
//     $stmt = $db->prepare($query);

//     // 绑定参数
//     $stmt->bindParam(':id', $user['id']);
//     $stmt->bindParam(':email', $user['email']);
//     $stmt->bindParam(':password', $user['password']);
//     $stmt->bindParam(':nom', $user['nom']);
//     $stmt->bindParam(':prenom', $user['prenom']);
//     $stmt->bindParam(':sexe', $user['sexe']);
//     $stmt->bindParam(':date_naissance', $user['date_naissance']);
//     $stmt->bindParam(':adresse', $user['adresse']);
//     $stmt->bindParam(':telephone', $user['telephone']);
//     $stmt->bindParam(':image_path', $user['image_path']);
//     $stmt->bindParam(':role', $user['role']);

//     // 执行查询
//     $success = $stmt->execute();

//     // 返回执行结果
//     return $success;
// }


function updateUser(array $user) {
    global $conn;
    $u_id = $user['id'];
    $u_email = $user['email'];
    $u_password = $user['password'];
    $u_nom = $user['nom'];
    $u_prenom = $user['prenom'];
    $u_sexe = $user['sexe'];
    $u_date_naissance = $user['date_naissance'];
    $u_adresse = $user['adresse'];
    $u_telephone = $user['telephone'];
    $u_image_path = $user['image_path'];
    $query = "UPDATE Users SET email = '$u_email', password = '$u_password', nom = '$u_nom', prenom = '$u_prenom', sexe = '$u_sexe', date_naissance = '$u_date_naissance', adresse = '$u_adresse', telephone = '$u_telephone', image_path = '$u_image_path 'WHERE id = '$u_id'";
    $result = mysqli_query($conn, $query);
    return $result;

}
function updateUserImagePath($id, $image_path) {
    global $db;

    // SQL 查询，更新指定用户的 image_path
    $query = "UPDATE Users 
              SET image_path = :image_path 
              WHERE id = :id";

    // 准备语句
    $stmt = $db->prepare($query);

    // 绑定参数
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':image_path', $image_path);

    // 执行查询
    try {
        $success = $stmt->execute();
    } catch (PDOException $e) {
        die("Error updating image_path: " . $e->getMessage());
    }

    // 返回执行结果
    return $success;
}

function updateUserPassword($id, $password) {
    global $conn;
    $query = "UPDATE Users SET password = $password WHERE id = $id";
    $result = mysqli_query($conn, $query);
    echo "<h2>" . $result . "</h2>";
    return $result;
}

function updateAllUsersImagePathToDefault() {
    global $conn;


    $query = "UPDATE Users SET image_path = 'hahahahah'";


    $result = mysqli_query($conn, $query);


    if (!$result) {
        die("Failed to update image paths: " . mysqli_error($conn));
    }


    return mysqli_affected_rows($conn);
}

?>