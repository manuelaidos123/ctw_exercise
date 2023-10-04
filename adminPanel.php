<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Car Management Tool</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Admin Panel - Car Management Tool</a>
        <a class="btn btn-danger ml-auto" href="logout.php">Logout</a>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3">
                <!-- Admin Sidebar -->
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action active">Dashboard</a>
                    <a href="manage_cars.php" class="list-group-item list-group-item-action">Manage Cars</a>
                    <a href="manage_users.php" class="list-group-item list-group-item-action">Manage Users</a>
                    <!-- Add more menu items as needed -->
                </div>
            </div>
            <div class="col-md-9">
                <!-- Admin Content -->
                <h2>Dashboard</h2>
                <!-- Display admin dashboard content here -->
            </div>
        </div>
    </div>

    <script src="js/custom.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
