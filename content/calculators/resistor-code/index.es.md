---
title: "Calculadora de código de colores de resistencias"
summary: "Dados los colores de una resistencia, calcula cuánto es su valor y tolerancia."
thumbnail: "/thumbs/resistor_code.jpg"
aliases: ["/codigo_resistencias/"]
date: "2011-01-01"
---

Dados los colores de una resistencia, esta página calcula cuánto es su valor y tolerancia.

{{< rawhtml >}}
<form action="" id="ccForm">
<table cellpadding="10" id="colorCode"><tr>
<td>
<b>Primera banda:</b><br/>
<input  name="band01" type="radio" value="0" id="b10"/> <label  class="resBlack" for="b10">0 (negro)</label><br/>
<input  name="band01" type="radio" value="10" id="b11"/> <label  class="resBrown" for="b11">1 (marrón)</label><br/>
<input  name="band01" type="radio" value="20" id="b12"/> <label  class="resRed" for="b12">2 (rojo)</label><br/>
<input  name="band01" type="radio" value="30" id="b13"/> <label  class="resOrange" for="b13">3 (naranja)</label><br/>
<input  name="band01" type="radio" value="40" id="b14" checked="checked"/> <label  class="resYellow" for="b14">4 (amarillo)</label><br/>
<input  name="band01" type="radio" value="50" id="b15"/> <label  class="resGreen" for="b15">5 (verde)</label><br/>
<input  name="band01" type="radio" value="60" id="b16"/> <label  class="resBlue" for="b16">6 (azul)</label><br/>
<input  name="band01" type="radio" value="70" id="b17"/> <label  class="resViolet" for="b17">7 (violeta)</label><br/>
<input  name="band01" type="radio" value="80" id="b18"/> <label  class="resGray" for="b18">8 (gris)</label><br/>
<input  name="band01" type="radio" value="90" id="b19"/> <label  class="resWhite" for="b19">9 (blanco)</label><br/>
</td>
<td>
<b>Segunda banda:</b><br/>
<input  name="band02" type="radio" value="0" id="b20"/> <label  class="resBlack" for="b20">0</label><br/>
<input  name="band02" type="radio" value="1" id="b21"/> <label  class="resBrown" for="b21">1</label><br/>
<input  name="band02" type="radio" value="2" id="b22"/> <label  class="resRed" for="b22">2</label><br/>
<input  name="band02" type="radio" value="3" id="b23"/> <label  class="resOrange" for="b23">3</label><br/>
<input  name="band02" type="radio" value="4" id="b24"/> <label  class="resYellow" for="b24">4</label><br/>
<input  name="band02" type="radio" value="5" id="b25"/> <label  class="resGreen" for="b25">5</label><br/>
<input  name="band02" type="radio" value="6" id="b26"/> <label  class="resBlue" for="b26">6</label><br/>
<input  name="band02" type="radio" value="7" id="b27" checked="checked" /> <label  class="resViolet" for="b27">7</label><br/>
<input  name="band02" type="radio" value="8" id="b28"/> <label  class="resGray" for="b28">8</label><br/>
<input  name="band02" type="radio" value="9" id="b29"/> <label  class="resWhite" for="b29">9</label><br/>
</td>
<td>
<b>Multiplicador:</b><br/>
<input  name="band03" type="radio" value="1" id="b30"/> <label  class="resBlack" for="b30">x1</label><br/>
<input  name="band03" type="radio" value="10" id="b31"/> <label  class="resBrown" for="b31">x10</label><br/>
<input  name="band03" type="radio" value="100" checked="checked" id="b32"/> <label  class="resRed" for="b32">x100</label><br/>
<input  name="band03" type="radio" value="1000" id="b33"/> <label  class="resOrange" for="b33">x1k</label><br/>
<input  name="band03" type="radio" value="10000" id="b34"/> <label  class="resYellow" for="b34">x10k</label><br/>
<input  name="band03" type="radio" value="100000" id="b35"/> <label  class="resGreen" for="b35">x100k</label><br/>
<input  name="band03" type="radio" value="1000000" id="b36"/> <label  class="resBlue" for="b36">x1m</label><br/>
<input  name="band03" type="radio" value="10000000" id="b37"/> <label  class="resViolet" for="b37">x10m</label><br/>
<input  name="band03" type="radio" value="100000000" id="b38"/> <label  class="resGray" for="b38">x100m</label><br/>
<input  name="band03" type="radio" value="1000000000" id="b39"/> <label  class="resWhite" for="b39">x1000m</label><br/>
</td>
<td valign="top">
<b>Tolerancia:</b><br/>
<input  name="band04" type="radio" value="5%" checked="checked" id="b40"/> <label  class="resGold" for="b40">5% (oro)</label><br/>
<input  name="band04" type="radio" value="10%" id="b41"/> <label  class="resSilver" for="b41">10% (plata)</label><br/>
<input  name="band04" type="radio" value="20%" id="b42"/> <label  class="resBlack" for="b42">20% (negro - nada)</label><br/>
</td>
</tr></table>
<p>R: <input id="r" disabled="disabled" /></p>
<p>Tolerancia: <input id="t" disabled="disabled" /></p>
</form>
<script src="/inc/calculators/resistor_code.js"></script>
{{< /rawhtml >}}