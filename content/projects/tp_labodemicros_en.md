'Domotic control via IR and PC (2014)','A domotic panel to control the lights of multiple bedrooms, allowing the user to change the intensity of them via 3 interfaces. This group project was done with Juan Ignacio Troisi and Martin Menendez, for the university subject "Laboratorio de microcontroladores".','/thumbs/controldomotico.png','/tp_labodemicros_en/');

	echo addBoxBeg('Domotic control via PC and infrared');
<p>This group project was done with Juan Ignacio Troisi and Martin Menendez, for the university subject "Laboratorio de microcontroladores". The idea was to make a domotic panel to control the lights of multiple bedrooms, allowing the user to change the intensity of them via 3 interfaces:
<ul>
<li>Using buttons and an alphanumeric display in the control panel, with the ability to set the time and automate the turn on/off of the loads, while also being able to set different permissions for different users. This interface is password protected.</li>
<li>Using a PC, via a USB-TTL adapter. This allows the user to execute the same actions available in the control panel, with the possibility of downloading a log of the last instructions executed, for security purposes.</li>
<li>Using an infrared remote control, which has a built in user identifier. This allows multiple users, and they can have limited permissions, in such a way that not every user is able to modify the state of each load.</li>
</ul></p>
<h2>Implementation details</h2>
<p>In the remote control, an AT89S52 microcontroller was used, as well as buttons, LEDs, infrared LED and a DIP switch. The timer2 was used as a square wave generator, to easily generate the 38KHz carrier needed for the IR amplitude modulation. Low power consumption mode was used to use less current. The protocol used for the data transmition was the following: fixed period signal, with different duty cycle depending if a 0 or a 1 is needed to be sent.<br/>
<img src="/images/ldm_transmisor.png" alt="Domotic control transmitter" style="width:100%;max-width:275px;"/></p>
<p>In the receiver end, another AT89S52 was used, as well as a IS1U60 infrared receiver (which handles the capture, filter and demodulation of the signal), a DS1307 real time clock (with I2C interface) and an alphanumeric LCD. The sofware was developed in assembler, and built with Keil uVision. Almost every resource of the microcontroller got used: nearly all the ram, more than 80% of the code memory, every timer, various interrupt sources and the UART.<br/>
<img src="/images/ldm_receptor.png" alt="Domotic control panel" style="width:100%;max-width:240px;"/></p>
