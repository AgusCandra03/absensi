<?php
    function convert_date ($value){
        return date('d M Y - H:i:s', strtotime($value));
    }
?>
