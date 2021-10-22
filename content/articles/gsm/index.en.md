---
title: "Using a cellphone or GSM/GPRS modem with a microcontroller"
tags: ["articles", "electronics"]
summary: "How to use a cellphone or a modem to send and receive texts and SMS using a microcontroller."
thumbnail: "/thumbs/gsm.png"
aliases: ["/gsm_en/"]
date: "2010-01-01"
---

It's possible to connect a microcontroller to a modem or GSM/GPRS cellphone, which enables the microcontroller to do stuff such as answer the phone, call a number, send and receive SMS as well as connect to the Internet, even with small microcontrollers.

The first thing needed to know is that most cellphones and GSM modules work with AT commands, which are mostly universal and are present in any cellphone with a data cable, particularly old ones which could be used as modems through a virtual serial port.

We need to build the interface between the microcontroller and the module/cellphone. In most cases, the cellphones work with 3.3 V, so the microcontroller needs to be supplied with that voltage, or a level shifter (which can be a simple resistive divider) has to be used.

Dedicated modules (such as the Motorola G20 or G24) tend to use a complete RS232 interface (to keep compatibility with old modems), so an IC such as the MAX232 is needed to connect them (see [more information of the MAX232]({{< ref "/articles/rs232ttl" >}})).

Once both parts are connected physically, it's possible to talk to the module via a standard serial communication, usually at 4800bps, 1 bit stop, no parity and no flow control. Commands can then be sent.

Every character sent will be echoed by the module, so that will have to be handled in software.

List of main commands:

* `AT`\r\n : used to verify that the modem is connected and to try the link. It should reply OK.
* `ATE0`\r\n : desables echo
* `ATE1`\r\n : enables echo
* `AT+CPIN="1234"`\r\n : if the SIM has PIN protection, sets the PIN to use 
* `AT+CMGF=1`\r\n : activates the text mode for SMS (makes easier routines software-wise)
* `AT+CMGS="+541155554444"`\r`Message<^Z>` : Sends `Message` to the specified 12-digit number.
* `AT+CNMI=,2`\r\n : Activates the redirection of received messages to the microcontroller\
When a message arrives, the module outputs `+CMT: “+541155554444,"10/9/22,14:12:34"\r\nMESSAGE`\
It's necessary to tell the module that the message was received correctly, using `AT+CNMA`\r\n
		
`\r` is the control character corresponding to the carriage return (ASCII 13 or 0x0D)\
`\n` is the line feed character (ASCII 10 or 0x0A)\
`^z` is the character corresponding to *end of file* - EOF (ASCII 26 or 0x1A)

The routines to connect to the Internet, send and receive TCP and UDP packets aren't standardized and tend to vary depending on the manufacturer. The module needs to have a TCP/IP stack to use it. Otherwise, every protocol required (from PPP up to UDP) has to be implemented in the microcontroller's firmware.

A sample code from an [application note by Freescale (AN120)](https://www.nxp.com/docs/en/application-note/AN2120.pdf) explains how to do it, including C code that can be ported to other microcontrollers.
