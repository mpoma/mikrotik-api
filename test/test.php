<?php
require '../vendor/autoload.php';
use MikrotikAPI\Talker\Talker;
use \MikrotikAPI\Entity\Auth;
use MikrotikAPI\Commands\Queues\Queues;



$auth = new Auth();
$auth->setHost("192.168.233.2");
$auth->setUsername("user");
$auth->setPassword("password");
$auth->setDebug(TRUE);

$talker = new Talker($auth);
$queues = new Queues($talker);
$queuename = "Prueba desde Test";
$queuerate = "256K_UP/1M_DOWN";
$queueip = "192.168.233.51";
$target = $queues->getTarget($queueip);
MikrotikAPI\Util\DebugDumper::dump($target);
if ( $target) {
		$status = $queues->set(array( 'name' => $queuename, 'target' => $queueip, 'queue' => $queuerate), 
		$target[0]['.id']);
}


MikrotikAPI\Util\DebugDumper::dump($status);
?>
