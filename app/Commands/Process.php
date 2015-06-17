<?php
/**
 * Created by PhpStorm.
 * User: soufiane
 * Date: 18/06/2015
 * Time: 16:39
 */

namespace App\Commands;


class Process {

    public static function run($command, $Priority = 0){
        if($Priority)
            $PID = shell_exec("nohup nice -n {$Priority} php ".__DIR__."/{$command} >> nohup.out 2>&1 & echo $!");
        else
            $PID = shell_exec("nohup php ".__DIR__."/{$command} >> nohup.out 2>&1 & echo $!");
        return($PID);
    }

    public static function run_after($Seconds){

        //sleep after
    }

    public static function is_running($pid){
        exec("ps {$pid}", $ProcessState);
        return(count($ProcessState) >= 2);
    }

    public static function kill($pid){
        //posix_kill
        if(self::is_running($pid)){
            exec("kill -2 {$pid}");
            return true;
        }else
            return false;
    }

    public static function pause($PID){
        //-STOP
    }

    public static function resume($PID){

    }

}