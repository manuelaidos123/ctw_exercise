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
        <a class="navbar-brand d-flex justify-content-center" href="index.php">Car Management Tool</a>
    </nav>

    <!-- Content -->
    <div class="container">
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
                    <button type="submit" class="btn btn-success">Reserve Car</button>
                </form>
            </div>
        </div>
        
        <!-- Display Reservation Status Here -->
        <div class="card mt-4">
            <div class="card-header">
                <h3>Reservation Status</h3>
            </div>
            <div class="card-body">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Check if all form fields are filled
                    if (isset($_POST["carId"]) && isset($_POST["pickupDate"]) && isset($_POST["dropoffDate"])) {
                        $carId = $_POST["carId"];
                        $pickupDate = $_POST["pickupDate"];
                        $dropoffDate = $_POST["dropoffDate"];

                        // Database connection (replace with your credentials)
                        $conn = new mysqli("localhost", "root", "", "ctw");

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Query to insert the reservation into the database
                        $sql = "INSERT INTO reservation (car_id, pickupDate, dropOffDate)
                                VALUES ($carId, '$pickupDate', '$dropoffDate')"; 
                        if ($conn->query($sql) === TRUE) {
                            echo "Car reserved successfully!";
                        } else {
                            echo "Error reserving car: " . $conn->error;
                        }

                        $conn->close();
                    } else {
                        echo "Please fill in all fields to reserve a car.";
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>
</html>
