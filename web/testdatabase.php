<?php
session_start();

// default Heroku Postgres configuration URL
$dbUrl = getenv('DATABASE_URL');

if (empty($dbUrl)) {
 // example localhost configuration URL with postgres username and a database called cs313db
 $dbUrl = "postgres://postgres:michelle@localhost:5432/postgres";
 //$dbUrl = "postgres://postgres:password@localhost:5432/cs313db";
}

$dbopts = parse_url($dbUrl);

//print "<p>$dbUrl</p>\n\n";

$dbHost = $dbopts["host"]; 
$dbPort = $dbopts["port"]; 
$dbUser = $dbopts["user"]; 
$dbPassword = $dbopts["pass"];
$dbName = ltrim($dbopts["path"],'/');

try {
	$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
	//print "<p>pgsql:host=$dbHost;port=$dbPort;dbname=$dbName;dbPassword=$dbPassword</p>\n\n";
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch (PDOException $ex) {
 echo "<p>error: $ex->getMessage() </p>\n\n";
 die();
}

/*
foreach ($db->query('SELECT now()') as $row)
{
 //print "<p>$row[0]</p>\n\n";
}
*/
?>