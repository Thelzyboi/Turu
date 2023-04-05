<?php
    session_start();
    include('server/connection.php');

    if (isset($_SESSION['logged_in'])) {
        header('location: dashboard.php');
        exit;
    }

    if (isset($_POST['login_btn'])) {
        
        $email = $_POST['email'];
        $password = ($_POST['password']);

        $query = "SELECT id_admin, username, email, password, no_telepon FROM admin
        WHERE email = ? AND password = ? LIMIT 1";

        $stmt_login = $conn->prepare($query);
        $stmt_login->bind_param('ss', $email, $password);
        
        if ($stmt_login->execute()) {
            $stmt_login->bind_result($id_admin, $username, $user_email, $user_password, 
            $no_telepon);
            $stmt_login->store_result();

            if ($stmt_login->num_rows() == 1) {
                $stmt_login->fetch();

                $_SESSION['user_id'] = $id_admin;
                $_SESSION['user_name'] = $username;
                $_SESSION['user_email'] = $useremail;
                $_SESSION['user_phone'] = $telepon;
                $_SESSION['logged_in'] = true;
                
                header('location:dashboard.php?message=Logged in successfully');
            } else {
                header('location:login.php?error=Could not verify your account');
            }
        } else {
            // Error
            header('location: login.php?error=Something went wrong!');
        }
    }
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Sayang</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="/image/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
</head>
    <!-- Login Section Begin -->
    <section>
        <div class="box">
            <form id="login-form" action="login.php" method="post">
                <?php if (isset($_GET['error'])) ?>
                    <div role="alert">
                        <?php if (isset($_GET['error'])) {
                            echo $_GET['error'];
                    } ?>
                    </div>

                    <div class="container">
                        <div class="top">
                            <span>Login</span>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email">
                            <i class="bx bx-envelope"></i>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password">
                            <i class="bx bx-key"></i>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary" name="login_btn" value="LOGIN">Login</button>
                            <a href="register.html" class="btn btn-primary" role="button">Register</a>
                        </div>
                        
                    </div>
            </form>
        </div>
    </section>