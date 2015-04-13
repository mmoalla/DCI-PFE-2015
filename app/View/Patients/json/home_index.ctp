<?php
$output = array();
foreach ($data as $d) {
    array_push($output, $d['User']);
}
echo json_encode($output);
