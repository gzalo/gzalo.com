---
title: ""
tags: ["articles", "electronics"]
summary: ""
thumbnail: "/thumbs/.png"
aliases: ["//"]
---
addProjectBox('DC motor control with H bridge', 'Different ways to control DC motors.','/thumbs/puenteh.png','/hbridge_en/');

$tituloPagina = 'DC motor control with H bridge';
<p>There are three principal types of motor control:</p>
<ul>
	<li>On/Off: The motor can spin in one direction or stop</li>
	<li>Off/Forwards/Backwards: The motor can spin in any given direction and stop</li>
	<li>Off/Forwards/Backwards/Brake: Similar to the previous type, but there is an extra state that allows to do a fast brake of the motor, by shorting its terminals</li>
</ul>
<p>Also, in some cases it's possible to regulate the speed of the motors, for instance via Pulse Width Modulation (PWM) as long as the system allows it (if the control driver is built with slow components such as relays, it might not be feasible).</p>
<p>In the case of needing to use PWM, there is the need of a signal with high enough frequency to avoid hearing it while the motor is running: the electrical signal gets translated into vibration in the motor, so the carrier is often heard. To avoid it, it should be enough to use a frequency higher than 19 KHz. In most cases, the higher the frequency the higher the switching losses.</p>
<p>If the motor specifications aren't that complex, there are a few already built integrated H bridges that have all the control and power stages in one package. For instance, a common one is the L293 and L298.</p>
<h2>H bridge using discrete components</h2>
<h3>On/Off</h3>
<p>This is the easiest one to make, it can be done with a transistor or a relay:</p>
<p><img src="/images/ph1.png" alt="OnOff Motor control with transistor" style="width:49%;max-width:224px;"/>
   <img src="/images/ph1_r.png" alt="OnOff Motor control with relay" style="width:49%;max-width:197px;"/>
</p>
<p>As seen, the transistor works as a switch. The diode is needed because the motor is an inductive load, so after abruptly opening the transistor the motor has to release energy as a voltage, possibly damaging the transistor. The diodes should be ultrafast or fast recovery type if the signal is a high frequency PWM. If the relay got activated via a transistor, another diode would be needed as well, to avoid letting the peaks from the relay coil damage the transistor.</p>
<p>The second circuit is similar, but with the main difference that the switching element is the relay. It's simpler, but supports a higher current motor, has less voltage drop, and the motor can use another power supply (its isolated). The main issue is that most relays have a limited life, and high frequency PWM can be used. Also, the relay coil adds another current (hopefully much smaller than the motor one).</p>
<h3>Off/Forwards/Backwards</h3>
<p>This is method often use in robots, RC cars, drills and similar stuff. Like the other one, it can also be done using relays.</p>
<p><img src="/images/ph2.png" alt="Off/Forwards/Backwards control with relays" style="width:49%;max-width:362px;"/>
   <img src="/images/ph2_t.png" alt="Off/Forwards/Backwards control with transistors" style="width:49%;max-width:400px;"/>
</p>
<p>Each relays controls which supply goes connected to which one of the motor terminals, so it gives 4 combinations:</p>
<table>
	<tr><td class="f">Left relay</td><td class="f">Right Relay</td><td class="f">Result</td></tr>
	<tr><td>Off</td><td>Off</td><td>Motor brake</td></tr>
	<tr><td>Off</td><td>On</td><td>Motor spinning forwards</td></tr>
	<tr><td>On</td><td>Off</td><td>Motor spinning backwards</td></tr>
	<tr><td>On</td><td>On</td><td>Motor brake</td></tr>
</table>
<p>In the second circuit, each transistor interrupts or lets the current flow in the motor, creating 16 combinations:</p>
<table>
	<tr><td class="f">A</td><td class="f">B</td><td class="f">C</td><td class="f">D</td><td class="f">Result</td></tr>
	<tr><td>0</td><td>0</td><td>0</td><td>0</td><td>Motor shorted to +V</td></tr>
	<tr><td>0</td><td>0</td><td>0</td><td>1</td><td><strong>SHORTCIRCUIT</strong></td></tr>
	<tr><td>0</td><td>0</td><td>1</td><td>0</td><td>Motor floating</td></tr>
	<tr><td>0</td><td>0</td><td>1</td><td>1</td><td>Motor spinning forwards</td></tr>
	<tr><td>0</td><td>1</td><td>0</td><td>0</td><td><strong>SHORTCIRCUIT</strong></td></tr>
	<tr><td>0</td><td>1</td><td>0</td><td>1</td><td><strong>SHORTCIRCUIT</strong></td></tr>
	<tr><td>0</td><td>1</td><td>1</td><td>0</td><td><strong>SHORTCIRCUIT</strong></td></tr>
	<tr><td>0</td><td>1</td><td>1</td><td>1</td><td><strong>SHORTCIRCUIT</strong></td></tr>
	<tr><td>1</td><td>0</td><td>0</td><td>0</td><td>Motor floating</td></tr>
	<tr><td>1</td><td>0</td><td>0</td><td>1</td><td><strong>SHORTCIRCUIT</strong></td></tr>
	<tr><td>1</td><td>0</td><td>1</td><td>0</td><td>Motor floating</td></tr>
	<tr><td>1</td><td>0</td><td>1</td><td>1</td><td>Motor floating</td></tr>
	<tr><td>1</td><td>1</td><td>0</td><td>0</td><td>Motor spinning backwards</td></tr>
	<tr><td>1</td><td>1</td><td>0</td><td>1</td><td><strong>SHORTCIRCUIT</strong></td></tr>
	<tr><td>1</td><td>1</td><td>1</td><td>0</td><td>Motor floating</td></tr>
	<tr><td>1</td><td>1</td><td>1</td><td>1</td><td>Motor shorted to ground</td></tr>
</table>
<p>This circuit is also known as "smokeable" H-Bridge, since a wrong input can destroy every transistor. That's why it's often used with an external logic to avoid the forbidden states. With good transistors, it might be possible an efficiency of higher than 90%. Also, using transistors allows for velocity changes, using techniques such as PWM or BAM.</p>
<h3>Hybrid H-Bridge</h3>
<p>Considering that typically in a system the reversal of direction of a motor isn't ussual, it's possible to combine both systems and make an hybrid one, in which a relay is used to change the direction, and a transistor regulates the speed. This are some advantages and disadvantages of this method:</p>
<ul>
	<li>Extra current: Higher consumption than the one built with more transistors, but less than the one built with relays</li>
	<li>Efficiency: In the middle, better than the one with transistors, but worse than the one with relays</li>
	<li>Cost: typically lower, also might fit in a smaller board</li>
	<li>Velocity control: Easily controllable using PWM in the switching transistor</li>
	<li>Smoke-less: no combination of inputs destroys the circuit</li>
</ul>
<p><img src="/images/ph3.png" alt="Hybrid H-Bridge, with transistors and relays" style="width:100%;max-width:300px;"/>
</p>
<p>This methods may be used for motors and for any other load that might need reversing in polarity. For instance, a peltier cell may be used, in order to change the temperature of an object, allowing to both heat and cool it.</p>
