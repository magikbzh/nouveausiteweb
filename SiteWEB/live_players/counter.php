<?php
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
$dbrush = array(
	"a3_rush_altis",
	"a3_rush_tanoa"
);
$dbexile = array(
	"exile"
);
$dbkoth = array(
	"koth1"
);

$user_total = array();

$user_wasteland = array();
foreach ($dbwasteland as &$value)
{
	$query = 'SELECT UID FROM '.$value.'.PlayerInfo';
	if (!mysqli_query($con,$query))
		echo("Error description: " . mysqli_error($con));
	$res = mysqli_query($con, $query);
	while ($row = mysqli_fetch_array($res))
	{
		array_push($user_wasteland, intval($row[0]));
		array_push($user_total, intval($row[0]));
	}
	echo "<br/>";
	echo "<br/>";
	echo $value." : ";
	echo count($user_wasteland);
}
echo "<br/>";
echo "Total : ".count($user_wasteland);
echo "<br/>";
echo "Total unique : ".count(array_unique($user_wasteland));


$user_rush = array();
foreach ($dbrush as &$value)
{
	$query = 'SELECT steamid FROM '.$value.'.players';
	if (!mysqli_query($con,$query))
		echo("Error description: " . mysqli_error($con));
	$res = mysqli_query($con, $query);
	while ($row = mysqli_fetch_array($res))
	{
		array_push($user_rush, intval($row[0]));
		array_push($user_total, intval($row[0]));
	}
	echo "<br/>";
	echo "<br/>";
	echo $value." : ";
	echo count($user_rush);
}
echo "<br/>";
echo "Total : ".count($user_rush);
echo "<br/>";
echo "Total unique : ".count(array_unique($user_rush));


$user_exile = array();
foreach ($dbexile as &$value)
{
	$query = 'SELECT uid FROM '.$value.'.account';
	if (!mysqli_query($con,$query))
		echo("Error description: " . mysqli_error($con));
	$res = mysqli_query($con, $query);
	while ($row = mysqli_fetch_array($res))
	{
		array_push($user_exile, intval($row[0]));
		array_push($user_total, intval($row[0]));
	}
	echo "<br/>";
	echo "<br/>";
	echo $value." : ";
	echo count($user_exile);
}
echo "<br/>";
echo "Total : ".count($user_exile);
echo "<br/>";
echo "Total unique : ".count(array_unique($user_exile));

echo "<br/>";
echo "Total unique tout serveurs: ".count(array_unique($user_total));
?>
