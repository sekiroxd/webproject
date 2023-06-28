<?php
require_once("connection.php");
session_start();

if (!isset($_SESSION['login_active'])) {
  header("Location: lock.php");
  exit();
}
?>
<?php
function sanitize_input($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reservationId = sanitize_input($_POST['reservation_id']);
    $action = sanitize_input($_POST['action']);

    if ($action === 'Mentés') {
        $tableNumber = sanitize_input($_POST['table_number']);
        $guestNumber = sanitize_input($_POST['guest_number']);
        $startTime = sanitize_input($_POST['start_time']);

        $finishTime = date('Y-m-d H:i:s', strtotime($startTime . ' +1 hour'));

        $maxFinishTime = date('Y-m-d H:i:s', strtotime($startTime . ' +6 hours'));

        if ($finishTime > $maxFinishTime) {
            echo "
                <script>
                alert('A foglalás maximum 6 óráig lehetséges a kezdő időponttól számítva!');
                </script>";
        } else {
            $updateReservationQuery = "UPDATE reservation SET table_number = ?, guest_number = ?, start_time = ?, finish_time = ? WHERE reservation_id = ?";
            $stmtReservation = $conn->prepare($updateReservationQuery);
            $stmtReservation->bind_param("iisss", $tableNumber, $guestNumber, $startTime, $finishTime, $reservationId);

            if ($stmtReservation->execute()) {
                echo "
                  <script>
                  alert('Foglalás sikeresen frissítve!');
                  </script>";
            } else {
                echo "Error: " . $stmtReservation->error;
            }

            $stmtReservation->close();
        }
    } elseif ($action === 'Lemondom') {
        $deleteReservationQuery = "DELETE FROM reservation WHERE reservation_id = ?";
        $stmtReservation = $conn->prepare($deleteReservationQuery);
        $stmtReservation->bind_param("i", $reservationId);

        if ($stmtReservation->execute()) {
            echo "
              <script>
              alert('Foglalás sikeresen törölve!');
              </script>";
        } else {
            echo "Error: " . $stmtReservation->error;
        }

        $stmtReservation->close();
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Foglalások</title>
    <style>
        body {
            background-color: #f0f5f9;
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #2c3e50;
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #2c3e50;
        }

        select,
        input[type="datetime-local"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #2980b9;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #1c6ea4;
        }

        input[type="button"] {
            background-color: #2980b9;
            color: #fff;
            border: none;
            padding: 10px 10px;
            margin-left: 65px;
            border-radius: 4px;
            text-align: center;
            cursor: pointer;
        }

        input[type="button"]:hover {
            background-color: #1c6ea4;
        }

        .back a
        {
            background-color: #2980b9;
            color: #fff;
            border: none;
            padding: 10px 10px;
            border-radius: 4px;
        }

    </style>
    <link rel="stylesheet" href="assets/css/fooldal.css">
</head>

<body>

<nav class="nav">
    <ul>
        <li><a href="index.php">Főoldal</a></li>
        <li><a href="foglalas.php">Foglalások</a></li>
        <li><a href="signup.php">Regisztráció</a></li>
        <li><a href="login.php">Bejelentkezés</a></li>
        </div>
    </ul>
</nav>

<h1>Asztal foglalás</h1>
<form method="POST" action="">
    <label for="reservation_id">Foglalás azonosítója:</label>
    <input type="text" name="reservation_id" id="reservation_id" style="border: 1px solid #ccc;border-radius: 4px; padding:5.5px; width:100%;" required>
    <br><br>
    <form method="POST" action="" >
        <label for="smoking_preference">Dohányzó vagy nem dohányzó asztalt szeretne:</label>
        <select name="smoking_preference" id="smoking_preference">
            <option value="non_smoking">Nem dohányzó</option>
            <option value="smoking">Dohányzó</option>
        </select>
        <br><br>
        <label for="table_number">Asztal száma:</label>
        <select name="table_number" id="table_number">
            <option value="" disabled selected>Válasszon asztalt</option>
            <optgroup id="non_smoking_options" label="Tilos a dohányzás">
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </optgroup>
            <optgroup id="smoking_options" label="Szabad a dohányzás">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
            </optgroup>
        </select>
        <br><br>
        <label for="guest_number">Hány személyre számítsunk?</label>
        <select name="guest_number" id="guest_number">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select>
        <br><br>
        <label for="start_time">Időpont kezdete:</label>
        <input type="datetime-local" name="start_time" id="start_time">
        <br><br>
        <label for="finish_time">Időpont vége:</label>
        <select name="finish_time" id="finish_time">
            <option value="" disabled selected></option>
        </select>
        <br><br>

        <input type="submit" name="action" value="Mentés">
        <input type="submit" name="action" value="Lemondom">
        <a href="foglalas.php" type="button" style="background-color:#D2042D; color:#fff; padding: 9px 10px; border-radius:4px; ">Vissza</a>

    </form>

    <script>
        document.getElementById('smoking_options').style.display = 'none';

        document.getElementById('smoking_preference').addEventListener('change', function() {
            var selectedPreference = this.value;

            if (selectedPreference === 'smoking') {
                document.getElementById('smoking_options').style.display = 'block';
                document.getElementById('non_smoking_options').style.display = 'none';
            } else {
                document.getElementById('smoking_options').style.display = 'none';
                document.getElementById('non_smoking_options').style.display = 'block';
            }
        });

        document.getElementById('start_time').addEventListener('change', function() {
            var startTime = new Date(this.value);
            var finishTimeSelect = document.getElementById('finish_time');

            finishTimeSelect.innerHTML = '';

            for (var i = 1; i <= 6; i++) {
                var option = document.createElement('option');
                var finishTime = new Date(startTime.getTime() + (i * 60 * 60 * 1000));
                var finishTimeString = finishTime.toLocaleTimeString('en-US', {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                });
                option.value = finishTime.toISOString().slice(0, 19).replace('T', ' ');
                option.text = finishTimeString;
                finishTimeSelect.appendChild(option);
            }
        });

        document.getElementById('start_time').addEventListener('change', function() {
            var startTime = new Date(this.value);
            var finishTimeSelect = document.getElementById('finish_time');
            var maxFinishTime = new Date(startTime.getTime() + (6 * 60 * 60 * 1000));
            var currentFinishTime = new Date(finishTimeSelect.value);

            if (currentFinishTime > maxFinishTime) {
                finishTimeSelect.value = maxFinishTime.toISOString().slice(0, 19).replace('T', ' ');
            }
        });
    </script>
</body>

</html>
