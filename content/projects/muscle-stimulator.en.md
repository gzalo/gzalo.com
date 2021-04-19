---
title: "Muscular electrostimulator"
summary: "Muscular electrostimulator controlled by a microcontroller"
thumbnail: "/thumbs/muscle-stimulator.png"
aliases: ["/electrostimulator_en/"]
date: "2011-01-01"
---

![Muscle stimulator](/images/electro4.jpg)

**The following information is given without any warranty, I'm not responsible for possible accidents. The project involves high voltages, which can lead to severe accidents and even death.**

The electrostimulator is formed by three main blocks: a voltage booster, a controller and a high voltage control stage.

## Voltage booster
The booster is built using a flyback type inverter:
![Flyback inverter](/images/inversor.jpg)

The transformer used is a 220V-6V, connected in such a way that outputs more voltage in the output. The zener diode limits the voltage to around 100V DC.

## Controller
A controller was designed using the AT89S52 microcontroller. It generates the different waveforms according to the selected program. It also has a small user interface to change modes. The different waveforms are generated via Pulse density modulation.

## High voltage control
To handle the high voltage outputs from the microcontroller, 4 high speed optocouplers were used, as well as two pairs of 2N5401 and 2N5551 transistors to create an H-bridge.

The electrodes used are the following:
![Electrodes for electrostimulator](/images/electro1.jpg)

They get connected to the stimulator using banana-banana wires. To improve conductivity and require less voltage, applying a small amount of neutral gel (conductive fluid) is suggested.
