<?php
	$descripcionPagina = 'Medidas de rulemanes que se consiguen localmente.';
	$tituloPagina = 'Tabla de tamaños de rulemanes';
	
	echo addBoxBeg('Tabla de tamaños de rulemanes');
?>
<table class="w3-table w3-striped w3-bordered w3-border" id="tablita">
<thead>
	<tr>
		<th data-sort="int">ID</th>
		<th data-sort="int">Diámetro interno</th>
		<th data-sort="int">Diámetro externo</th>
		<th data-sort="int">Longitud</th>
		<th data-sort="int">Costo unitario [ARS]</th>
	</tr>
</thead>
<tbody>
	<tr><td>6301</td><td>12</td><td>37</td><td>12</td><td>22.00</td></tr>
	<tr><td>6302</td><td>13</td><td>42</td><td>15</td><td>15.00</td></tr>
	<tr><td>6303</td><td>17</td><td>47</td><td>14</td><td>14.00</td></tr>
	<tr><td>6304</td><td>20</td><td>52</td><td>15</td><td>65.00</td></tr>
	<tr><td>6305</td><td>25</td><td>62</td><td>17</td><td>75.00</td></tr>
					
	<tr><td>6200</td><td>10</td><td>30</td><td>9</td><td>15.00</td></tr>
	<tr><td>6201</td><td>12</td><td>32</td><td>10</td><td>30.00</td></tr>
	<tr><td>6202</td><td>15</td><td>35</td><td>11</td><td>23.00</td></tr>
	<tr><td>6203</td><td>17</td><td>40</td><td>12</td><td>25.00</td></tr>
	<tr><td>6204</td><td>20</td><td>47</td><td>14</td><td>39.00</td></tr>
	<tr><td>6205</td><td>25</td><td>52</td><td>15</td><td>45.00</td></tr>
	<tr><td>6206</td><td>30</td><td>62</td><td>16</td><td>193.00</td></tr>
					
	<tr><td>6000</td><td>10</td><td>26</td><td>8</td><td>48.00</td></tr>
	<tr><td>6001</td><td>12</td><td>28</td><td>8</td><td>25.00</td></tr>
	<tr><td>6002</td><td>15</td><td>32</td><td>9</td><td>49.00</td></tr>
	<tr><td>6003</td><td>17</td><td>35</td><td>10</td><td>80.00</td></tr>
	<tr><td>6004</td><td>20</td><td>42</td><td>12</td><td>69.00</td></tr>
	<tr><td>6005</td><td>25</td><td>47</td><td>12</td><td>60.00</td></tr>
	<tr><td>6006</td><td>30</td><td>55</td><td>13</td><td>58.00</td></tr>
					
	<tr><td>607</td><td>7</td><td>19</td><td>6</td><td>25.00</td></tr>
	<tr><td>608</td><td>8</td><td>22</td><td>7</td><td>22.00</td></tr>
	<tr><td>609</td><td>9</td><td>24</td><td>7</td><td>29.00</td></tr>
					
	<tr><td>623</td><td>3</td><td>10</td><td>4</td><td>40.00</td></tr>
	<tr><td>624</td><td>4</td><td>13</td><td>5</td><td>30.00</td></tr>
	<tr><td>625</td><td>5</td><td>16</td><td>5</td><td>40.00</td></tr>
	<tr><td>626</td><td>6</td><td>19</td><td>6</td><td>26.00</td></tr>
	<tr><td>627</td><td>7</td><td>22</td><td>7</td><td>25.00</td></tr>
	<tr><td>629</td><td>9</td><td>26</td><td>8</td><td>25.00</td></tr>
</tbody>
</table>
<p>Precios tomados en septiembre del 2016.</p>
<script>
document.onreadystatechange = function () {
	if (document.readyState == "complete") {
		$("#tablita").stupidtable();
	}
 }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/stupidtable/0.0.1/stupidtable.min.js"></script>

<?php echo addBoxEnd();?>