<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List All Cars - Car Management Tool</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Car Management Tool</a>
    </nav>
    <!-- Content -->
    <div class="container">
        <div class="car-list">
            <h2>List of All Cars</h2>
            <table>
                <thead>
                    <tr>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Seats</th>
                        <th>License Plate</th>
                        <th>Engine Type</th>
                        <th>Current Autonomy</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $conn = new mysqli("localhost", "root", "", "ctw");

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Query to retrieve car data
                    $sql = "SELECT brand, model, seats, licensePlate, engineType, currentAutonomy FROM Car";
                    $result = $conn->query($sql);

                    // Check if there are rows in the result set
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $row["brand"] . '</td>';
                            echo '<td>' . $row["model"] . '</td>';
                            echo '<td>' . $row["seats"] . '</td>';
                            echo '<td>' . $row["licensePlate"] . '</td>';
                            echo '<td>' . $row["engineType"] . '</td>';
                            echo '<td>' . $row["currentAutonomy"] . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="7">No cars found in the database.</td></tr>';
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="js/custom.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>