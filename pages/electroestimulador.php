<?php
	$descripcionPagina = 'Electroestimulador Muscular controlado por microcontrolador';
	$tituloPagina = 'Electroestimulador Muscular';
	
	echo addBoxBeg('Electroestimulador Muscular');
?>
<p><img src="/images/electro4.jpg" alt="Electroestimulador" style="width:100%;max-width:160px;"/></p>
<p><strong>La siguiente información se da sin ninguna garantía, no me responsabilizo por posibles accidentes. El proyecto involucra altas tensiones, que mal manejadas pueden causar accidentes graves y la muerte.</strong></p>
<p>El electroestimulador construido consta de tres bloques principales: un bloque elevador de tensión, un bloque controlador y un bloque de manejo de la alta tensión.</p>
<h2>Elevador de tensión</h2>
<p>El bloque elevador de tensión está construido con una metodología tipo flyback:</p>
<p><img src="/images/inversor.png" alt="Flyback inverter" style="width:100%;max-width:700px;"/></p>
<p>El transformador es uno típico 220V-6V, conectado de forma tal que a la salida haya más tensión que a la entrada. El zener se encarga de limitar la tensión de salida a aproximadamente 100V de continua.</p>
<h2>Controlador</h2>
<p>Se diseñó un controlador basado en un microcontrolador AT89S52. El mismo se encarga de generar las señales según el programa elegido. Además cuenta el tiempo de uso posee una pequeña interfaz para cambiar de modos. Las distintas formas de onda se generan mediante una especie de modulación de densidad de pulsos.</p>
<h2>Alta tensión</h2>
<p>Para manejar las salidas de alta tensión desde el microcontrolador se utilizaron 4 optoacopladores de alta velocidad, y dos pares de transistores 2N5401 y 2N5551 para crear un puente H. </p>
<p>Los electrodos utilizados son los siguientes:<br/><img src="/images/electro1.jpg" alt="Electrodos para electroestimulador" style="width:100%;max-width:640px;"><br/>Se conectan al equipo mediante cables banana-banana</p>

<?php echo addBoxEnd();?>