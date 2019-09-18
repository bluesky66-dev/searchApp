<?php
//use CustomSearch\CustomSearch;
//require 'CustomSearch.php';
require 'cSearch.php';
//$data = json_decode(file_get_contents('php://input'));
//echo json_encode($_GET);exit;
$data = $_GET;
//echo $data['query'];exit;
$options = array();
if (isset($data['query']) && $data['query'] != "undefined") {
    $q = $data['query'];
} else {
    $q = '';
}
if (isset($data['exactTerms']) && $data['exactTerms'] != "undefined") {
    $exactTerms = $data['exactTerms'];
    $options['exactTerms'] = $exactTerms;
} else {
    $options['exactTerms'] = '';
}

if (isset($data['exculdeTerms']) && $data['exculdeTerms'] != "undefined") {
    $excludeTerms = $data['exculdeTerms'];
    $options['excludeTerms'] = $excludeTerms;
} else {
    $options['excludeTerms'] = '';
}
if (isset($data['dateRestrict']) && $data['dateRestrict'] != "undefined") {
    $dateRestrict = $data['dateRestrict'];
    $options['dateRestrict'] = $dateRestrict;
} else {
    $options['dateRestrict'] = '';
}
if (isset($data['itemsPerPage']) && $data['itemsPerPage'] != "undefined") {
    $itemsPerPage = $data['itemsPerPage'];
} else {
    $itemsPerPage = 10;
}
if (isset($data['pageNo']) && $data['pageNo'] != "undefined") {
    $pageNo = $data['pageNo'];
} else {
    $pageNo = 1;
}

$search = new falcon\GoogleCustomSearch('007577718444908837077:osx41lumbni', 'AIzaSyC73YuAU-neu48kB3Awbtqw2W1d3_vUeXI');
//$search = new falcon\GoogleCustomSearch('015464364486294051301:fyk4qrhtlsc', 'AIzaSyBIKeqJrxc4NVLRG-AeZqkLx1bKeAdLRhA'); 
$results = $search->search($q, $pageNo, $itemsPerPage, $options);
//print "<pre>" . print_r($results, true) . "</pre>";

//if($results->results != "")
//$myfile = fopen("newfile.html", "w") or die("Unable to open file!");
$html = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">';
$html .= '<div style="width:1170px;margin:0 auto;">';
$html .= '<h2 style="text-align:center;">Search Results</h2>';
$html .= '<div style="text-align:center;color:#A94447;"><b>Keyword: ' . $results->q . '</b><br><b>Exact Term: ' . $results->exactTerms . '</b><br><b>Exclude Term: ' . $results->excludeTerms . '</b><br><b>Page No:' . $results->page . '</b></div>';
foreach ($results->results as $key => $value) {

    $html .= '<article class="search-result row">';
    $html .= '<div class="col-xs-12 col-sm-12 col-md-3">';
    $html .= '<a href="' . $value->link . '" title="' . $value->title . '" class="thumbnail">';
    if ($value->thumbnail) {
        $html .= '<img src="' . $value->thumbnail . '" style="height: 80px;float" /></a>';
    } else {
        $html .= '<div><p style="text-align:center">Image Not available</p></div>';
    }
    $html .= '</div>';


    $html .= '<div class="col-xs-12 col-sm-12 col-md-9 excerpet">';
    $html .= '<h3><a href="' . $value->link . '" title="' . $value->title . '">' . $value->title . '</a></h3>';
    $html .= '<p>' . $value->snippet . '</p></div><span class="clearfix borda"></span><hr></article>';

}
$html .= '</div>';
$txt = stripslashes(mb_convert_encoding(preg_replace('/[\s\pZ]+/u', ' ', $html),"HTML-ENTITIES", "UTF-8"));
file_put_contents('newfile.html', $txt);
//fwrite($myfile, $txt);
//fclose($myfile);
echo "true";

//}
//if($results){
//echo json_encode($results);	
//} else {
//echo "Error could not fetch the results";
//}

?>
