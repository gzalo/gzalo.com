---
title: "Mini game console with LED matrix"
summary: "Simple 8x8 game console based in an 8052 microcontroller, developed in C."
thumbnail: "/thumbs/miniconsola.png"
aliases: ["/miniconsole_en/"]
---
<p>As a final project for the subject "Electrónica Digital II" (2009, Professor: José Salama) we had to do a project using the 8052 microcontroller. I had some 8x8 LED matrices laying around, so I decided to make a mini game console. Using the Proteus simulator, I could design the circuit, program it and test it without needing a physical prototype. First I started using assembler, but it got too complex (specially the game logic section), so I decided to rewrite it using C, compiling with SDCC (free and open source compiler for various embedded platforms). </p>
<p>It supports simple sounds, has 4 games (a tetris clone with single pixel pieces), a simple racing game, an helicopter avoider and a snake clone. Only one color of the matrix was implemented in the harware, due to time constraints and the requirement of single sided board construction.</p>
<p>The Timer0 is used in 16 bit mode, and it's job is to refresh the display every 200 uS. Timer1 is also used in 16 bit mode, it executes the game logic and handles the menu and the scores. Timer2 is used in a 16 bit with autorecharge mode, it generates square waveforms of different frequencies (the melodies) and has priority to avoid sound glitches. Some buttons are connected as interrupt sources, and are used to feed the random number generator.</p>
<p><a href="/downloads/miniconsola.zip" >Download schematic, PCB, source code </a></p>
<p><iframe width="420" height="345" src="http://www.youtube.com/embed/ic0n-pDeKgQ" frameborder="0" allowfullscreen></iframe></p>
<p><img src="/images/consolalyt.png" alt="Mini game console, PCB" style="width:100%;max-width:600px;"/></p>
<p><img src="/images/consolasch.png" alt="Mini game console, schematic AT89S52" style="width:100%;max-width:800px;"/></p>
<p>
Materials:
<ul>
	<li><a href="http://www.sure-electronics.net/DC,IC%20chips/LE-MM103-4.jpg">8x8 LED matrix</a></li>
	<li>74HCT164 (to drive the columns of the matrix)</li>
	<li>8x 330 ohms resistors (for the rows)</li>
	<li>AT89S52 microcontroller (should work with AT89C52 as well, but its harder to burn the hex into the microcontroller)</li>
	<li>12MHz Crystal, two 33pF capacitors</li>
	<li>1 kohm resistor, 10 uF capacitor (for the reset circuit)</li>
	<li>4x tact switchs (the ones that have 4 terminals)</li>
	<li>6x 100 nF capacitors (for power supply stabilization and antibounce)</li>
	<li>Power supply: 100 uF capacitor, 1N4007 rectifier diode, 5V regulator (7805)</li>
</ul>
</p>