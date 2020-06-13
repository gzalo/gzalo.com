<?php
	$descripcionPagina = 'Búsqueda en Gzalo.com';
	$tituloPagina = 'Buscar';
	$comentariosActivados = false;	
	
	//'.addslashes($_GET['q']).'
	echo addBox('Búsqueda','
<script>
  (function() {
    var cx = \'005889502242245734256:rxyk79ma7ow\';
    var gcse = document.createElement(\'script\');
    gcse.type = \'text/javascript\';
    gcse.async = true;
    gcse.src = \'https://cse.google.com/cse.js?cx=\' + cx;
    var s = document.getElementsByTagName(\'script\')[0];
    s.parentNode.insertBefore(gcse, s);
  })();
</script>
<gcse:search></gcse:search>');

