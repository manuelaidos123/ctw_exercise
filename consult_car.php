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
        <a class="navbar-brand d-flex justify-content-center" href="index.php">Car Management Tool</a>
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

                            $sql = "SELECT id, brand, model FROM Car"; 
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    // Generate option elements with car data
                                    echo '<option value="' . $row["id"] . '">' . $row["brand"] . ' ' . $row["model"] . '</option>';
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
                // Database connection (replace with your credentials)
                $conn = new mysqli("localhost", "root", "", "ctw");

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $carId = $_POST["carId"];

                    // Query to retrieve car details based on $carId
                    $sql = "SELECT * FROM Car WHERE id = $carId"; 
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();

                        // Display car details
                        echo "<p><strong>Brand:</strong> " . $row["brand"] . "</p>";
                        echo "<p><strong>Model:</strong> " . $row["model"] . "</p>";
                        echo "<p><strong>Seats:</strong> " . $row["seats"] . "</p>";
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