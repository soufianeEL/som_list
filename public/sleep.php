#!/usr/bin/php

<?php
$queue_id = 83;

set_sent($queue_id,200);

function set_sent($queue_id, $return){
    $db = connect_to_db();

    $query = "UPDATE `queues` SET `status` = '1', `return` = {$return},`pid` = 'null' WHERE `id` = {$queue_id}; ";
    $result = $db->query($query);

    if (!$result) {
        echo "Update record failed: (" . $db->errno . ") " . $db->error;
        return flase;
    }
    return true;
}

function connect_to_db() {
    $mysqli = new mysqli('127.0.0.1', 'root', '', 'som_list');

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: ( $mysqli->connect_errno ) $mysqli->connect_error";
        return;
    }

    return $mysqli;
}