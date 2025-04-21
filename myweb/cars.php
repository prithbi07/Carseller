<?php
// DB connection
$host = "localhost";
$username = "root";
$password = "";
$database = "carseller";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query for Cashflow table
$sql = "SELECT * FROM cars ";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cars</title>
    <style>
        body { font-family: Arial; background-color: #f4f4f4; padding: 20px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; background: #fff; margin-top: 20px; box-shadow: 0 0 10px #ccc; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        tr{
            padding: 12px;
            border: 7px solid #ddd;
            text-align: center;
            border-radius: 10px 10px 0 0px;
        }
        th { background-color: #333; color: white; }
    </style>
</head>
<body>

<h2>Cars</h2>

<?php
if ($result && $result->num_rows > 0) {
    echo "<table><tr>";
    while ($field = $result->fetch_field()) {
        echo "<th>{$field->name}</th>";
    }
    echo "</tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $cell) {
            echo "<td>" . htmlspecialchars($cell) . "</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>No cashflow records found.</p>";
}

$conn->close();
?>

</body>
</html>
