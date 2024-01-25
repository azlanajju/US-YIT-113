<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Bill</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <?php
        include("./config.php"); // Make sure to include your database configuration

        // Fetch the latest bill
        $sql = "SELECT * FROM billing ORDER BY timestamp DESC LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of the latest bill
            $row = $result->fetch_assoc();
            $billingId = $row['billing_id'];
            $pcId = $row['pc_id'];
            $numOfPersons = $row['num_of_persons'];
            $numOfHours = $row['num_of_hours'];
            $totalAmount = $row['total_amount'];
            $timestamp = $row['timestamp'];
            ?>

            <div class="card">
                <div class="card-header">
                    Latest Bill
                </div>
                <div class="card-body">
                    <p class="card-text"><strong>Billing ID:</strong> <?php echo $billingId; ?></p>
                    <p class="card-text"><strong>PC ID:</strong> <?php echo $pcId; ?></p>
                    <p class="card-text"><strong>Number of Persons:</strong> <?php echo $numOfPersons; ?></p>
                    <p class="card-text"><strong>Number of Hours:</strong> <?php echo $numOfHours; ?></p>
                    <p class="card-text"><strong>Total Amount:</strong> <?php echo $totalAmount; ?></p>
                    <p class="card-text"><strong>Timestamp:</strong> <?php echo $timestamp; ?></p>
                </div>
            </div>

        <?php
        } else {
            echo "<p>No bills found.</p>";
        }

        $conn->close();
        ?>
    </div>

    <!-- Bootstrap JS and Popper.js CDN -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
