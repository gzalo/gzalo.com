---
title: "Monitor de pulsaciones con Mi Band 6 (2022)"
summary: "Muestra las pulsaciones cardíacas en un navegador, leyéndolas de un Mi Band 6 via Bluetooth."
thumbnail: "/thumbs/miband-6-heart-rate-monitor.jpg"
date: "2022-01-18"
---

Este es un sitio web básico que permite mostrar tus pulsaciones cardíacas en una ventana del navegador, usando un smartwatch Mi Band 6. Básicamente es una mejora del miband-5-heart-rate-monitor, modificado para que soporte la versión 6 del reloj (que usa un mecanisimo de autenticación sobre BLE totalmente distinto).

Usa [mi propio port a WASM](https://github.com/gzalo/tiny-ECDH-wasm) de la biblioteca [tiny-ECDH-c](https://github.com/kokke/tiny-ECDH-c) para implementar el nuevo método de autenticación (basado en Diffie–Hellman con curvas elípticas, también llamado ECDH). 

**[Acceder al repositorio y al demo en vivo](https://github.com/gzalo/miband-6-heart-rate-monitor)**
