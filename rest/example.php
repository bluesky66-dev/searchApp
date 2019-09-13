<?php
//use CustomSearch\CustomSearch;
//require 'CustomSearch.php';
require 'cSearch.php';
//$data = json_decode(file_get_contents('php://input'));
//echo json_encode($_GET);exit;
$data = $_GET;
//echo $data['query'];exit;
$options = array();
if(isset($data['query']) && $data['query'] != "undefined"){
$q = $data['query'];
} else {
$q = '';	
}
if(isset($data['exactTerms']) && $data['exactTerms'] != "undefined"){
$exactTerms = $data['exactTerms'];
$options['exactTerms'] = $exactTerms;
} else {
	$options['exactTerms'] = '';
}

if(isset($data['exculdeTerms']) && $data['exculdeTerms'] != "undefined"){
$excludeTerms = $data['exculdeTerms'];
$options['excludeTerms'] = $excludeTerms;
} else {
	$options['excludeTerms'] = '';
}
if(isset($data['dateRestrict']) && $data['dateRestrict'] != "undefined"){
$dateRestrict = $data['dateRestrict'];
$options['dateRestrict'] = $dateRestrict;
} else {
	$options['dateRestrict'] = '';
}
if(isset($data['itemsPerPage']) && $data['itemsPerPage'] != "undefined"){
$itemsPerPage = $data['itemsPerPage'];
} else {
	$itemsPerPage = 10;
}
if(isset($data['pageNo']) && $data['pageNo'] != "undefined"){
$pageNo = $data['pageNo'];
} else {
	$pageNo = 1;
}

$search = new falcon\GoogleCustomSearch('007577718444908837077:osx41lumbni', 'AIzaSyC73YuAU-neu48kB3Awbtqw2W1d3_vUeXI');
//$search = new falcon\GoogleCustomSearch('015464364486294051301:fyk4qrhtlsc', 'AIzaSyBIKeqJrxc4NVLRG-AeZqkLx1bKeAdLRhA'); 
$results = $search->search($q,$pageNo,$itemsPerPage,$options);
//print "<pre>" . print_r($results, true) . "</pre>";

if($results){
echo json_encode($results);	
} else {
	echo "Error could not fetch the results";
}

//print "<pre>" . print_r($results, true) . "</pre>";
?>
