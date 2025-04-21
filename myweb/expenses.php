<?php
$host = "localhost";
$username = "root";
$password = "";
$db = "carseller";

$conn = new mysqli($host, $username, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$msg = "";

// 🔹 Pay Salary
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pay_salary'])) {
    $employee_id = $_POST['employee_id'];
    $pay_date = date("Y-m-d");

    $emp = $conn->query("SELECT * FROM Employees WHERE employee_id = $employee_id")->fetch_assoc();
    $amount = $emp['salary'];
    $description = "Salary paid to {$emp['name']}";

    $insert = "INSERT INTO Cashflow (date, type, description, amount, reference)
               VALUES ('$pay_date', 'Expense', '$description', $amount, 'Emp ID: $employee_id')";
    $conn->query($insert);
    $msg = "✅ Salary paid to {$emp['name']}";
}

// 🔹 Add Utility Expense
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_expense'])) {
    $desc = $_POST['expense_description'];
    $amount = $_POST['expense_amount'];
    $pay_date = $_POST['expense_date'];
    $reference = $_POST['expense_reference'];

    $insert = "INSERT INTO Cashflow (date, type, description, amount, reference)
               VALUES ('$pay_date', 'Expense', '$desc', $amount, '$reference')";
    $conn->query($insert);
    $msg = "✅ Expense recorded successfully!";
}

$employees = $conn->query("SELECT * FROM Employees ORDER BY name ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Expenses</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 30px; }
        h2 { text-align: center; }
        .box {
            background: white;
            padding: 25px;
            max-width: 600px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
            margin-bottom: 30px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            margin-top: 15px;
            padding: 10px 20px;
            background: #333;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background: #555;
        }
        .success {
            text-align: center;
            margin-bottom: 20px;
            color: green;
        }
    </style>
</head>
<body>

<h2>💸 Manage Expenses</h2>
<?php if ($msg): ?>
    <div class="success"><?= $msg ?></div>
<?php endif; ?>

<!-- 🔹 Pay Salary -->
<div class="box">
    <h3>👥 Pay Employee Salary</h3>
    <form method="POST">
        <label>Select Employee:</label>
        <select name="employee_id" required>
            <option value="">-- Select Employee --</option>
            <?php while ($emp = $employees->fetch_assoc()): ?>
                <option value="<?= $emp['employee_id'] ?>"><?= $emp['name'] ?> (<?= $emp['position'] ?>)</option>
            <?php endwhile; ?>
        </select>
        <button type="submit" name="pay_salary">Pay Salary</button>
    </form>
</div>

<!-- 🔹 Add Utility or Other Expense -->
<div class="box">
    <h3>🧾 Add Utility / Other Expense</h3>
    <form method="POST">
        <label>Description:</label>
        <input type="text" name="expense_description" required>

        <label>Amount:</label>
        <input type="number" name="expense_amount" required>

        <label>Date:</label>
        <input type="date" name="expense_date" value="<?= date('Y-m-d') ?>" required>

        <label>Reference (e.g., Bill ID):</label>
        <input type="text" name="expense_reference" placeholder="Optional">

        <button type="submit" name="add_expense">Add Expense</button>
    </form>
</div>

</body>
</html>

<?php $conn->close(); ?>
