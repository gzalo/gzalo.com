<?php
	$descripcionPagina = 'Cómo usar las herramientas libres para compilar archivos .c o .cpp.';
	$tituloPagina = 'Compilando programas de C o C++ usando GCC/G++';
	
	echo addBoxBeg('Compilación de programas con compiladores GNU');
?>
<p>Los programas de un proyecto suelen estar compuestos de varios archivos de código fuente, con extensión .c o .cpp (en caso de ser C++). Compilar cada uno de estos archivos resulta en archivos .o, llamados código objeto. Estos archivos contienen el código fuente traducido a código máquina.</p>
<p>Luego de tener todos los archivos .o resultantes (y los .a que corresponden a librerías dinámicas), es necesario juntarlos para formar el .exe final, usando un enlazador. Este proceso se encarga de unirlos, haciendo que las referencias entre las distintas partes funcione correctamente. </p>
<p>El proceso completo se puede ver en esta imagen:<br/><img src="/images/com_enlazado.png" alt="Proceso de compilación y enlazado" style="width:100%;max-width:471px;"/></p>
<p>En la implementación de compiladores de GCC (tanto el de Linux como el que se puede instalar en Windows mediante Mingw), el ejecutable principal se llama <code>gcc</code>, y se encarga tanto de la compilación como del enlazado.</p>
<p>Supongamos que quisieramos armar el "Programa.exe" como muestra la imagen. Estos serían los pasos:</p>
<ol>
	<li>Primero necesitamos compilar Archivo1.c para generar Archivo1.o. Esto se puede hacer con el siguiente comando: <code>gcc Archivo1.c -o Archivo1.o</code></li>
	<li>Luego necesitamos compilar Archivo2.c, al igual que el paso anterior. Para eso usamos un comando similar: <code>gcc Archivo2.c -o Archivo2.o</code></li>
	<li>Finalmente, enlazamos las tres cosas (los dos .o y la librería .a), mediante el comando <code>gcc Archivo1.o Archivo2.o Lib1.a -o Programa.exe</code></li>
</ol>
<p>Luego de este último paso, si no hubieron errores, se debería haber creado un ejecutable Programa.exe.</p>
<p>Si estuviésemos compilando archivos de C++, cambiar <code>gcc</code> por <code>g++</code>, y las extensiones por .cpp debería ser suficiente.</p>
<p>El proceso de compilación puede ser automatizado usando un archivo .bat que contenga todas los comandos a ejecutar (en orden, uno por línea). También es posible automatizarlo aún más, utilizando una herramienta llamada <code>make</code>, que permite, entre otras cosas, evitar la recompilación de algúnos códigos fuente que no hayan cambiado desde la última compilación.</p>
<p>Palabras clave: compilando con mingw, compilando con dev-cpp, devc++, djgpp, geany, gedit, notepad++, compilación de programas de c++</p>
<?php echo addBoxEnd();?>