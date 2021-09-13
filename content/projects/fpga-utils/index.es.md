---
title: "Utilidades para Sistemas Digitales"
summary: "Programas desarrollados para TPs de Sistemas Digitales, permiten debuggear a través de simulación sistemas basados en FPGAs que usan salidas de video VGA."
thumbnail: "/thumbs/cordic.png"
date: "2015-01-01"
---

Estas son algunas pequeñas utilidades creadas en 2015 para ayudar a debuggear sistemas basados en FPGAs:
- Parser VCD: convierte señales `R`, `G`, `B`, `VerticalSync` y `HorizontalSync` en una imagen
- Enviador de puntos: envía una lista de puntos a través de un puerto serie
- PNG a ROM de caracteres: convierte una imagen en código VHDL que describe una memoria ROM donde cada bit es un pixel de la misma
- Simulación CORDIC: Simula rotaciones en 3 dimensiones usando ese algoritmo, muestra como la cantidad de iteraciones afecta la calidad del resultado

**[Acceder al código fuente en el repositorio](https://github.com/gzalo/sistemas-digitales)**
