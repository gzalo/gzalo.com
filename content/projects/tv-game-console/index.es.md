---
title: "Mini consola de juegos con salida a TV (2012)"
summary: "Aplicación de prueba para generar señales NTSC (blanco y negro) que pueden ser vistas en cualquier televisión con entrada de video compuesta. Basado en un microcontrolador 8052."
thumbnail: "/thumbs/consolatetris.png"
aliases: ["/consola_tv/"]
date: "2012-01-01"
---
Unos años luego de diseñar y armar la [miniconsola con matriz de LEDs](({{< ref "/projects/game-console" >}})), encontré un artículo muy interesante que explica una forma sencilla de generar señales NTSC blanco y negro utilizando microcontroladores baratos. El artículo ya no está más en el sitio original pero [puede encontrarse aquí](https://web.archive.org/web/20100221181006/https://www.rickard.gunee.com/projects/video/pic/howto.php).

Utilizando la idea de usar dos resistencias para generar 4 valores y así poder generar la señal de sincronismo y 3 colores (blanco, negro, gris), adapté la miniconsola para tener salida de video compuesto. Basicamente fue necesario agregar un buffer, porque la corriente de salida del microcontrolador AT89S52 no es suficiente para hacer un correcto manejo de la señal (que tiene impedancia 75 ohms).

En cuanto al software, se aprovechó el hecho de que muchos televisores y placas capturadoras no requieren la señal completa de sincronismo vertical, utilizando por lo tanto ese tiempo para actualizar la *lógica del juego*. Se usó la memoria accesible en forma de bits, para lograr extraer los bits del framebuffer de una manera eficiente. Además, se podría llegar a usar la UART del microcontrolador en modo sincrónico, y de esa forma tener mucha mejor resolución horizontal. En el prototipo se llegó a una resolución de 30x32 pixeles sin problemas. Para usar mayor resolución sería necesario también agregar más memoria RAM al microcontrolador.

[El código funcionando puede encontrarse en el mismo repositorio que contiene los datos de la mini consola original.](https://github.com/gzalo/minigameconsole)

Un código similar al usado para el manejo de la parte de salida de video es el siguiente:

```c
#define BitSync P1_0
#define BitColor P3_0

__idata __at(0x80) unsigned char frameBuffer[30*4];  //Framebuffer que contiene los pixeles a mostrar
unsigned char line=0,i,j,k;

__bit bit00, bit01, bit02, bit03, bit04, bit05, bit06, bit07, 
	  bit08, bit09, bit10, bit11, bit12, bit13, bit14, bit15, 
	  bit16, bit17, bit18, bit19, bit20, bit21, bit22, bit23, 
	  bit24, bit25, bit26, bit27, bit28, bit29, bit30, bit31;
unsigned char __at(0x20) currentByte[4];	
//La idea es que estos 4 bytes (la información de la línea actual) se pueda acceder de a bits

void hsync(void) __interrupt(TF0_VECTOR) __naked{
	__asm
		setb	_P1_0
		inc	_line
		mov	a,_line
		rrc	a
		anl a,#0x7C		;Para que comienze en la posicion vertical correcta
		add	a,#0xF8+_frameBuffer
		mov	r1,a
		clr	_P1_0
	
		;Cargamos los datos de la linea actual
		mov	_currentByte,@r1	
		inc r1
		mov	_currentByte+1,@r1
		inc r1
		mov	_currentByte+2,@r1
		inc r1
		mov	_currentByte+3,@r1
		nop
	__endasm;
		
	//Sacamos por el pin los datos de la línea actual, en el orden correcto
	BitColor = bit07;		
	BitColor = bit06;
	BitColor = bit05;
	BitColor = bit04;
	BitColor = bit03;
	BitColor = bit02;
	BitColor = bit01;
	BitColor = bit00;
	BitColor = bit15;
	BitColor = bit14;
	BitColor = bit13;
	BitColor = bit12;
	BitColor = bit11;
	BitColor = bit10;
	BitColor = bit09;
	BitColor = bit08;
	BitColor = bit23;
	BitColor = bit22;
	BitColor = bit21;
	BitColor = bit20;
	BitColor = bit19;
	BitColor = bit18;
	BitColor = bit17;
	BitColor = bit16;		
	BitColor = bit31;
	BitColor = bit30;
	BitColor = bit29;
	BitColor = bit28;
	BitColor = bit27;
	BitColor = bit26;
	__asm;	
		nop
		nop
	__endasm;
	BitColor = 1;
	
	if(line == 0){
		BitSync = 1;
		P1_1 = 1;

		TR1 = 0;
		TH1 = 0xFF-10;
		TL1 = 0xF0;		
		TR1 = 1;
		//Usamos el timer1 para contar el tiempo de VSYNC
		
		gameLogic();	//Ejecutamos la lógica del juego (asumimos que la función se ejecuta en menos del tiempo de VSYNC)
		while(!TF1);	//Esperamos hasta que se haya cumplido el tiempo de VSYNC
		TR1 = 0;
		TF1 = 0;
	
		
		BitSync = 0;
		P1_1 = 0;
	}
	__asm;
		reti
	__endasm;
}

int main(){
	unsigned char i;
	frameBuffer[0] = frameBuffer[1] = frameBuffer[2] = frameBuffer[3] = 0x00;
	frameBuffer[116] = frameBuffer[117] = frameBuffer[118] = frameBuffer[119] = 0x00;
	for(i=4;i<116;i+=4) 
		frameBuffer[i] = 0x7F,frameBuffer[i+1] = 0xFF,
		frameBuffer[i+2] = 0xFF, frameBuffer[i+3] = 0xF8;
		
	TMOD = T0_M1 | T1_M0;
	TH0 = 128; //Timer0 interrumpe cada 64 uS (HSYNC)
	IT0 = 1;
	
	TR0 = 1;
	
	EA = 1;
	ET0 = 1;

	SCON = 0;
	
	while(1);
}
```

Algunos resultados pueden observarse en estos GIFs animados, capturados con una capturadora de video Aimslab VHX. Se usó el mismo código de la miniconsola, por lo que la resolución del juego sigue siendo 8x8 (aunque es posible adaptarlo y usar todos los 30x32 píxeles sin problemas)

![Vid1](/images/consolaAuto.gif)
![Vid2](/images/consolaChopper.gif)
![Vid3](/images/consolaMenu.gif)
![Vid4](/images/consolaTetris.gif)
