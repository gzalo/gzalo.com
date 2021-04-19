---
summary: "Given the number found in a capacitor, this page calculates its value, as well as the tolerance."
title: "Capacitor value calculator"
thumbnail: "/thumbs/capacitor_code.png"
aliases: ["/capacitor_code_en/"]
date: "2011-01-01"
---

Given the number found in a capacitor, this page calculates its value, as well as the tolerance.

{{< rawhtml >}}	
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
<p>C (farads): <input id="c" disabled="disabled" class="w3-input w3-border"/></p>
<p>Tolerance: <input id="t" disabled="disabled" class="w3-input w3-border"/></p>
</form>
<script src="/inc/calculators/capacitor_code.js"></script>
{{< /rawhtml >}}

Lower value capacitors generally have their capacitance marked in picofarads. For instance, 2.2 pF capacitors have a 2.2 label.
