---
title: "Introducción a PLD (dispositivos lógicos programables)"
tags: ["articles", "electronics"]
summary: "Resumen de aplicaciones y programación de PLA, PAL, GAL y PLD."
thumbnail: "/thumbs/pld.png"
aliases: ["/pld/"]
date: "2009-01-01"
---

## ¿Qué es y para qué sirve una Pal/Gal/Pla?
Es un componente electrónico programable que permite construir circuitos digitales. La familia completa es llamada PLD (Dispositivo lógico programable).

El uso principal es minimizar la cantidad de circuitos integrados (y así bajar el costo y tamaño del equipo).

## ¿Qué circuitos pueden sintetizarse en un PLD?
Por lo general, es posible sintetizar cualquier circuito del tipo suma de productos (minitérminos) y en algunos dispositivos también circuitos secuenciales (aunque por lo general muy sencillos).

## ¿Qué ventajas y desventajas obtengo comparado con los integrados TTL/CMOS?
Por lo general hay un ahorro de costo y espacio significativo. Además, en algunos PLDs es posible reprogramar la lógica, cosa que sería imposible de estar cableada manualmente. Como desventajas está la necesidad de tener un programador, un entorno para escribir las ecuaciones lógicas y más dificultad para simularla.

## ¿Qué diferencias hay entre PLA, PAL, GAL, CPLD?
Las PLA son más flexibles, ya que permiten programar no solo la matriz de AND sino también la matriz de OR. Las PAL, en cambio, solamente permiten programar la matriz de AND, por lo que cuestan menos pero están limitadas en cuanto a la máxima cantidad de minitérminos por salida. Las GAL tienen las mismas propiedades de que las PALs, pero con la adición que pueden ser borradas y reprogramadas. Los CPLD son dispositivos lógicos programables que juntan varias celdas programables, de tal forma de que se puedan sintetizar circuitos más complejos, por lo general secuenciales, que necesiten máquinas de estado complejas o que no puedan ser implementadas en microcontroladores por necesitar altas velocidades.

## ¿En qué lenguaje se programa?
Por lo general se usa algún lenguaje de "alto nivel" (como CUPL o ABEL) que describe la ecuaciones lógicas deseadas, y posteriormente se lo compila (mediante pasos de optimización y minimización) a un archivo JEDEC, que posee la información sobre qué fusibles internos quemar. Un entorno de desarrollo y simulación gratuito es [WinCUPL](http://www.atmel.com/tools/WINCUPL.aspx) de Atmel.

## ¿Cómo se programa?
Es necesario comprar (o construir) un programador. Al contrario que con los mayoría de los microcontroladores, no parece haber ninguno sencillo, ya que por lo general todos los PLD necesitan una tensión de programación VPP de aproximadamente 15V.

## ¿Dónde se puede comprar? ¿Cuánto cuesta?
El modelo GAL16v8 es posible comprarlo en varias casas de componentes, generalmente a un precio de aproximadamente 90 centavos de dolar por unidad.

## ¿Cómo se puede configurar un determinado pin como entrada?
Dependiendo del software en el que se esté programando, al acceder a la variable correspondiente a ese PIN ya debería establecerse como entrada. Además, si en ninguna parte se le asigna un valor, el PIN debería quedarse como entrada (estado de alta impedancia). A más bajo nivel, en la hoja de datos debería mostrar como se pueden hacer entradas dedicadas, por ejemplo en los dispositivos 16V8, configurar los fuses como SYN=1,AC0=0,AC1=1 hace que ese pin se comporte como entrada.


## Ejemplos de aplicaciones con PLD
* Conversores de código (por ejemplo de binario a gray o viceversa)
* Conversores de binario a 7 segmentos (que también muestren las letras A-F)
* Verificadores de paridad y chequeo de errores
* Distintos tipos de contadores y registros
* Controladores de memoria y E/S para microprocesadores
* Tablas predefinidas ([LUTs](http://es.wikipedia.org/wiki/Lookup_table))

## ¿Como hacer una tabla en CUPL? 
Con este método se evita tener que hacer la tabla, hacer el mapa de Karnaugh y hallar la ecuación (suma de minitérminos) de cada salida, es posible dejar que el compilador lo haga automáticamente, por ejemplo de la siguiente manera:

```cupl
Device  g16v8 ;

PIN [13..19]=[S0..6];
PIN [2..5]=[E0..3];

FIELD entradas = [E0..3] ;
FIELD salidas = [S0..6] ;

TABLE entradas => salidas {
	0=>7E;    1=>30;    2=>6D;    3=>79;
	4=>33;    5=>5B;    6=>5F;    7=>70;
	8=>7F;    9=>73;    A=>77;    B=>1F;
	C=>4E;    D=>3D;    E=>4F;    F=>47;
}
```

En este video se puede ver la simulación de ese código en un circuito simple, con un contador binario y una señal de clock:

{{< youtube NwBH5X1C8pI >}}

## ¿Hay alguna alternativa con más capacidad?
Si se necesita implementar una aplicación más compleja, es posible usar un CPLD o un FPGA. En el caso del primero, está compuesto por varios bloques, cada uno de los cuales forma una especie de PLD sencilla. Por lo general se suelen programar en los mismos lenguajes que los PLD. En el caso de los FPGAs, la arquitectura es distinta, suelen poseer una gran cantidad de celdas lógicas sencillas, que se pueden interconectar de una gran cantidad de maneras distintas. Por ejemplo, es posible implementar un microprocesador dentro de una FPGA. Por lo general se programan en otros lenguajes, como son el Verilog y el VHDL.
