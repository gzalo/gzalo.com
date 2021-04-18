---
title: "Introduction to I2C protocol, reading and writing in 24LC memories"
tags: ["articles", "electronics"]
summary: "Very useful memories, typically used to store configuration data or to keep logs with sensor data."
thumbnail: "/thumbs/i2c.png"
aliases: ["/i2c_en/"]
---
<p>I2C (spelled I squared C) is a standard that allows for easy communication between multiple devices (microcontrollers, memories, computer monitors, sensors, converters, and many other smart devices).</p>
<p>It only requires two signals: one for clock and one for data (as well as the common ground). Originally designed by Philips, it has a maximum speed of 100 Kbits per second, but some devices can be interfaced at a higher speed.</p>
<p>It's a serial type bus (the bits travel one after the other) and synchronic (one of the signal is used to synchronize the master and slave)</p>
<p>The data signal is called SDA, while the clock signal is SCL o SCK. As they are open collector signals, two pullup resistors are needed, in the range from 2 Kohm to 50 Kohm.</p> 
<p>The protocol features different signals, which are sent by the master device. In a halt state, both signals remain as a logic high.</p>
<p>The START and STOP signals are used to mark the beginning and ending of a request to a slave device, they are the only signals that can have a SDA change while SCK is high:</p>
<img src="/images/secuenciasi2c.png" alt="START and STOP I2C sequences" style="width:100%;max-width:486px;"/>
<p>The data is transmitted in 8 bit sequences, in a serial way: starting by the most significant bit, they bits get placed in the SDA line, and a SDK pulse is made (rising and falling edge). Every 8 sent bits, the receiver adds an acknowledge bit, which indicates if it's ready to receive more bytes. If it's 0, more bytes can be sent, and if it's 1, a STOP signal should be issued to end the transfer.</p>
<img src="/images/secuenciaenvioi2c.png" alt="Secuencia envío I2C" style="width:100%;max-width:390px;"/>
<p>Tipically, I2C devices have a 7 bit address (128 different slave devices can stay in the same line), so before starting a transfer another packet must be sent, containing the 7 bits of the address and an extra bit, indicating if a write (1) or read (0) is desired.</p>
<p>Most applications that need a small non volatile memory can use 24LC series EEPROMs. They are very useful devices, and can be used to store configuration data or keep a small log of sensors. Being I2C, it only adds two extra required I/O lines, so it can be used with small microcontrollers.</p>
<p>This series of memories come in a range of 128 bytes to 1 Megabyte. For instance, a 24LC256 has 256 kilobits (32 KB) available byte and costs less than a dollar.</p>
<p>They aren't designed for continuous use (they support at least 1 million write cycles), so they are limited to fixed data or information that doesn't need to change much. Having a pretty big delay while writing (5 ms) means that they can't be used to replace RAMs.</p>
<p>Doing a write or read command is quite easy, the microcontroller can have a I2C module or it can be bit-banged in software. Each memory has 3 extra terminals, which allows putting multiple of them in cascade, each one of those in a different address.</p>
<h3>Writing a single byte</h3>
<p>The process is the following:
	<ol>
		<li>Make a START sequence</li>
		<li>Send 1010XXX0, where XXX is the direction of the IC to use, wait for ACK</li>
		<li>Send the low byte of the address to be writen, wait for ACK</li>
		<li>Send the high byte of the address to be writen, wait for ACK</li>
		<li>Send the byte to be writen in the specified address, wait for ACK</li>
		<li>Make a STOP sequence</li>
	</ol>
</p>
<h3>Writing a page (multiple writes in same command)</h3>
<p>The memories tend to support page writing: writing more than 1 byte in a same command. This can be used to reduce the write time, needing to wait only 5 ms per written page. The memories usually support 64 byte pages, and in most cases the writes can only start in an address multiple of 64.</p>
<p>The process is similar to the single byte one, but more bytes are sent before making the STOP signal:
	<ol>
		<li>Make a START sequence</li>
		<li>Send 1010XXX0, where XXX is the direction of the IC to use, wait for ACK</li>
		<li>Send the low byte of the address to be writen, wait for ACK</li>
		<li>Send the high byte of the address to be writen, wait for ACK</li>
		<li>Send the byte to be writen in the specified address+0, wait for ACK</li>
		<li>Send the byte to be writen in the specified address+1, wait for ACK</li>
		<li>Send the byte to be writen in the specified address+2, wait for ACK</li>
		<li>...</li>
		<li>When finished, send a STOP sequence</li>
	</ol>
	It's possible to write any amount of data up to 64 contiguous bytes, always closing the transfer with a STOP signal.
</p>
<h3>Waiting for end of writing</h3>
<p>After making a write request, the memory won't reply commands for around 5 ms, until it finishes writing the data. It's possible to detect if the memory is busy by sending the start of a write request. If the memory doesn't answer with an ACK, it's still busy.</p>
<h3>Single Byte Read</h3>
<p>Reading a byte from a specified address is easy:
	<ol>
		<li>Make a START sequence</li>
		<li>Send 1010XXX0, where XXX is the direction of the IC to use, wait for ACK</li>
		<li>Send the low byte of the address to be read, wait for ACK</li>
		<li>Send the high byte of the address to be read, wait for ACK</li>
		<li>Make a START sequence</li>
		<li>Send 1010XXX1, where XXX is the direction of the IC to use, wait for ACK</li>
		<li>Read byte, don't send ACK to the memory</li>
		<li>Send a STOP sequence</li>
	</ol>
</p>
<h3>Multiple Byte Read (Sequential)</h3>
<p>As well as writing multiple bytes, reading multiple adjacent bytes is supported.
	<ol>
		<li>Make a START sequence</li>
		<li>Send 1010XXX0, where XXX is the direction of the IC to use, wait for ACK</li>
		<li>Send the low byte of the address to be read, wait for ACK</li>
		<li>Send the high byte of the address to be read, wait for ACK</li>
		<li>Make a START sequence</li>
		<li>Send 1010XXX1, where XXX is the direction of the IC to use, wait for ACK</li>
		<li>Read byte 0, send an ACK to the memory</li>
		<li>Read byte 1, send an ACK to the memory</li>
		<li>Read byte 2, send an ACK to the memory</li>
		<li>...</li>
		<li>When no more bytes need to be read, send a STOP sequence</li>
	</ol>
</p>
<p>Some other types of I2C devices are the widely used RTC (real time clocks) such as the DS1307, which allows for timekeeping and making clocks or alarms. They also tend to have an internal RAM or EEPROM memory. There are also I2C non volatile RAMs, that work in a similar way to the memories described in this article, but with the main difference that they support "Unlimited writes", so they don't wear out in time.</p>
