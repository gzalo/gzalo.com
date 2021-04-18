---
title: "Introduction to PLD (Programmable Logic Devices)"
tags: ["articles", "electronics"]
summary: "Small summary of applications of PLA, PAL, GAL and PLD based systems."
thumbnail: "/thumbs/pld.png"
aliases: ["/pld_en/"]
---

<h2>What is a Pal/Gal/Pla? What is their main use?</h2>
<p>They are programmable electronic components that can be used to build digital circuits. The complete family is called PLD (Programmable Logic Device).
<p>Their main use is to minimize the amount of integrated circuits, and thus lower the cost and size of a board.
<h2>Which type of circuits can be built into a PLD?</h2>
<p>Generally, it's possible to synthesize any digital circuit which can be writen as a sum of product (minterms) and some sequential circuits, with complexity depending on the type of device.

<h2>What are the advantages and disadvantages in comparision with TTL/CMOS ICs?</h2>
<p>They typically allow to reduce cost and space in boards. Also, in some PLDs the logic can be reprogrammed multiple times, which would be impossible in a hardwired logic circuit. The disadvantages are mainly that it needs a programmer, an environment to write the equations, and is harder to simulate them.

<h2>Which are the differences between PAL, PLA, GAL, CPLD?</h2>
<p>They mostly have differences in they internal strucutre. For instance, PLAs are more flexible because they allow programming of the AND and OR matrices, while PALs can only have their AND matrix programmed. This makes the latter ones cheaper, but with more limitations regarding the maximum amount of minterms per output. GALs are similar to PALs, but with the possibility of erasing and reprogramming. CPLDs are programmable logic devices that join different programmable cells, so more complex circuits can be implemented, typically with complex state machines or problems that can't be solved fast in microcontrollers.

<h2>Which language are they programmed in?</h2>
<p>Typically, a high level language such as CUPL or ABEL is used, which allows the user to write the logic equations, and then it gets compiled (using minimization and optimization steps) to a JEDEC file, which has the information regarding which internal fuses should be burn. A free IDE is <a href="http://www.atmel.com/tools/WINCUPL.aspx">WinCUPL</a> by Atmel.

<h2>How can the chip be programmed?</h2>
<p>A programmer is needed. Since most programming timings and sequences aren't free, most homemade programmers can't support them, only the commercial ones do. Most PLD need a higher voltage (around 15 V) to enter programming mode.

<h2>Where can it be bought? What's the typical cost?</h2>
<p>They can be found in most electronic stores, the cost varies between model, but for instance the GAL16v8 are found at around 0.90 U$D

<h2>How can a certain terminal be configured as input?</h2>
<p>Depending on which software you use, by accessing the variable linked to that pin, it should work as an input. Also, if you never assign any value to it, it should stay in high impedance/input mode. If you want the low level details, you can look in the datasheet where it says that the required control bits are SYN=1,AC0=0,AC1=1 to enable dedicated input for a pin.

<h2>Examples of PLD applications</h2>
<p>
<li>Code converter, for instance from binary to gray code.</li>
<li>BCD to 7 segment converters, supporting A-F letters</li>
<li>Quadrature decoders and counters</li>
<li>Parity checkers, checksums and error detection and correction</li>
<li>Different types of counters and registers</li>
<li>Memory and I/O controllers for microprocessors</li>
<li>Lookup tables</li>

<h2>How to implement a table in CUPL? </h2>
<p>With this method one avoids having to do all the table, K-Map and equation finding manually, it's possible to let the compiler handle it automatically. For instance, this code showcases that:
<p><pre><code>Device  g16v8 ;

PIN [13..19]=[S0..6];
PIN [2..5]=[E0..3];

FIELD inputs = [E0..3] ;
FIELD outputs = [S0..6] ;

TABLE inputs => outputs {
	0=>7E;    1=>30;    2=>6D;    3=>79;
	4=>33;    5=>5B;    6=>5F;    7=>70;
	8=>7F;    9=>73;    A=>77;    B=>1F;
	C=>4E;    D=>3D;    E=>4F;    F=>47;
}</code></pre>

<p>This video shows the simulation of the code, with a binary counter and a clock signal as input:

{{< youtube NwBH5X1C8pI >}}

<h2>Is there any alternative with more capacity?</h2>
<p>If a more complex application needs to be implemented, it's possible to use a CPLD or FPGA. The first one is build by different blocks, each one resembling a simple PLD. They are usually programmed using the same languages as PLD. In the case of FPGAs, the architecture is different, they tend to have a high number of simple logic cells, which can be interconnected in many different ways. For instance, a microprocessor may be implemented inside an FPGa. Typically used languages for FPGA programming are Verilog and VHDL. 