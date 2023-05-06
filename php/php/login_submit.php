<?php
    session_start();
    include 'config.php';
    if( isset($_POST['submit']) && $_POST["email"] != '' && $_POST["password"] != ''){
        $email = $_POST["email"];
        $password = $_POST["password"];
        // $password = md5($password); 

        $sql_admin = "SELECT * FROM user_inf WHERE email = '$email' AND password = '$password' AND role='admin'";
        $sql_user = "SELECT * FROM user_inf WHERE email = '$email' AND password = '$password' AND role='user'";
        $rs_admin = mysqli_query($conn, $sql_admin);
        $rs_user = mysqli_query($conn, $sql_user);

        if(mysqli_num_rows($rs_admin) > 0){
            // echo "Đăng nhập thành công rồi nha!";
            $_SESSION["email"] = $email;  
            header("http://localhost:3000/Downloads/CODE_WEB_TRACNGHIEM/Header-Vinh/Header-Vinh/main_logined/trac_nghiem.html");
            
        }
        if(mysqli_num_rows($rs_user) > 0){
            $_SESSION["email"] = $email; 
            header("Location: http://127.0.0.1:3000/main_user/trac_nghiem.html");
        }
        else{
            echo '<script language="javascript">
                    alert("Nhập sai password hoặc user");
                    window.history.back("login.php");
                </script>';
        }
    }

    else{
        echo '<script language="javascript">
            alert("Hãy nhập đủ thông tin!");
            window.location="login.php";
        </script>';
    }
?>