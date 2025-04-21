
<?php 
  
  $servername = "localhost"; 
  $username = "root"; 
  $password = ""; 
  $databasename = "bank"; 
  
  // CREATE CONNECTION 
  $conn = mysqli_connect($servername,  
    $username, $password, $databasename); 
  
  // GET CONNECTION ERRORS 
  if (!$conn) { 
      die("Connection failed: " . mysqli_connect_error()); 
  } 
  
  
  
?>

