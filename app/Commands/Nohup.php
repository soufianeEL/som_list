<?php
/**
 * Created by PhpStorm.
 * User: soufiane
 * Date: 11/06/2015
 * Time: 15:58
 */

namespace App\Commands;


class Nohup {

    public $command;
    public $pid;
    public $stdout;

    public function __construct($Command){
        $this->command = $Command;
    }

    function run($Priority = 0){
        if($Priority)
            $PID = shell_exec("nohup nice -n {$Priority} php ".__DIR__."/{$this->command} >> nohup.out 2>&1 & echo $!");
        else
            $PID = shell_exec("nohup php ".__DIR__."/{$this->command} >> nohup.out 2>&1 & echo $!");
        $this->pid=$PID;
        return($PID);
    }

    function run_after($Seconds){

        //sleep after
    }


    function is_running(){
        exec("ps {$this->pid}", $ProcessState);
        return(count($ProcessState) >= 2);
    }

    function kill(){
        //posix_kill
        if($this->is_running()){
            exec("kill -KILL {$this->pid}");
            return true;
        }else return false;
    }

    function pause($PID){
        //-STOP
    }

    function resume($PID){

    }

}