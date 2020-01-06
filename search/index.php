<?php
session_start();  
require('../model/database.php');
require('../model/File.php');
require('../model/files_db.php');
require_once('../util/main.php');

if (isset($_REQUEST['pagenum'])) {
    if ($_REQUEST['pagenum'] == 1) {

        // initialise variables
        $min_length = 3;
        $term_1="";
        $term_2="";
        $term_1_status = 'unknown';
        $term_2_status = 'unknown';
        $cnt = 0;
        
        echo "<div id='show_total'>";

        if(isset($_REQUEST['term_1'])){
            // first establish if term_1 is valid
            if(!empty($_REQUEST['term_1'])) {
                $term_1 = trim($_REQUEST['term_1']);
                $term_1_status = (strlen($term_1) >= $min_length ? "valid" : "too short");
            }
            else {
                $term_1_status = "empty";
            }

            // now term_2
            if(!empty($_REQUEST['term_2'])) {
                $term_2 = trim($_REQUEST['term_2']);
                $term_2_status = (strlen($term_2) >= $min_length ? "valid" : "too short");
            }
            else {
                $term_2_status = "empty";
            }
            
            // at least one is valid
            if ($term_1_status === "valid" || $term_2_status === "valid") {

                // now act on the validation        
                if ($term_1_status === "valid" && $term_2_status === "valid") {
                    // two valid term entered
                    $cnt = (int)FileDB::get_file_count_by_filepath_2($term_1, $term_2, 1);
                      
                    echo  $cnt . " results found for " . stripslashes($term_1) . 
                    " and " . stripslashes($term_2);
                }
                elseif ($term_1_status === "valid") { 
                    // term_1 is valid, term_2 is not
                    $cnt = (int)FileDB::get_file_count_by_filepath_1($term_1, 1);

                    echo $cnt . " results found for " . stripslashes($term_1);
                }        
                elseif ($term_2_status === "valid"){
                    // term_2 is valid, term_1 is not               
                    $cnt = (int)FileDB::get_file_count_by_filepath_1($term_2, 1);

                    echo $cnt . " results found for " . stripslashes($term_2);
                }

                echo "</div>";
                echo "<div id='show_data'>";

                if ($cnt > 0) {
                    // store file count for later use
                    $_SESSION['cnt'] = $cnt;  
                    // construct the table
                    echo "<table id='resultTable' class='table sortable table-striped " .
                        " table-hover table-responsive table-bordered' style='width:100%'>";
                    echo "<thead>";
                    echo "<th style='width:8%'>Disk</th>";                
                    echo "<th style='width:86%'>Name</th>";
                    echo "<th style='width:8%'>Ext.</th>";
                    echo "</thead>";
                    echo "<tbody>"; 
                    include 'search_results.php';
                }
            }
            else {
                // neither are valid - report error for one of them
                if ($term_1_status === 'too short' || $term_2_status === 'too short') {
                    echo 'Please enter at least ' . $min_length . ' characters';
                    echo SET_FOCUS;
                }
                elseif ($term_1_status === 'empty' || $term_2_status === 'empty') {
                    echo 'Nothing entered';
                    echo SET_FOCUS;
                } 
                echo "</div>";
            }
        }
        else {
            // should never get here
            // error
        }
    }
    else {
        $term_1 = (!empty($_REQUEST['term_1']) ? trim($_REQUEST['term_1']) : '');
        $term_2 = (!empty($_REQUEST['term_2']) ? trim($_REQUEST['term_2']) : '');
        include 'search_results.php';
    
    }
    // should never get here
    // error
}
?>
