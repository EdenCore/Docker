<html>
<head>
<title>Recuperation des donnees depuis le serveur MariaDB</title>
</head>
<body>
<style>
td,th {
border: solid black 1px;
font-size: 30px;
width: 200px;
}
</style>
<table>
<tr>
<th>Name</th>
<th>Email</th>
</tr>
<?php
$dbhost = "mariadb";
$dbuser = "linus";
$dbpass = "nopass";
$db = "testdb";
$dbconn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
if(! $dbconn ) {
die('Could not connect: ' . mysql_error());
}
$query = mysqli_query($dbconn, "SELECT * FROM test")
or die (mysqli_error($dbconn));
while ($row = mysqli_fetch_array($query)) {
echo
"<tr>
<td>{$row['name']}</td>
<td>{$row['email']}</td>
</tr>";
}
mysqli_close($dbconn);
?>
</body>
</html>