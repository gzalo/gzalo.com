---
title: "Digital combination lock"
summary: "Digital logic based that implements a combination lock similar to those used in hotel rooms."
thumbnail: "/thumbs/cerradura.png"
aliases: ["/lock_en/"]
---
This project was developed in 2012 for the subject "Técnica Digital", for the university. Basically it's a lock similar to those found in hotel rooms.

To simplify the design, the key is 4 digit, modulo 4. Unlike other locks that only allow to change the key by soldering different wires, the idea of the project is to make it in such a way that the key can be "stored" in a DIP switch.

![Block diagram of the lock](/images/td-diagbloques.png)
![Lock schematics](/images/td-esquema.png)

The circuit was designed in such a way that it needs no clock signal, its fully asyncronic. The signal is extracted from the button presses. Two shift registers are used to store the key while its being input, and a modulo 5 counter to know in which state the lock is. After inserting the 4 digits, it gets compared to the "key" stored in the DIP switch, and the compare result is shown in a red/green LED.

Storing the input in the shift register allows to show the user which digits it has input. The fact that they have two data inputs (which are internally joined via an AND gate) was used to reduce the amount of external logic necessary.