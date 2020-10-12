<?php
	$descripcionPagina = 'Dados los números presentes en un capacitor, calcula cual es la capacitancia, y su tolerancia.';
	$tituloPagina = 'Calculadora de valor de capacitores';
	
	echo addBoxBeg('Calculadora de valor de capacitores');
?>
<script type="text/javascript">
//

function f(r){
	if(r >= 1000000) return (r/1000000) + " Microfaradios"
	if(r >= 1000) return (r/1000) + " Nanofaradios"
	return r + " Picofaradios";
}

function compute(){
    var r1 = parseInt(document.querySelector("input[name='band01']:checked").value);
	var r2 = parseInt(document.querySelector("input[name='band02']:checked").value);
	var r3 = parseInt(document.querySelector("input[name='band03']:checked").value);
	var r4 = parseInt(document.querySelector("input[name='band04']:checked").value);
	document.querySelector("#c").value = f((r1+r2)*r3);
	document.querySelector("#t").value = r4 + " %";
	
}
document.onreadystatechange = function () {
	if (document.readyState == "complete") {	
		let inputs = document.querySelectorAll("input");
		for (let i = 0; i < inputs.length; i++) {
			inputs[i].addEventListener("input", compute);
			inputs[i].addEventListener("change", compute);
		}

		let selects = document.querySelectorAll("select");
		for (let i = 0; i < selects.length; i++) {
			selects[i].addEventListener("change", compute);
		}
		compute();	
	}
}
//
</script>
<p>Dados los números presentes en un capacitor, esta página calcula cual es la capacitancia, así como su tolerancia.</p>
<form action="" id="ccForm">
<table cellpadding="10" id="colorCode"><tr>
<td>
<b>Primer número:</b><br/>
<input name="band01" type="radio" value="0" class="w3-radio"/> <label class="w3-validate">0</label><br/>
<input name="band01" type="radio" value="10" checked="checked" class="w3-radio"/> <label class="w3-validate">1</label><br/>
<input name="band01" type="radio" value="20" class="w3-radio"/> <label class="w3-validate">2</label><br/>
<input name="band01" type="radio" value="30" class="w3-radio"/> <label class="w3-validate">3</label><br/>
<input name="band01" type="radio" value="40" class="w3-radio"/> <label class="w3-validate">4</label><br/>
<input name="band01" type="radio" value="50" class="w3-radio"/> <label class="w3-validate">5</label><br/>
<input name="band01" type="radio" value="60" class="w3-radio"/> <label class="w3-validate">6</label><br/>
<input name="band01" type="radio" value="70" class="w3-radio"/> <label class="w3-validate">7</label><br/>
<input name="band01" type="radio" value="80" class="w3-radio"/> <label class="w3-validate">8</label><br/>
<input name="band01" type="radio" value="90" class="w3-radio"/> <label class="w3-validate">9</label><br/>
</td>
<td>
<b>Segundo número:</b><br/>
<input name="band02" type="radio" value="0" checked="checked" class="w3-radio"/> <label class="w3-validate">0</label><br/>
<input name="band02" type="radio" value="1" class="w3-radio"/> <label class="w3-validate">1</label><br/>
<input name="band02" type="radio" value="2" class="w3-radio"/> <label class="w3-validate">2</label><br/>
<input name="band02" type="radio" value="3" class="w3-radio"/> <label class="w3-validate">3</label><br/>
<input name="band02" type="radio" value="4" class="w3-radio"/> <label class="w3-validate">4</label><br/>
<input name="band02" type="radio" value="5" class="w3-radio"/> <label class="w3-validate">5</label><br/>
<input name="band02" type="radio" value="6" class="w3-radio"/> <label class="w3-validate">6</label><br/>
<input name="band02" type="radio" value="7" class="w3-radio"/> <label class="w3-validate">7</label><br/>
<input name="band02" type="radio" value="8" class="w3-radio"/> <label class="w3-validate">8</label><br/>
<input name="band02" type="radio" value="9" class="w3-radio"/> <label class="w3-validate">9</label><br/>
</td>
<td valign="top">
<b>Multiplicador:</b><br/>
<input name="band03" type="radio" value="1" checked="checked" class="w3-radio"/> <label class="w3-validate">0</label><br/>
<input name="band03" type="radio" value="10" class="w3-radio"/> <label class="w3-validate">1</label><br/>
<input name="band03" type="radio" value="100" class="w3-radio"/> <label class="w3-validate">2</label><br/>
<input name="band03" type="radio" value="1000" class="w3-radio"/> <label class="w3-validate">3</label><br/>
<input name="band03" type="radio" value="10000" checked="checked" class="w3-radio"/> <label class="w3-validate">4</label><br/>
<input name="band03" type="radio" value="100000" class="w3-radio"/> <label class="w3-validate">5</label><br/>
</td>
<td valign="top">
<b>Tolerancia:</b><br/>
<input name="band04" type="radio" value="0.5pF" checked="checked" class="w3-radio"/> <label class="w3-validate">D</label><br/>
<input name="band04" type="radio" value="1%" class="w3-radio"/> <label class="w3-validate">F</label><br/>
<input name="band04" type="radio" value="2%" class="w3-radio"/> <label class="w3-validate">G</label><br/>
<input name="band04" type="radio" value="3%" class="w3-radio"/> <label class="w3-validate">H</label><br/>
<input name="band04" type="radio" value="5%" class="w3-radio"/> <label class="w3-validate">J</label><br/>
<input name="band04" type="radio" value="10%" class="w3-radio"/> <label class="w3-validate">K</label><br/>
<input name="band04" type="radio" value="20%" class="w3-radio"/> <label class="w3-validate">M</label><br/>
<input name="band04" type="radio" value="+100% -0%" class="w3-radio"/> <label class="w3-validate">P</label><br/>
<input name="band04" type="radio" value="+80% -20%" class="w3-radio"/> <label class="w3-validate">Z</label><br/>
</td>
</tr></table>
<p>C: <input id="c" disabled="disabled" class="w3-input w3-border"/></p>
<p>Tolerancia: <input id="t" disabled="disabled" class="w3-input w3-border"/></p>
</form>
<p>Los capacitores de menor valor por lo general tienen marcado directo su capacitancia en picofaradios (por ejemplo los de 2.2 pF tienen impreso un 2.2).</p>

<?php echo addBoxEnd();?>