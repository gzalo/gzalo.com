<?php
	$descripcionPagina = 'Finales de Algoritmos y Programación I (Cátedra: Mónica Kuhn, FIUBA)';
	$tituloPagina = 'Finales de Algoritmos y Programación I (Kuhn)';
	
	echo addBoxBeg('Finales de Algoritmos y Programación I (Kuhn) para Ingeniería Electrónica');
?>
<h2>Final 10 de agosto de 2015</h2>
<p>Se define una estructura <i>tnodo</i> con un cierto campo "valor" (de cualquier tipo) y "*sig", puntero a <i>tnodo</i>. Hay dos vectores de punteros, <pre><code>tnodo *VE[100], tnodo *VCOL[100]</code></pre>. El primero es un vector de punteros a listas (de distintas longitudes -obviamente pueden haber 2 o más con la misma longitud-), con NULL en la última posición.<br/>
Hay que hace un procedimiento <pre><code>void elim_cols(tnodo *VE, tnodo *VCOL)</code></pre> que realice lo siguiente: Que desenganche (removiéndolas de la lista correspondiente) las "columnas" impares de cada lista (formadas por los nodos del vector de listas que estén a una misma "profundidad"), y las enganche entre sí, guardando el primer nodo de cada columna en un puntero de una posición del vector de VCOL. Es decir que el <i>*sig</i> de cada nodo de cada columna impar, debe apuntar al nodo "de abajo" de la columna, y el nodo anterior (el de la columna par) debe apuntar al nodo siguiente al de la columna impar. Los nodos finales de cada lista tendrán <i>sig=NULL</i>.</p>
<p>Realizar una función que ordene un vector usando solamente <strong>recursividad</strong>, aplicando el método de <i>Selección</i>. La función puede recibir por parámetro <strong>solamente</strong> al vector y a su cantidad de elementos. Todas las sub-funciones que se usen deben usar recursividad (pueden recibir más variables por parámetro). No se puede usar nada iterativo.</p>
<h2>Final 4 de julio de 2013</h2>
<p>Hay dos listas de personas, una de padres y una de hijos.</p>
<pre><code>
struct persona{
	char nombre[20];
	char antecesor[20];
	persona *sig;
};</code></pre>
<p>hay que escribir un procedimiento <code>void enganchar(persona *padres, persona **hijos);</code> que cambiase la lista de padres de tal manera que la lista quedara de la siguiente forma: A &rarr; 1er hijo de A &rarr; 2do hijo de A &rarr; B &rarr; 1er hijo de B &rarr; C &rarr; NULL</p>
<p>Es decir, que estén los padres ordenados según el mismo orden que la lista original, pero que entre ellos estén todos los hijos correctos.</p>
<p><img src="/extras/algo/algo1_1.png" alt="Final 4 julio 2013 - Ejercicio 1" style="width:100%;max-width:600px"/></p>
<hr/>
<p>Dadas las siguientes estructuras:</p>
<pre><code>struct alumno{
	char nombre[20];
	int nota;
	alumno *sig2;
	alumno *sig;
};
struct materia{
	char nombre[20];
	alumno *prim;
};
</code></pre>
<p>Hay un vector de materias. La última materia tiene un NULL en el campo prim.</p>
<p>Escribir un procedimiento <code>void enganchar(materia *materias, alumno **primer2);</code> que <i>enganche</i> a los alumnos que tienen nota 2, poniendo el primero de ellos en la variable primer2, de tal forma que recorriendo por sig2 pases por todos ellos.</p>
<p><img src="/extras/algo/algo1_2.png" alt="Final 4 julio 2013 - Ejercicio 2" style="width:100%;max-width:600px"/></p>

<h2>Final 8 de julio de 2013</h2>
<p>Dada una matriz cuadrada imprimir las celdas recorriendo en forma de "reloj de arena": <br/><img src="/extras/algo/reloj.png" alt="Reloj" style="width:100%;max-width:200px;"/></p>
<p>Variantes: matriz de ancho par/impar, misma forma de recorrer pero rotada 90º.</p>
<hr/>
<p>Dado un vector de listas, ordenarlas según longitud (cantidad de elementos en la lista):<br/><img src="/extras/algo/ejlunes.png" alt="Ejercicio final lunes 8" style="width:100%;max-width:400px"/></p>
<p>Variantes: sin usar/usando un vector auxiliar para guardar la longitud de cada lista.</p>
<hr>
<p><img src="/extras/algo/diagonales.png" alt="Final" style="width:100%;max-width:600px"/></p>
<p>Dado un vector de listas como se ve en la figura (cuadrado), se pide enganchar la <strong>Diagonal principal</strong> y <strong>secundaria</strong>, descartando esos nodos del vector original y además si hay un nodo compartido (si la longitud es impar), no agregarlo a la diagonal secundaria.</p>
<h2>Extras de otros finales</h2>
<ul>
<li>Ordenamiento de vector de enteros por selección/burbujeo de manera recursiva.</li>
<li>Un archivo tiene muchos enteros, cada uno en una línea. Obtener los 100 valores máximos de ellos, leyendo el archivo 1 sola vez y sin guardarlo todo en memoria. Variantes: cadenas de texto en lugar de enteros</li>
<li>Recorrer una matriz (tanto cuadrada como rectangular) en forma de caracol, tanto de forma iterativa como recursiva.</li>
<li>Enganchar un vector de listas de tal manera que al recorrerla haga forma de Z o X: <img src="/extras/algo/caracoles.png" alt="Caracoles y Z de zorro" style="width:200px;"/> (cada cuadrado representa un nodo, están enganchados horizontalmente)</li>
<li>Enganchar un vector de listas de manera de recorrerlo por <i>columnas</i>, es decir: primer nodo de primera lista &rarr; primer nodo de segunda lista &rarr; ... &rarr; segundo nodo de primera lista &rarr; ...</li>
<li>Dada una matriz de enteros, escribir una función que diga en qué celda (qué fila y columna) es máxima la suma de los valores de las celdas vecinas. Variantes: conectividad4/8 (incluyendo y no incluyendo vecinos en diagonal), warpeado (la matriz es un toroide/dona, los vecinos se repiten horizontal y verticalmente)</li>
</ul>
<p><a href="/downloads/practica_kuhn_ffilippetti.tar.gz" data-no-instant>Ejercicios resueltos por Fernando Filippetti</a></p>
	<h5>Última actualización: Febrero de 2017</h5>
	
	<?php echo addBoxEnd();?>