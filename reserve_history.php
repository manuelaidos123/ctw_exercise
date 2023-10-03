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
        <a class="navbar-brand d-flex justify-content-center" href="index.php">Car Management Tool</a>
    </nav>

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
                                WHERE car_id = $carId AND pickupDate >= '$startDate' AND dropOffDate <= '$endDate'"; 
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
