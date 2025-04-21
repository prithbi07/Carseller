<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "";
$db = "carseller";

$conn = new mysqli($host, $username, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Build search filters
$conditions = ["status = 'Available'"];

if (!empty($_GET['make'])) {
    $make = $conn->real_escape_string($_GET['make']);
    $conditions[] = "make LIKE '%$make%'";
}

if (!empty($_GET['model'])) {
    $model = $conn->real_escape_string($_GET['model']);
    $conditions[] = "model LIKE '%$model%'";
}

if (!empty($_GET['year_min'])) {
    $year_min = (int)$_GET['year_min'];
    $conditions[] = "year >= $year_min";
}

if (!empty($_GET['year_max'])) {
    $year_max = (int)$_GET['year_max'];
    $conditions[] = "year <= $year_max";
}

if (!empty($_GET['price_min'])) {
    $price_min = (float)$_GET['price_min'];
    $conditions[] = "price >= $price_min";
}

if (!empty($_GET['price_max'])) {
    $price_max = (float)$_GET['price_max'];
    $conditions[] = "price <= $price_max";
}

$where = implode(' AND ', $conditions);
$sql = "SELECT * FROM Cars WHERE $where ORDER BY make ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Buy a Car</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
        table { width: 100%; border-collapse: collapse; background: #fff; box-shadow: 0 0 10px #ccc; border-radius: 10px; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: center; }
        th { background: #333; color: white; }
        .left { background: #333; color: white; border-radius:10px 0px 0px; }
        .right { background: #333; color: white; border-radius:0 10px 0px 0px; }
        button { padding: 8px 16px; border: none; background: #28a745; color: white; cursor: pointer; border-radius: 6px; }
        button:hover { background: #218838; }
        h2 { text-align: center; margin-bottom: 20px; }
        form.search-form input { margin: 5px; padding: 8px; }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>
<body>

<h2><i class='bx bx-target-lock'></i> Available Cars for Purchase</h2>

<form method="GET" class="search-form">
    Make: <input type="text" name="make" value="<?= htmlspecialchars($_GET['make'] ?? '') ?>">
    Model: <input type="text" name="model" value="<?= htmlspecialchars($_GET['model'] ?? '') ?>">
    Year: <input type="number" name="year_min" placeholder="Min" value="<?= htmlspecialchars($_GET['year_min'] ?? '') ?>">
    - <input type="number" name="year_max" placeholder="Max" value="<?= htmlspecialchars($_GET['year_max'] ?? '') ?>">
    Price: <input type="number" name="price_min" placeholder="Min" value="<?= htmlspecialchars($_GET['price_min'] ?? '') ?>">
    - <input type="number" name="price_max" placeholder="Max" value="<?= htmlspecialchars($_GET['price_max'] ?? '') ?>">
    <button type="submit">Search</button>
</form>

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
                    <form action='confirm_purchase.php' method='POST' style='margin: 0;'>
                        <input type='hidden' name='car_id' value='{$row['car_id']}'>
                        <button type='submit'><i class='bx bx-cart-download'></i> Buy</button>
                    </form>
                </td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No available cars match your search.</p>";
}

$conn->close();
?>

</body>
</html>
