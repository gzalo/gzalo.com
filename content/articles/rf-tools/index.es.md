---
title: "Herramientas de RF"
summary: "Algunas herramientas simples de banco para medir, atenuar y terminar señales de RF."
thumbnail: "/thumbs/rftools.jpg"
date: "2026-06-29"
---

Estas son algunas herramientas de RF que fui armando. No son instrumentos de laboratorio calibrados pero ayudan a la hora de medir equipos, filtros y salidas de RF.

La idea general fue hacer piezas chicas, con conectores SMA, fáciles de intercalar en una medición con VNA, vatímetro o algún receptor/analizador.

## Carga fantasma

![Carga fantasma cerrada](/images/dummy1.jpg)
![Carga fantasma con la resistencia visible](/images/dummy2.jpg)

La carga fantasma está hecha con una resistencia **G150N 50W4B** (de 50 ohms, 150W) montada sobre un disipador de CPU antiguo. La resistencia queda atornillada al aluminio y conectada directamente a un SMA, intentando mantener el recorrido lo más corto posible, para hacer que funcione bien incluso en altas frecuencias.

El tamaño del disipador no es tan grande, por lo que no sirve para disipar potencia continua, pero sí para medir transmisores de baja potencia o para hacer pruebas rápidas. 

![Carga fantasma medida con el VNA](/images/dummy3.png)

Se puede observar una ROE menor a 1.15 hasta 900 MHz. 

## RF tap de -40 dB

![RF tap cerrado](/images/tap1.jpg)
![Conector pasante del RF tap](/images/tap2.jpg)
![Interior del RF tap](/images/tap3.jpg)

El tap de RF tiene dos conectores principales para la línea que pasa de lado a lado, y un tercer conector de muestreo, que entrega aproximadamente **-40 dB** respecto de lo que circula por la línea principal.

Por ejemplo, si por la línea pasan 10 W, en el puerto de muestra aparecen idealmente 1 mW. Eso lo vuelve muy útil para mirar una transmisión con instrumental sensible como un analizador de espectro, sin meterlo directamente en la salida del equipo. Sirve por lo tanto para ver la potencia de salida de un transmisor sin quemar el instrumento.

Internamente usa un pedazo de plaquita tipo *NanoVNA testboard kit* como línea pasante, montada dentro de una caja de aluminio. La derivación hacia el tercer conector SMA está hecha con resistencias discretas.

![Esquemático del RF tap](/images/tap-schematic.png)

Funciona bien hasta un GHz (como se observa, tiene una ROE menor a 1.5), y la atenuación de -40 dB es bastante estable en todo el rango, por lo que puede ser usado para medir armónicos de señales de HF, VHF o UHF sin problemas.

![Gráfico 1](/images/tap4.png)
![Gráfico 2](/images/tap5.png)

## Mini atenuador de 7.7 dB

![Mini atenuador de RF](/images/filter_1.jpg)
![Detalle del mini atenuador](/images/filter_2.jpg)

Este mini atenuador agrega alrededor de **7.7 dB** de atenuación. Es de baja potencia, armado directamente entre conectores SMA y con 3 resistencias SMD.

Es posible usarlo a la salida del tap. Si un equipo sigue entregando demasiada potencia para el instrumento aun mirando por la salida de -40 dB, este atenuador atenúa más aún.

![Esquemático del mini atenuador](/images/filter_schematic.png)

Los cálculos fueron hechos con esta calculadora, probando distintas opciones de valores que se tenían disponibles para minimizar la pérdida de retorno. Es un atenuador tipo PI: https://leleivre.com/rf_pipad.html

![Gráfico 1](/images/atten-0.png)
![Gráfico 2](/images/atten-1.png)

Se observa que posee una ROE menor a 1.5 hasta 1 GHz, y que la atenuación es más estable de lo esperado en todo el mismo rango.

## Calibraciones hembra para VNA

![Calibraciones SMA hembra para VNA](/images/vna_calibrations.jpg)

Este es un set de calibraciones SMA hembra para el VNA: abierto, carga y corto. Es especialmente práctico porque muchas veces los filtros o plaquitas a medir tienen conectores SMA macho, y el kit clásico del NanoVNA tiene las calibraciones equivocadas, lo que introduce errores en las mediciones.

Con estas calibraciones se puede llevar el plano de referencia directamente al conector hembra donde va a enchufarse el dispositivo bajo prueba. 

Son fáciles de armar:
- El corto es un SMA hembra con una soldadura directa entre el pin central y el cuerpo.
- La carga es un SMA hembra con una resistencia de 50 ohms (49.9 en mi caso, pero no cambia mucho) SMD conectada entre el pin central y el cuerpo.
- El abierto es un SMA hembra con el pin central cortado.