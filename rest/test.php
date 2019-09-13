<?php
use CustomSearch\CustomSearch;
require '../CustomSearch.php';
require 'cSearch.php';
$data = json_decode(file_get_contents('php://input'));
//echo json_encode($data);
//$q = $data->query;
//$exactTerms = $data->exactTerms;
//$excludeTerms = $data->exculdeTerms;
//$options = array();
//$options['exactTerms'] = $exactTerms;
//$options['excludeTerms'] = $excludeTerms;
//print_r($options);
//Initialize the search class
$cs = new CustomSearch();

//Perform a simple search
//$response = $cs->simpleSearch('whole foods');

//Perform a search with extra parameters
$results = $cs->search('whole foods', ['excludeTerms'=>'tomato']);
//$search = new falcon\GoogleCustomSearch('012480111164681847637:_naphjczwvw', 'AIzaSyA4V3GlU7MVIoqR_tPmPlVoxsOXD3-82WA');
//$results = $search->search($q,1,10,$options);
if($results){
print "<pre>" . print_r($results, true) . "</pre>";
} else {
	echo "wat d fuck man";
}
?>
