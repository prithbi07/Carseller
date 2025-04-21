<?php
$host = "localhost";
$username = "root";
$password = "";
$db = "carseller";

$conn = new mysqli($host, $username, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $color = $_POST['color'];
    $mileage = $_POST['mileage'];
    $fuel_type = $_POST['fuel_type'];
    $transmission = $_POST['transmission'];
    $price = $_POST['price'];
    $status = $_POST['status'];

    $sql = "INSERT INTO Cars (make, model, year, color, mileage, fuel_type, transmission, price, status)
            VALUES ('$make', '$model', $year, '$color', $mileage, '$fuel_type', '$transmission', $price, '$status')";

    if ($conn->query($sql) === TRUE) {
        $success = "✅ Car added successfully!";
    } else {
        $success = "❌ Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Car</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            padding: 30px;
        }
        .form-container {
            background: white;
            padding: 25px;
            max-width: 500px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }
        h2 {
            text-align: center;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            width: 100%;
            margin-top: 20px;
            padding: 10px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background: #218838;
        }
        .success {
            text-align: center;
            color: green;
            margin-top: 15px;
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>➕ Add a New Car</h2>
    <form method="POST">
        <label>Make</label>
        <input type="text" name="make" required>

        <label>Model</label>
        <input type="text" name="model" required>

        <label>Year</label>
        <input type="number" name="year" required>

        <label>Color</label>
        <input type="text" name="color" required>

        <label>Mileage</label>
        <input type="number" name="mileage" required>

        <label>Fuel Type</label>
        <select name="fuel_type" required>
            <option value="">-- Select Fuel Type --</option>
            <option value="Petrol">Petrol</option>
            <option value="Diesel">Diesel</option>
            <option value="Electric">Electric</option>
            <option value="Hybrid">Hybrid</option>
        </select>

        <label>Transmission</label>
        <select name="transmission" required>
            <option value="">-- Select Transmission --</option>
            <option value="Manual">Manual</option>
            <option value="Automatic">Automatic</option>
        </select>

        <label>Price</label>
        <input type="number" name="price" step="0.01" required>

        <label>Status</label>
        <select name="status" required>
            <option value="Available">Available</option>
            <option value="Sold">Sold</option>
            <option value="Reserved">Reserved</option>
        </select>

        <button type="submit">Add Car</button>
    </form>

    <?php if (!empty($success)): ?>
        <div class="success"><?= $success ?></div>
    <?php endif; ?>
</div>

</body>
</html>
