---
title: "Introducción a SDL, desarrollando un editor simple de tipografías pixel"
tags: ["articles", "programming"]
summary: "Pequeño tutorial para aprender a usar SDL, en C++."
thumbnail: "/thumbs/sdl.png"
aliases: ["/sdl/"]
date: "2010-01-01"
---
En este pequeño tutorial mostraré como hacer un editor de fuentes píxel de 8x8, útil para diseñar tu propia tipografía estilo "pixel". Usaré C++ y SDL (para acceder a la pantalla y eventos). Conocimiento de C/C++ es recomendado.

![Editor de fuentes pixel 8x8](/images/sdleditor.png)

Primero necesitamos incluir todas los archivos cabecera (headers, extensión .h) de todas las bibliotecas que vayamos a usar en el editor. Estos archivos incluyen prototipos de funciones (dicen como se llaman, la cantidad y tipos de argumentos, el tipo de retorno) y son necesarios para que el compilador pueda escribir correctamente la referencia a lo que necesitemos.

```c
#include <SDL/SDL.h>
#include <fstream>
#include <iostream>
using namespace std;
```
Incluímos la biblioteca principal de SDL, la biblioteca fstream (para trabajar con archivos) y la biblioteca iostream (para trabajar con la consola). Las funciones de estas dos últimas biblioteca están contenidas en un nombre de espacio llamado `std`. Para no tener que escribir `std::` antes de cualquier función (de la stl) que usemos, escribimos `using namespace std;`.
```c
int fuente[8][8];
```
Declaramos un array bidimensional de enteros de 8x8, que contentrá los valores de cada celda (1 si está pintado de negro, 0 si está pintado de blanco). Para mantener las cosas simples, el tamaño de cada glifo será fijo.
```
int main(int argc, char* args[]){
	if(SDL_Init(SDL_INIT_EVERYTHING) != 0){
		cerr << "Error al iniciar SDL" << endl;
		return -1;
	}
```
Declaramos la función principal del programa. Intentamos inicializar la biblioteca SDL. Si falla (es decir, si la función `SDL_Init` devuelve algo distinto de cero, imprimimos un error por la consola.

```c
	SDL_Surface *pantalla = SDL_SetVideoMode( 8*32, 8*32, 32, SDL_SWSURFACE );
	
	if(pantalla == NULL){
		cerr << "Error al crear la superficie de video" << endl;
	}
```
Intentamos crear una ventana de 256*256 píxeles, 32 bits de profundidad y no acelerada por hardware (SW vs HW). Si falla, escribimos un mensaje de error.

```c
SDL_WM_SetCaption("Editor de fuentes",NULL);
```

Cambiamos el título de la ventana.

```c
	bool cerrado=false;	
	int botonApretado = 0;
```	
Declaramos dos variables, una booleana que indica si el programa se sigue ejecutando (para cerrar el programa hay que ponerla en verdadero) y otra que indica si hay algún boton apretado (0=ninguno, 1=izquierdo, 2=derecho).
```c
	while(!cerrado){
```
Siempre que no hayan cerrado la ventana, seguimos haciendo el loop principal.	
```c
SDL_Event event;
while(SDL_PollEvent(&event)){ 
```
Siempre que haya algún evento, lo procesamos.
```c
if(event.type == SDL_QUIT)
	cerrado = true;
```
Si se apretó la X de la ventana, establecemos la variable cerrado en verdadero, así en el próximo frame se cierra.

```c
if(event.type == SDL_MOUSEBUTTONDOWN){
	if(event.button.button == SDL_BUTTON_LEFT)
		botonApretado = 1;
	else if(event.button.button == SDL_BUTTON_RIGHT)
		botonApretado = 2;	
}
```
Si se apretó algún botón, nos fijamos cual fue apretado y establecemos la variable al valor correspondiente.

```c
if(event.type == SDL_MOUSEBUTTONUP)
	botonApretado = 0;
```
Si se soltó algún botón, lo recordamos.

```c
if(botonApretado != 0){ 
	int posX = event.motion.x; 
	int posY = event.motion.y; 
```
Si hay algún botón apretado, almacenamos la posición del mouse.
```c
		if(posX<32*8 && posY<32*8){
			int celdaX = posX/32;
			int celdaY = posY/32;

			if(botonApretado == 1){
				fuente[celdaY][celdaX] = 1;
			}else{
				fuente[celdaY][celdaX] = 0;
			}
		}	
	}
}
```
Si el mouse está dentro de la ventana, calculamos a qué celda corresponde dividiendo la posición por el tamaño de cada celda (32 píxeles en este caso). Si está apretado el botón izquierdo, establecemos el valor a de la celda correspondiente a 1, caso contrario lo ponemos a 0.

```c
	for(int y=0;y<8;y++){
		for(int x=0;x<8;x++){

		SDL_Rect rect;
		rect.x = x*32;
		rect.y = y*32;
		rect.h = 32;
		rect.w = 32;
```
Vamos por cada una de las 8x8 celdas y calculamos la posición de cada cuadrado.

```c
		if(fuente[y][x]==0){
			SDL_FillRect(pantalla,&rect,0x00FFFFFF);
		}else{
			SDL_FillRect(pantalla,&rect,0x00000000);
		}
	}
}
```
Si el valor de la celda estaba en 0, llenamos el rectángulo correspondiente de la pantalla con el color blanco, caso contrario negro.
```c
		SDL_Flip(pantalla);
		SDL_Delay(1);
	}
```
Forzamos a que la ventana se redibuje, esperamos un milisegundo para disminuir un poco el consumo de CPU.

```c
ofstream of("salida.txt");
for(int y=0;y<8;y++){
	for(int x=0;x<8;x++){
		of << fuente[y][x] << ",";
	}
}
of.close();
```
Si llegamos a este punto es porque cerraron la aplicación, por lo que abrimos el archivo "salida.txt" como salida, vamos por cada celda e imprimimos el valor correspondiente. Luego cerramos el archivo.

```c
	SDL_Delay(100);
	system("notepad salida.txt");
```
Esperamos un tiempo y abrimos el archivo con el bloc de notas. No es una solución muy elegante, pero funciona correctamente, y permite copiar rapidamente los valores de los píxeles..
```c
	SDL_Quit();
	return 0;
}
```
Le decimos a SDL que puede devolver toda la memoria que haya usado, y le decimos al sistema operativo que el proceso se terminó correctamente.

Para compilar el código en Windows, es posible usar directamente Mingw32, o una interfaz como CodeBlocks o Dev-Cpp. Es necesario instalar la biblioteca SDL (incluyendo los headers y archivos lib) y agregar "-lsdlmain -lsdl" a la línea de comandos del compilador, para que se incluyan las bibliotecas.

[Descargar código fuente y ejecutable](/downloads/editorfuentes.zip)
