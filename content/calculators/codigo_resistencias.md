	$descripcionPagina = 'Dados los colores de una resistencia, calcula cuánto es su valor y tolerancia.';
	$tituloPagina = 'Calculadora de código de colores de resistencias';
<script type="text/javascript"> 
// 
function f(r){
	if(r > 1000000) return (r/1000000) + " Megaohms"
	if(r > 1000) return (r/1000) + " Kilohms"
	return r;
}

function compute(){
    var r1 = parseInt(document.querySelector("input[name='band01']:checked").value);
	var r2 = parseInt(document.querySelector("input[name='band02']:checked").value);
	var r3 = parseInt(document.querySelector("input[name='band03']:checked").value);
	var r4 = parseInt(document.querySelector("input[name='band04']:checked").value);
	document.querySelector("#r").value = f((r1+r2)*r3);
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
<p>Dados los colores de una resistencia, esta página calcula cuánto es su valor y tolerancia.</p>
<form action="" id="ccForm">
<table cellpadding="10" id="colorCode"><tr>
<td>
<b>Primera banda:</b><br/>
<input class="w3-radio" name="band01" type="radio" value="0" id="b10"/> <label class="w3-validate" class="resBlack" for="b10">0 (negro)</label><br/>
<input class="w3-radio" name="band01" type="radio" value="10" id="b11"/> <label class="w3-validate" class="resBrown" for="b11">1 (marrón)</label><br/>
<input class="w3-radio" name="band01" type="radio" value="20" id="b12"/> <label class="w3-validate" class="resRed" for="b12">2 (rojo)</label><br/>
<input class="w3-radio" name="band01" type="radio" value="30" id="b13"/> <label class="w3-validate" class="resOrange" for="b13">3 (naranja)</label><br/>
<input class="w3-radio" name="band01" type="radio" value="40" id="b14" checked="checked"/> <label class="w3-validate" class="resYellow" for="b14">4 (amarillo)</label><br/>
<input class="w3-radio" name="band01" type="radio" value="50" id="b15"/> <label class="w3-validate" class="resGreen" for="b15">5 (verde)</label><br/>
<input class="w3-radio" name="band01" type="radio" value="60" id="b16"/> <label class="w3-validate" class="resBlue" for="b16">6 (azul)</label><br/>
<input class="w3-radio" name="band01" type="radio" value="70" id="b17"/> <label class="w3-validate" class="resViolet" for="b17">7 (violeta)</label><br/>
<input class="w3-radio" name="band01" type="radio" value="80" id="b18"/> <label class="w3-validate" class="resGray" for="b18">8 (gris)</label><br/>
<input class="w3-radio" name="band01" type="radio" value="90" id="b19"/> <label class="w3-validate" class="resWhite" for="b19">9 (blanco)</label><br/>
</td>
<td>
<b>Segunda banda:</b><br/>
<input class="w3-radio" name="band02" type="radio" value="0" id="b20"/> <label class="w3-validate" class="resBlack" for="b20">0</label><br/>
<input class="w3-radio" name="band02" type="radio" value="1" id="b21"/> <label class="w3-validate" class="resBrown" for="b21">1</label><br/>
<input class="w3-radio" name="band02" type="radio" value="2" id="b22"/> <label class="w3-validate" class="resRed" for="b22">2</label><br/>
<input class="w3-radio" name="band02" type="radio" value="3" id="b23"/> <label class="w3-validate" class="resOrange" for="b23">3</label><br/>
<input class="w3-radio" name="band02" type="radio" value="4" id="b24"/> <label class="w3-validate" class="resYellow" for="b24">4</label><br/>
<input class="w3-radio" name="band02" type="radio" value="5" id="b25"/> <label class="w3-validate" class="resGreen" for="b25">5</label><br/>
<input class="w3-radio" name="band02" type="radio" value="6" id="b26"/> <label class="w3-validate" class="resBlue" for="b26">6</label><br/>
<input class="w3-radio" name="band02" type="radio" value="7" id="b27" checked="checked" /> <label class="w3-validate" class="resViolet" for="b27">7</label><br/>
<input class="w3-radio" name="band02" type="radio" value="8" id="b28"/> <label class="w3-validate" class="resGray" for="b28">8</label><br/>
<input class="w3-radio" name="band02" type="radio" value="9" id="b29"/> <label class="w3-validate" class="resWhite" for="b29">9</label><br/>
</td>
<td>
<b>Multiplicador:</b><br/>
<input class="w3-radio" name="band03" type="radio" value="1" id="b30"/> <label class="w3-validate" class="resBlack" for="b30">x1</label><br/>
<input class="w3-radio" name="band03" type="radio" value="10" id="b31"/> <label class="w3-validate" class="resBrown" for="b31">x10</label><br/>
<input class="w3-radio" name="band03" type="radio" value="100" checked="checked" id="b32"/> <label class="w3-validate" class="resRed" for="b32">x100</label><br/>
<input class="w3-radio" name="band03" type="radio" value="1000" id="b33"/> <label class="w3-validate" class="resOrange" for="b33">x1k</label><br/>
<input class="w3-radio" name="band03" type="radio" value="10000" id="b34"/> <label class="w3-validate" class="resYellow" for="b34">x10k</label><br/>
<input class="w3-radio" name="band03" type="radio" value="100000" id="b35"/> <label class="w3-validate" class="resGreen" for="b35">x100k</label><br/>
<input class="w3-radio" name="band03" type="radio" value="1000000" id="b36"/> <label class="w3-validate" class="resBlue" for="b36">x1m</label><br/>
<input class="w3-radio" name="band03" type="radio" value="10000000" id="b37"/> <label class="w3-validate" class="resViolet" for="b37">x10m</label><br/>
<input class="w3-radio" name="band03" type="radio" value="100000000" id="b38"/> <label class="w3-validate" class="resGray" for="b38">x100m</label><br/>
<input class="w3-radio" name="band03" type="radio" value="1000000000" id="b39"/> <label class="w3-validate" class="resWhite" for="b39">x1000m</label><br/>
</td>
<td valign="top">
<b>Tolerancia:</b><br/>
<input class="w3-radio" name="band04" type="radio" value="5%" checked="checked" id="b40"/> <label class="w3-validate" class="resGold" for="b40">5% (oro)</label><br/>
<input class="w3-radio" name="band04" type="radio" value="10%" id="b41"/> <label class="w3-validate" class="resSilver" for="b41">10% (plata)</label><br/>
<input class="w3-radio" name="band04" type="radio" value="20%" id="b42"/> <label class="w3-validate" class="resBlack" for="b42">20% (negro - nada)</label><br/>
</td>
</tr></table>
<p>R: <input id="r" disabled="disabled" class="w3-input w3-border"/></p>
<p>Tolerancia: <input id="t" disabled="disabled" class="w3-input w3-border"/></p>
</form>
