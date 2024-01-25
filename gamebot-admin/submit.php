<?php
include("./config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reservationId = $_GET["id"]; 
    $numOfPlayers = $_POST["numOfPlayers"];
    $reservationTime = $_POST["reservationTime"] * 3600;
    $beverage = $_POST["beverage"];
    $beverageQuantity = $_POST["beverageQuantity"];
    $sql = "UPDATE messages SET number_of_players = '$numOfPlayers', Time = '$reservationTime' WHERE id = '$reservationId'";
    
    if ($conn->query($sql) === TRUE) {
        if ($beverage != 0 && $beverageQuantity > 0) {
            $sqlBeverage = "UPDATE messages_beverages SET beverage_id = '$beverage', quantity = '$beverageQuantity' WHERE message_id = '$reservationId'";
            $conn->query($sqlBeverage);
        }

        echo "Reservation updated successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
