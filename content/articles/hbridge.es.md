---
title: "Control de motores de continua con puente H"
tags: ["articles", "electronics"]
summary: "Distintas formas de controlar motores de CC."
thumbnail: "/thumbs/puenteh.png"
aliases: ["/puenteh/"]
---

<p>Principalmente, hay tres tipos de control de motor de corriente continua:</p>
<ul>
	<li>Apagado/Prendido: El motor se puede apagar y prender</li>
	<li>Apagado/Adelante/Atrás: El motor se puede apagar y hacer girar en ambas direcciones</li>
	<li>Apagado/Adelante/Atrás/Frenado: Además del anterior, hay un estado extra en el que se gira al motor, cortocircuitando sus terminales</li>
</ul>
<p>Además, en algunos casos es posible controlar la velocidad de los motores, por ejemplo mediante una modulación de ancho de pulso (PWM), siempre que el sistema lo permita (si está hecho con componentes lentos como relés, no se podrá realizar).</p>
<p>En el caso de desear utilizar PWM, será necesario generar la señal con una frecuencia suficientemente alta para que no se escuche la portadora cuando está funcionando el motor. Por lo general, una frecuencia de más de 19 KHz es suficiente. Cabe aclarar que una mayor frecuencia casi siempre implica mayor pérdida en los elementos que interrumpen la corriente del motor.</p>
<p>Si las especificaciones del motor no son muy complejas, es posible encontrar diversos puentes H integrados que realizan todo el control y la parte de potencia en un mismo encapsulado, evitando la necesidad de diseñarlo. Por ejemplo, uno común es el L293D y el L298.</p>
<h2>Puente H a partir de componentes discretos</h2>
<h3>Primer modo: Apagado/Prendido</h3>
<p>Este es el modo más sencillo, se puede realizar tanto con un transistor como con un relé:</p>
<p><img src="/images/ph1.png" alt="Control apagado-prendido de motor con transistor" style="width:49%;max-width:224px;"/>
   <img src="/images/ph1_r.png" alt="Control apagado-prendido de motor con relé" style="width:49%;max-width:197px;"/>
</p>
<p>Como se puede ver en el primer circuito, es un transistor operando como interruptor. El diodo es necesario porque, al ser el motor una carga inductiva, cuando se le corta la tensión retiene parte de la energía y la libera en el sentido inverso, lo que podría quemar los transistores. Los diodos deberían ser del tipo "recuperación rápida" o ultrarrápida si la señal de comando usa PWM, en particular si la frecuencia de la señal de control es muy alta. Si el relé se activa mediante un transistor, también será necesario un diodo para que los picos inductivos del relé no quemen al transistor.</p>
<p>El segundo circuito es similar, con la diferencia que el elemento de control es el relé. Es mucho más sencillo, soporta un motor de mucha más corriente, tiene menos caída de tensión y el motor puede utilizar otra fuente de tensión (es decir, está teóricamente aislado). El problema es que los relé tienen una vida útil limitada, no se puede usar PWM de alta frecuencia, y la bobina del relé agrega un consumo considerable en el caso que se manejen motores de baja corriente.</p>
<h3>Segundo modo: Apagado/Adelante/Atrás</h3>
<p>Este método es interesante porque se puede usar para realizar robots, autos radio controlados, entre muchas otras cosas. Al igual que el anterior, se puede realizar con transistores como con relés:</p>
<p><img src="/images/ph2.png" alt="Control apagado-adelante-atrás con relés" style="width:49%;max-width:362px;"/>
   <img src="/images/ph2_t.png" alt="Control apagado-adelante-atrás con transistores" style="width:49%;max-width:400px;"/>
</p>
<p>En el primer circuito, cada relé controla a qué tensión va conectada cada una de las terminales del motor, por lo que hay 4 combinaciones:</p>
<table>
	<tr><td class="f">Relé izquierdo</td><td class="f">Relé derecho</td><td class="f">Resultado</td></tr>
	<tr><td>Apagado</td><td>Apagado</td><td>Motor frenado</td></tr>
	<tr><td>Apagado</td><td>Prendido</td><td>Motor girando para adelante</td></tr>
	<tr><td>Prendido</td><td>Apagado</td><td>Motor girando para atrás</td></tr>
	<tr><td>Prendido</td><td>Prendido</td><td>Motor frenado</td></tr>
</table>
<p>En el segundo circuito, cada transistor interrumpe o deja pasar corriente al motor, por lo que hay 16 combinaciones:</p>
<table>
	<tr><td class="f">A</td><td class="f">B</td><td class="f">C</td><td class="f">D</td><td class="f">Resultado</td></tr>
	<tr><td>0</td><td>0</td><td>0</td><td>0</td><td>Motor cortocircuitado a +V</td></tr>
	<tr><td>0</td><td>0</td><td>0</td><td>1</td><td><strong>CORTOCIRCUITO</strong></td></tr>
	<tr><td>0</td><td>0</td><td>1</td><td>0</td><td>Motor flotando</td></tr>
	<tr><td>0</td><td>0</td><td>1</td><td>1</td><td>Motor girando para adelante</td></tr>
	<tr><td>0</td><td>1</td><td>0</td><td>0</td><td><strong>CORTOCIRCUITO</strong></td></tr>
	<tr><td>0</td><td>1</td><td>0</td><td>1</td><td><strong>CORTOCIRCUITO</strong></td></tr>
	<tr><td>0</td><td>1</td><td>1</td><td>0</td><td><strong>CORTOCIRCUITO</strong></td></tr>
	<tr><td>0</td><td>1</td><td>1</td><td>1</td><td><strong>CORTOCIRCUITO</strong></td></tr>
	<tr><td>1</td><td>0</td><td>0</td><td>0</td><td>Motor flotando</td></tr>
	<tr><td>1</td><td>0</td><td>0</td><td>1</td><td><strong>CORTOCIRCUITO</strong></td></tr>
	<tr><td>1</td><td>0</td><td>1</td><td>0</td><td>Motor flotando</td></tr>
	<tr><td>1</td><td>0</td><td>1</td><td>1</td><td>Motor flotando</td></tr>
	<tr><td>1</td><td>1</td><td>0</td><td>0</td><td>Motor girando para atrás</td></tr>
	<tr><td>1</td><td>1</td><td>0</td><td>1</td><td><strong>CORTOCIRCUITO</strong></td></tr>
	<tr><td>1</td><td>1</td><td>1</td><td>0</td><td>Motor flotando</td></tr>
	<tr><td>1</td><td>1</td><td>1</td><td>1</td><td>Motor cortocircuitado a masa</td></tr>
</table>
<p>Como se puede ver, este circuito también se lo conoce con el nombre de Puente H "quemable", porque una entrada puede quemar todos los transistores. Por esto se le acopla lógica externa para evitar que esto suceda. Con transistores buenos (poco VCEmin) es posible lograr un rendimiento del orden del 90%, a diferencia de los relés, cuya corriente de bobina reduce el rendimiento. Además, con los transistores es posible regular la velocidad del motor, usando PWM.</p>
<h3>Tercer modo: Híbrido</h3>
<p>Considerando que por lo general en un sistema es poco frecuente el cambio de dirección de un motor, es posible combinar los dos sistemas anteriores y hacer un híbrido, en el que un relé se use para cambiar la dirección, y un transistor para variar la velocidad. Este método está en el medio de los dos:</p>
<ul>
	<li>Corriente extra: consume más que el puente H puro con transistores, pero menos que el hecho todo con relés</li>
	<li>Rendimiento: tiene una caída de tensión media, más que el hecho con relés, pero menos que el hecho con transistores</li>
	<li>Costo: al necesitar solamente dos transistores (solamente uno de potencia) y un relé, es bastante barato</li>
	<li>Control de velocidad: Es posible controlarla usando PWM en el transistor que apaga y prende el motor</li>
	<li>Facilidad de uso: No hay una combinación en la que exploten los transistores</li>
</ul>
<p><img src="/images/ph3.png" alt="Puente H híbrido con transistores y relés" style="width:100%;max-width:300px;"/>
</p>
<p>Estos métodos pueden ser utilizados tanto con motores como con cualquier otra carga a la que sea necesario cambiar su polaridad, como por ejemplo una celda peltier. Sería posible controlar la temperatura via PWM (con un lazo de realimentación) y además invertir su polaridad, para hacer que caliente en vez de enfriar.</p>
