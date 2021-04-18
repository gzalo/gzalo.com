---
title: "Uso del MAX232 para conversiones RS232-TTL"
tags: ["articles", "electronics"]
summary: "Un circuito muy sencillo, usado en casi cualquier lugar que se necesite conexión entre un microcontrolador y una computadora."
thumbnail: "/thumbs/rs232ttl.png"
aliases: ["/rs232ttl/"]
---
<p>Este circuito es muy usado en el ámbito de microcontroladores, básicamente permite hacer de adaptador de niveles entre una señal TTL (0 ... 5v) y una señal RS232 (15v ... -15v).
<p>Se basa en el integrado MAX232, que está diseñado específicamente para eso, necesitando unicamente cuatro capacitores externos para elevar la señal (se alimenta a 5V y genera señales de 12V)
<p>Hay varios clones del max232 (por ejemplo el HIN232) que tienen la misma funcionalidad pero por lo general son más baratos. Es posible intercambiarlos sin ningún problema.
<img src="/images/placamax.png" alt="Esquemático conversor RS232-TTL con MAX232" style="width:100%;max-width:600px;"/>
<p>D1 está para evitar que se queme el MAX si se le da tensión al revés, C6 y C5 filtran ruido y estabilizan la tensión. Los demás capacitores son los usados por el MAX232 para elevar la tensión a los 15 volts, por lo que deberían soportar al menos 30v.
<p>Si la señal TTL es de baja tensión (0...3.3v), por ejemplo en el caso de algunos microcontroladores modernos (los basados en ARM, MIPS, entre otros), será necesario cambiar el MAX232 por el MAX3232, que es prácticamente similar con la diferencia de que funciona desde 3 volts (en lugar de 5), y alimentarlo a la tensión correcta. Si no se tiene a este integrado, en algunos casos es posible usar un MAX232 estándar alimentado con menos tensión, aunque no se garantiza que la salida esté dentro de lo definido por el estándar RS232. 
<img src="/images/lytmax232.png" alt="Circuito impreso conversor RS232-TTL con MAX232" style="width:100%;max-width:320px;"/>
<p><a href="/downloads/rs232ttl.zip" >Descargar esquemático e impreso editable en Proteus</a>
<p>Hay que tener en cuenta que la distancia máxima recomendada es alrededor de 10 metros a 115200 bps. Si se necesita lograr una comunicación entre dos microcontroladores que estén más separados, es posible usar un estándar como el RS485, que utiliza señales diferenciales (con tres cables), de manera que el ruido no influya tanto.
