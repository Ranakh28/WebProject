<?php
include "db.php";
$from = $_GET['from'] ?? '';
// LOGIN
if (isset($_POST['login']) || isset($_POST['admin_login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {

        $user = $result->fetch_assoc();

        // ✅ IF ADMIN BUTTON CLICKED
        if (isset($_POST['admin_login'])) {

            if ($user['role'] === 'admin') {
                header("Location: admin_dashboard.php");
                exit();
            } else {
                echo "<script>alert('You are not an admin');</script>";
            }

        } 
        // ✅ NORMAL USER LOGIN
        else {

            if ($user['role'] === 'user') {

    // ✅ If came from Pay page
    if ($from === 'pay') {
        echo "<script>
        alert('Your order was placed successfully');
        window.location.href='homepage.php';
        </script>";
        exit();
    }

    // ✅ Normal login
    header("Location: homepage.php");
    exit();
} else {
                echo "<script>alert('Admins must use admin login');</script>";
            }

        }

    } else {
        echo "<script>alert('Wrong username or password');</script>";
    }
}

// SIGN UP
if (isset($_POST['signup'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (username, email, password)
            VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql)) {
        echo "<script>alert('Account created! You can now log in');</script>";
    } else {
        echo "<script>alert('Error creating account');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login / Sign Up</title>

<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #FAF7F2, #E2C2C6);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    background: white;
    padding: 35px;
    border-radius: 18px;
    width: 360px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.12);
    text-align: center;
}

h2 {
    color: #671D2D;
}

input {
    width: 100%;
    padding: 12px;
    margin-top: 10px;
    border-radius: 10px;
    border: 1px solid #E2C2C6;
    box-sizing: border-box;
}

/* PASSWORD */
.password-wrapper {
    position: relative;
}

.toggle-password {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #671D2D;
}

/* BUTTON */
button {
    width: 100%;
    padding: 12px;
    margin-top: 15px;
    border: none;
    border-radius: 10px;
    background: #671D2D;
    color: white;
    font-weight: bold;
    cursor: pointer;
}

button:hover {
    background: #2A1B18;
}

/* SWITCH TEXT */
.switch {
    margin-top: 15px;
    font-size: 14px;
    color: #671D2D;
    cursor: pointer;
}
</style>
</head>

<body>

<div class="container">

    <h2 id="title">Login</h2>

    <!-- LOGIN FORM -->
<form method="POST" action="?from=<?php echo htmlspecialchars($from); ?>" id="loginForm">

        <input type="text" name="username" placeholder="Username" required>

        <div class="password-wrapper">
    <input type="password" name="password" id="passwordLogin" placeholder="Password" required>
    <span class="toggle-password" id="iconLogin" onclick="togglePassword('passwordLogin','iconLogin')">👁</span>
</div>

        <button type="submit" name="login">Login as customer</button>
        <button type="submit" name="admin_login" style="background:black;">
    👑 Admin Login
</button>
    </form>

    <!-- SIGNUP FORM -->
    <form method="POST" id="signupForm" style="display:none;">

        <input type="text" name="username" placeholder="Username" required>

        <input type="email" name="email" placeholder="Email" required>

        <div class="password-wrapper">
    <input type="password" name="password" id="passwordSignup" placeholder="Password" required>
    <span class="toggle-password" id="iconSignup" onclick="togglePassword('passwordSignup','iconSignup')">👁</span>
</div>

        <button type="submit" name="signup">Sign Up</button>

    </form>

    <!-- SWITCH -->
    <div class="switch" onclick="toggleForms()">
        <span id="switchText">Don't have an account? Sign up</span>
    </div>

</div>

<script>
let isLogin = true;

function toggleForms() {
    isLogin = !isLogin;

    document.getElementById("loginForm").style.display = isLogin ? "block" : "none";
    document.getElementById("signupForm").style.display = isLogin ? "none" : "block";

    document.getElementById("title").innerText = isLogin ? "Login" : "Sign Up";
    document.getElementById("switchText").innerText = isLogin
        ? "Don't have an account? Sign up"
        : "Already have an account? Login";
}

function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    if (!input || !icon) return; // safety check

    if (input.type === "password") {
        input.type = "text";
        icon.textContent = "👁️‍🗨️"; // closed eye
    } else {
        input.type = "password";
        icon.textContent = "👁"; // open eye
    }
}
</script>

</body>
</html>
