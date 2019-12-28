<?php
/**
This file resides in the administrator part of the website. Where it can be called from the root or from the administrator folder. So we need to make sure we are sending the information back to the correct function.
The assumption is we are always sending info back to the calling functiobn.
*/

/* include section */
require_once "../class/HtmlUrl.php";

/* if the referer ends with a / just add index.php */
$urlObject = new HtmlUrl($_SERVER['HTTP_REFERER']);
$urlObject->setQueryElements($_GET);

///* because strrpos is zero based and length is 1 based we need to subtract 1 from the length. */
//if (strrpos($nmpath, "/") === strlen($nmpath)-1){
//	$nmpath .= "index.php";
//}

//print_r($_POST);
//print_r($_GET);

//switch ($mode){
//	default:
//		$ftkeys = array_keys($_POST);
//		foreach ($ftkeys as $ftkey){
//			if (empty($fturl)){
//				$fturl = $ftkey . "=" . $_POST[$ftkey];
//			} else {
//				$fturl .= "&" . $ftkey . "=" . $_POST[$ftkey];
//			}
//		}
//		print_r("Location: " . $nmpath . "?" . $fturl);
////		header("Location: " . $nmpath . "?" . $fturl);
//		break;
//}

//	print_r("Location: " . $urlObject->createUrlContent());
	header("Location: " . $urlObject->createUrlContent());

?>