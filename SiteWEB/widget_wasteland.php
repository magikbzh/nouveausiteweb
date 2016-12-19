<?php
require_once 'a3_get_player_number.php';

$con = mysqli_connect("163.172.171.90", "stats", "zgzYPQH6P3SN9Gq3", NULL, 62638);
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$dbwasteland = array(
	"a3wasteland",
	"a3wasteland2",
	"a3wastelandaltis",
	"a3wastelandtanoa",
	"a3wchernarus"
);


?>


<html>
<head>
	<title>stats</title>
</head>
<body>
	<table>
		<tr>
			<th>
				Server
			</th>
			<th>
				Online
			</th>
			<th>
				Unique players
			</th>
		</tr>
		<?php
		foreach ($dbwasteland as &$value)
		{
			$user_wasteland = array();
			switch ($value)
			{
				case "a3wasteland";
				$server_name = "Wasteland #1 | STRATIS";
				$ip = "195.154.223.242";
				$port = 25016;
				$password = "bgkBD)n@942)9N";
				break;

				case "a3wasteland2";
				$server_name = "Wasteland #2 | STRATIS";
				$ip = "195.154.223.242";
				$port = 25012;
				$password = "bgkBD)n@942)9N";
				break;

				case "a3wastelandaltis";
				$server_name = "Wasteland #3 | ALTIS";
				$ip = "195.154.223.249";
				$port = 25012;
				$password = "bgkBD)n@942)9N";
				break;

				case "a3wastelandtanoa";
				$server_name = "Wasteland #4 | TANOA";
				$ip = "87.98.134.112";
				$port = 25016;
				$password = "bgkBD)n@942)9N";
				break;

				case "a3wchernarus";
				$server_name = "Wasteland #5 | Chernarus";
				$ip = "195.154.223.249";
				$port = 25020;
				$password = "bgkBD)n@942)9N";
				break;

			}
			$query = 'SELECT UID FROM '.$value.'.PlayerInfo ';
			if (!mysqli_query($con,$query))
			echo("Error description: " . mysqli_error($con));
			$res = mysqli_query($con, $query);
			while ($row = mysqli_fetch_array($res))
			{
				array_push($user_wasteland, intval($row[0]));
			}
			?>
			<tr>
				<td><center>


					<?php
					echo $server_name;
					?>

				</center></td>
				<td><center>


					<?php
					echo get_a3_server_player_count($ip, $port, $password);
					?>

				</center></td>
				<td><center>


					<?php
					echo count($user_wasteland);
					?>

				</center></td>
			</tr>
		<?php
		}
		?>
	</table>
</body>
</html>
