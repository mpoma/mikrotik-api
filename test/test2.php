<?php
require '../vendor/autoload.php';
use MikrotikAPI\Talker\Talker;
use \MikrotikAPI\Entity\Auth;
use MikrotikAPI\Commands\IP\Address;
use MikrotikAPI\Commands\IP\Firewall\FirewallFilter;
$auth = new Auth();
$auth->setHost("192.168.233.2");
$auth->setUsername("simbmad");
$auth->setPassword("antena123sol");
$auth->setDebug(true);
$talker = new Talker($auth);
//$filter = new FirewallFilter($talker);
//$a = $filter->getAll();
$ipaddr = new Address($talker);
$listIP = $ipaddr->getAll();
MikrotikAPI\Util\DebugDumper::dump($listIP);