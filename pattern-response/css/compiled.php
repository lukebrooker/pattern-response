<?php
header('Content-type: text/css');
// Uncomment if you want the CSS to be compressed
// ob_start("compress");
// function compress($buffer) {
//   /* remove comments */
//   $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
//   /* remove tabs, spaces, newlines, etc. */
//   $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
//   return $buffer;
// }

// Change this if you want your patterns file in a different place, Also needs to be changes in index.php
$dir = realpath('../../patterns');

/* include your css files */

$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir), RecursiveIteratorIterator::SELF_FIRST);
foreach($objects as $file => $object){
  $file_path = pathinfo($file);
  if($file_path['extension'] == 'css') {
  	echo '
/*--- '. ucwords(str_replace('-',' ',$file_path['basename'])) . ' ---*/
';
  	include($file);
  }
}

ob_end_flush();

?>