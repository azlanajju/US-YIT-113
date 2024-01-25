<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "yen_hackathon";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted for updating an existing client
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_transaction"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $credited_amount = $_POST["credited_amount"];
    $balance = $_POST["balance"];
    $type = $_POST["type"];

    $sql = "UPDATE transactions SET name='$name', credited_amount=$credited_amount, balance=$balance, type='$type' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header("Location:./index.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Retrieve the transaction details based on the provided ID
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $result = $conn->query("SELECT * FROM transactions WHERE id=$id");

    if ($result->num_rows > 0) {
        $transaction = $result->fetch_assoc();
    } else {
        echo "Transaction not found";
        exit;
    }
} else {
    echo "Transaction ID not provided";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Transaction</title>
    <!-- Include Bootstrap CSS (you can use a CDN or host it locally) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        form {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <h2>Update Transaction</h2>

    <form action="update.php" method="post">
        <input type="hidden" name="id" value="<?php echo $transaction['id']; ?>">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" value="<?php echo $transaction['name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="credited_amount">Credited Amount:</label>
            <input type="number" class="form-control" name="credited_amount" value="<?php echo $transaction['credited_amount']; ?>" required>
        </div>
        <div class="form-group">
            <label for="balance">Balance:</label>
            <input type="number" class="form-control" name="balance" value="<?php echo $transaction['balance']; ?>" required>
        </div>
        <div class="form-group">
            <label for="type">Type:</label>
            <input type="text" class="form-control" name="type" value="<?php echo $transaction['type']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary" name="update_transaction">Update Transaction</button>
    </form>
</div>

<!-- Include Bootstrap JS (you can use a CDN or host it locally) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
