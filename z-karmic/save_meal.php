<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "karmiccanteen";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get data from AJAX request
$data = json_decode(file_get_contents("php://input"), true);

$employee_name = $data['employee_name'];
$meals = implode(", ", $data['meals']); // convert array to string

$sql = "INSERT INTO meal_selection (employee_name, meals) VALUES ('$employee_name', '$meals')";

if ($conn->query($sql) === TRUE) {
  echo json_encode(["status" => "success", "message" => "Meal saved successfully"]);
} else {
  echo json_encode(["status" => "error", "message" => $conn->error]);
}

$conn->close();
?>
