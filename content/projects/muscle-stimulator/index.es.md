---
title: "Electroestimulador Muscular"
summary: "Electroestimulador Muscular controlado por microcontrolador."
thumbnail: "/thumbs/muscle-stimulator.png"
aliases: ["/electroestimulador/"]
date: "2011-01-01"
---
	
![Electroestimulador](/images/electro4.jpg)

**La siguiente información se da sin ninguna garantía, no me responsabilizo por posibles accidentes. El proyecto involucra altas tensiones, que mal manejadas pueden causar accidentes graves y la muerte.**

El electroestimulador construido consta de tres bloques principales: un bloque elevador de tensión, un bloque controlador y un bloque de manejo de la alta tensión.

## Elevador de tensión

El bloque elevador de tensión está construido con una metodología tipo flyback:

![Flyback inverter](/images/inversor.png)

El transformador es uno típico 220V-6V, conectado de forma tal que a la salida haya más tensión que a la entrada. El zener se encarga de limitar la tensión de salida a aproximadamente 100V de continua.

## Controlador
Se diseñó un controlador basado en un microcontrolador AT89S52. El mismo se encarga de generar las señales según el programa elegido. Además cuenta el tiempo de uso posee una pequeña interfaz para cambiar de modos. Las distintas formas de onda se generan mediante una especie de modulación de densidad de pulsos.

## Alta tensión
Para manejar las salidas de alta tensión desde el microcontrolador se utilizaron 4 optoacopladores de alta velocidad, y dos pares de transistores 2N5401 y 2N5551 para crear un puente H. 

Los electrodos utilizados son los siguientes:

![Electrodos para electroestimulador](/images/electro1.jpg)

Se conectan al equipo mediante cables banana-banana. Para mejorar la conductividad y requerir menor tensión de estimulación, se sugiere aplicar una pequeña cantidad de gel neutro (fluido conductor).
