<?php
include("./config.php");

$sql = "SELECT * FROM messages";
$result = $conn->query($sql);
$systems='';
if ($result->num_rows > 0) {
    $systems="";
    while ($row = $result->fetch_assoc()) {
        $id= $row["id"]; 
        $Device_id=$row["device_id"];
        $Device_name=$row["device_name"];
        $msg_content = $row["message_content"];
        $time = $row["Time"] ;
        $timeStamp = $row["timestamp"] ;
        $is_on= $row["is_on"] ;
        if($is_on==0){
            $onOff="available";
        }else{
            $onOff="occupied";
        }

        $systems .='
        
        <div class="col" style="padding: 10px;">
        <div style="background-image:linear-gradient(45deg, #ff1c1c, #ffb4b4); padding:
        20px;border-radius: 12px;">
            <h3 class="h3">'.$Device_name.'</h3>
            <p class="h6 text-light">'.$Device_id.'</p>
            <p?>  system is '.$onOff.' </p>

            <a class="btn btn-light text-danger  w-100" href="singlesystem.php?id='.$id.'&occ='.$is_on.'" >View</a>
        </div>

    </div>';
    }
} else {
    $systems= "No systems found";
}

$conn->close();
// echo $systems;
?>
