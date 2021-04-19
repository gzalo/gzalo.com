---
title: "Utilización de un celular o modem GSM/GPRS con microcontroladores"
tags: ["articles", "electronics"]
summary: "Cómo usar un celular o módem para enviar y recibir mensajes de texto y llamadas desde un microcontrolador."
thumbnail: "/thumbs/gsm.png"
aliases: ["/gsm/"]
---

Es posible conectar un microcontrolador a un modem o celular GSM o GPRS, lo que nos permite hacer cosas como atender el teléfono, llamar a cierto número, enviar y recibir mensajes de texto, o incluso conectarse a internet, todo desde un microcontrolador cualquiera.

Lo primero que necesitamos saber es que la mayoría de los celulares y módulos GSM trabajan con comandos AT, que son casi universales y están presentes en todo celular que tenga un cable de datos y se pueda usar como modem.

Necesitamos construir una interfaz entre el módulo/celular y el microcontrolador. Por lo general los celulares trabajan con 3.3v (casi TTL), por lo que podremos alimentar el microcontrolador a 3.3V, o caso contrario usar un divisor resistivo para bajar la tensión de salida del microcontrolador a 3.3V.

Los módulos dedicados (como el Motorola G20 o G24), por el contrario, suelen tener una interfaz RS232, por lo que necesitaremos un integrado como el Max232 para conectarlos (ver [más información del MAX232]({{< ref "/articles/rs232ttl" >}})).

Una vez que tenemos a ambas partes conectadas, por lo general es posible hablarle al módulo/modem a 4800bps (1 bit de stop, ninguno de paridad y sin control de flujo) y enviar comandos. 

Todo lo que escribamos será repetido por el módulo (eco), por lo que tenemos que tener cuidado al escribir rutinas para hablarle al mismo

Esta es la lista de comandos principales:

* `AT`\r\n : es usado para comprobar que el modem está conectado y probar el vínculo. Debería responder OK.
* `ATE0`\r\n : desactiva el eco
* `ATE1`\r\n : activa el eco
* `AT+CPIN="1234"`\r\n : si la sim tiene protección por PIN, setea el PIN a usar
* `AT+CMGF=1`\r\n : activa el modo texto para sms (facilita las rutinas de envío y recepción de sms)
* `AT+CMGS="+541155554444"`\r`Mensaje<^Z>` : Envía "Mensaje" al número especificado.
* `AT+CNMI=,2`\r\n : Habilita la redirección de mensajes entrantes a la terminal\
Cuando llega un mensaje, el celular escribe `+CMT: "+541155554444,”10/9/22,14:12:34"\r\nMENSAJE`\
Es necesario avisar al celular que se recibió correctamente, con `AT+CNMA\r\n`
		
`\r` Es el caracter de control correspondiente al retorno de carro (ASCII 13 o 0x0D)\
`\n` Es el caracter de salto de linea (ASCII 10 o 0x0A)\
`^z` Es el caracter correspondiente al "fin de archivo" - EOF (ASCII 26 o 0x1A)

Las rutinas para conectarse a internet, enviar y recibir paquetes TCP y UDP no son estándar, y suelen variar de acuerdo al fabricante. Es necesario que el módulo tenga una pila TCP/IP integrada para poder usarlo (los baratos no lo tienen). En el caso que no lo tengan, para conectar el microcontrolador a internet hay que implementar todos los protocolos en el firmware del micro. Esta [nota de aplicación de Freescale (AN120)](http://cache.freescale.com/files/microcontrollers/doc/app_note/AN2120.pdf) explica cómo hacerlo y da código en C que se puede portar a otros microcontroladores.
