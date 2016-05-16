<?php
require '../vendor/autoload.php';
use MikrotikAPI\Talker\Talker;
use \MikrotikAPI\Entity\Auth;
use MikrotikAPI\Commands\Queues\Queues;

$auth = new Auth();
$auth->setHost("192.168.233.2");
$auth->setUsername("user");
$auth->setPassword("password");
$auth->setDebug(true);
$talker = new Talker($auth);
$ipaddr = new Queues($talker);
$listIP = $ipaddr->getTarget("192.168.233.51");
MikrotikAPI\Util\DebugDumper::dump($listIP);