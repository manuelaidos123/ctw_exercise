<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Management Tool</title>
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
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

    <div class="card mt-5" id="loginCard">
    <div class="card-header">
        <h5 class="card-title text-center">User Login</h5>
    </div>
    <div class="card-body">
        <form id="loginInfoForm">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control" id="role" name="role">
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            <button type="button" class="btn btn-primary btn-block">Log In</button>
        </form>
        <div class="mt-3 text-center">
            <p>Don't have an account? <a href="#">Sign Up</a></p>
            <p><a href="#">Forgot Password?</a></p>
        </div>
    </div>
</div>
    <script src="js/custom.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>

