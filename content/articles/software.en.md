---
title: "List of software commonly used in electronics"
tags: ["articles", "electronics"]
summary: "Analysis of some electronic programs I used or use daily."
thumbnail: "/thumbs/software.png"
aliases: ["/software_en/"]
date: "2010-01-01"
---

### Simulation, PCB design and schematic software
**Electro Workbench 5.12**: Full of bugs, specially with wires (when adding connections they tend to move randomly), has only a few components, some ICs are badly drawn, the automatic redraw fails, has no undo button. Doesn't support PCBs. It's fine for simulating simple logic gate circuits, allows for equation simplification and conversion to NAND. Doesn't support microcontrollers (PICs, AVRs, 8051, etc.)

**NI Multisim 10.0**: New and improved version of Electronics Workbench, various bugs got corrected. The software looks more professional, PCB design was added, as well as different microcontrollers and memories.
	
**Crocodile Technology**: Quite nice simulator, allows for 3d visualization and easy PCB creation, automatic tracs. Has lots of components, but no microcontrollers or memories. Ideal to make small simple circuits with transistors, logic ICs or 555.

**Cedar logic**: It's a digital logic simulator that works with blocks. There is no way to use commercial ICs, so it's not useful for creating real circuits. It supports memories, matrix keyboards, z80 microprocessor. Has a 6 channel oscillosope. Doesn't support PCB design.

**Eagle Layout Editor**: A pretty good program that allows for schematic and PCB design. Has no similator, but it's useful to create professional PCBs, since there is a really large number of user libraries, supporting virtually every component. This suite is used by professional companies such as SparkFun, Arduino, Adafruit.

**Protel 99SE**: It's a quite old complete PCB and schematic design suite. Doesn't support simulation. It takes a while to get used to the keyboard combinations, which are needed to do stuff. Has some issues: redrawing, components often dissapear, bad track movements, amongst other.

**Proteus**: It's one of the best tools. Allows for a high amount of components, has multiple test instruments (serial terminal, SPI, I2C debuggers, oscillosopes, logic analyzer). Has a 3d visualization option, can simulate microcontrollers in real time, supports most of the 74xxx series of ICs. 

**LTSpice**: It's an analogic circuit simulator, allows for accurate analysis of multiple circuits, with RLC, transistors, opamps, and different types of power supplies. It's ideal to do models and to test SMPS supplies efficiencies. Doesn't have a great amount of components, but there are lots of user created components online. Doesn't have PCB design.
	
### Burn software for microcontrollers, memories, PLDs, CPLDs and FPGAs

**Max Loader**: Has a high amount of supported microcontrollers and memories. Needs a privative hardware, which is expensive. By default, it opens hex files as binary, which can be quite bothering.

**ISP-30a**: Allows for programming of AT89SXX serrie microcontrollers. Needs a parallel port and not many components.

**AtmelWrite**: Allows for programming of AT89SXX serrie microcontrollers. Needs a serial port and a simple circuit with a MAX232.

**WinPic800**: Allows for programming of multiple PICs, supports a huge number of programmers, including JDM. Tends to be fast and run without hitches.

**ICProg**: Allows for different microcontroller programming, also supports JDM. Has an older interface, tends to be harder to configure and has a slower programming process.

**PonyProg**: The interface is really old, but has a great variety of microcontrollers and memories, such as 24lc, atmega, attiny, 8052.

**H-JTAG**: This program allows to program newer microcontrollers, using a JTAG interface. Really useful to reflash routers or cellphones. A simple parallel port adapter can be built, but the transfer speed isn't that high.

**PicPGM**: Alternative to WinPic800, doesn't need a driver installation to work with JDM programmer, so it works better in 64 bit Windows.

### Compilers and assemblers
**SDCC**: Is a free compiler that allows for C programming in multiple microcontrollers, mainly 8052 series and PICs (the latter with a mediocre support with some bugs). Has an interesting set of optimizations, and supports almost the entire C89 Standard.

**Keil uVision**: It's an IDE that features an assembler and C compiler for 8052. It has also a interesting simulator, but with limitations on the free version. Supports part of the C89 standard.

**PICC**: It's an IDE that allows for C programming of PIC microcontrollers. Has some incompatibilities (for instance doesn't support 2d arrays) but features better optimization than SDCC, and has lots of built in libraries, such as LCD, GLCD, keyboard matrix support. It also features functions that allow for easier setting of the peripherals of the microcontroller, without needing to fiddle with the registers.

**MPLAB**: It's an IDE that allows PIC programming using assembler (PIC18 supports C using HI-TEC compiler). The interface is a bit confuse and heavy.

**XC8**: Compiler for low/middle tier PICs, has a free version that doesn't do much optimizations, but it tends to work perfectly.

**WinAVR/AVR-GCC**: C Compiler for AVR microcontrollers. It is basically a port of GCC so it has a high compatibility with most code, it has a better compliance with the standards than most PIC compilers.

