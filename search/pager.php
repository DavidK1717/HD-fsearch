<link rel="stylesheet" type="text/css" 
          href="<?php echo $app_path ?>css/style02.css"/>
<div id="pagination-digg">
<div class="height30"></div>
<table width="100%" border="0" cellspacing="2" cellpadding="0"  align="center">
<tr>
    <td width=30% valign="top" align="left">
	
<label> Rows Limit: 
<select name="show" onChange="changeDisplayRowCount(this.value);">
  <option value="10" 
      <?php if ($_POST["show"] == 10 || $_POST["show"] == "" ) { 
                echo ' selected="selected"';                 
            }  ?> >10</option>
  <option value="20" 
      <?php if ($_POST["show"] == 20) { 
                echo ' selected="selected"';                 
            }  ?> >20</option>
  <option value="30" <?php if ($_POST["show"] == 30) { 
                echo ' selected="selected"';                 
            }  ?> >30</option>
  
</select>
</label>
	</td>
    <td width="55%" valign="top" align="center" >
 
<?php
$dots = ' ... ';
$range = 5; // must be odd number
$lead = ($range + 3) / 2;
$inner_lead = ($range - 1) / 2;
$full = $lead * 2;

if ($last > 1){
    // normal pages
    if (($pagenum > $lead) && ($pagenum < ($last - $lead)) && ($last > $full)) {

        $start = $pagenum - $inner_lead;
        $end = $pagenum + $inner_lead;
        $start_dots = true;
        $end_dots = true;
    }
    // now deal with last few pages
    elseif (($pagenum > $lead) && ($pagenum >= ($last - $lead)) && ($last > $full)) {

        if ($pagenum == $last){
                $start = $last - ($range - 1);
                $end = $last;
                $start_dots = true;
                $end_dots = false;
            }

        for ($i = 1; $i < 3; $i++) {
            if ($pagenum + $i == $last){
                $start = $last - ($range);
                $end = $last - 1;
                $start_dots = true;
                $end_dots = true;
            }
        }	
        for ($i = 3; $i <= $lead; $i++) {
            if ($pagenum + $i == $last){
                $start = $last - ($range + 1);
                $end = $last - 2;
                $start_dots = true;
                $end_dots = true;
            }
        }    
    }
    elseif ($pagenum <= $lead && $last > $full) {
        // now first few pages
        if ($pagenum == 1) {
            $start = 1;
            $end = $range;
            $start_dots = false;
            $end_dots = true;
        }
        if ($pagenum == 2 || $pagenum == 3) {
            $start = 2;
            $end = $range + 1;
            $start_dots = true;
            $end_dots = true;
        }
        elseif ($pagenum > 3 && $pagenum <= $lead) {
            $start = 3;
            $end = ($full - 1);
            $start_dots = true;
            $end_dots = true;
        }    
    } // not working
    elseif ($last <= $full) {
        // and if total pages is less than the normal spread?
        if ($last < ($full - 1)){
            $start = 1;
            $end = $last;
            $start_dots = false;
            $end_dots = false;
        }
        elseif ($pagenum == 1) {
            $start = 1;
            $end = $start + $range;
            $start_dots = false;
            $end_dots = false;
        }
        elseif ($pagenum == 2 || $pagenum == 3) {
            $start = 2;
            $end = $last - $inner_lead;
            $start_dots = true;
            $end_dots = true;
        }
        else {
            $start = 3;
            $end = $last;
            $start_dots = true;
            $end_dots = true;
        }
    }

	if ( ($pagenum - 1) > 0) {
		?>	    
		<a href="javascript:void(0);" class="links"  
			onclick="displayRecords('<?php echo $page_limit;  ?>', '<?php echo $pagenum-1; ?>');">Previous</a>
		<?php
	}
	if ($start_dots) {
		?> 
		<a href="javascript:void(0);" class="links" 
		onclick="displayRecords('<?php echo $page_limit;  ?>', '1');">1</a>

		<span class='links'><?php echo $dots ?></span>  
			<?php
	}
	for($i = $start; $i <= $end; $i++) {
		if ($i == $pagenum ) {
			?>
			<a href="javascript:void(0);" class="selected" ><?php echo $i ?></a>
			<?php
		} else {  
			?>
			<a href="javascript:void(0);" class="links" 
			onclick="displayRecords('<?php echo $page_limit;  ?>', '<?php echo $i; ?>');" ><?php echo $i ?></a>
			<?php 
		}
	}
	if ($end_dots) {
		?>
		     
		<span class='links'><?php echo $dots ?></span>
		<a href="javascript:void(0);" class="links" 
			onclick="displayRecords('<?php echo $page_limit;  ?>', '<?php echo $last; ?>');" ><?php echo $last ?></a>	
		<?php
	}
	if ( ($pagenum + 1) <= $last) {
		?>
			<a href="javascript:void(0);" onclick="displayRecords('<?php echo $page_limit;  ?>', '<?php echo $pagenum+1; ?>');" class="links">Next</a>
		<?php 
	} 
}
?>
</td>
	<td width=15% align="right" valign="top">
	Page <?php echo $pagenum; ?> of <?php echo $last; ?>
	</td>
</tr>
</table>
</div>