<?php
$openmeta = "/Users/hans/bin/openmeta -p /Users/hans/Dropbox/Notes/Node.js.txt > /Users/hans/x.x";

$info = system($openmeta, $retv);
$lines = file("/Users/hans/x.x");
$tag = trim($lines[1]);
if (strlen($tag) > 5) $tag = substr($tag,6); else $tag = "pp";
print ".$tag.";
?>