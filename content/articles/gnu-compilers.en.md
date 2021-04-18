---
title: "Compiling programs with GNU compilers"
tags: ["articles", "programming"]
summary: "How to use the free GNU compilers to build C/C++ projects."
thumbnail: "/thumbs/compiladores_gnu.png"
aliases: ["/gnu_compilers_en/"]
---
<p>The programs of a project are typically based on many source code files, with .c or .cpp (in case of C++) extension. Compiling each one of those creates .o files, called "object files", which contain the source code "translated" into machine code.</p>
<p>After having all the .o files (and the .a that correspond to dynamic libraries), it's necessary to join them to create the final executable, using a linker. This tool joins all the files in such a way that the cross references work fine.</p>
<p>The completed process can be seen in this image:<br/><img src="/images/com_enlazado.png" alt="Compile and link process" style="width:100%;max-width:471px;"/></p>
<p>In the GCC implementation (which can be used in Linux as well as in Windows using Mingw), the compiler executable is called <code>gcc</code> and can be used for both the compile process and the linking.</p>
<p>For instance, if we wanted to create the program called "Programa.exe" as the image shows, this would be the required steps:</p>
<ol>
	<li>Compiling Archivo1.c into Archivo1.o. This can be done with the following command: <code>gcc Archivo1.c -o Archivo1.o</code></li>
	<li>Compiling Archivo2.c, using a similar step: <code>gcc Archivo2.c -o Archivo2.o</code></li>
	<li>Finally, we link the three files (two .o and the .a library) using the command <code>gcc Archivo1.o Archivo2.o Lib1.a -o Programa.exe</code></li>
</ol>
<p>After this last step, if there were no errors, the executable should be created.</p>
<p>If we needed to compile C++ files, changing <code>gcc</code> to <code>g++</code> should be enough.</p>
<p>The compilation process may be automated using a batch file which can contain all the commands to execute (in order, one per line). It's a better idea to use a tool called <code>make</code> which allows for easier compiling: for instance, it can be used to recompile only the changed files, thus reducing the total time.</p>
