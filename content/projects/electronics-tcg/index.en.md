---
title: "Card game - Electrónica"
summary: "SDL based multiplayer game done as a final project for an assignature."
thumbnail: "/thumbs/electronica-tcg.png"
aliases: ["/electronica_tcg_en/"]
date: "2010-01-01"
---
	
It's a small game I did as a final project for highschool with Lucas Tavolaro. It's a multiplayer card game (working via LAN and Internet). The idea was to make some similar to the Pokemon Trading Card Game, but with funny cards (with internal jokes)

The game uses the SDL and SDL_image libraries to open windows, handle events and load game images. It also uses OpenGL for graphics acceleration and Unix sockets for multiplayer. To compile it, it's necessary to have installed Mingw or Cygwin (plus the libraries), go to the `cliente` folder and run `make`. It should work fine in Linux, though it was never tested.

![Trading card game](/images/tcgort.jpg)

[Download code and executable](https://code.google.com/p/electronica-tgc/)
(License: GPL2)

