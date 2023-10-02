<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $brand = $_POST["brand"];
    $model = $_POST["model"];
    $seats = $_POST["seats"];
    $licensePlate = $_POST["licensePlate"];
    $engineType = $_POST["engineType"];
    $currentAutonomy = $_POST["currentAutonomy"];

    // Handle image upload (you'll need to adjust this code)
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);

    // Insert data into the database
    $conn = new mysqli("localhost", "root", "", "ctw");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO Car (brand, model, seats, licensePlate, engineType, currentAutonomy, image)
            VALUES ('$brand', '$model', $seats, '$licensePlate', '$engineType', $currentAutonomy, '$targetFile')";

    if ($conn->query($sql) === TRUE) {
        echo "Car added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
