<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation History - Car Management Tool</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
</head>
<body>
    
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
        </nav>>

    <!-- Content -->
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                <h2>Reservation History</h2>
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
                        <label for="startDate">Start Date:</label>
                        <input type="date" class="form-control" id="startDate" name="startDate" required>
                    </div>
                    <div class="form-group">
                        <label for="endDate">End Date:</label>
                        <input type="date" class="form-control" id="endDate" name="endDate" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Show Reservation History</button>
                </form>
            </div>
        </div>

        <!-- Display Reservation History Here -->
        <div class="card mt-4">
            <div class="card-header">
                <h3>Reservation History</h3>
            </div>
            <div class="card-body">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Check if a car is selected
                    if (isset($_POST["carId"]) && isset($_POST["startDate"]) && isset($_POST["endDate"])) {
                        $carId = $_POST["carId"];
                        $startDate = $_POST["startDate"];
                        $endDate = $_POST["endDate"];

                        $conn = new mysqli("localhost", "root", "", "ctw");

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Query to retrieve reservation history for the selected car within the specified date range
                        $sql = "SELECT pickupDate, dropOffDate FROM reservation 
                        WHERE car_id = $carId 
                        AND DATE(pickupDate) >= '$startDate' 
                        AND DATE(dropOffDate) <= '$endDate'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo '<table class="table">';
                            echo '<thead><tr><th>Pick-up Date and Time</th><th>Drop-off Date and Time</th></tr></thead>';
                            echo '<tbody>';

                            while ($row = $result->fetch_assoc()) {
                                // Display reservation details
                                echo '<tr><td>' . $row["pickupDate"] . '</td><td>' . $row["dropOffDate"] . '</td></tr>';
                            }

                            echo '</tbody></table>';
                        } else {
                            echo 'No reservations found for the selected car and date range.';
                        }

                        $conn->close();
                    } else {
                        echo "Please select a car and specify the date range to view reservation history.";
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>
</html>
