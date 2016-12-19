<?php
require_once 'arc.php';
require_once 'rust.php';

// use \Nzarii\ARC;
ini_set('xdebug.var_display_max_data', 0);
try
{
	$rcon1 = new ARC("195.154.223.242", "bgkBD)n@942)9N", 25016, ["sendHeartbeat" => true]);
	$rcon2 = new ARC("195.154.223.242", "bgkBD)n@942)9N", 25012, ["sendHeartbeat" => true]);
	$rcon3 = new ARC("195.154.223.249", "bgkBD)n@942)9N", 25012, ["sendHeartbeat" => true]);
	$rcon4 = new ARC("195.154.223.249", "bgkBD)n@942)9N", 25020, ["sendHeartbeat" => true]);
	$rcon5 = new ARC("87.98.134.112", "bgkBD)n@942)9N", 25016, ["sendHeartbeat" => true]);
	$rcon6 = new ARC("62.210.100.8", "62){zP9eDwVpU2*", 25025, ["sendHeartbeat" => true]);
	$rcon7 = new ARC("62.210.100.8", "62){zP9eDwVpU2*", 25012, ["sendHeartbeat" => true]);
	$rcon8 = new ARC("62.210.100.8", "nWNbn9M2255zsV", 25020, ["sendHeartbeat" => true]);
	$rcon9 = new ARC("195.154.39.197", "8maR@6.u8bB7~J", 25025, ["sendHeartbeat" => true]);
	$rcon10 = new ARC("163.172.51.243", "8maR@6.u8bB7~J", 25012, ["sendHeartbeat" => true]);

}
catch (Exception $e)
{
	echo "Ups! Something went wrong: {$e->getMessage()}";
}
$total = 0;
$ip_rust = '163.172.51.243';
$port_rust = 28016;
$password_rust = 'autiste';
$rust = new RustRcon($ip_rust, $port_rust, $password_rust);
$total += $rust->GetPlayerCount();

$total += count($rcon1->getPlayersArray());
$total += count($rcon2->getPlayersArray());
$total += count($rcon3->getPlayersArray());
$total += count($rcon4->getPlayersArray());
$total += count($rcon5->getPlayersArray());
$total += count($rcon6->getPlayersArray());
$total += count($rcon7->getPlayersArray());
$total += count($rcon8->getPlayersArray());
$total += count($rcon9->getPlayersArray());
$total += count($rcon10->getPlayersArray());

echo 'Le nombre de joueurs qui jouent actuellement sur nos serveur de jeux est de : ' . $total;

sleep(1);
?>
