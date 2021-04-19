---
title: "DC motor control with H bridge"
tags: ["articles", "electronics"]
summary: "Different ways to control DC motors."
thumbnail: "/thumbs/puenteh.png"
aliases: ["/hbridge_en/"]
---

There are three principal types of motor control:

* On/Off: The motor can spin in one direction or stop
* Off/Forwards/Backwards: The motor can spin in any given direction and stop
* Off/Forwards/Backwards/Brake: Similar to the previous type, but there is an extra state that allows to do a fast brake of the motor, by shorting its terminals

Also, in some cases it's possible to regulate the speed of the motors, for instance via Pulse Width Modulation (PWM) as long as the system allows it (if the control driver is built with slow components such as relays, it might not be feasible).

In the case of needing to use PWM, there is the need of a signal with high enough frequency to avoid hearing it while the motor is running: the electrical signal gets translated into vibration in the motor, so the carrier is often heard. To avoid it, it should be enough to use a frequency higher than 19 KHz. In most cases, the higher the frequency the higher the switching losses.

If the motor specifications aren't that complex, there are a few already built integrated H bridges that have all the control and power stages in one package. For instance, a common one is the L293 and L298.

## H bridge using discrete components
### On/Off
This is the easiest one to make, it can be done with a transistor or a relay:

![OnOff Motor control with transistor](/images/ph1.png)
![OnOff Motor control with relay](/images/ph1_r.png)

As seen, the transistor works as a switch. The diode is needed because the motor is an inductive load, so after abruptly opening the transistor the motor has to release energy as a voltage, possibly damaging the transistor. The diodes should be ultrafast or fast recovery type if the signal is a high frequency PWM. If the relay got activated via a transistor, another diode would be needed as well, to avoid letting the peaks from the relay coil damage the transistor.

The second circuit is similar, but with the main difference that the switching element is the relay. It's simpler, but supports a higher current motor, has less voltage drop, and the motor can use another power supply (its isolated). The main issue is that most relays have a limited life, and high frequency PWM can be used. Also, the relay coil adds another current (hopefully much smaller than the motor one).

### Off/Forwards/Backwards
This is method often use in robots, RC cars, drills and similar stuff. Like the other one, it can also be done using relays.

![Off/Forwards/Backwards control with relays](/images/ph2.png)
![Off/Forwards/Backwards control with transistors](/images/ph2_t.png)

Each relays controls which supply goes connected to which one of the motor terminals, so it gives 4 combinations:
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

This circuit is also known as "smokeable" H-Bridge, since a wrong input can destroy every transistor. That's why it's often used with an external logic to avoid the forbidden states. With good transistors, it might be possible an efficiency of higher than 90%. Also, using transistors allows for velocity changes, using techniques such as PWM or BAM.

### Hybrid H-Bridge
Considering that typically in a system the reversal of direction of a motor isn't ussual, it's possible to combine both systems and make an hybrid one, in which a relay is used to change the direction, and a transistor regulates the speed. This are some advantages and disadvantages of this method:

* Extra current: Higher consumption than the one built with more transistors, but less than the one built with relays
* Efficiency: In the middle, better than the one with transistors, but worse than the one with relays
* Cost: typically lower, also might fit in a smaller board
* Velocity control: Easily controllable using PWM in the switching transistor
* Smoke-less: no combination of inputs destroys the circuit

![Hybrid H-Bridge, with transistors and relays](/images/ph3.png)

This methods may be used for motors and for any other load that might need reversing in polarity. For instance, a peltier cell may be used, in order to change the temperature of an object, allowing to both heat and cool it.
