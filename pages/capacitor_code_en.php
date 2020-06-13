<?php
	$descripcionPagina = '';
	$tituloPagina = 'Capacitor value calculator';
	$lang = 'en';
	echo addBoxBeg('Capacitor value calculator');
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
//

function f(r){
	if(r >= 1000000) return (r/1000000) + " Microfarads"
	if(r >= 1000) return (r/1000) + " Nanofarads"
	return r + " Picofarads";
}

function compute(){
    var r1 = parseInt($("input[name='band01']:checked", '#ccForm').val());
	var r2 = parseInt($("input[name='band02']:checked", '#ccForm').val());
	var r3 = parseInt($("input[name='band03']:checked", '#ccForm').val());
	var r4 = parseInt($("input[name='band04']:checked", '#ccForm').val());
	$("#c").val( f((r1+r2)*r3) );
	$("#t").val( r4 + " %");
	
}
document.onreadystatechange = function () {
	if (document.readyState == "complete") {
		$("input").keyup(compute);
		$("input").change(compute);
		$("select").change(compute);
		compute();	
	}
}
//
</script>
<p>Given the number found in a capacitor, this page calculates its value, as well as the tolerance.</p>
<form action="" id="ccForm">
<table cellpadding="10" id="colorCode"><tr>
<td>
<b>First digit:</b><br/>
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
<b>Second digit:</b><br/>
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
<b>Multiplier:</b><br/>
<input name="band03" type="radio" value="1" checked="checked" class="w3-radio"/> <label class="w3-validate">0</label><br/>
<input name="band03" type="radio" value="10" class="w3-radio"/> <label class="w3-validate">1</label><br/>
<input name="band03" type="radio" value="100" class="w3-radio"/> <label class="w3-validate">2</label><br/>
<input name="band03" type="radio" value="1000" class="w3-radio"/> <label class="w3-validate">3</label><br/>
<input name="band03" type="radio" value="10000" checked="checked" class="w3-radio"/> <label class="w3-validate">4</label><br/>
<input name="band03" type="radio" value="100000" class="w3-radio"/> <label class="w3-validate">5</label><br/>
</td>
<td valign="top">
<b>Tolerance:</b><br/>
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
<p>Tolerance: <input id="t" disabled="disabled" class="w3-input w3-border"/></p>
</form>
<p>Lower value capacitors generally have their capacitance marked in picofarads. For instance, 2.2 pF capacitors have a 2.2 label.</p>

<?php echo addBoxEnd();?>