#!/usr/bin/php
<?php

declare(ticks = 1); // how often to check for signals
function sig_handler($signo){ // this function will process sent signals
 if ($signo == SIGTERM || $signo == SIGHUP || $signo == SIGINT || $signo == SIGSTOP){
 print "\tGrandchild : "
 .getmypid()
 . " I got signal $signo and will exit!\n";
// If this were something important we might do data cleanup here
  exit();
 }
}

// These define the signal handling
pcntl_signal(SIGTERM, "sig_handler");
pcntl_signal(SIGHUP,  "sig_handler");
pcntl_signal(SIGINT, "sig_handler");
pcntl_signal(SIGSTOP, "sig_handler");

print "Grandchild : ".getmypid()."\n";
sleep(15);
sleep(15);
print "\tGrandchild : " . getmypid() . " exiting\n";
exit();

?>
