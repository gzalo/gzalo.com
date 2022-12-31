---
title: "DC motor control with H bridge"
tags: ["articles", "electronics"]
summary: "Different ways to control DC motors."
thumbnail: "/thumbs/puenteh.jpg"
aliases: ["/hbridge_en/"]
date: "2010-01-01"
---

There are three principal types of motor control:

* On/Off: The motor can spin forwards or stop
* Off/Forwards/Backwards: The motor can spin in any given direction or stop
* Off/Forwards/Backwards/Brake: Similar to the previous type, but there is an extra state that allows to quickly slow down the motor, by connecting its pins together.

Also, in some cases, it's possible to regulate the speed of the motors, for instance using Pulse Width Modulation (PWM). This can only be done if system allows it. For example, if the control driver uses slow components such as relays, it might not be feasible.

If PWM is used, its frequency has to be high enough to avoid hearing it while the motor is running: the electrical signal gets translated into vibration in the motor, so the carrier frequency is often heard. To avoid hearing it, using a frequency greater than 19 KHz should be enough. In most cases, the higher the frequency the higher the switching losses.

If the motor doesn't use much power, there are a few already built integrated H bridges that have all the control and power stages in one package. For instance, a common one is the L298, which also comes in prepared modules.

## H bridge using discrete components
### On/Off
This is the easiest one to make, it can use a transistor or a relay:

![OnOff Motor control with transistor](/images/ph1.png)
![OnOff Motor control with relay](/images/ph1_r.png)

The transistor works as a switch. The diode is needed because the motor is an inductive load, so after abruptly opening the transistor the motor has to release energy as a high voltage peak, possibly damaging the transistor. The diodes should be ultrafast or fast recovery type if the signal is a high frequency PWM. If the relay gets activated via a transistor, another diode is be needed as well, to keep the voltage peaks from the relay coil from damaging the transistor.

The second circuit is similar, but here the switching element is the relay. It's simpler, but supports a higher current motor, has less voltage drop, and the motor can use another power supply (as it's isolated). The main issue is that most relays have a limited life (in cycles), and high frequency PWM can't be used here. Also, the relay coil reduces the overall efficiency of the circuit (but ideally the relay coil current is much smaller than the motor current).

### Off/Forwards/Backwards
This method is often used in robots, RC cars and drills. As the previous case, it can also be implemented with relays.

![Off/Forwards/Backwards control with relays](/images/ph2.png)
![Off/Forwards/Backwards control with transistors](/images/ph2_t.png)

Each relay controls which supply (VCC/GND) connects to which one of the motor pins, so it has 4 combinations:

| Left relay | Right Relay | Result |
| - | - | - |
| Off | Off | Motor brakes | 
| Off | On | Motor spinning forwards | 
| On | Off | Motor spinning backwards | 
| On | On | Motor brakes | 

In the second circuit, each transistor interrupts or lets the current flow in the motor, creating 16 combinations:

| A | B | C | D | Result |
| - | - | - | - | ------ |
| 0 | 0 | 0 | 0 | Motor shorted to +V |
| 0 | 0 | 0 | 1 | **SHORTCIRCUIT** |
| 0 | 0 | 1 | 0 | Motor floating |
| 0 | 0 | 1 | 1 | Motor spinning forwards |
| 0 | 1 | 0 | 0 | **SHORTCIRCUIT** |
| 0 | 1 | 0 | 1 | **SHORTCIRCUIT** |
| 0 | 1 | 1 | 0 | **SHORTCIRCUIT** |
| 0 | 1 | 1 | 1 | **SHORTCIRCUIT** |
| 1 | 0 | 0 | 0 | Motor floating |
| 1 | 0 | 0 | 1 | **SHORTCIRCUIT** |
| 1 | 0 | 1 | 0 | Motor floating |
| 1 | 0 | 1 | 1 | Motor floating |
| 1 | 1 | 0 | 0 | Motor spinning backwards |
| 1 | 1 | 0 | 1 | **SHORTCIRCUIT** |
| 1 | 1 | 1 | 0 | Motor floating |
| 1 | 1 | 1 | 1 | Motor shorted to ground |

This circuit is also known as *smokeable* H-Bridge, since a wrong input can destroy every transistor. That's why it's often used with external logic to avoid the forbidden states. With high quality transistors, efficiencies higher than 90% can be achieved. Also, using transistors allows for speed changes, using techniques such as PWM or BAM.

### Hybrid H-Bridge
Considering that typically in a system the direction of a motor isn't changed often, it's possible to combine both systems and make an hybrid one, in which a relay is used to change the direction, and a transistor regulates the speed. These are some advantages and disadvantages of this method:

* Extra current: Higher consumption than the one built with more transistors, but less than the one built with relays
* Efficiency: In the middle, better than the one with transistors, but worse than the one with relays
* Cost: typically lower, also might fit in a smaller board
* Velocity control: Easily controllable using PWM in the switching transistor
* Smoke-less: no combination of inputs destroys the circuit

![Hybrid H-Bridge, with transistors and relays](/images/ph3.png)

Besides motors, this method can be used for any other load that might need reversing its polarity. For instance, a peltier cell could be used to change the temperature of an object, allowing to both heat and cool it.
