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
        <div class="row mt-4">
            <!-- Main Content -->
            <div class="col-md-12">
                <!-- Add New Car Form (Inside a Card) -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add New Car</h4>
                        <form action="process_add_car.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="brand" class="custom-label" style="color:#FFD700 !important;">Brand:</label>
                                <input type="text" class="form-control" id="brand" name="brand" required>
                            </div>
                            <div class="form-group">
                                <label for="model" class="custom-label" style="color:#FFD700 !important;">Model:</label>
                                <input type="text" class="form-control" id="model" name="model" required>
                            </div>
                            <div class="form-group">
                                <label for="seats" class="custom-label" style="color:#FFD700 !important;">Seats:</label>
                                <input type="number" class="form-control" id="seats" name="seats" required>
                            </div>
                            <div class="form-group">
                                <label for="licensePlate" class="custom-label" style="color:#FFD700 !important;">License Plate:</label>
                                <input type="text" class="form-control" id="licensePlate" name="licensePlate" required>
                            </div>
                            <div class="form-group">
                                <label for="engineType" class="custom-label" style="color:#FFD700 !important;">Engine Type:</label>
                                <select class="form-control" id="engineType" name="engineType" required>
                                    <option value="COMBUSTION">COMBUSTION</option>
                                    <option value="ELECTRIC">ELECTRIC</option>
                                    <option value="HYBRID">HYBRID</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="currentAutonomy" class="custom-label" style="color:#FFD700 !important;">Current Autonomy:</label>
                                <input type="number" class="form-control" id="currentAutonomy" name="currentAutonomy">
                            </div>
                            <div class="form-group">
                                <label for="image" class="custom-label file-input-label" style="color:#FFD700 !important;">Car Image:</label>
                                <input type="file" class="form-control-file" id="image" name="image">
                            </div>
                            <button type="submit" class="btn btn-primary">Add Car</button>
                        </form>
                    </div>
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
