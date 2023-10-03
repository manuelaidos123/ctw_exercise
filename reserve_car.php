<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserve a Car - Car Management Tool</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Car Management Tool</a>
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
        <!-- Increase the size of the card -->
        <div class="card mt-4 card-large">
            <div class="card-header">
                <h2>Reserve a Car</h2>
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

                            // Query to retrieve car options
                            $sql = "SELECT car_id, brand, model FROM car"; 
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    // Generate option elements for car selection
                                    echo '<option value="' . $row["car_id"] . '">' . $row["brand"] . ' ' . $row["model"] . '</option>';
                                }
                            } else {
                                echo '<option value="">No cars found</option>';
                            }

                            $conn->close();
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pickupDate">Pick-up Date and Time:</label>
                        <input type="datetime-local" class="form-control" id="pickupDate" name="pickupDate" required>
                    </div>
                    <div class="form-group">
                        <label for="dropoffDate">Drop-off Date and Time:</label>
                        <input type="datetime-local" class="form-control" id="dropoffDate" name="dropoffDate" required>
                    </div>

                    <?php
                    // Check if the form is submitted
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Validate reservation based on restrictions
                        $carId = $_POST["carId"];
                        $pickupDate = $_POST["pickupDate"];
                        $dropoffDate = $_POST["dropoffDate"];
                    
                        // Database connection (replace with your credentials)
                        $conn = new mysqli("localhost", "root", "", "ctw");
                    
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                    
                        // Check if the reservation duration exceeds the allowed limit (4 days)
                        $pickupDateTime = new DateTime($pickupDate);
                        $dropoffDateTime = new DateTime($dropoffDate);
                        $interval = $pickupDateTime->diff($dropoffDateTime);
                        $daysDifference = $interval->d;
                    
                        if ($daysDifference > 4) {
                            echo '<div class="alert alert-danger" role="alert">';
                            echo 'Error reserving car: The reservation duration cannot exceed 4 days.';
                            echo '</div>';
                        } else {
                            // No weekend reservation restriction, insert the reservation into the database
                            $sql = "INSERT INTO reservation (car_id, pickupDate, dropOffDate) 
                                    VALUES ($carId, '$pickupDate', '$dropoffDate')";
                            if ($conn->query($sql) === TRUE) {
                                echo '<div class="alert alert-success" role="alert">';
                                echo 'Car reserved successfully!';
                                echo '</div>';
                            } else {
                                echo '<div class="alert alert-danger" role="alert">';
                                echo 'Error reserving car: ' . $conn->error;
                                echo '</div>';
                            }
                        }
                    
                        $conn->close();
                    }
                    ?>

                    <button type="submit" class="btn btn-success">Reserve Car</button>
                </form>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>
</html>
