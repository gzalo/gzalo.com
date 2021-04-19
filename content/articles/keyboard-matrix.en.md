---
title: "Matrix keyboards, microcontroller interface"
tags: ["articles", "electronics"]
summary: "Easy tips to route multiple tact switches disposed in a matrix configuration."
thumbnail: "/thumbs/teclado4x4.png"
aliases: ["/keyboard4x4_en/"]
date: "2010-01-01"
---
Making a keyboard with 4 terminal buttons (also known as tact switches) is very easy, specially using the fact that two of the 4 terminals are internally joined, so it's possible to use a single board PCB without needing extra wire jumps.
![3x4 keyboard schematic](/images/keypad_lyt.png)

[Download editable PCB (for Proteus)](/downloads/keypad.zip)

The easiest way to read the keyboard status from a microcontroller is the following: it can be connected to a single 8-bit I/O port, using the low nibble for columns and the high nibble for rows.

![3x4 keyboard connection for microcontroller](/images/keypad_conn.png)

A sample code may be the following:

* Every a certain sample time (10 o 20 milliseconds typical)
	* Activate the first column, deactivate the other ones
	* If any row is active, the pressed key is idxRow*3
	* Activate the second column, deactivate the other ones
	* If any row is active, the pressed key is idxRow*3+1
	* Activate the third column, deactivate the other ones
	* If any row is active, the pressed key is idxRow*3+2
	
For more complex applications, it is possible to add a gate to detect the press of any of the keys, and in that case enable the microcontroller to be in a sleep mode (low power consumption), and creating an external interrupt when any key is pressed.

If the detection of multiple simultaneous keys is needed, it's possible to add a small diode in series with each button. If the diode is not added, when pressing two or more keys (specially diagonally adjacent keys) the detection of ghost keys might happen. Most computer keyboards don't have this diodes, but the keys are arranged in such a way that the probability of detecting ghost keys is low. For instance, the arrow keys, WASD, adjacent letters are ussualy in a same row, so it's possible to detect two of them regardless of the state of the other keys.
