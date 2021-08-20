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
<input name="band01" type="radio" value="0" /> <label >0</label><br/>
<input name="band01" type="radio" value="10" checked="checked" /> <label >1</label><br/>
<input name="band01" type="radio" value="20" /> <label >2</label><br/>
<input name="band01" type="radio" value="30" /> <label >3</label><br/>
<input name="band01" type="radio" value="40" /> <label >4</label><br/>
<input name="band01" type="radio" value="50" /> <label >5</label><br/>
<input name="band01" type="radio" value="60" /> <label >6</label><br/>
<input name="band01" type="radio" value="70" /> <label >7</label><br/>
<input name="band01" type="radio" value="80" /> <label >8</label><br/>
<input name="band01" type="radio" value="90" /> <label >9</label><br/>
</td>
<td>
<b>Second digit:</b><br/>
<input name="band02" type="radio" value="0" checked="checked" /> <label >0</label><br/>
<input name="band02" type="radio" value="1" /> <label >1</label><br/>
<input name="band02" type="radio" value="2" /> <label >2</label><br/>
<input name="band02" type="radio" value="3" /> <label >3</label><br/>
<input name="band02" type="radio" value="4" /> <label >4</label><br/>
<input name="band02" type="radio" value="5" /> <label >5</label><br/>
<input name="band02" type="radio" value="6" /> <label >6</label><br/>
<input name="band02" type="radio" value="7" /> <label >7</label><br/>
<input name="band02" type="radio" value="8" /> <label >8</label><br/>
<input name="band02" type="radio" value="9" /> <label >9</label><br/>
</td>
<td valign="top">
<b>Multiplier:</b><br/>
<input name="band03" type="radio" value="1" checked="checked" /> <label >0</label><br/>
<input name="band03" type="radio" value="10" /> <label >1</label><br/>
<input name="band03" type="radio" value="100" /> <label >2</label><br/>
<input name="band03" type="radio" value="1000" /> <label >3</label><br/>
<input name="band03" type="radio" value="10000" checked="checked" /> <label >4</label><br/>
<input name="band03" type="radio" value="100000" /> <label >5</label><br/>
</td>
<td valign="top">
<b>Tolerance:</b><br/>
<input name="band04" type="radio" value="0.5pF" checked="checked" /> <label >D</label><br/>
<input name="band04" type="radio" value="1%" /> <label >F</label><br/>
<input name="band04" type="radio" value="2%" /> <label >G</label><br/>
<input name="band04" type="radio" value="3%" /> <label >H</label><br/>
<input name="band04" type="radio" value="5%" /> <label >J</label><br/>
<input name="band04" type="radio" value="10%" /> <label >K</label><br/>
<input name="band04" type="radio" value="20%" /> <label >M</label><br/>
<input name="band04" type="radio" value="+100% -0%" /> <label >P</label><br/>
<input name="band04" type="radio" value="+80% -20%" /> <label >Z</label><br/>
</td>
</tr></table>
<p>C (farads): <input id="c" disabled="disabled" /></p>
<p>Tolerance: <input id="t" disabled="disabled" /></p>
</form>
<script src="/inc/calculators/capacitor_code.js"></script>
{{< /rawhtml >}}

Lower value capacitors generally have their capacitance marked in picofarads. For instance, 2.2 pF capacitors have a 2.2 label.
