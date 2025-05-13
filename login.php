<?php
// Database connection
define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASS","");
define("DB_NAME","salon");

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

error_reporting(0);
session_start();

// Login Processing
if (isset($_POST['sub'])) {
    $name = $_POST['username'];
    $pass = sha1($_POST['password']);
    $sql = "SELECT * FROM users WHERE username='$name' AND password='$pass'";
    $query = mysqli_query($conn, $sql);
    if ($r = mysqli_fetch_array($query)) {
        $pos = $r['position'];
    }
    $count = mysqli_num_rows($query);
    if ($count == 1) {
        $_SESSION['user'] = $name;
        header("Location: Customer/");
    } else {
        echo "<div class='alert error'>❌ Login Failed. Try Again.</div>";
    }
}

// Registration Processing
if (isset($_POST['sign'])) {
    $name = $_POST['fname'];
    $sname = $_POST['sname'];
    $username = $_POST['uname'];
    $email = $_POST['uemail'];
    $pass = sha1($_POST['pass']);
    $cpass = sha1($_POST['cpass']);
    $id = $_POST['id'];
    $tel = $_POST['tel'];
    if ($pass != $cpass) {
        echo "<div class='alert error'>❌ Passwords Do Not Match.</div>";
    } else {
        $sql = "INSERT INTO users (fname, sname, username, email, password, c_id, c_tel, type)
                VALUES ('$name', '$sname', '$username', '$email', '$pass', '$id', '$tel', 'Customer')";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            echo "<div class='alert success'>✅ Registered Successfully. Please login.</div>";
        } else {
            echo "<div class='alert error'>❌ Registration Failed. Try Again.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Login</title>
    <style>
        body {
            background: linear-gradient(to right, #2c3e50, #3498db);
            font-family: 'Segoe UI', sans-serif;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            background: rgba(0,0,0,0.4);
            padding: 20px 0;
            font-size: 28px;
            font-weight: bold;
            position: relative;
        }

        .header .icon {
            font-size: 40px;
            display: block;
            margin-bottom: 10px;
        }

        .container {
            width: 400px;
            margin: 30px auto;
            background: rgba(255,255,255,0.1);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 10px #000;
        }

        form {
            display: none;
        }

        form.active {
            display: block;
        }

        fieldset {
            border: none;
        }

        legend {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .label-control {
            display: block;
            margin: 10px 0 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background-color: #27ae60;
            border: none;
            color: white;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn:hover {
            background-color: #2ecc71;
        }

        .toggle-link, .back-home {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #ecf0f1;
            cursor: pointer;
            text-decoration: underline;
        }

        .alert {
            width: 400px;
            margin: 10px auto;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            font-weight: bold;
        }

        .alert.success {
            background-color: #2ecc71;
            color: #fff;
        }

        .alert.error {
            background-color: #e74c3c;
            color: #fff;
        }

        .back-home {
            position: absolute;
            top: 15px;
            left: 20px;
            font-size: 16px;
        }

        a {
            color: #f1c40f;
        }
    </style>
    <script>
        function showLoginForm() {
            document.querySelector('.login-form').classList.add('active');
            document.querySelector('.signup-form').classList.remove('active');
        }

        function showSignUpForm() {
            document.querySelector('.signup-form').classList.add('active');
            document.querySelector('.login-form').classList.remove('active');
        }

        window.onload = function() {
            showLoginForm();
        };
    </script>
</head>
<body>

    <div class="header">
        <div class="icon">👤</div>
        Customer Login System
        <a href="index.php" class="back-home">← Back Home</a>
    </div>

    <div class="container">
        <!-- Login Form -->
        <form method="POST" action="" class="login-form active">
            <fieldset>
                <legend>Login</legend>
                <label class="label-control">Username</label>
                <input type="text" name="username" required placeholder="Enter Username">
                <label class="label-control">Password</label>
                <input type="password" name="password" required placeholder="Enter Password">
                <button type="submit" class="btn" name="sub">Login</button>
                <span class="toggle-link" onclick="showSignUpForm()">Not a member? Sign Up</span>
            </fieldset>
        </form>

        <!-- Signup Form -->
        <form method="POST" action="" class="signup-form">
            <fieldset>
                <legend>Sign Up</legend>
                <label class="label-control">First Name</label>
                <input type="text" name="fname" required>
                <label class="label-control">Last Name</label>
                <input type="text" name="sname" required>
                <label class="label-control">Username</label>
                <input type="text" name="uname" required>
                <label class="label-control">Email</label>
                <input type="email" name="uemail" required>
                <label class="label-control">Password</label>
                <input type="password" name="pass" required>
                <label class="label-control">Confirm Password</label>
                <input type="password" name="cpass" required>
                <label class="label-control">ID Card Number</label>
                <input type="number" name="id" required>
                <label class="label-control">Telephone Number</label>
                <input type="number" name="tel" required>
                <button type="submit" class="btn" name="sign">Sign Up</button>
                <span class="toggle-link" onclick="showLoginForm()">Already have an account? Login</span>
            </fieldset>
        </form>
    </div>

</body>
</html>
