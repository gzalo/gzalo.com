---
title: "Compiling programs with GNU compilers"
tags: ["articles", "programming"]
summary: "How to use the free GNU compilers to build C/C++ projects."
thumbnail: "/thumbs/compiladores_gnu.png"
aliases: ["/gnu_compilers_en/"]
date: "2010-01-01"
---

The programs of a project are typically built using many source code files, with `.c` or `.cpp` extension (in case of C++). Compiling each one of those creates `.o` (object files), which contain the translation of the source code into machine code.

After all the `.o` files are created (and also the `.a` that correspond to dynamic libraries), it's necessary to join them to create the final executable file, by using a linker. This tool joins all the files in such a way that the cross-references work fine.

The complete process can be seen in this image:

![Compile and link process](/images/com_enlazado.png)

In the GCC implementation (which can be used in Linux as well as in Windows using Mingw), the compiler executable is called `gcc` and can be used for both the compile process and the linking.

For instance, if we wanted to create the program called `Programa.exe` as the image shows, this would be the required steps:

* Compiling Archivo1.c into Archivo1.o. This can be done with the following command: `gcc Archivo1.c -o Archivo1.o`
* Compiling Archivo2.c, using a similar step: `gcc Archivo2.c -o Archivo2.o`
* Finally, we link the three files (two .o and the .a library) using the command `gcc Archivo1.o Archivo2.o Lib1.a -o Programa.exe`

After this last step, if there were no errors, the executable will be created.

If we needed to compile C++ files, changing `gcc` to `g++` should be enough.

The compilation process could be automated using a batch file containing all the commands to execute (in order, one per line). But a better idea is to use a tool called `make`, that allows for easier compiling: for instance, it can be used to recompile only the changed files, thus reducing the total time.
