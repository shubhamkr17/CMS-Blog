<?php
    function redirect_to($new_location){
        header("Location:".$new_location);
    }

    function date_time () {
        date_default_timezone_set("Asia/Kolkata");
        $currentTime = time();
        // $dateTime = strftime("%Y-%m-%d %H:%M:%S",$currentTime);
        $dateTime = strftime("%B %d, %Y %H:%M:%S",$currentTime);
        return $dateTime;
    }
?>