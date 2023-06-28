<!DOCTYPE html>
<html>
<head>
    <title>Admin oldal</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #3498db;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        a.button-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #D2042D;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h1>Össz asztal foglalás</h1>

    <?php
    require_once 'connection.php';

    $sql = "SELECT * FROM reservation";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>reservation_id</th><th>table_number</th><th>guest_number</th><th>start_time</th><th>finish_time</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["reservation_id"] . "</td>";
            echo "<td>" . $row["table_number"] . "</td>";
            echo "<td>" . $row["guest_number"] . "</td>";
            echo "<td>" . $row["start_time"] . "</td>";
            echo "<td>" . $row["finish_time"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Nem található foglalás!";
    }

    mysqli_close($conn);
    ?>
    <br>
    <a class="button-link" href="login.php">Vissza</a>
</body>
</html>
