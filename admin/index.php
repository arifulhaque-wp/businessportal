<?php

    require "../db.php";

    if ( isset( $_POST['login'] ) ) {

        $admin_email = $_POST['email'];
        $admin_pass  = $_POST['password'];

        $admin_pass_hash = md5( $admin_pass );

        $errors = array();

        $empmsg_aemail = "";
        $empmsg_apass  = "";
        $empmsg_login  = "";

        if ( empty( $admin_email ) ) {
            $empmsg_aemail = "Email is empty.";
        }

        if ( empty( $admin_pass ) ) {
            $empmsg_apass = "Password is empty.";
        }

        if (  ( $admin_email && $admin_pass ) == TRUE ) {
            $empmsg_login = "Email or Password not match";
        }

        if ( !empty( $admin_email ) && !empty( $admin_pass ) ) {

            $sql = "SELECT * FROM admin WHERE email = '$admin_email' AND password = '$admin_pass_hash'";

            $query = $conn->query( $sql );

            if ( $query->num_rows > 0 ) {
                header( 'Location:dashboard.php' );
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login</title>

    <link rel="shortcut icon" href="../assets/images/favicon/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<body>
    <div class="container">
        <div class="content-area">
            <h2 class="title-text">Admin Login</h2>
            <p class="text-center text-danger"><?php if ( isset( $_POST['login'] ) ) {echo $empmsg_login;} ?></p>
            <div class="form-container">
                <form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post" id="login_form"
                    class="login-form">
                    <div class="avater">
                        <img src="assets/images/avatar-1295397__340.webp" alt="profile">
                    </div>

                    <div class="mb-3">
                        <input type="email" class="form-control" id="useremail" name="email" placeholder="Admin Email">
                        <span class="text-danger"><?php if ( isset( $_POST['login'] ) ) {echo $empmsg_aemail;} ?></span>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="password">
                        <span class="text-danger"><?php if ( isset( $_POST['login'] ) ) {echo $empmsg_apass;} ?></span>
                    </div>
                    <div class="submit-btn">
                        <button type="submit" name="login" class="btn">Login</button>
                    </div>
                    <div id="createAccount" class="form-text text-center my-2 text-dark">
                        Not Registered? <a href="registration.php" class="text-dark fw-bold">Create an Account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.6.4.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>