jQuery(document).ready(function($) {
    $('.btnSearch').click(function(){
        displayRecords(20, 1);
    });

    $('form').submit(function(e){
        e.preventDefault();
        displayRecords(20, 1);
        
        return false;
    }); 
	
		
    
    
}); 

function displayRecords(numRecords, pageNum ) {
        // Create the "callback" functions that will be invoked when...

        // ... the AJAX request is successful
        var updatePage = function( response ) {
            if (pageNum > 1) {
                $('div#show_data').html(response);
            }
            else {
                $('div#data_goes_here').html(response);
            }
        
        
        };

        // ... the AJAX request fails
        var printError = function( req, status, err ) {
            console.log( 'something went wrong', status, err );};

        var doFirst = function () {
            $("body").css("cursor", "progress");};
        
        var applySorter = function(xhr,status) {
            sorttable.makeSortable(document.getElementById('resultTable'));};	

        var andFinally = function(xhr,status) {
            var message = $('div#show_total').html();
            if (message !== null) {
                if ((message.trim().length !== 0)) {
                    if ($.isNumeric(message.trim().charAt(0) ) ) {
                        if(message.trim().charAt(0) !== "0") {
                            sorttable.makeSortable(document.getElementById('resultTable'));
                        }
                    }
                }
            } 
            $("body").css("cursor", "default");
        };	

        // Create an object to describe the AJAX request
        var ajaxOptions = {
            url: 'search/index.php',
            type: 'POST',
            data: {   term_1: $('input#term_1').val(), 
                      term_2: $('input#term_2').val(),
                      show: numRecords,
                      pagenum: pageNum
                  },
            beforeSend: doFirst
          
        };
        
        var req = $.ajax(ajaxOptions);
        //req.then(doFirst);
        req.then(updatePage, printError);
        
        
        
        req.then(andFinally);
        
        //req.done(updatePage);
        //req.fail(printError);
        //req.always(andFinally);
    }

function changeDisplayRowCount(numRecords)  {
    displayRecords(numRecords, 1);
    }    
    
