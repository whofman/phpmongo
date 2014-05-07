<!DOCTYPE html>
<html>
<head>
	<meta name="author" content="Hans Hofman">
	<link href="static/css/mystyle.css" rel="stylesheet" type="text/css">
</head>
<body>
	
<?php
$conn = new Mongo();
$db = $conn->selectDB('dbNotes');                      // dbNotes database
$records = $db->records;                               // Collection records

if (isset($_GET['submit']) && ($_GET['submit'] == "Zoek")) {
	$search = $_GET['Search'];
	if (substr($search, 0, 7) == "title: ") {
	   $search = substr($search, 7);  $i = 1;
    } elseif (substr($search, 0, 5) == "tag: ") {
	   $search = substr($search, 5); $i = 2;
	} elseif (substr($search, 0, 10) == "modified: ") {
	   $search = substr($search, 10); $i = 3;
	} else { $i = 0;}                                  // default title
	$regex = new MongoRegex("/" . $search . "/i");     // Case insensitive
	switch ($i) {
		case 0:
		case 1:
		   $cursor = $records->find(array('title' => $regex));
		   break;
		case 2:
		   $cursor = $records->find(array('tag' => $regex));
		   break;
		case 3 :
		   $cursor = $records->find(array('modified' => $regex));
		   break;
	}
} else
$cursor = $records->find();
?> 
<center><h2>Notes Database</h2></center>	
<form method="get" action="<?php echo $PHP_SELF?>">
<input type="text" size="145" name="Search" value="">
<input type="submit" name="submit" value = "Zoek">
</form>

<table class="TFtable" style="width:800px">
	<tr><td><strong>Title<td>Tags<td>Date Modified</strong></tr>
<?php                            

foreach ($cursor as $venue) {
	echo "<tr><td>" . $venue['title'] . "<td>" . $venue['tag'] . "<td>" . $venue['modified'] . "</tr>";
}
echo "</table>";

$n_records = $cursor->count();                         // File count
echo "<p>Record count: $n_records";

?>
</body>
</html>