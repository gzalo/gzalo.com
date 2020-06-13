<?php
	$descripcionPagina = 'Conversión de cámara de video JVC para que solamente vea infrarrojo.';
	$tituloPagina = 'Cámara infrarroja';
	
	echo addBoxBeg('Modificación de cámara de video para ver luz infrarroja');
?>
<p>Hace un par de años encontré una cámara vieja de video: una JVC GR-C7u. Es una cámara de los años '80, tiene CCD, autofoco, viewfinder blanco y negro y graba en cinta, en formato VHSC. Es un modelo muy parecido a la usada en la película "Volver al futuro" (gr-c1u), con carcasa roja.</p>
<p>La estuve usando un poco como visora de viejas cintas, hasta que un día decidí ver cómo se podía modificar. Es conocido que los sensores CCD (usados en gran parte de las cámaras digitales) por naturaleza detectan un rango de luz que abarca más que la luz visible. Detectan parte del llamado "infrarrojo cercano", que está cerca del color rojo en la tabla de longitudes de onda. Este infrarrojo NO es el tipo de infrarrojo emitido por los cuerpos que tienen temperatura. El infrarrojo "térmico" es el mediano, y es imposible de ver por sensores CCD normales.</p>
<p>Las cámaras tienen por diseño un filtro anti-infrarrojo, que deja pasar solamente el rango de luz que el ojo ve. Esto es necesario ya que de otra forma las imágenes saldrían con un tono rojizo, y los colores no corresponderían a lo que las personas ven. Sacando a este filtro, y cambiándolo por uno paso-infrarrojo, que deje pasar lo infrarrojo y bloquee parte de la luz visible, es posible que la cámara "vea" infrarrojo.</p>
<p>Este filtro por lo general está bien cerca del sensor:</p>
<p><img src="/images/ircam0.jpg" alt="Filtro infrarrojo" style="width:100%;max-width:300px;"/></p>
<p><img src="/images/ircam3.jpg" alt="Ubicación Filtro infrarrojo" style="width:100%;max-width:650px;"/></p>
<p>Luego de varias horas de búsqueda, <a href="http://www.freeservicemanuals.info/en/servicemanuals/">conseguí el manual de service de la cámara en este lugar</a>, tienen muchos manuales gratis y los escanean a pedido. En la imagen marqué con rojo cual es el filtro que hay que cambiar.</p>
<p>Para crear un filtro pasa-infrarrojo, es posible usar la parte interna de los disquettes, o la parte subexpuesta ("negra") de los negativos de fotos:</p>
<p><img src="/images/ircam1.jpg" alt="Filtro pasa-infrarrojo" style="width:100%;max-width:350px;"/></p>
<p>Para mantener la misma altura del filtro, usé un par de vidrios viejos del mismo tamaño, intentando que el grosor total sea lo más parecido al del filtro original. Al variar este alto, la cámara pierde su capacidad de ser parfocal (mantener el foco variando el zoom) y tiene problemas al enfocar en cosas cercanas. para enfocar al infinito puede ser necesario tener que desenroscar el elemento del frente más que lo posible.</p>
<p>Algunas fotos luego de la modificación:</p>
<p>Árboles y plantas "blancas" bajo la luz del sol:<br/><img src="/images/ir0.jpg" 
alt="Arboles bajo luz infrarroja" style="width:100%;max-width:500px;"/></p>
<p>Venas:<br/><img src="/images/ir1.jpg" alt="Venas bajo luz infrarroja" style="width:100%;max-width:500px;"/></p>
<p>Control remoto se ve transparente:<br/><img src="/images/ir2.jpg" alt="Control remoto bajo luz infrarroja" style="width:100%;max-width:500px;"/></p>
<p>Teclado con algunas teclas de otro color (no tengo idea por qué):<br/><img src="/images/ir3.jpg" alt="Teclado bajo luz infrarroja" style="width:100%;max-width:500px;"/></p>
<p>Billete de dos pesos argentinos (se ve "blanco") la tinta refleja la luz infrarroja IR. Los dólares parece que usan otro tipo de tinta y no pasa esto.<br/><img src="/images/ir4.jpg" alt="Billete bajo luz infrarroja" style="width:100%;max-width:500px;"/></p>
<p>Partes del ojo<br/><img src="/images/ir5.jpg" alt="Ojo bajo luz infrarroja" style="width:100%;max-width:500px;"/></p>
<p>Otras cosas: Las bebidas gaseosas se ven transparentes (no saqué una foto todavía). Algunos tipos de telas dejan pasar la luz IR, por lo que se puede ver a través de algunas prendas de ropa. También hay muchas cosas que se ven "sin textura", como algunas maderas, algunas impresiones, entre otras cosas.</p>

<?php echo addBoxEnd();?>