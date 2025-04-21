<?php
$host = "localhost";
$username = "root";
$password = "";
$db = "carseller";

$conn = new mysqli($host, $username, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch available cars ordered by model
$sql = "SELECT * FROM Cars WHERE status = 'Available' ORDER BY model ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book a Test Drive</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px #ccc;
            border-radius: 10px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #333;
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
            border-radius:10px 0px 0px;
        }
        .right{
            background: #333;
            color: white;
            border-radius:0 10px 0px 0px;
        }
        button {
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>
<body>

<h2><i class='bx bx-target-lock'></i> Book a Test Drive</h2>

<?php
if ($result && $result->num_rows > 0) {
    echo "<table>
            <tr>
                <th class='left'>Model</th>
                <th>Make</th>
                <th>Year</th>
                <th>Color</th>
                <th>Price</th>
                <th class='right'>Action</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['model']}</td>
                <td>{$row['make']}</td>
                <td>{$row['year']}</td>
                <td>{$row['color']}</td>
                <td>\${$row['price']}</td>
                <td>
                    <form action='reserve_test_drive.php' method='POST' style='margin: 0;'>
                        <input type='hidden' name='car_id' value='{$row['car_id']}'>
                        <button type='submit'><i class='bx bxs-select-multiple' ></i> Book</button>
                    </form>
                </td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No available cars at the moment.</p>";
}

$conn->close();
?>

</body>
</html>
