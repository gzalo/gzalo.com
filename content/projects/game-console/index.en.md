---
title: "Mini game console with LED matrix (2009)"
summary: "Simple 8x8 game console based in an 8052 microcontroller, developed in C, compiled with SDCC."
thumbnail: "/thumbs/miniconsola.jpg"
aliases: ["/miniconsole_en/"]
date: "2009-01-01"
---
As a final project for the subject *Electrónica Digital II* (2009, Professor: José Salama) we had to do a project using the 8052 microcontroller. I had some 8x8 LED matrices laying around, so I decided to make a small game console. Using the Proteus simulator, I could design the circuit, program it and test it without needing a physical prototype. First I started using assembler, but it got too complex (specially the game logic section), so I decided to rewrite it using C, compiling with SDCC (free and open-source compiler for various embedded platforms). 

It supports simple sounds, has 4 games (a Tetris clone with single pixel pieces), a simple racing game, an helicopter avoider and a snake clone. Only one color of the matrix was implemented in the harware, due to time constraints and the requirement of single-sided PCB construction.

The Timer0 is used in 16 bit mode, and it's job is to refresh the display every 200 uS. Timer1 is also used in 16 bit mode, it executes the game logic and handles the menu and the scores. Timer2 is used in a 16 bit with auto-recharge mode, it generates square waveforms of different frequencies (the melodies) and has priority to avoid sound glitches. Some buttons are connected as interrupt sources and are used to feed the random number generator.

[Download schematic, PCB, source code](https://github.com/gzalo/minigameconsole/)

{{< youtube ic0n-pDeKgQ >}}

![Mini game console, PCB](/images/consolalyt.png)

![Mini game console, schematic AT89S52](/images/consolasch.png)

Required components:
* 8x8 LED matrix (model: LE-MM103-4)
* 74HCT164 (to drive the columns of the matrix)
* 8x 330 ohms resistors (for the rows)
* AT89S52 microcontroller (should work with AT89C52 as well, but its harder to burn the hex into the microcontroller)
* 12MHz Crystal, two 33pF capacitors
* 1 kohm resistor, 10 uF capacitor (for the reset circuit)
* 4x tactile switches (the ones that have 4 pins)
* 6x 100 nF capacitors (for power supply stabilization and antibounce)
* Power supply: 100 uF capacitor, 1N4007 rectifier diode, 5V regulator (7805)
