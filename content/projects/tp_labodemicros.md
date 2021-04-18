'Control domótico via infrarrojo y PC (2014)','Panel de control domótico para controlar luces de distintas habitaciones, permitiendo al usuario el cambio de intensidad a través de tres interfaces. Realizado para la materia "Laboratorio de microcontroladores".','/thumbs/controldomotico.png','/tp_labodemicros/');

	$descripcionPagina = 'Trabajo práctico para la materia -Laboratorio de microcontroladores- (Profesores: Pucci, Ratto)';
	$tituloPagina = 'Control domótico via PC e infrarrojo';
<p>Este proyecto grupal fue realizado junto a Juan Ignacio Troisi y Martin Menendez, para la materia de la FIUBA "Laboratorio de microcontroladores". La idea es un control domótico, que permita el control de las luces de varias habitaciones, permitiendo cambiar la intensidad de cada una de ellas mediante 3 interfaces:
<ul>
<li>Mediante botones y un display alfanumerico en el panel de control, con la posibilidad de establecer horarios
para automatizar el encendido y apagado de las cargas, modificar la hora actual y establecer permisos.</li>
<li>Mediante una PC via el puerto RS232, a traves de la cual se podrán realizar las mismas acciones que en el 
panel, con el agregado de poder descargar a la PC un log que contenga las ultimas instrucciones efectuadas,
para revisar el correcto funcionamiento del panel de control.</li>
<li>Mediante controles remotos infrarrojos, cada cual podra tener un identificador de usuario distinto (en el
prototipo sera elegido mediante un DIP switch), de forma tal que cada control remoto pueda tener permisos
limitados, es decir, cada usuario tendra control sobre diversos aspectos del sistema según se le asigne el
permiso.</li>
</ul></p>
<h2>Detalles de implementación</h2>
<p>En el control, se utilizó un microcontrolador AT89S52, junto a botones, LEDs, LED infrarrojo y el DIP switch. Se aprovechó el timer2 que posee un generador de onda cuadrada, para así generar la portadora de 38KHz necesaria para el infrarrojo. Se implementó el modo de bajo consumo para consumir menos corriente. El protocolo usado para el infrarrojo fue diseñado por nosotros: dependiendo de si se quiere transmitir un cero o un uno se transmite una señal de distinto duty cycle, manteniendo el período fijo. Esta señal además se la modula con la portadora.<br/>
<img src="/images/ldm_transmisor.png" alt="Transmisor de control domotico" style="width:100%;max-width:275px;"/></p>
<p>En el receptor, se utilizó otro AT89S52, junto a un receptor de infrarrojo IS1U60 (que se encarga de captar, filtrar y demodular la señal), un reloj de tiempo real DS1307 (con interfaz I2C) y un LCD alfanumérico. El software del panel fue programado en assembler, ensamblado con Keil uVision. Se utilizaron casi todos los recursos del microcontrolador, casi toda la RAM, más del 80% de la memoria de código, todos los timers, varias fuentes de interrupciones y la UART.<br/>
<img src="/images/ldm_receptor.png" alt="Panel de control domotico" style="width:100%;max-width:240px;"/></p>
