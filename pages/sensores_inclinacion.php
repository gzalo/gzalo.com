<?php
	$descripcionPagina = 'Armado de sensores de inclinación caseros.';
	$tituloPagina = 'Sensores de inclinación';
	echo addBoxBeg('Sensores de inclinación caseros');
?>
<p>Para un proyecto de la facultad, decidimos hacer unos sensores para detectar en qué orientación (dentro de un plano vertical) estaba un proyecto. Investigando encontramos unos simples sensores, basados en las comunes tiras de pines: <br/>
<img src="/images/sensor0.png" alt="Sensor de inclinacion sencillo" style="width:100%;max-width:318px;"/><br/>
Basicamente son dos pares de tiras, con una esfera conductora en el medio. Dichos sensores fueron armados y funcionaban más o menos, a veces era necesario hacer mucha fuerza lateral para activarlos, por lo que no se suelen activar solo con la gravedad.
<p>
Por lo tanto decidimos rearmarlos de otra forma: con un tubo conductivo y una esfera que conecta el tubo con dos terminales laterales.<br/>
<img src="/images/sensor1.png" alt="Sensor inclinación casero (figura)" style="width:100%;max-width:594px;"/><br/>
<img src="/images/sensor2.png" alt="Sensor inclinación casero armado" style="width:100%;max-width:400px;"/><br/>
</p>
<p>
Para detectar en qué posición está el proyecto, se utilizaron dos de estos sensores, ubicados a 90º, a 45º respecto de la placa. De esta forma en cada una de las 4 posibles orientaciones siempre hay 2 contactos conectados:<br/>
<img src="/images/sensor3.png" alt="Sensor inclinación casero, detectando gravedad" style="width:100%;max-width:690px;"/><br/>
</p>
<p>A la hora de implementarlo, se encontraron con dos problemas principales: El primero es que es necesario lijar el tubo de forma tal de eliminar el óxido y así ayudar a la conducción. El segundo es el rebote luego de girada la placa, causado por el propio rebote de la esfera sobre los contactos. Para resolverlo, se sobremuestrearon los sensores y se esperó a que ambos estuvieran en un estado estable durante un cierto tiempo para cambiar la imagen. </p>
<p>Para evitar el problema de la mala conducción, es posible usar sensores ópticos reflectivos, y una esfera coloreada de tal forma que se detecte la distancia a la esfera. Con eso podría implementarse un sistema más robusto, aunque quizás convenga reemplazarlos directamente por un acelerómetro y un microcontrolador que lea la aceleración en cada eje y estime la rotación de la placa.</p>
<p>
<iframe width="420" height="315" src="//www.youtube.com/embed/TV9hBVALbbg" frameborder="0" allowfullscreen></iframe>
</p>

<?php echo addBoxEnd();?>