<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Panel</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php $id = $_GET['id'];
    $occ = $_GET['occ']; ?>
    <?php
    include("./config.php");

    $options = "";

    $sql = "SELECT id, name FROM menu_items";
    $result = $conn->query($sql);

    if (!$result) {
        echo "Error: " . $conn->error;
    } else {

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $options .= "<option value='" . $row["name"] . "'>" . $row["name"] . "</option>";
            }
        } else {
            echo "<option value='0'>None</option>";
        }
    }

    ?>
<?php

if ($occ == 1) {
    date_default_timezone_set('Asia/Kolkata');

    $mesSql = "SELECT *  FROM messages WHERE id = '$id'";
    $mesResult = $conn->query($mesSql);

    while ($mesRow = $mesResult->fetch_assoc()) {


        $startTime = strtotime($mesRow['timestamp']);
        $totalHours = $mesRow['Time'] / 3600;
        $endTime =( $startTime + $totalHours * 3600)+2;
        $currentTime = time();
        $np = $mesRow['no_of_players'];

        if ($currentTime > $endTime) {
            echo "<p>Time's up!</p>";
        } else {
            $timeLeft = $endTime - $currentTime;
            $hours = floor($timeLeft / 3600);
            $minutes = floor(($timeLeft % 3600) / 60);
            $seconds = $timeLeft % 60;


            echo "<p id='countdown'>Time Left: $hours hours, $minutes minutes, $seconds seconds</p>";
        }
    }

    echo '<div class="alert">This System has been already occupied <a href="http://localhost:3000/reset?id=' . $id . '&time='.$timeLeft.'&np='.$np.'">End Session</a></div>';
}else{
    echo '
    
    <div class="reservation-box">
        <div class="top">
            <div class="static">
                <div class="input-container" id="date-picker-container">
                    <label for="players">No. of Players</label>
                    <input type="text" id="players" class="date-field" placeholder="Enter the No. of players (max:4)" name="numOfPlayers">
                </div>
            </div>
            <div class="flex">
                <div class="input-container" id="date-picker-container">
                    <label for="reservationTime">reservation Time</label>
                    <input type="text" placeholder="Hours" id="reservationTime" class="date-field" name="reservationTime">
                </div>
                <div class="flex">
                    <div class="input-container" id="date-picker-container">
                        <label for="reservationTime">Beverages</label>
                        <select class="date-field" id="beverage" name="beverage">
                            <option value="none">None</option>
                            <?php echo $options ?>
                        </select>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="reservation-box">

        <div class="button-container">
            <span class="button ok">Save</span>
        </div>
    </div>';
}
?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var countdownElement = document.getElementById('countdown');

        function updateCountdown() {
            var currentTime = new Date().getTime() / 1000; 
            var endTime = <?php echo $endTime; ?>; 

            if (currentTime > endTime) {
                countdownElement.innerHTML = "<p>Time's up!</p>";
            } else {
                var timeLeft = endTime - currentTime;
                var hours = Math.floor(timeLeft / 3600);
                var minutes = Math.floor((timeLeft % 3600) / 60);
                var seconds = Math.floor(timeLeft % 60);

                countdownElement.innerHTML = "<p>Time Left: " + hours + " hours, " + minutes + " minutes, " + seconds + " seconds</p>";
            }
        }

        // Update every second
        setInterval(updateCountdown, 1000);
    });
</script>




    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.ok').addEventListener('click', function() {
                saveReservation();
            });

            function saveReservation() {
                // Get selected values
                var numOfPlayers = document.getElementById('players').value;
                var reservationTime = Number(document.getElementById('reservationTime').value) * 3600;
                var selectedBeverage = document.getElementById('beverage');
                var beverage = selectedBeverage.options[selectedBeverage.selectedIndex].value;

                var url = 'http://localhost:3000/addTime?id=<?php echo $id ?>&time=' + reservationTime+'&np='+numOfPlayers;

                window.location.href = url;
            }
        });
    </script>

</body>

</html>
