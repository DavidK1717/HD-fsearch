<!doctype html>
<html lang="en">
<head>
    <title><?php echo $Title;?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!--<script type="text/javascript" > google.load("jquery", "1"); </script> -->
<!--    <script src="<?php //echo $app_path ?>js/jquery-1.11.0.js"></script>-->
    <script src="<?php echo $app_path ?>js/jquery-2.1.0.js"></script>
    <script src="<?php echo $app_path ?>js/sorttable.js"></script>
    <script src="<?php echo $app_path ?>/js/bootstrap.js"></script>
    <script src="<?php echo $app_path ?>/js/main.js"></script>
    <link rel="stylesheet" type="text/css" 
          href="<?php echo $app_path ?>css/style02.css"/>
    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" 
          href="<?php echo $app_path ?>css/bootstrap.css"/>
</head>
<body>
    <div class="wrapper">
        <div class="page-header ">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 class="blueFont"><?php echo $Title;?></h3>
                    <form class="form-horizontal" role="form" method="POST" >
    					<div class="control-group ">
                            <input id="term_1" name="term_1" type="text" class="form-control-sunken" placeholder="Enter a search term" />
                            <input id="term_2" name="term_2" type="text" class="form-control-sunken" placeholder="Enter a second search term" />    
                            
                                <button type="button" class="btn btn-default btnSearch">
                                    <span class="glyphicon glyphicon-search"> Search</span>
                                </button>
                                                       
                        </div>    				
                    </form>
                </div>
                
            </div>
        </div>
<?php echo SET_FOCUS; ?>