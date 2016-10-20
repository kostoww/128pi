<?php
include("config.php");
$sql = "SELECT * FROM `lights` ORDER BY `id` DESC LIMIT 5" ;
$result = $estCon->query($sql);
$handler = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['type'] == 2) {
            $text = "desk light";
        } elseif ($row['type'] == 17) {
            $text = "led light";
        }  elseif ($row['type'] == 4) {
            $text = "xmas light";
        } else {
            $text = "main light";
        }

        if ($row['state'] == 0) {
            $state = "turned off";
        } else {
            $state = "turned on";
        }

        $data[] = array(
            "id" =>   $row['id'],
            "type"  =>   $text,
            "state"  =>  $state,
            "date" =>   $row['date'],
            "browser"  =>   $row['browser'],
            "os"  =>   $row['os']
        );
    }
}
print_r(json_encode($data));
?>