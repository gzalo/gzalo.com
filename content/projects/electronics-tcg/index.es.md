---
title: "Juego de cartas de electrónica (2010)"
summary: "Juego multijugador basado en la biblioteca SDL, hecho como proyecto final para una materia."
thumbnail: "/thumbs/electronica-tcg.png"
aliases: ["/electronica_tcg/"]
date: "2010-01-01"
---

Es un juego que hicimos de proyecto final de una materia para el colegio (Electrónica Digital III) en el 2010, junto a Lucas Tavolaro. Es un juego de cartas multijugador (funciona via LAN e internet). La idea era hacer algo similar al juego de las cartas pokémon, pero con cartas graciosas (con bromas internas de la división). 

El juego usa la biblioteca SDL y SDL_Image para abrir ventanas, manejar eventos y cargar las imágenes del juego. También usa OpenGL para el renderizado gráfico, y los *sockets de Unix* para multiplayer. Para compilarlo es necesario tener instalado mingw o cygwin, ir a la carpeta del cliente y ejecutar make. Debería funcionar en Linux, aunque nunca lo probamos.

![Trading card game](/images/tcgort.jpg)

[Descargar código y ejecutable](https://code.google.com/p/electronica-tgc/)
(Licencia: GPL2)
