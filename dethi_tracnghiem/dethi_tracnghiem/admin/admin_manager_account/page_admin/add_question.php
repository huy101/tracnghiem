<?php

try {
    include('connect.php');
    // $role = $_POST['role'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "insert into user_inf(name,email,password,role)";
    $sql = $sql."value('".$name."','".$email."','".$password."','user')";
    if ($conn->query($sql) == TRUE) {
        echo "Thêm câu hỏi thành công";
    } 
    else {
        echo "Không thêm được câu hỏi";
    }
} catch (Exception $e) {
    echo "Lỗi" .$e;
}
