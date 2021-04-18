---
title: "Control remoto de 4 canales por RF, mediante HT12D/E"
tags: ["articles", "electronics"]
summary: "Cómo controlar cargas a distancias a través de un enlace de radiofrecuencia, usando módulos y ciruitos integrados de bajo costo."
thumbnail: "/thumbs/rfht12.png"
aliases: ["/rfht12/"]
---
	
<img src="/images/controlrf_lyt.png" alt="Transmisor y Receptor RF 4 canales" style="width:100%;max-width:681px;"/>
<p>Estos circuitos sencillos se puede usar para controlar una gran cantidad de aplicaciones, desde autos y barcos radiocontrolados hasta apertura de portones de garages, alarmas de autos, adquisición de datos, robótica, entre muchas otras cosas.
<p>La parte de radiofrecuencia de este circuito se basa en los transmisores baratos WenShing TWS-BS-X, que transmiten via ASK y los receptores RWS-X-X (ver más información de los <a href="http://www.wenshing.com.tw/Products/RF_Module/ASK_RF_Transmitter_Module/">transmisores</a> y de los <a href="http://www.wenshing.com.tw/Products/RF_Module/ASK_RF_Receiver_Module/">Receptores</a>). Suelen costar menos de 10 dólares cada uno, y con una buena antena y buena sintonización pueden llegar facilmente a los 50 metros de distancia.
<p>La parte de codificación se basa en los integrados HT12E (codificador) y HT12D (decodificador), que permiten enviar hasta 4 bits de datos y 8 de dirección (por lo que sería posible transmitir a hasta 256 dispositivos en la misma frecuencia)
<h3>Transmisión</h3>
<img src="/images/ht12e.png" alt="Diagrama conexión HT12E codificador para RF" style="width:100%;max-width:211px;"/>
<p>Las terminales 1 a 8 eligen la dirección (que tendría que ser igual en el transmisor y receptor para lograr comunicación), las terminales 10 a 13 son los datos que se desean enviar, la pata 14 controla el envío (al dejarla en estado bajo transmite, es posible dejarla en 0 para que transmita continuamente), la terminales 15 y 16 necesita ser conectada a una resistencia de 1 Megaohm para generar la señal de clock interna, la pata 17 es la salida de datos, que debe ser conectada al módulo de transmisión.
<h3>Recepción</h3>
<img src="/images/ht12d.png" alt="Diagrama conexión HT12D decodificador para RF" style="width:100%;max-width:212px;"/>
<p>Nuevamente, las terminales 1 a 8 eligen la dirección (que tendría que ser igual en el transmisor y receptor para lograr comunicación), las terminales 10 a 13 son los datos recibidos (pueden ser conectados a LEDs o cargas siempre que la corriente no supere 5mA), la pata 14 deberá ser conectada a la salida del módulo de recepción de RF, las terminales 15 y 16 necesitan ser conectadas a una resistencia de 47 Kilohm para generar la señal de clock interna, la pata 17 dice si la recepción fue correcta o no.
<p><a href="/downloads/controlrf.zip" >Descargar circuitos impresos editables con Proteus</a>			
<p>Un circuito similar (usando HT12A y HT12F) puede ser usado para comunicaciones via infrarrojo o LASER. Estos otros circuitos integrados vienen internamente con un modulador y demodulador de 38KHz, similar al que usan todos los controles remotos infrarrojos. 
