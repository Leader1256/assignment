<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
   
    $servername = "localhost";
    $username = "your_username";
    $password = "";
    $dbname = "car_options_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $carOptions = isset($_POST["carOptions"]) ? implode(", ", $_POST["carOptions"]) : "None";
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $address = $_POST["address"];

    
    $sql = "INSERT INTO responses (name, phone, email, address, car_options) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $phone, $email, $address, $carOptions);

    if ($stmt->execute()) {
      
        header("Location: thank_you.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

