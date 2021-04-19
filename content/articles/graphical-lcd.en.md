---
title: "Graphical LCDs based on KS0108"
tags: ["articles", "electronics"]
summary: "How to control a Graphic LCD with a resolution of 128x64 (or 192x64) based in KS0108, using a microcontroller and two 8 bit I/O ports."
thumbnail: "/thumbs/lcdgrafico.png"
aliases: ["/graphicallcd_en/"]
---
Most monochromatic graphical LCDs use a controller compatible with KS0108. Each one has an internal 512-byte memory, so it allows resolutions up to 64x64 pixels. Bigger displays tend to use multiple controllers, one per fraction of the screen. For instance, a 128x64 LCD has two controllers, a 196x64 has 3, and a 128x128 has 4 of them.

Each controller is independent thus they don't transmit information between them. In order to choose which controller has to be activated, two control lines are used: CS1 and CS2 (chip select), acting like a 2 bit address which can select up to four different ICs. They don't have an internal font generator, so in order to write text the driver has to store the pixels of each wanted glyph, in a microcontroller or an external memory.

The LCDs have these terminals:
	
* VSS: 0V, ground reference
* VDD: 5V, supply voltage for LCD
* V0: Contrast adjustment
* D/I: selects between Data (1) or Instruction (0)
* R/W: selects between reading (1) or writing (0) to the controller
* E: When a pulse is applied, the data transfer happens
* DB0..7: Data bus (8-bit bus)
* CS1..2: Lines to select the controller
* RES: Reset signal, if 0 all controllers get reseted
* Vee: Negative voltage OUTPUT
* K y A: Backlight, typically LEDs
	

Most LCDs feature an internal negative voltage generator, which is needed by the controller to turn on the segments. To control the contrast, a 20 kiloohm preset can be used, connected between Vee and Vss (extremes) and the middle terminal (wiper) can be connected to V0. A and K terminals are typically connected to LEDs in the side of the display, and should be connected to 5V and 0V, with a series resistance of 100-200 ohm to make sure that they don't have a high current.

How to send a command or data to the LCD::
	
* Select the wanted controller (CS1 and CS2)
* Set D/I line in the wanted stete: 1 if a command needs to be sent, 0 if data will be sent
* Place the data or the command in the data bus
* Make a pulse in the E line
* Wait a small time (~500nS). Alternatively, the LCD status can be read to avoid hardcoding delays in the code.

The display itself is divided in 8 horizontal pages (each with 8 pixels of height) and 64 vertical lines.
### Important commands
#### Turn on/off display
D/I = 0, DB = 0x3F (on) or 0x3E (off)
#### Move pointer - X axis
D/I = 0, DB = 0x40 + line (0 to 63)
#### Move pointer - Y axis
D/I = 0, DB = 0x9C + page (0 to 7)
#### Write data to screen
D/I = 1, DB = DataToWrite

The data is written into the place stored by the pointer. After writing a value, the X position is incremented, in order to avoid fast copies.
