---
title: "Using a cellphone or GSM/GPRS modem with a microcontroller"
tags: ["articles", "electronics"]
summary: "How to use a cellphone or a modem to send and receive texts and SMS using a microcontroller."
thumbnail: "/thumbs/gsm.png"
aliases: ["/gsm_en/"]
---

<p>It's possible to connect a microcontroller to a modem or GSM/GPRS cellphone, which enables the microcontroller to do stuff such as answer the phone, call a number, send and receive SMS as well as connect to the internet, even with small microcontrollers.</p>
<p>The first thing needed to know is that most cellphones and GSM modules work with AT commends, which are mostly universals and presents in any cellphone with a data cable, particularly old ones which could be used as modems through a virtual serial port.</p>
<p>We need to build the interface between the microcontroller and the module/cellphone. In most cases the cellphones work with 3.3 V, so the microcontroller needs to be supplied that voltage, or a level shifter or a simple resistive divider needs to be used.</p>
<p>Dedicated modules (such as the Motorola G20 or G24) tend to use a complete RS232 interface (to keep compatibility with old modems), so an IC such as the MAX232 is needed to connect them together (se <a href="/rs232ttl_en/">more information of the MAX232</a>).</p>
<p>Once both parts can interface, it's possible to talk to the module via a standard serial communication, usually at 4800bps, 1 bit stop, no parity and no flow control. Commands can then be sent.</p>
<p>Everything sent will be echoed by the module, so that will have to be handled in software.</p>
<p>List of main commands:</p>
<ul>
	<li><tt>AT</tt>\r\n : used to verify that the modem is connected and to try the link. It should reply OK.</li>
	<li><tt>ATE0</tt>\r\n : desables echo</li>
	<li><tt>ATE1</tt>\r\n : enables eco</li>
	<li><tt>AT+CPIN="1234"</tt>\r\n : if the SIM has PIN protection, sets the PIN to use </li>
	<li><tt>AT+CMGF=1</tt>\r\n : activates the text mode for SMS (makes easier routines software-wise)</li>
	<li><tt>AT+CMGS="+541155554444"</tt>\r<tt>Message<^Z></tt> : Sends "Message" to the specified 12-digit number.</li>
	<li><tt>AT+CNMI=,2</tt>\r\n : Activates the redirection of received messages to the microcontroller</br>
		When a message arrives, the module outputs <pre>+CMT: “+541155554444,”10/9/22,14:12:34”<br/>MESSAGE</pre>
		It's necessary to tell the module that the message was received correctly, using <tt>AT+CNMA</tt>\r\n
		</li>
</ul><br/>
<p>\r is the control character corresponding to the carriage return (ASCII 13 or 0x0D)<br/> \n is the line feed character (ASCII 10 or 0x0A)<br/> ^z is the character corresponding to "end of file" - EOF (ASCII 26 or 0x1A)</p>
<p>The routines to connect to the Internet, send and receive TCP and UDP packets aren't standard, and tend to vary according to the manufacturer. It's needed for the module to have a TCP/IP stack to use it (cheap ones don't have one). Otherwise, its needed to implement every protocol in the microcontroller firmware (from PPP up to UDP) . A sample code from an <a href="http://cache.freescale.com/files/microcontrollers/doc/app_note/AN2120.pdf">application note by Freescale (AN120)</a> explains how to do it, including C code that can be ported to other microcontrollers.</p>
