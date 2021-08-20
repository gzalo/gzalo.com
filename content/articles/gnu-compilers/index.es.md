---
title: "Compilación de programas con compiladores GNU"
tags: ["articles", "programming"]
summary: "Cómo usar los compiladores libres de GNU para armar programas en C o C++."
thumbnail: "/thumbs/compiladores_gnu.png"
aliases: ["/compiladores_gnu/"]
date: "2010-01-01"
---

Los programas de un proyecto suelen estar compuestos de varios archivos de código fuente, con extensión .c o .cpp (en caso de ser C++). Compilar cada uno de estos archivos resulta en archivos .o, llamados código objeto. Estos archivos contienen el código fuente traducido a código máquina.

Luego de tener todos los archivos .o resultantes (y los .a que corresponden a bibliotecas dinámicas), es necesario juntarlos para formar el .exe final, usando un enlazador. Este proceso se encarga de unirlos, haciendo que las referencias entre las distintas partes funcione correctamente. 

El proceso completo se puede ver en esta imagen:

![Proceso de compilación y enlazado](/images/com_enlazado.png)

En la implementación de compiladores de GCC (tanto el de Linux como el que se puede instalar en Windows mediante Mingw), el ejecutable principal se llama `gcc`, y se encarga tanto de la compilación como del enlazado.

Supongamos que quisieramos armar el `Programa.exe` como muestra la imagen. Estos serían los pasos:

* Primero necesitamos compilar Archivo1.c para generar Archivo1.o. Esto se puede hacer con el siguiente comando: `gcc Archivo1.c -o Archivo1.o`
* Luego necesitamos compilar Archivo2.c, al igual que el paso anterior. Para eso usamos un comando similar: `gcc Archivo2.c -o Archivo2.o`
* Finalmente, enlazamos las tres cosas (los dos .o y la biblioteca .a), mediante el comando `gcc Archivo1.o Archivo2.o Lib1.a -o Programa.exe`

Luego de este último paso, si no hubieron errores, se debería haber creado un ejecutable Programa.exe.

Si estuviésemos compilando archivos de C++, cambiar `gcc` por `g++`, y las extensiones por .cpp debería ser suficiente.

El proceso de compilación puede ser automatizado usando un archivo .bat que contenga todas los comandos a ejecutar (en orden, uno por línea). También es posible automatizarlo aún más, utilizando una herramienta llamada `make`, que permite, entre otras cosas, evitar la recompilación de algúnos códigos fuente que no hayan cambiado desde la última compilación.

Palabras clave: compilando con mingw, compilando con dev-cpp, devc++, djgpp, geany, gedit, notepad++, compilación de programas de c++