<?php
$host = "localhost";
$username = "root";
$password = "";
$db = "carseller";

$conn = new mysqli($host, $username, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 🟩 Handle Add Employee
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_employee'])) {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $hire_date = $_POST['hire_date'];
    $salary = $_POST['salary'];

    $sql = "INSERT INTO Employees (name, position, phone, email, hire_date, salary)
            VALUES ('$name', '$position', '$phone', '$email', '$hire_date', $salary)";
    $conn->query($sql);
}

// 🟥 Handle Delete Employee
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_employee'])) {
    $employee_id = $_POST['employee_id'];
    $conn->query("DELETE FROM Employees WHERE employee_id = $employee_id");
}

// Fetch all employees
$employees = $conn->query("SELECT * FROM Employees ORDER BY hire_date DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Employees</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 30px; }
        h2 { text-align: center; margin-bottom: 20px; }
        .form-container, .table-container {
            width:80%;
            background: white;
            padding: 50px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
            max-width: 800px;
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
        table {
            width: 50%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 0 10px #ccc;
            border-radius: 10px;
            padding: 10;
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
        .delete-btn {
            background-color: #d9534f;
        }
        .delete-btn:hover {
            background-color: #c9302c;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>
<body>

<h2>👥 Manage Employees</h2>

<!-- ✅ Hire New Employee -->
<div class="form-container">
    <h3><i class='bx bx-add-to-queue' ></i> Hire New Employee</h3>
    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="text" name="position" placeholder="Position" required>
        <input type="text" name="phone" placeholder="Phone" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="date" name="hire_date" required>
        <input type="number" name="salary" placeholder="Salary" required>
        <button type="submit" name="add_employee">Add Employee</button>
    </form>
</div>

<!-- ✅ List of Employees with Delete Button -->
<div class="table-container">
    <h3><i class='bx bx-list-ul' ></i> Current Employees</h3>
    <table>
        <tr>
            <th class="left">ID</th>
            <th>Name</th>
            <th>Position</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Hire Date</th>
            <th>Salary</th>
            <th class="right">Action</th>
        </tr>
        <?php if ($employees && $employees->num_rows > 0): ?>
            <?php while ($emp = $employees->fetch_assoc()): ?>
                <tr>
                    <td><?= $emp['employee_id'] ?></td>
                    <td><?= $emp['name'] ?></td>
                    <td><?= $emp['position'] ?></td>
                    <td><?= $emp['phone'] ?></td>
                    <td><?= $emp['email'] ?></td>
                    <td><?= $emp['hire_date'] ?></td>
                    <td><?= $emp['salary'] ?></td>
                    <td>
                        <form method="POST" onsubmit="return confirm('Are you sure you want to remove this employee?');">
                            <input type="hidden" name="employee_id" value="<?= $emp['employee_id'] ?>">
                            <button type="submit" name="delete_employee" class="delete-btn">Cut Off</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="8">No employees found.</td></tr>
        <?php endif; ?>
    </table>
</div>

</body>
</html>

<?php $conn->close(); ?>
