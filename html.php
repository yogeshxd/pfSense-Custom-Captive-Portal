<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login / Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            border-radius: 10px;
            width: 300px;
            text-align: center;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        input[type="text"], input[type="password"], input[type="email"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background-color: #5cb85c;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
        .switch-link {
            color: #007bff;
            cursor: pointer;
            text-decoration: underline;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<script>
        function switchForm(formType) {
            if (formType === 'login') {
                document.getElementById('loginForm').style.display = 'block';
                document.getElementById('registerForm').style.display = 'none';
                document.getElementById('formTitle').innerHTML = 'Login';
            } else if (formType === 'register') {
                document.getElementById('loginForm').style.display = 'none';
                document.getElementById('registerForm').style.display = 'block';
                document.getElementById('formTitle').innerHTML = 'Register';
            }
        }
    </script>
<body>
    <div class="container">
        <h2 id="formTitle">Login</h2>

        <form id="loginForm" method="post" action="$PORTAL_ACTION$">
            <input type="text" name="auth_user" placeholder="Username" required><br>
            <input type="password" name="auth_pass" placeholder="Password" required><br>
            <input type="hidden" name="redirurl" value="$PORTAL_REDIRURL$"><br>
            <input type="hidden" name="zone" value="$PORTAL_ZONE$"><br>
            <input type="submit" name="accept" value="Continue">
            <p>Don't have an account? <span class="switch-link" onclick="switchForm('register')">Register here</span></p>
        </form>

        <form id="registerForm" class="hidden" method="post" action="">
            <input type="text" id="username" name="username" placeholder="Username" required><br>
            <span id="validationMessage" style="text-align: left font-size: 12"> Note: Username must not contain spaces or special characters</span>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="text" name="pin" placeholder="PIN" required><br>
            <input type="hidden" name="redirurl" value="$PORTAL_REDIRURL$"><br>
            <input type="hidden" name="zone" value="$PORTAL_ZONE$"><br>
            <div>


<?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $user = $_POST["username"];
    $pass = $_POST["password"];
    $email = $_POST["email"];
    $pin = $_POST["pin"];
    $hardcoded_pin = "2222"; // Hardcoded PIN

    // Verify hardcoded PIN
    if ($pin === $hardcoded_pin) {
        // PIN is valid, proceed with registration

        $api_url = "http://10.5.48.1/api/v2/user";

        $user_data = [
            "name" => $user,
            "password" => $pass,
        ];

        $json_data = json_encode($user_data);

        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Basic YWRtaW46QWRtaW5AMTIz",
            "Content-Type: application/json",
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        $response = curl_exec($ch);

        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);
            die("cURL error: $error");
        }

        $response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($response_code === 200) {
            echo '<div style="text-align: left; margin: 0 auto; width: 80%;">  <p>User created successfully!</p></div>';
        } else {
            echo <<<EOL
            <div style="text-align: center; margin: 0 auto; width: 100%;">
            <p>Error while creating user.<br></div>
            <div style="text-align: left; margin: 0 auto; width: 100%; font-size: 8;">
            What can you do?<br>
            - Please check if your username contain any spaces or special characters as they are not allowed.<br>
            - If not then try to pick a unique username!<br>
            If you still face any issue then try to contact your network admin.<br></p>
            </div>
            EOL;
        }

        curl_close($ch);
    } else {
        // PIN is not valid
        echo "Invalid PIN";
    }
} ?>
            </div>
            <input type="submit" id="register" name="register" value="Register">
            <p>Already have an account? <span class="switch-link" onclick="switchForm('login')">Login here</span></p>

        </form>

    </div>
</body>
</html>
