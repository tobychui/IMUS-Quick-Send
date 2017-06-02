<?php
$memodir = "Memo/";
if(isset($_POST['content']) !== False){
    $content = $_POST['content'];
	$content = bin2hex($content);
}
$max = 0;
	foreach (new DirectoryIterator('Memo/') as $fileInfo) {
		if ($fileInfo->isDot()) continue;
		$current = pathinfo($fileInfo->getFilename())['filename'];
		if (!is_numeric($current)) continue;
		if ($current > $max) $max = $current;
	}
$filename = (int)$max + 1;
$myfile = fopen($memodir . $filename . ".txt", "w") or die("Unable to open file!");
$txt = $content;
fwrite($myfile, $txt);
fclose($myfile);
echo $filename;
?>