---
title: "Usage of MAX232 for RS232-TTL level shifting"
tags: ["articles", "electronics"]
summary: "A simple circuit used in almost every circuit that needs a connection with a PC."
thumbnail: "/thumbs/rs232ttl.jpg"
aliases: ["/rs232ttl_en/"]
date: "2009-01-01"
---
This circuit is widely used in the world of microcontrollers. It basically allows shifting levels between a TTL signal (0 ... 5 V) and a RS232 signal (15 V ... -15 V).

It's built around the MAX232 IC, which is designed specifically for that purpose, needing only four external capacitors to generate a higher voltage internally. 

There are different clones of the MAX232 IC (for instance the HIN232) that have the same functionality but are generally cheaper. It's possible to swap them without any issue.

![Schematic RS232-TTL converter with MAX232](/images/placamax.png)

If the TTL signal is low voltage (0...3.3 V) like in some modern microcontrollers (ARM, MIPS, etc), it will be necessary to exchange the MAX232 IC for the MAX3232, which is similar but it works from around 3 volts up. If that IC is not available, it might be possible to use a regular MAX232 with a smaller voltage supply, but the output might not be inside the margins defined by the RS232 standard. 

![PCB for RS232-TTL converter with MAX232](/images/lytmax232.png)

[Download schematic and PCB editable in Proteus](/downloads/rs232ttl.zip)

The maximum recommended distance is around 10 meters at 115200 bps. If higher distances are needed, it's possible to use other standards/protocols (such as RS485) that use differential signaling, so the noise doesn't affect them as much. This method usually requires more wires (5 for full-duplex)
