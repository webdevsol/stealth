<?php session_start(); ?>
    <!-- jQuery and jQuery UI -->
	<script src="../elRTE/js/jquery-1.6.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="../elRTE/js/jquery-ui-1.8.13.custom.min.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" href="../elRTE/css/smoothness/jquery-ui-1.8.13.custom.css" type="text/css" media="screen" charset="utf-8">

    <!--link rel="stylesheet" type="text/css" media="screen" href="../elfinder/jquery/themes/smoothness/jquery-ui-1.8.23.custom.css" />
    <script type="text/javascript" src="../elfinder/jquery/jquery-1.9.1.min.js" ></script> 
    <script type="text/javascript" src="../elfinder/jquery/jquery-ui-1.10.1.custom.min.js"></script-->

    <!-- elFinder -->
    <link rel="stylesheet" type="text/css" media="screen" href="../elfinder/css/elfinder.min.css">
    <script type="text/javascript" src="../elfinder/js/elfinder.min.js"></script>
    
	<!-- elRTE -->
	<script type="text/javascript" src="../elRTE/js/elrte.full.js" charset="utf-8"></script>
	<link rel="stylesheet" href="../elRTE/css/elrte.full.css" type="text/css" media="screen" charset="utf-8">

	<!-- elRTE translation messages -->
	<script src="../elRTE/js/i18n/elrte.en.js" type="text/javascript" charset="utf-8"></script>
  
    <script type="text/javascript" charset="utf-8">    	
      $().ready(function() {
				$('#elFinder a').hover(
					function () {
						$('#elFinder a').animate({
							'background-position' : '0 -45px'
						}, 300);
					},
					function () {
						$('#elFinder a').delay(400).animate({
							'background-position' : '0 0'
						}, 300);
					}
				);

			$('#elFinder a').delay(800).animate({'background-position' : '0 0'}, 300);
      
      var opts = {
				cssClass : 'el-rte',
				lang     : 'en',
				height   : 250,
				toolbar  : 'compact',
                allowSource: false,
				cssfiles : ['../elRTE/css/elrte-inner.css'],
        
                fmAllow: true,
				fmOpen : function(callback) {
                    $('<div />').dialogelfinder({
                      url: '../elfinder/php/connector.php',
                      commandsOptions: {
                        getfile: {
                          oncomplete: 'destroy' // destroy elFinder after file selection
                        }
                      },
                      getFileCallback: callback // pass callback to file manager
                    });
                  }
			}
			$('#newcard_editor').elrte(opts);
		})
	</script>

 