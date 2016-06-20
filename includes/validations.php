<?php
// VALIDATION \\

function safe_html($string) {

   $string = stripslashes($string);
   $string = htmlspecialchars($string);
   return nl2br($string);
}

function query_safe($string) {
  if(get_magic_quotes_gpc()) {
    $string = stripslashes($string);
  }
  if (phpversion() >= '4.3.0') {
    $string = mysql_real_escape_string($string);
  } else {
    $string = mysql_escape_string($string);
  }
  return $string;
}

function is_email($email) {
	return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email));
}

function clean_urls($value) {
	// Needs some attention to make functional
	$value = strtolower(str_replace(' ','-',$value));
	$value = str_replace('&','',$value);
	$value = str_replace('--','-',$value);
	return $value;
}

function clean_meta_string($value, $sentenceCase) {
	$value = strtolower(str_replace('.php','',$value));
	$pattern = '/[,.\'\(\)\&]+/';
	$replacement = '-';

	$value = preg_replace($pattern, $replacement, $value);
	$value = str_replace('--','-',$value);
	$value = strtolower(str_replace('-',' ',$value));

	switch ($sentenceCase) {
		case 1:
			$value = ucwords($value);
		break;
		case 2:
			$value = ucfirst($value);
		break;
		case 3:
			$value = strtolower($value);
		break;
	}
	return $value;
}

function custom_date_format($date, $format) {
  return date($format, strtotime($date));
}

function css_class_format($value) {
	$pattern = '/[,.\'\(\)\&\s]+/';
	$replacement = '';
	$value = preg_replace($pattern, $replacement, $value);
	return $value;
	}

function integer_safe($value) {
	if(!is_numeric($value))	{
		$value = 0;
	}
	return $value;
}

function meta_header($metatTitle, $metaDesc, $metaKeywords){
	echo ('<title>' . ($metatTitle==''? clean_meta_string(getCurrentPagename(),1):$metatTitle) . '</title>'."\n".'<meta name="description" content="' . ($metaDesc==''? cleanMetaString(getCurrentPagename(),2):$metaDesc) . '"/>'."\n".'<meta name="keywords" content="' . ($metaKeywords==''? cleanMetaString(getCurrentPagename(),3):$metaKeywords) . '"/>');
}

function get_file_extension($file_name) {
	return strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
}

function validate_image($file_name) {
  $image_extensions = array("tif", "tiff", "gif", "jpeg", "jpg", "jif", "jfif", "jp2", "jpx", "j2k", "j2c", "fpx", "pcd", "png");
  $image_extension = get_file_extension($file_name);
  if(in_array($image_extension, $image_extensions)) {
    return TRUE;
  } else {
    return FALSE;
  }
}
?>
