<?php
require_once 'arc.php';
function get_a3_server_player_count($ip, $port, $password)
{
	$rcon1 = new ARC($ip, $password, $port);
	return count($rcon1->getPlayersArray());
}
?>
