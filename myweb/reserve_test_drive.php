<?php
$host = "localhost";
$username = "root";
$password = "";
$db = "carseller";

$conn = new mysqli($host, $username, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['car_id'])) {
    $car_id = $_POST['car_id'];

    // Update car status to 'Reserved'
    $update = "UPDATE Cars SET status = 'Reserved' WHERE car_id = $car_id";
    if ($conn->query($update)) {
        // Get car details
        $result = $conn->query("SELECT * FROM Cars WHERE car_id = $car_id");
        $car = $result->fetch_assoc();

        echo "<h2>✅ Test Drive Booked!</h2>";
        echo "<p>You have successfully reserved the following car:</p>";
        echo "<ul>
                <li><strong>Make:</strong> {$car['make']}</li>
                <li><strong>Model:</strong> {$car['model']}</li>
                <li><strong>Year:</strong> {$car['year']}</li>
                <li><strong>Color:</strong> {$car['color']}</li>
                <li><strong>Status:</strong> {$car['status']}</li>
              </ul>";
        echo "<p>🚘 Please visit the shop on your scheduled date for the test drive.</p>";
    } else {
        echo "<p>❌ Failed to reserve the car. Error: " . $conn->error . "</p>";
    }
} else {
    echo "<p>❌ Invalid request.</p>";
}

$conn->close();
?>
