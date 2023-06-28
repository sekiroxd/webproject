<!DOCTYPE html>
<html>
<head>
    <title>Jelszó megváltoztatása</title>
    <style>
        body {
            background-color: #f1f1f1;
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-box {
            width: 400px;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #cccccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333333;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333333;
        }

        input[type="password"] {
            width: 90%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 3px;
        }

        .error-message {
            color: #ff0000;
            margin-bottom: 10px;
        }

        .success-message {
            color: #008000;
            margin-bottom: 10px;
        }

        .submit-btn {
            background-color: #337ab7;
            color: #ffffff;
            padding: 10px;
            border: none;
            border-radius: 3px;
            width: 95%;
            cursor: pointer;
        }

        .link
        {
            background-color: #337ab7;
            color: #ffffff;
            padding: 10px;
            border: none;
            border-radius: 3px;
            display: grid;
            width: 90%;
            text-align:center;
            cursor: pointer;
            text-decoration:none;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h2>Jelszó megváltoztatása</h2>
            <div id="error-message" class="error-message"></div>
            <div id="success-message" class="success-message"></div>
            <form id="myForm" method="POST" action="">
                <label for="password">Jelszó:</label>
                <input type="password" id="password" name="password" required>

                <label for="confirm_password">Jelszó újra:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                <br> <br>
                <button type="submit" class="submit-btn">Frissítés</button>
                <br><br>
                <a href="login.php" class="link">Vissza a bejelentkezéshez</a>
                <br>
                <a href="foglalas.php" class="link">Vissza a foglaláshoz</a>
            </form>
        </div>
    </div>

    <script>
        document.getElementById("myForm").addEventListener("submit", function(event) {
            event.preventDefault();
            
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm_password").value;
            
            var errorContainer = document.getElementById("error-message");
            errorContainer.innerHTML = "";

            if (password.length < 8 || !/\d/.test(password)) {
                errorContainer.innerHTML = "A jelszónak legalább 8 betűt és egy számot kell tartalmaznia";
            } else if (password !== confirmPassword) {
                errorContainer.innerHTML = "A két jelszó nem egyezik meg.";
            } else {
                this.submit();
            }
        });
    </script>

    <?php
    require 'connection.php';
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $password = $_POST['password'];
        $email = $_SESSION['email'];

        $password = md5($password);

        $query = "UPDATE users SET password='$password' WHERE email='$email'";
        $result = mysqli_query($conn, $query);

          echo '<script>document.getElementById("success-message").innerHTML = "Jelszó sikeresen frissítve!";</script>';
    }
    ?>
</body>
</html>
