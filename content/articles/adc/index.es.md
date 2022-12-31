---
title: "Convertir una tensión en un valor digital, sin usar ADC"
tags: ["articles", "electronics"]
summary: "Cómo leer datos analógicos desde un microcontrolador que solamente tiene entradas/salidas digitales."
thumbnail: "/thumbs/adc.jpg"
aliases: ["/adc/"]
date: "2010-01-01"
---

Hay sistemas en los que se necesita leer desde sensores, potenciómetros u otros dispositivos analógicos, desde un microcontrolador de bajo costo, sin conversores analógicos digitales integrados.

Acoplar un ADC externo hace que necesitemos más pines en el microcontrolador (lo usual es que el valor muestreado se lee desde un bus de datos de 8 bits, como en el típico ADC0808), más espacio en el circuito impreso, o más complejidad en el software (por ejemplo, habría que programar rutinas para comunicarse via I2C con el ADC)

Si no nos interesa la resolución, precisión, linealidad, tiempo de sampleo, una solución es usar un circuito RC, usando un estilo de conversión similar al de doble rampa, pero sin integrar, unicamente contando el tiempo que tarda en descargarse el RC

![Circuito RC](/images/rc.png)

La resistencia puede ser cambiada por un termistor (PTC o NTC) si se quiere medir temperatura, o un LDR si se quiere medir luminosidad. También es posible usar un sensor capacitivo, usando una resistencia de valor conocido.

Es necesario tener un pin bidireccional (de entrada/salida) en el microcontrolador, que además permita establecer un estado de alta impedancia

El principio de funcionamiento es el siguiente:
* Ponemos el pin en positivo durante 1 ms, para cargar el capacitor
* Ponemos el pin en modo entrada (alta impedancia) y medimos cuanto tarda en descargarse el capacitor
* Repetimos este ciclo cada 50ms

![Ciclo carga/descarga capacitor](/images/descarga.png)

Un pequeño ejemplo de como programarlo sería el siguiente:

```c
uint16_t tiempo = 0;
DIR_CARGA = SALIDA;
PIN_CARGA = 1; delay1ms(); PIN_CARGA = 0; //Cargar el capacitor
DIR_CARGA = ENTRADA;
while(PIN_CARGA == 0) tiempo++; // Esperar descarga y contar el tiempo
```

Al valor resultante (16 bits) habría que restarle una constante, y escalarlo para obtener un valor entre 0 y 0xFF. Si se desea que el microcontrolador pueda hacer otras cosas mientras se está *muestreando*, se podría usar algún módulo de captura del microcontrolador, que cuente cuanto tiempo estuvo en alto la señal.
