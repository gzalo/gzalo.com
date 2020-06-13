<?php
	$descripcionPagina = '';
	$tituloPagina = 'Introduction to PIC microcontrollers';
	$lang = 'en';	
	echo addBoxBeg('Introduction to PIC microcontrollers');
?>
<p>In order to define a PIC microcontroller, we will first need to know what a microcontroller is. In broad strokes, it's an integrated circuit that has most of the stuff a computer has:<ul>
  <li><strong>CPU:</strong> processes and executes every instruction. Them main parameters are the maximum speed it supports and the width of the data bus it has, which generally defines de width of the internal registers. In most microcontrollers, CPUs are orders of magnitude slower in comparison with typical PC CPUs, and typically 8 to 16 bits.</li><li><strong>Memory:</strong> holds both the program instructions as well as the data space that will be used by the program to store temporal data (RAM). Typically, microcontrollers have their program stored in an EEPROM/Flash memory.</li><li><strong>Peripherals:</strong>
    <ul>
      <li><strong>General purpose input/output ports </strong>(<em>GPIO</em>)<strong>:</strong> are tipically in groups of 8, they let the microcontroller read and write external signals. They usually control external devices such as LEDs, relays, switches, or any other digital components.</li>
<li><strong>Analog inputs:</strong> most microcontrollers feature ADC converters which allow to work with analog signals. Their main parameters are the maximum sampling speed and the resolution. Both parameters defines the maximum frequency of the signal that can be sampled, as well as the sensitivity and signal to noise ratio in the quantization process.</li>
<li><strong>Timers and counters:</strong> they are synchronic circuits that allow the microcontroller to count internal time (timer) or count external pulses (counters). Some of them can also be used to generated clock signals, measure frequency and period, generate a PWM signal, read a quadrature encoded signal, etc. Most of them have an interrupt line, which can interrupt the CPU when a certain event happens, for instance, when the timer overflows.</li>
<li><strong>
  Non volatile memories:</strong> some microcontrollers also feature internal EEPROM memory, usually used to store configuration data that needs to be preserved even if the energy gets removed. Also, some microcontrollers can self program their program memory.</li>
<li><strong>
  PWM module:</strong> basically generates a PWM signal, with different frequency and duty cycle according to the value set in different registers. It can be used to regulate motor speeds, do a digital to analog conversion, regulate intensity of lights, make sounds, among other applications.</li>
<li><strong>
  Comparators:</strong> they are peripherals which allow for the comparison of two analog signals. On some microcontrollers, one of the signals can be generated internally by a voltage reference. The output result of the comparison is binary and can be read by the micro, and some even support generating interrupts when the comparison goes into one certain state.</li>
<li><strong>
  Communication ports: </strong> most of the microcontrollers feature one or more UART/USARTs, which allow for easy communication between the microcontroller and external peripherals. Most of them support at least a serial (both synchronic and asynchronic) and some even support other protocols such as I2C, SPI, USB, Ethernet, among others.</li>
</ul></li></ul></p>
The main advantage of microcontrollers over microprocessors is that they cost less, have lower power consumption and they don't need much external circuitry in order to work. PIC microcontrollers are usually chosen because of their simple architecture, their low cost and great amount of code available in the web, as well as the great amount of tools to program them.
<p>
  This article is oriented to low/middle tier PICs, mainly the 16F series. They can handle natively 8 bit data, and are based in a Hardvard architecture: the program memory is separated from the data memory.
</p>
<p>
To start with a small project with PIC, we need three main things:
<ul>
<li>A program to compile code into instructions that the microcontroller understands (compiler/assembler)</li>
<li>Components to try the circuits, or a simulator</li>
<li>Patience, lots of it</li>
</ul>
</p>
For instance, the PIC16F628A doesn't have much peripherals, but it's a nice choice to enter the world of microcontrollers. It has 2K of program memory, 224 bytes of RAM and 128 bytes of EEPROM memory.
<p>The models have different identification codes:</p>
<ul>
<li>First field: model</li>
<li>Second field: Temperature and voltage range (I = industrial, E = extended)</li>
<li>Third field (optional): Maximum supported speed (4/20/45) - measured in MHz</li>
<li>Fourth field: Package format (ML = QFN, P = PDIP, SO = SOIC, SS = SSOP) </li>
</ul>
<img src="/images/modelospic.png" alt="Code description for PICs" style="width:100%;max-width:279px;"/>
<h3>How to make a program for a microcontroller</h3>
<p>There are three basic ways to do it: in C, in Basic and in Assembler</p>
<p>To compile the C code, the main used program is CCS, a C compiler for Microchip microcontrollers, which works quickly and good. The issue is that it's paid. The typical program in a microcontroller is the blinking of a LED, since it can show that the environment, compiler and programmer are all working fine.</p>
<p>In C, the program used is quite easy to understand:</p>
<pre><code>
#include &lt;16f628a.h> //Which microcontroller we have
#use delay(clock=4000000) //To use the delay routines, we need to tell the compiler we're running at 4MHz

void main(){
	while(true){
		output_high(PIN_A0); //Prendemos la línea A0
		delay_ms(500); //Esperamos medio segundo
		output_low(PIN_A0); //Apagamos la línea A0
		delay_ms(500); //Esperamos medio segundo
	}
}
</code></pre>
<p>The compiled C program used 52 Words</p>
<p>To use Basic, a simple IDE that features a basic compiler is called PIC SIMULATOR IDE, it's paid as well. The code used was the following:</p>
<pre><code>
main:
	High PORTA.0
	WaitMs 500
	Low PORTA.0
	WaitMs 500
	Goto main
</code></pre>
<p>The compiled program used 66 Words</p>
<p>To program it in Assembly, MPLAB IDE can be used, as well as the free and open alternative gputils. The assembled program used less words than both shown, but is harder to maintain.</p>
<h3>How to transfer the HEX file to the microcontroller</h3>
<p>A PIC programmer (sometimes called burner) is needed. One of the cheaper ones is called JDM, and connects to the PC using serial port. There are also multiple official programmers, such as PicKit series, as well as clones of those. Special caution is needed before programming, since there are some fuses that can make the microcontroller not programmable anymore.</p>
<p>Some typical used programs are IC-Prog, Pony Prog, WinPic800, PicPGM. Most of them support different types of programmers.</p>
<p>There are also solutions that use ZIF sockets, to avoid terminal rupture after several insertion cycles.</p>
<p>Also, most microcontrollers allow for In-Circuit Programming, which allows for reprogramming the microcontroller without removing it from the circuit. This needs five connections that connect it to the programmer</p>
<p>This lines are the ones called Vpp, Vss, Vdd, Pgd and Pgc. If those lines were used by external circuitry, protection components may be needed, since they get driven as outputs.</p>
<img src="/images/picpinout.jpg" style="width:100%;max-width:442px;"/>
<p>A simple PIC test schematic is the following:</p>
<img src="/images/piccircuit.png" style="width:100%;max-width:400px;"/>
<p>Components:
	<ul>
		<li>D1 is a rectifier diode, avoids burning the microcontroller if the voltage is reversed.</li>
		<li>IC1 regulates the input voltage to 5 v, needed by the microcontroller to correctly run. C1 and C2 act as filters and smooth the output voltage.</li>
		<li>The PIC is connected to the 5 v supply as well as ground, and from terminal 17 (bit 0 of port A, RA0) a LED and a resistor are connected to ground. The resistor limits the current flowing through the LED, protecting it and the microcontroller.</li>
	</ul>
</p>
<?php echo addBoxEnd();?>