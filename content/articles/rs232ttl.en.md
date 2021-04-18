---
title: "Usage of MAX232 for RS232-TTL level shifting"
tags: ["articles", "electronics"]
summary: "A simple circuit used in almost every circuit that needs a connection with a PC."
thumbnail: "/thumbs/rs232ttl.png"
aliases: ["/rs232ttl_en/"]
---
<p>This circuit is widely used in the world of microcontrollers. It basically allows to shift levels between a TTL signal (0 ... 5 V) and a RS232 signal (15 V ... -15 V).
<p>It's built around the MAX232 IC, which is designed specifically for that purpose, needing only four external capacitors to generate higher voltage. 
<p>There are different clones of the MAX232 IC (for instance the HIN232) which have the same functionality but are generally cheaper. It's possible to swap them without any issue.
<img src="/images/placamax.png" alt="Schematic RS232-TTL converter with MAX232" style="width:100%;max-width:600px;"/>
<p>If the TTL signal is low voltage (0...3.3 V) like in some modern microcontrollers (ARM, MIPS, etc), it will be necessary to exchange the MAX232 IC for the MAX3232, which is similar but it works from around 3 volts up. If that IC is not available, it might be posible to use a regular MAX232 with a smaller voltage supply, but the output might not be inside the margins defined by the RS232 standard. 
<img src="/images/lytmax232.png" alt="PCB for RS232-TTL converter with MAX232" style="width:100%;max-width:320px;"/>
<p><a href="/downloads/rs232ttl.zip" >Download schematic and PCB editable in Proteus</a>
<p>The maximum recomended distance is around 10 meters at 115200 bps. If higher distances are needed, it's possible to use another standards (like RS485) which use differential signals, in such a way that the noise doesn't affect as much. This method usually requires more wires (5 for full duplex)
