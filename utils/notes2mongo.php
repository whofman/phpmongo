<?php

date_default_timezone_set("Europe/Amsterdam");

$notesDir = "/Users/hans/Dropbox/Notes";
$openMeta = "/Users/hans/bin/openmeta -p ";
$output   = "/Users/hans/Tmp/_meta.txt";

$conn = new Mongo();
$db = $conn->selectDB('dbNotes');                       // dbNotes database
$records = $db->records;                                // Collection records

/*
foreach (glob("$notesDir/*.*") as $dfile) {
  $file = basename($dfile);                             // Directory stripped
  if (substr($file,0,4) == ":2e_") continue;            // skip Apple system file
  $stat = stat($dfile);
  $mtime = date("Y-m-d H:i:s", $stat['mtime']);
//	print "File: $dfile $mtime\n";
  $cmd = $openMeta . '"' . $dfile . '" > ' . $output;
//  print "$cmd\n";
  system($cmd, $retv);
  $lines = file($output);
  $tag = trim($lines[1]);
  if (strlen($tag) > 5) $tag = substr($tag,6); else $tag = "";  // remove tags:
 
  $record = array(
	  'title'    => $file,
	  'tag'      => $tag,
	  'modified' => $mtime
  );
  $records->insert($record);
}
*/

// All records
$records = $db->records;                                // Files collection
$n_records = $records->count();                         // File count
$cursor = $records->find();
foreach ($cursor as $venue) {
	print $venue['title'] . " " . $venue['tag'] ."\n";
}
print "Record count: $n_records\n";
exit;
