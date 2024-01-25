<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Table</title>
    <!-- Include Bootstrap CSS (you can use a CDN or host it locally) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cybere";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
header("Location: ./memership");
// Check if the form is submitted for adding a new client
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_transaction"])) {
    // Collect form data
    $name = $_POST["name"];
    $credited_amount = $_POST["credited_amount"];
    $balance = $_POST["balance"];
    $type = $_POST["type"];

    // Prepare and execute the SQL query to insert new client data
    $sql = "INSERT INTO transactions (name, credited_amount, balance, type) VALUES ('$name', $credited_amount, $balance, '$type')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        // Redirect to a different page
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Display type filter buttons with Bootstrap styling
echo '<div class="btn-group">';
echo '<button class="btn btn-primary" onclick="filterTransactions(\'pro\')">View Pro</button>';
echo '<button class="btn btn-primary" onclick="filterTransactions(\'medium\')">View Medium</button>';
echo '<button class="btn btn-primary" onclick="showAllTransactions()">Show All</button>';
echo '</div>'; // Button group for filtering

// Display Bootstrap table
echo '<table class="table table-bordered mt-3">';
echo '<thead class="thead-dark">';
echo '<tr>';
echo '<th>Name</th>';
echo '<th>Credited Amount</th>';
echo '<th>Balance</th>';
echo '<th>Type</th>';
echo '<th>Action</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

// Display table rows with data
$result = $conn->query("SELECT * FROM transactions");
while ($transaction = $result->fetch_assoc()) {
    echo '<tr class="transaction-row">';
    echo '<td>' . $transaction['name'] . '</td>';
    echo '<td>' . $transaction['credited_amount'] . '</td>';
    echo '<td>' . $transaction['balance'] . '</td>';
    echo '<td class="transaction-type">' . $transaction['type'] . '</td>';
    echo '<td><a class="btn btn-warning" href="update.php?id=' . $transaction['id'] . '">Update</a></td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';

// Display input form for adding a new client with Bootstrap form styling
echo '<form action="index.php" method="post" class="mt-3">';
echo '<div class="form-group">';
echo '<label for="name">Name:</label>';
echo '<input type="text" class="form-control" name="name" required>';
echo '</div>';
echo '<div class="form-group">';
echo '<label for="credited_amount">Credited Amount:</label>';
echo '<input type="number" class="form-control" name="credited_amount" required>';
echo '</div>';
echo '<div class="form-group">';
echo '<label for="balance">Balance:</label>';
echo '<input type="number" class="form-control" name="balance" required>';
echo '</div>';
echo '<div class="form-group">';
echo '<label for="type">Type:</label>';
echo '<input type="text" class="form-control" name="type" required>';
echo '</div>';
echo '<button type="submit" class="btn btn-success" name="add_transaction">Add Transaction</button>';
echo '</form>';

// JavaScript function to filter transactions based on type
echo '<script>
    function filterTransactions(type) {
        // Hide all rows
        var rows = document.querySelectorAll(".transaction-row");
        rows.forEach(function(row) {
            row.style.display = "none";
        });

        // Show only rows with the selected type
        var selectedRows = document.querySelectorAll(".transaction-type");
        selectedRows.forEach(function(row) {
            if (row.textContent === type) {
                row.parentElement.style.display = "";
            }
        });
    }

    function showAllTransactions() {
        // Show all rows
        var rows = document.querySelectorAll(".transaction-row");
        rows.forEach(function(row) {
            row.style.display = "";
        });
    }
</script>';
?>

</div>

<!-- Include Bootstrap JS (you can use a CDN or host it locally) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>