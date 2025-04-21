<?php
$servername = "localhost";
$username = "root";
$password = "";
$databasename="carseller";
// Create connection
$conn = new mysqli($servername, $username, $password,$databasename);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  echo "Connected successfully";

  $sql = "SELECT * FROM customers";  // <-- Change this to any SELECT query you want

  $result = $conn->query($sql);
  ?>
  
  <!DOCTYPE html>
  <html>
  <head>
      <title>Table Viewer</title>
      <style>
          body { font-family: Arial; background-color: #f4f4f4; padding: 20px; }
          table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 0 10px #ccc; }
          th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
          th { background-color: #333; color: #fff; }
          h2 { text-align: center; margin-bottom: 20px; }
      </style>
  </head>
  <body>
      <h2>Query Output</h2>
  
      <?php
      if ($result && $result->num_rows > 0) {
          echo "<table><tr>";
  
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