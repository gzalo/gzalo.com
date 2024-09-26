---
title: "Doom en POS Verifone VX820"
summary: "Port del juego DOOM a una terminal de pagos"
thumbnail: "/thumbs/doom-posnet.jpg"
date: "2024-02-01"
---

En septiembre del 2023 me encontré esta terminal de pago (_posnet_) Verifone en la calle. Alguien la había tirado, seguramente porque estaba rota la carcasa.

![verifone vx820 running basic program](/images/pos-doom.jpg)

Buscando un poco en Internet, encontré que ya alguien había logrado correr Doom en el mismo equipo: [Thomas Rinsma](https://th0mas.nl/2022/07/18/porting-doom-to-a-payment-terminal/), por lo que decidí seguir sus pasos y terminé haciendo algo parecido, con algunos extras:

- Usar los botones del dispositivo no está tan bueno porque solo detectan de a un botón a la vez, por lo que decidí usar una palanca de arcade externa con botones

- Las puertas se abren pasando una tarjeta magnética

## [Video mostrando funcionamiento](https://www.youtube.com/watch?v=WlOgtZLBNoE)
## [Código fuente](https://github.com/gzalo/doomgeneric-vx)


Gracias a [OZKL](https://github.com/ozkl/doomgeneric) por su doom genérico portable a cualquier plataforma, [Thomas Rinsma](https://th0mas.nl/2022/07/18/porting-doom-to-a-payment-terminal/) por la idea, y a [paymentvillage](https://www.paymentvillage.org/resources), [denisdemaisbr](https://github.com/denisdemaisbr), [Mats Engstrom](https://x.com/matseng) que dieron mucha información que fue crucial a la hora de realizar el proyecto.

Necesita el SDK y compilador oficial para ARM de Verix, y usa un microcontrolador externo para detectar y enviar las pulsaciones de teclas via RS232.
