<?php
$host = "localhost";
$username = "root";
$password = "";
$db = "carseller";

$conn = new mysqli($host, $username, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$car_id = $_POST['car_id'] ?? null;

if (!$car_id) {
    echo "<h3>No car selected.</h3>";
    exit;
}

// Fetch selected car details
$car_sql = "SELECT * FROM Cars WHERE car_id = $car_id";
$car_result = $conn->query($car_sql);
if (!$car_result || $car_result->num_rows == 0) {
    echo "<h3>Car not found.</h3>";
    exit;
}
$car = $car_result->fetch_assoc();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_purchase'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $sale_date = date("Y-m-d");
    $payment_method = "Cash"; // or get from user input if needed
    $amount = $car['price'];

    // 1. Insert customer
    $insert_customer = "INSERT INTO Customers (name, phone, email, address)
                        VALUES ('$name', '$phone', '$email', 'Not Provided')";
    $conn->query($insert_customer);
    $customer_id = $conn->insert_id;

    // 2. Insert into Sales table
    $insert_sale = "INSERT INTO Sales (car_id, customer_id, sale_date, sale_price, payment_method)
                    VALUES ($car_id, $customer_id, '$sale_date', $amount, '$payment_method')";
    $conn->query($insert_sale);
    $sale_id = $conn->insert_id;

    // 3. Insert into Payments table
    $insert_payment = "INSERT INTO Payments (sale_id, amount_paid, payment_date, payment_method)
                       VALUES ($sale_id, $amount, '$sale_date', '$payment_method')";
    $conn->query($insert_payment);
    // 4. Insert into Cashflow table
$insert_cashflow = "INSERT INTO Cashflow (date, type, description, amount, reference)
VALUES ('$sale_date', 'Income', 'Car sale: {$car['make']} {$car['model']}', $amount, 'Sale ID: $sale_id')";
$conn->query($insert_cashflow);


    // 4. Update car status to 'Sold'
    $conn->query("UPDATE Cars SET status = 'Sold' WHERE car_id = $car_id");

    echo "<h2>✅ Purchase Successful!</h2>";
    echo "<p>Thank you, $name. Your purchase of <strong>{$car['make']} {$car['model']}</strong> has been recorded.</p>";

    $conn->close();
    header("Location: https://example.com");
exit; // Always use exit after redirect to stop script execution
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Confirm Purchase</title>
    <style>
        body {
            font-family: Arial;
            background: #f7f7f7;
            padding: 30px;
        }
        .box {
            background: white;
            padding: 50px;
           
            width: 50%;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-top: 12px;
            margin-bottom:12px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            margin-top: 20px;
            padding: 10px 20px;
            background:rgb(0, 0, 0);
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background:rgb(0, 0, 0);
            transform: scale(1.05);
            translate: 0.3s;
        }
        h2, h3 {
            text-align: center;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>
<body>

<div class="box">
    <h2><i class='bx bx-select-multiple' ></i> Confirm Your Purchase</h2>
    <h3><?php echo "{$car['make']} {$car['model']} ({$car['year']}) - \${$car['price']}"; ?></h3>

    <form method="POST">
        <input type="hidden" name="car_id" value="<?php echo $car_id; ?>">
        <label>Your Name:</label>
        <input type="text" name="name" required>

        <label>Phone:</label>
        <input type="text" name="phone" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <button type="submit" name="confirm_purchase"><i class='bx bx-user-check' ></i> Confirm Purchase</button>
    </form>
</div>

</body>
</html>
