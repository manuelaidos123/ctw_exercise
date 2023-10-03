<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove Car - Car Management Tool</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand d-flex justify-content-center" href="index.php">Car Management Tool</a>
    </nav>

    <!-- Content -->
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                <h2>Remove Car</h2>
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
                            $sql = "SELECT car_id, brand, model FROM Car"; 
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
                    <button type="submit" class="btn btn-danger">Remove Car</button>
                </form>
            </div>
        </div>
        
        <!-- Display Removal Status Here -->
        <div class="card mt-4">
            <div class="card-header">
                <h3>Removal Status</h3>
            </div>
            <div class="card-body">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Check if a car ID was selected
                    if (isset($_POST["carId"])) {
                        $carId = $_POST["carId"];

                        $conn = new mysqli("localhost", "root", "", "ctw");

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "DELETE FROM Car WHERE car_id = $carId"; 

                        if ($conn->query($sql) === TRUE) {
                            echo "Car removed successfully!";
                        } else {
                            echo "Error removing car: " . $conn->error;
                        }

                        $conn->close();
                    } else {
                        echo "Please select a car to remove.";
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>
</html>