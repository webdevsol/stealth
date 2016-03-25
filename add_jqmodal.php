  <!-- jqModal -->                                                           
  <script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script>
  <script type="text/javascript" src="js/jqModal.js"></script>
  <link rel="stylesheet" href="css/jqModal.css" type="text/css" media="screen" charset="utf-8">
	
  <script type="text/javascript" charset="utf-8">                                             
    $(document).ready(function() {
    	$('#newpage').jqm({ajax: '@href', trigger: 'a.nptrigger', target:'div.jqmContent'});
      $('#newpage').jqmAddClose('#npsub');
    });                                             
  </script>