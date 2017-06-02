<?php
$max = 0;
	foreach (new DirectoryIterator('Memo/') as $fileInfo) {
		if ($fileInfo->isDot()) continue;
		$current = pathinfo($fileInfo->getFilename())['filename'];
		if (!is_numeric($current)) continue;
		if ($current > $max) $max = $current;
	}
echo json_encode($max);
?>