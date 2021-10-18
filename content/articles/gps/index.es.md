---
title: "Utilización de módulos GPS con microcontroladores"
tags: ["articles", "electronics"]
summary: "Cómo usar un módulo GPS para obtener la posición, parseando las cadenas NMEA que envía."
thumbnail: "/thumbs/gps.png"
aliases: ["/gps/"]
date: "2010-01-01"
---
Esta información sirve para cualquier módulo GPS que transmita datos via un puerto serie, usando el protocolo NMEA.

Básicamente aproximadamente 10 veces por segundo, el GPS envía muchas cadenas NMEA, separadas por retornos de carro y fines de línea, de las cuales la que más interesa es la que comienza con GPGGA. Un ejemplo de cadena es: `$GPGGA,182402.02,3436.5829,S,05825.7855,W,1,04,1.5,57,M,-34.0,M,,,*70`

Significado de cada campo:
	
* `$GPGGA`: Identificador de la cadena
* `182402.02`: Hora (en GMT)
* `3436.5829,S`: Latitud (34º 36.5829' Sur)
* `05825.7855,W`: Longitud (58º 25.7855' Oeste)
* `1`: Fix válido (si fuera 0 es porque los datos pueden ser extrapolados)
* `04`: Cantidad de satélites que fueron usados para obtener posición
* `1.5`: Exactitud relativa de la posición horizontal (ver [HDOP](https://en.wikipedia.org/wiki/Dilution_of_precision_(GPS)))
* `57,M`: Altitud (medida en metros sobre nivel del mar)
* `-34.0,M`: Altura respecto al sistema de referencia [WGS84](https://en.wikipedia.org/wiki/World_Geodetic_System)
* `*70`: Checksum, se calcula como un XOR de todos los bytes entre $ y *
	
Una forma sencilla de interpretar los datos desde un microcontrolador es guardar almacenar todas las cadenas (desde $ hasta un \r\n) en un buffer, y analizarlas posteriormente. Esto se complica en dispositivos con poca memoria, ya que las cadenas suelen tener alrededor de 80 caracteres.

Por eso, es posible analizar la cadena a medida que vaya llegando. Esto usa poca memoria pero usa toda la CPU, ya que tiene que quedarse esperando a que lleguen bytes ([busy waiting](https://en.wikipedia.org/wiki/Busy_waiting)).

Es posible implementar lo mismo en una ISR (rutina de manejo de interrupción) que se ejecute cada vez que llega un byte, mediante una máquina de estados que se acuerde de por qué parte va.
