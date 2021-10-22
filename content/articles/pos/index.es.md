---
title: "Desarme de POS de tarjeta Naranja y MercadoPago"
tags: ["articles", "electronics"]
summary: "Fotos de alta resolución mostrando el interior de los lectores de tarjeta de Naranja y MercadoPago"
thumbnail: "/thumbs/pos.png"
date: "2021-10-21"
---

Estos lectores POS son de bajo costo, y básicamente implementan una interfaz Bluetooth 4 (BLE) contra un celular corriendo alguna aplicación especial. La misma recibe los datos de la tarjeta (cifrados) cuando un usuario hace un _swipe_ o la inserta en el lector del chip.

Debido a que el costo de los equipos está subsidiado por las comisiones de los usuarios, por lo general es posible comprarlos por un precio menor al de algunos módulos Bluetooth. La idea de esta página era empezar a documentar qué tan factible es usar los componentes que poseen estos lectores en otras aplicaciones.

En ambos casos para desarmar los lectores es necesario romper unas solapas plásticas que lo rodean (están soldadas ultrasónicamente de fábrica), por lo que sería posible detectar si alguien estuvo interfiriendo o saboteando el dispositivo.

# Naranja (lector NPos)

[![Naranja 1](/images/pos/npos1_small.jpg)](/images/pos/npos1.jpg)
[![Naranja 2](/images/pos/npos2_small.jpg)](/images/pos/npos2.jpg)
[![Naranja 3](/images/pos/npos3_small.jpg)](/images/pos/npos3.jpg)
[![Naranja 4](/images/pos/npos4_small.jpg)](/images/pos/npos4.jpg)
[![Naranja 5](/images/pos/npos5_small.jpg)](/images/pos/npos5.jpg)

Algunos componentes que se observan:
- Batería 3.7V 190 mAh
- Lector de banda magnética
- nxp 8035: smart card interface
- GD32F103: procesador principal (clon del stm32f103)
- YC1021: bluetooth processor (en placa hija)

No se hizo un intento de leer la memoria flash del procesador principal, pero se espera que la misma esté bloqueada y el debugging desactivado.
Si se pudiera borrar la memoria y programarle algún firmware distinto, este POS podría ser usado para obtener muchos microcontroladores GD32F103 de forma económica, ya que comprarlos por separado puede costar alrededor de 5 USD, mientras que estos POS suelen venderse a 2-3 USD por unidad, e incluso más baratos en mayores cantidades. 

# MercadoPago (Point Bluetooth - no mini)

[![MercadoPago 1](/images/pos/meli1_small.jpg)](/images/pos/meli1.jpg)
[![MercadoPago 2](/images/pos/meli2_small.jpg)](/images/pos/meli2.jpg)
[![MercadoPago 3](/images/pos/meli3_small.jpg)](/images/pos/meli3.jpg)
[![MercadoPago 4](/images/pos/meli4_small.jpg)](/images/pos/meli4.jpg)
[![MercadoPago 5](/images/pos/meli5_small.jpg)](/images/pos/meli5.jpg)

El fabricante es BBPos, y el modelo CHB70.

Algunos componentes que se observan:
- Batería 3.7V 190 mAh
- Lector de banda magnética
- qh16bhig: memoria flash similar a EN25QH16-104HIP	
- YC1021: bluetooth processor
- MH1902: Main microprocessor
- YL120 * 2: oscillator
- TSSF005: oscillator
- 1AM: NPN transistor MMBT3904L
- ADYO5: MAX6418UK46 reset circuit
- 5C * 3: BC807-40 PNP transistor
- C96CJ * 2: SU0524 esd protection
- 341L: ?

Al conectarlo por USB a una computadora se enumera como dispositivo HID, vid 2c69 pid 5750. No hay mucha información sobre el microcontrolador MH1902, y se espera que su memoria flash interna esté bloqueada y no sea posible reprogramarla.

# MercadoPago Point Smart

El modelo Point Smart (que corre Android) es fabricado por PAX, y el modelo interno es A910. 

[Aquí pueden encontrarse fotos de sus PCBs](https://fccid.io/V5PA910/Internal-Photos/Internal-photos-4328322)

Algunos circuitos integrados que son visibles:
- GT5688: pantalla táctil capacitiva, se comunica por I2C
- SC2342A: módulo RF 4 en 1 RF diseñado para aplicaciones móviles
- SR3593l: ?
- 5627e: ?
- 5596e: ?
- klm861*: memoria emmc
- mh1901cb: similar al MH1902, parece ser un chip encargado de la seguridad
- 74lvt125: buffers
- fm17550: soporte contactless 
- mx25l3233f: 32Mbit flash
- SC9832A: SoC quad core ARM con soporte para  Android
- 3401709: memoria? kingston

La mayoría de los circuitos integrados que posee son realizados a medida o no existe datasheet público. 
