<?php
	$descripcionPagina = 'Project for the subject Introducción al a Ingeniería Electrónica (Professors: Ricardo Veiga, Ariel Lutenberg, Pablo Marino, Ricardo Iuzzolino)';
	$tituloPagina = 'Groupal Project - LED matrix';
	$lang = 'en';
	
	echo addBoxBeg('LED matrix with inclination sensors');
?>
<p>This project is based in a 8x8 bicolor LED matrix, controlled by a PC via the parallel port. There were also included two DIY orientatio sensors, to allow the detection of the inclination of the matrix, and thus allow the rotation of the wanted image.</p>
<p>
<img src="/images/intromatriz.jpg" alt="Working LED matrix" style="width:100%;max-width:800px"/><br/>
<img src="/images/introprgm.png" alt="LED matrix control software" style="width:100%;max-width:616px;"/><br/>
<iframe width="420" height="315" src="//www.youtube.com/embed/Dbs_kgilwAc" frameborder="0" allowfullscreen></iframe>
</p>

<p>
This group project was developed with Juan Ignacio Troisi.<br/>
<a href="/downloads/matrizLedsIntro260613.zip" data-no-instant>Download source code</a>
</p>
<?php echo addBoxEnd();?>