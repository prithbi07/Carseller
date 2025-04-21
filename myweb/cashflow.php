<?php
$servername = "localhost";
$username = "root";
$password = "";
$databasename = "carseller";

// Create connection
$conn = new mysqli($servername, $username, $password, $databasename);

// Check connection (❌ You were checking the wrong way)
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ❌ You wrote "cachflow", it should be "cashflow"
$sql = "SELECT * FROM cashflow";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Table Viewer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 0 10px #ccc;
            border-radius: 10px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
            border-radius:10px 10px 0 0;
        }
        th {
            background:#000;
            color: white;
        }
        tr{
            padding: 12px;
            border: 7px solid #ddd;
            text-align: center;
            border-radius: 10px 10px 0 0px;
        }
        .left{
            background: #333;
            color: white;
            border-radius:10px 0px 10px;
        }
        .right{
            background: #333;
            color: white;
            border-radius:0 10px 0px 0px;
        }
        button {
            padding: 8px 16px;
            border: none;
            background: #28a745;
            color: white;
            cursor: pointer;
            border-radius: 6px;
        }
        button:hover {
            background: #218838;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>
<body>
    <h2>💵 Cashflow Records</h2>

    <?php
    if ($result && $result->num_rows > 0) {
        echo "<table><tr class='header'>";

        // Table headers
        while ($field = $result->fetch_field()) {
            echo "<th>{$field->name}</th>";
        }
        echo "</tr>";

        // Table rows
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $cell) {
                echo "<td>" . htmlspecialchars($cell) . "</td>";
            }
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No results found or query error.</p>";
    }

    $conn->close();
    ?>
</body>
</html>
