<?php 
// set the page number first.
$pagenum = (int)(!(isset($_REQUEST['pagenum'])) ? 1 : $_REQUEST['pagenum']);

if ($pagenum > 1) {
    //    // get count from HTML if not first page
    //    $dom = new DOMDocument();
    //    $dom->loadHTMLFile('index.php');
    //    $elm = $dom->getElementById("show_total");
    //    $cnt = trim($elm)[0];
    $cnt = (int)$_SESSION['cnt'];
}

//Number of results displayed per page     by default its 10.
$page_limit = (int)($_REQUEST["show"] <> "" && is_numeric($_REQUEST["show"]) ) ? $_REQUEST["show"] : 10;

//Calculate the last page based on total number of rows and rows per page.
$last = (int)ceil($cnt / $page_limit);

//this makes sure the page number isn't below one, or more than our maximum pages 
if ($pagenum < 1) { 
	$pagenum = 1; 
} elseif ($pagenum > $last)  { 
	$pagenum = $last; 
}

//Calculate the lower limit i.e the starting point of each page based on the current page
$lower_limit = (int)(($pagenum - 1) * $page_limit);

$order = (isset($_REQUEST['order']) ? trim($_REQUEST['term_1']) : 'volume_label, filename');

if (!empty($_REQUEST['term_1']) && !empty($_REQUEST['term_2'])) {
     // two valid term entered
    $files = 
        FileDB::get_files_by_filepath_2($term_1, $term_2, 1, $lower_limit, $page_limit);
}
elseif (!empty($_REQUEST['term_1'])) { 
     // term_1 is valid, term_2 is not
    $files = 
        FileDB::get_files_by_filepath_1($term_1, $order, $lower_limit, $page_limit);
}        
elseif (!empty($_REQUEST['term_2'])) {
    // term_2 is valid, term_1 is not               
    $files = 
        FileDB::get_files_by_filepath_1($term_2, 1, $lower_limit, $page_limit);
}
else
{
    // should never get here
    // eror message?    
}

if ($pagenum > 1)   
{
    // construct the table
    echo "<table id='resultTable' class='table sortable table-striped " .
        " table-hover table-responsive table-bordered' style='width:100%'>";
    echo "<thead>";
    echo "<th style='width:8%'>Disk</th>";                
    echo "<th style='width:86%'>Name</th>";
    echo "<th style='width:8%'>Ext.</th>";
    echo "</thead>";
    echo "<tbody>"; 
}

foreach($files as $file) {
    $path = htmlspecialchars($file->GetFilepath(), ENT_QUOTES | ENT_IGNORE);
    echo "<tr id='x'>";
    echo "<td style='width:8%'>" . $file->GetVolume_label() . "</td>";
    echo "<td title='" . $path . "' style='width:86%'>" . $file->GetFilename() . "</td>";
    echo "<td style='width:8%'>" . $file->GetFile_ex() . "</td>";
}
  
 echo "</tbody>";
 echo "</table>";

include('pager.php');  

echo "</div>";
?>






