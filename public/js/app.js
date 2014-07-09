var app = angular.module("myapp", [], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
	});

app.filter("timeago", function () {
    
    return function (time) {
    local = Date.now();
     
     var match =  time.match(/^(\d+)-(\d+)-(\d+) (\d+)\:(\d+)\:(\d+)$/);
   time = new Date(match[1], match[2] - 1, match[3], match[4], match[5], match[6]);
   time =  Date.parse(time);
    var
            offset = Math.abs((local - time - 3600000*2) / 1000),
            span = [],
            MINUTE = 60,
            HOUR = 3600,
            DAY = 86400,
            WEEK = 604800,
            MONTH = 2629744,
            YEAR = 31556926;
           

        if (offset <= MINUTE)               span = [ '', 'mindre än en minut' ];
        else if (offset == MINUTE)          span = [ 1, 'minut' ];
        else if (offset < (MINUTE * 60))    span = [ Math.round(Math.abs(offset / MINUTE)), 'minuter' ];
        else if (offset == HOUR)       	    span = [ 1, 'timme' ];
        else if (offset < (HOUR * 24))      span = [ Math.round(Math.abs(offset / HOUR)), 'timmar' ];
        else if (offset == DAY)       	    span = [ 1, 'dag' ];
        else if (offset < (DAY * 7))        span = [ Math.round(Math.abs(offset / DAY)), 'dagar' ];
        else if (offset == WEEK)    		    span = [1, 'vecka' ];
        else if (offset < (WEEK * 52))      span = [ Math.round(Math.abs(offset / WEEK)), 'veckor' ];
        else if (offset < (YEAR * 100))     span = [ Math.round(Math.abs(offset / YEAR)), 'år' ];
        else                               span = [ '', 'länge' ];

        span[1] += (span[0] === 0 || span[0] > 1) ? '' : '';
        span = span.join(' ');

      
			return (time <= local) ? span + ' sedan' : 'in ' + span;

     };	
    });


   $( document ).on( "click", ".show-page-loading-msg", function() {
    var $this = $( this ),
        theme = $this.jqmData( "theme" ) || $.mobile.loader.prototype.options.theme,
        msgText = $this.jqmData( "msgtext" ) || $.mobile.loader.prototype.options.text,
        textVisible = $this.jqmData( "textvisible" ) || $.mobile.loader.prototype.options.textVisible,
        textonly = !!$this.jqmData( "textonly" );
        html = $this.jqmData( "html" ) || "";
    $.mobile.loading( "show", {
            text: msgText,
            textVisible: textVisible,
            theme: theme,
            textonly: textonly,
            html: html
    });
     setTimeout(function(){ $.mobile.loading( "hide", {
            text: msgText,
            textVisible: textVisible,
            theme: theme,
            textonly: textonly,
            html: html
    });},500);
})
;
$(document).ready(function(){
	

	
	
	var sanitize = function(input) {
		var output = input.replace(/<script[^>]*?>.*?<\/script>/gi, '').
					 replace(/<[\/\!]*?[^<>]*?>/gi, '').
					 replace(/<style[^>]*?>.*?<\/style>/gi, '').
					 replace(/<![\s\S]*?--[ \t\n\r]*>/gi, '');
	    return $.trim(output);
	};
	  $('.editor').click(function() {
 	
 	
       $(this).addClass("editable");
       
     
       $(this).focusout(function() {
   
			$(this).removeClass("editable");
			if($(this).data('param')=="description"){
				
   			 $.ajax({url:"http://localhost/sfi/public/exerciseupdate", data : {description : $(this).html(), id : $(this).data('id')}});
   			}
   			
   		
   			});
   			
		
		
   
 });

 
	 });


