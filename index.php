<!DOCTYPE html>

<!-- 
Pattern Response - Style Guide/Pattern Library
Author: Luke Brooker (http://lukebrooker.com)
Version: 1.1
URL: http://lukebrooker.com
-->

<head>
<meta charset="utf-8">
<title>Pattern Response - A Responsive Style Guide & Pattern Library</title>

<!-- Mobile viewport optimization h5bp.com/ad -->
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width">
<!-- Mobile IE allows us to activate ClearType technology for smoothing fonts for easy reading -->
<meta http-equiv="cleartype" content="on">
<!-- Styles just for pattern response -->
<link rel="stylesheet" href="pattern-response/css/styles.css">
<!-- Styles for Google Prettify -->
<link rel="stylesheet" href="pattern-response/google-code-prettify/prettify.css" />
<!-- Style guide styles -->
<!-- Compiles all the css files that are in the patterns directory -->
<link rel="stylesheet" href="pattern-response/css/compiled.php">
<!-- Uncomment and point this to any other custom css files you want to add -->
<!-- <link rel="stylesheet" href="custom/css/custom.css"> -->
</head>
<body onload="prettyPrint()" data-spy="scroll" class="pat-res pat-res-no-code">

<?php

// Change this if you want your patterns file in a different place, Also needs to be changes in comiled.css
$dir = 'patterns/*';

// Display Menu

echo '<nav class="pat-res-nav">
			<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="#home">Pattern Response</a>
				<div class="nav-collapse">
					<ul class="nav" id="main-menu">';

foreach(glob($dir, GLOB_ONLYDIR) as $folder)  
{  
    $folder_path = pathinfo($folder);
    $folder_id = strtolower(remove_chars($folder_path['basename']));
    if (glob($folder . '/*.html') || glob($folder . "/*", GLOB_ONLYDIR)) {
	    echo '<li class="dropdown">';
	    echo '<a href="#" class="dropdown-toggle"
          data-toggle="dropdown">';
	    echo ucwords(str_replace('-',' ',$folder_path['basename']));
	    echo '<b class="caret"></b></a><ul class="dropdown-menu">';
	    foreach(glob($folder . '/*') as $file)  
			{
					$file_path = pathinfo($file);
					if (is_dir($file) === true) {
						$file_id = strtolower(remove_chars($file_path['basename']));
						echo '<li><a href="#' . $file_id . '">'. ucwords(str_replace('-',' ',$file_path['basename'])) . '</a></li>';
					}
					elseif ($file_path['extension'] == 'html') {
						$file_id = strtolower(remove_chars($file_path['filename']));
						echo '<li><a href="#' . $file_id . '">'. ucwords(str_replace('-',' ',$file_path['filename'])) . '</a></li>';
					}
			}
			echo '</ul></li>';
		}
		else {
			echo '<li>';
	    echo '<a href="#' . $folder_id . '">';
	    echo ucwords(str_replace('-',' ',$folder_path['basename']));
	    echo '</a>';
		}
}

echo '</ul>
			<form class="navbar-search pull-right">
				<input type="search" data-provide="typeahead" data-items="4" class="pat-res-search-query" placeholder="Search" id="mainSearch">
			</form>
			<ul class="nav pull-right">
				<li><a href="responsive">Other Sizes</span></a></li>
				<li><a href="#" class="pat-res-code-toggle">Show Code</a></li>
			</ul>
			</div></div></div></div></nav>';

// Display Patterns

echo '<div class="pat-res-patterns" id="home">';

foreach(glob($dir, GLOB_ONLYDIR) as $folder)  
{  
    $folder_path = pathinfo($folder);
    $folder_id = strtolower(remove_chars($folder_path['basename']));
    echo '<div class="searchable pat-res-space" title="' . ucwords(str_replace('-',' ',$folder_path['basename'])) . '" id="' . $folder_id . '"></div><section class="pat-res-section">';
    echo '<header class="pat-res-header"><h2 class="pat-res-heading">' . ucwords(str_replace('-',' ',$folder_path['basename'])) . '<a href="#home" class="pat-res-btt">Back to top</a></h2>';
    $info_file = $folder . '/info.txt';
    if (file_exists($info_file)) {
    	echo '<div class="pat-res-info">';
			include($info_file);
			echo '</div></header>';
    }
    else {
    	echo '</header>';
    }
    foreach(glob($folder . '/*') as $file)  
		{
			$file_path = pathinfo($file);
			if (is_dir($file) === true) {
				$file_id = strtolower(remove_chars($file_path['basename']));
				echo '<div class="searchable pat-res-space" title="' . ucwords(str_replace('-',' ',$file_path['basename'])) . '" id="' . $file_id . '"></div>';
				echo '<header class="pat-res-sub-header"><h3 class="pat-res-heading">' . ucwords(str_replace('-',' ',$file_path['basename'])) . '</h3>';
				$info_file = $file . '/info.txt';
		    if (file_exists($info_file)) {
		    	echo '<div class="pat-res-info">';
					include($info_file);
					echo '</div></header>';
		    }
		    else {
		    	echo '</header>';
		    }
				foreach(glob($file . '/*.html') as $sub_file)
				{
					$folder_name = $file_path['filename'];
					$file_path = pathinfo($sub_file);
					print_html($file, $sub_file, $file_path, $folder_name);
				}
				
			}
			elseif ($file_path['extension'] == 'html') {
				$file_id = strtolower(remove_chars($file_path['filename']));
				echo '<div class="searchable pat-res-space" title="' . ucwords(str_replace('-',' ',$file_path['filename'])) . '" id="' . $file_id . '"></div>';
				print_html($folder, $file, $file_path);
			}
		} 
		echo '</section>';
}

echo '</div>';

function print_html($folder, $file, $file_path, $folder_name = null) {
	$file_id = strtolower(remove_chars($file_path['filename']));
	$file_contents = file_get_contents($file);
	$css_file = $folder . '/' . $file_path['filename'] . '.css';
	$info_string = find_string($file_contents, '<!--INFO!', '/INFO-->');
	$html_string = find_html($file_contents, '/INFO-->', '<!--CSS!');
	if (!$html_string): $html_string = 'No HTML'; endif;
	$html_string_code = htmlspecialchars($html_string);
	$css_string = find_string($file_contents, '<!--CSS!', '/CSS-->');
	$max_width_string = find_string($file_contents, '<!--MAXWIDTH!', '/MAXWIDTH-->');
	if (!$folder_name) {
		echo '<header class="pat-res-sub-header"><h3 class="pat-res-heading">' . ucwords(str_replace('-',' ',$file_path['filename'])) . ' <a class="pat-res-link" href="'.$file.'">'.$file_path['filename']. '.' . $file_path['extension'].'</a></h3>';
		if ($info_string): echo '<div class="pat-res-info">' . $info_string . '</div>'; endif;
		echo '</header>';
	}
	else {
		echo '<div class="searchable pat-res-space" title="' . ucwords(str_replace('-',' ',$file_path['filename'])) . '" id="' . $file_id . '"></div>';
		echo '<header class="pat-res-sub-header"><h4 class="pat-res-heading">' . ucwords(str_replace('-',' ',$file_path['filename'])) . ' <a class="pat-res-link" href="'.$file.'">'.$file_path['filename']. '.' . $file_path['extension'].'</a></h4>';
		if ($info_string): echo '<div class="pat-res-info">' . $info_string . '</div>'; endif;
		echo '</header>';
	}
	echo '<div class="pat-res-pattern">';
  echo '<div class="pat-res-display"';
  if($max_width_string): echo ' style="max-width: ' . $max_width_string . '";'; endif;
  echo '>';
  echo $html_string;
  echo '</div>';
  echo '<div class="pat-res-source">';
  echo '<div class="html code"><h5 class="pat-res-heading"><a href="'.$file.'" class="clip">HTML <span>select</span></a></h5>';
  echo '<pre class="prettyprint lang-html">';
  echo $html_string_code;
  echo '</pre></div>';
  if ($css_string) {
    echo '<div class="css code"><h5 class="pat-res-heading"><a href="'.$file.'" class="clip">CSS <span>select</span></a>';
    echo '<span class="inline">embedded</span>';
    echo '</h5>';
    echo '<pre class="prettyprint lang-css">';
    echo $css_string;
    echo '</pre></div>';
    echo '<style type="text/css">';
    echo $css_string;
    echo '</style>';
  } elseif (file_exists($css_file)) {
    echo '<div class="css code"><h5 class="pat-res-heading"><a href="'.$file.'" class="clip">CSS <span>select</span></a>';
    echo '<span class="inline">compiled</span>';
    echo '</h5>';
    echo '<pre class="prettyprint lang-css">';
    echo htmlspecialchars(file_get_contents($css_file));
    echo '</pre></div>';
  }
  echo '</div>';
  echo '</div>';
}

function remove_chars($string) {
	$bad_chars = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", " ", ".", "-");
	$string = str_replace($bad_chars, '', $string);
	return $string;
}

function find_string($source_string, $first_string, $last_string) {
	if (strstr($source_string, $first_string)): $starts_at = strpos($source_string, $first_string) + strlen($first_string);
	else: return false;
	endif;
	$ends_at = strpos($source_string, $last_string, $starts_at);
	$result = substr($source_string, $starts_at, $ends_at - $starts_at);
	return $result;
}

function find_html($source_string, $first_string, $last_string) {
	$starts_at = strpos($source_string, $first_string);
	if ($starts_at): $starts_at = $starts_at + strlen($first_string);
	else: $starts_at = 0;
	endif;
	$ends_at = strpos($source_string, $last_string, $starts_at);
	if ($ends_at): $ends_at = strpos($source_string, $last_string, $starts_at);
	elseif (strpos($source_string, '<!MAXWIDTH!', $starts_at)): $ends_at = strpos($source_string, '<!MAXWIDTH!', $starts_at); 
	else: $ends_at = strlen($source_string);
	endif;
	$result = substr($source_string, $starts_at, $ends_at - $starts_at);
	return $result;
}

?>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="pattern-response/js/bootstrap-dropdown.js"></script>
<script type="text/javascript" src="pattern-response/js/bootstrap-scrollspy.js"></script>
<script type="text/javascript" src="pattern-response/js/bootstrap-collapse.js"></script>
<script type="text/javascript" src="pattern-response/js/bootstrap-typeahead.js"></script>
<script type="text/javascript" src="pattern-response/google-code-prettify/prettify.js"></script>
<script type="text/javascript" src="pattern-response/js/pattern-response.js"></script>

</body>
</html>