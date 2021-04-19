---
title: "LCDs gráficos basados en KS0108"
tags: ["articles", "electronics"]
summary: "Cómo controlar un LCD gráfico de 128x64 (o 192x64) basado en KS0108, usando un microcontrolador y dos puertos de E/S."
thumbnail: "/thumbs/lcdgrafico.png"
aliases: ["/lcdgrafico/"]
---
La mayoría de los LCDs gráficos usan un controlador como el KS0108 (o compatible). Cada controlador tiene una memoria de 512 bytes interna y por lo tanto permite controlar un display de 64x64 píxeles. El truco que usan los diplays más grandes es usar un controlador por cada fracción de la pantalla, es decir, un display de 128x64 tiene 2 controladores, un display de 196x64 tiene 3 controladores, y uno de 128x128 tiene 4 controladores.

Cada controlador es independiente, es decir, no transmiten información entre ellos. Para elegir a qué controlador hablarle, se usan dos líneas de control, llamadas CS1 y CS2 (CS = Chip Select). Básicamente actúa como una "dirección" de 2 bits, que elige a cual de los 4 controladores posibles se desea hablar. El controlador no tiene generador interno de fuentes, por lo que si se desea escribir un texto, será necesario almacenar los píxeles de cada caracter en un microcontrolador o memoria externa.

En total están estas líneas:	
	
* VSS: 0V, referencia de masa para el chip
* VDD: 5V, alimentación del lcd
* V0: Contraste
* D/I: Elige si se desea escribir/leer un dato (1) o instrucción (0)
* R/W: Elige si se desa leer (1) o escribir (0)
* E: Cuando se hace un pulso en esta terminal, se hace la transferencia
* DB0..7: Conforman el bus de datos, es de donde se lee y donde se escriben los datos a transferir
* CS1..2: Eligen el controlador al que se le quiere hablar
* RES: Al estar en 0 resetea los controladores
* Vee: Salida de tensión negativa
* K y A: Luz de fondo (Backlight) del LCD

La mayoría de los LCDs poseen internamente un generador de tensión negativa, necesario para manejar los segmentos propiamente dichos. Para controlar el contraste, es necesario usar un preset de 20 kiloohms, conectado entre Vee y Vdd (en los extremos) y la terminal del medio a V0. Las terminales A y K están conectadas a un LED interno, deberían ser conectadas a 5v y 0v correspondientemente, con una resistencia de 100-200 ohm en serie para asegurarse de que el/los LEDs estén protegidos.

Como enviar un comando o dato al LCD:
	
* Elegir el controlador al que se desea hablar (terminales CS1 y CS2)
* Poner D/I en el estado correcto: 1 si se desea escribir un comando, 0 si se desea escribir datos
* Poner en el bus de datos el comando o dato que se desea escribir
* Hacer un pulso en la terminal E
* Esperar el tiempo correspondiente (500nS) por lo general

El display está dividido en 8 secciones horizontales llamadas páginas (de 8 pixeles de alto cada uno) y 64 líneas verticales.
### Lista de comandos importantes
#### Prender/Apagar display
D/I = 0, DB = 0x3F (prendido) o 0x3E (apagado)
#### Elegir posición (X)
D/I = 0, DB = 0x40 + dirección (0 a 63)
#### Elegir página (Y)
D/I = 0, DB = 0x9C + página (0 a 7)
#### Escribir datos
D/I = 1, DB = dato a escribir

Luego de escribir un dato, se incrementa la posición horizontal.

