<?php
function getPhilippineStandardTime() {
    date_default_timezone_set('Asia/Manila');
    $time = date('Y-m-d h:i:s A'); // 'h' for 12-hour format, 'A' for AM/PM
    return $time;
}