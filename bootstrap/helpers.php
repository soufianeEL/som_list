<?php

function currentAction(){
    if(isset($_SERVER['PATH_INFO'])){
        $result = explode('/',$_SERVER['PATH_INFO']);
        return $result[1];
    }

    return '';
}