<?php

function getAllMailsByID($id) {
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $query = "SELECT mail_id, sender_id, receiver_id, title, date FROM Mails WHERE sender_id = $id OR receiver_id = $id ORDER BY date DESC";
    $result = mysqli_query($conn, $query);
    $mails = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $mails[] = $row;
    }
    mysqli_close($conn);
    return $mails;
}

function send_email($email_cont) {
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $sender_id = $email_cont['sender_id'];
    $receiver_ids = get_id_by_email($email_cont['emails']);
    $title = $email_cont['title'];
    $content = $email_cont['content'];
    $date = $email_cont['date'];
    $error_not_sent = [];
    for ($i = 0; $i < count($receiver_ids); $i++) {
        $receiver_id = $receiver_ids[$i];
        $query = "INSERT INTO Mails (sender_id, receiver_id, title, content, date) VALUES ('$sender_id', '$receiver_id', '$title', '$content', '$date')";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            array_push($error_not_sent, $receiver_id);
        }
    }
    mysqli_close($conn);
    return $error_not_sent;
}
function get_id_by_email($email_list) {
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $ids = [];
    for ($i = 0; $i < count($email_list); $i++) {
        $email_tmp = $email_list[$i];
        $query = "SELECT id FROM Users WHERE email = '$email_tmp' LIMIT 1";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        if ($row){
            array_push($ids, $row["id"]);
        }
    }
    mysqli_close($conn);
    return $ids;
}
function get_email_by_id($id) {
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $query = "SELECT email FROM Users WHERE id = $id LIMIT 1";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    mysqli_close($conn);
    return $row['email'];
}

function get_email_detail( $id){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $query = "SELECT * FROM Mails WHERE mail_id = '$id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    mysqli_close($conn);
    return $row;
}