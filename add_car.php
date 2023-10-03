<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Car</title>
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand d-flex justify-content-center" href="index.php">Car Management Tool</a>
        </nav>

        <!-- Content -->
        <div class="row mt-4">
            <!-- Main Content -->
            <div class="col-md-12">
                <!-- Add New Car Form -->
                <div id="addCar">
                    <h4>Add New Car</h4>
                    <form action="process_add_car.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="brand">Brand:</label>
                            <input type="text" class="form-control" id="brand" name="brand" required>
                        </div>
                        <div class="form-group">
                            <label for="model">Model:</label>
                            <input type="text" class="form-control" id="model" name="model" required>
                        </div>
                        <div class="form-group">
                            <label for="seats">Seats:</label>
                            <input type="number" class="form-control" id="seats" name="seats" required>
                        </div>
                        <div class="form-group">
                            <label for="licensePlate">License Plate:</label>
                            <input type="text" class="form-control" id="licensePlate" name="licensePlate" required>
                        </div>
                        <div class="form-group">
                            <label for="engineType">Engine Type:</label>
                            <select class="form-control" id="engineType" name="engineType" required>
                                <option value="COMBUSTION">COMBUSTION</option>
                                <option value="ELECTRIC">ELECTRIC</option>
                                <option value="HYBRID">HYBRID</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="currentAutonomy">Current Autonomy:</label>
                            <input type="number" class="form-control" id="currentAutonomy" name="currentAutonomy">
                        </div>
                        <div class="form-group">
                            <label for="image">Car Image:</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Car</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="js/custom.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <?php
    if (isset($_SESSION['success_message'])) {
        echo '<div class="alert alert-success" role="alert">' . $_SESSION['success_message'] . '</div>';
        unset($_SESSION['success_message']); // Clear the session variable
    }
    ?>

    <script>
        setTimeout(function(){
            document.querySelector('.alert.alert-success').style.display = 'none';
        }, 5000); // Hide the alert after 5 seconds (5000 milliseconds)
    </script>
</body>
</html>