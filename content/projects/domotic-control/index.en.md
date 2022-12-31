---
title: "Domotic control via IR and PC (2014)"
summary: "A domotic panel to control the lights of multiple bedrooms, allowing the user to change the intensity of them via 3 interfaces. This project was created with Juan Ignacio Troisi and Martin Menendez, for the university subject Laboratorio de microcontroladores."
thumbnail: "/thumbs/controldomotico.jpg"
aliases: ["/tp_labodemicros_en/"]
date: "2014-01-01"
---

This project was created in 2014 with Juan Ignacio Troisi and Martin Menendez, for the *Laboratorio de microcontroladores* university subject. The idea was to make a domotic panel to control the lights of multiple bedrooms, allowing the user to change the intensity of them via 3 interfaces:

* Using buttons and an alphanumeric display in the control panel, with the ability to set the time and automate the turn on/off of the loads, while also being able to set different permissions for different users. This interface is password protected.
* Using a PC, via a USB-TTL adapter. This allows the user to execute the same actions available in the control panel, with the possibility of downloading a log of the last instructions executed, for security purposes.
* Using an infrared remote control, which has a built-in user identifier. This allows multiple users, and they can have limited permissions, in such a way that not every user is able to modify the state of each load.

## Implementation details
In the remote control, an AT89S52 microcontroller was used, as well as buttons, LEDs, infrared LED and a DIP switch. The timer2 was used as a square wave generator, to easily generate the 38KHz carrier needed for the IR amplitude modulation. Low power consumption mode was used to use less current. The protocol used for the data transmission was the following: fixed period signal, with different duty cycle depending if a 0 or a 1 is needed to be sent.

![Domotic control transmitter](/images/ldm_transmisor.png)

In the receiver end, another AT89S52 was used, as well as a IS1U60 infrared receiver (which handles the capture, filter and demodulation of the signal), a DS1307 real-time clock (with I2C interface), and an alphanumeric LCD. The software was developed in assembler and built with Keil uVision. Almost every resource of the microcontroller got used: nearly all the ram, more than 80% of the code memory, every timer, various interrupt sources, and the UART.

![Domotic control panel](/images/ldm_receptor.png)

Currently the code, schematics and PCB files aren't available for download, but I can answer questions related to the project (or other similar projects).
