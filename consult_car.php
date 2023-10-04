<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consult Car Details - Car Management Tool</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
</head>
<body>
    
     <!-- Navigation Bar -->
     <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Car Management Tool</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto"> <!-- Align the links to the right -->
                <li class="nav-item">
                    <a class="nav-link" href="add_car.php">Add New Car</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="list_cars.php">List All Cars</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="consult_car.php">Consult Car Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="remove_car.php">Remove Car</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="reserve_car.php">Reserve a Car</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="reserve_history.php">Consult Reserve History</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Content -->
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                <h2>Consult Car Details</h2>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                        <label for="carId">Select Car:</label>
                        <select class="form-control" id="carId" name="carId">
                        <?php
                            $conn = new mysqli("localhost", "root", "", "ctw");

                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            $sql = "SELECT car_id, brand, model FROM Car"; 
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    // Generate option elements with car data
                                    echo '<option value="' . $row["car_id"] . '">' . $row["brand"] . ' ' . $row["model"] . '</option>';
                                }
                            } else {
                                echo '<option value="">No cars found</option>';
                            }

                            $conn->close();
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Consult Details</button>
                </form>
            </div>
        </div>
        
        <!-- Display Car Details Here -->
        <div class="card mt-4">
            <div class="card-header">
                <h3>Car Details</h3>
            </div>
            <div class="card-body">
                <?php

                $conn = new mysqli("localhost", "root", "", "ctw");

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $carId = $_POST["carId"];

                    // Query to retrieve car details based on $carId
                    $sql = "SELECT * FROM Car WHERE car_id = $carId"; 
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();

                        // Display car details
                        echo "<p><strong>Brand:</strong> " . $row["brand"] . "</p>";
                        echo "<p><strong>Model:</strong> " . $row["model"] . "</p>";
                        echo "<p><strong>Seats:</strong> " . $row["seats"] . "</p>";
                        echo "<p><strong>License Plate:</strong> " . $row["licensePlate"] . "</p>";
                        echo "<p><strong>Engine Type:</strong> " . $row["engineType"] . "</p>";
                        echo "<p><strong>Current Autonomy:</strong> " . $row["currentAutonomy"] . "</p>";
                        // Add more fields as needed
                    } else {
                        echo "Car not found in the database.";
                    }
                }

                $conn->close();
                ?>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>
</html>