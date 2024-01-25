<?php
// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cybere";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $people = $_POST["people"];
    $time = $_POST["time"];
    $transaction_id = $_POST["transaction_id"];

    // Validate and process the input data
    // ...

    // Calculate the bill based on the number of people
    $hourly_rate = 0;
    if ($people == 1) {
        $hourly_rate = 80;
    } elseif ($people == 2) {
        $hourly_rate = 140;
    } elseif ($people == 3) {
        $hourly_rate = 160;
    } elseif ($people == 4) {
        $hourly_rate = 200;
    }

    $total_bill = $hourly_rate; // Assuming booking is for 1 hour

    // Insert the booking details into the database
    $sql = "INSERT INTO bookings (name, people, time, transaction_id, total_bill) VALUES ('$name', $people, '$time', '$transaction_id', $total_bill)";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Booking successful. Total Bill: $'.$total_bill.'"); window.location.href = "index.php";</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
