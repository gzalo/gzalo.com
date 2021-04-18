---
title: "Using GPS modules with microcontrollers"
tags: ["articles", "electronics"]
summary: "How to get the position from a GPS module, by parsing the NMEA strings."
thumbnail: "/thumbs/gps.png"
aliases: ["/gps_en/"]
---
<p>This information should work with any GPS module (it was tested with an <a href="http://www.globalsat.co.uk/product_pages/product_et332.htm">ET-332</a>) that transmits data via a serial port, using the NMEA protocol.
<p>The main output of the GPS module are lots of NMEA strings, generally more than 10 per second, separated by carriage return and line feed characters. The most interesting one for typical applications is the one starting with GPGGA. For instance: <pre>$GPGGA,182402.02,3436.5829,S,05825.7855,W,1,04,1.5,57,M,-34.0,M,,,*70 </pre>
<p>Each field has a different information:
	<ol>
		<li><tt>$GPGGA</tt>: String identifier</li>
		<li><tt>182402.02</tt>: Time (en GMT)</li>
		<li><tt>3436.5829,S</tt>: Latitude (34º 36.5829' South)</li>
		<li><tt>05825.7855,W</tt>: Longitude (58º 25.7855' West)</li>
		<li><tt>1</tt>: Is the fix valid? If 0, the data may have been extrapolated from old positions</li>
		<li><tt>04</tt>: Amount of satellites used to get position</li>
		<li><tt>1.5</tt>: Dilution of precision (see <a href="http://en.wikipedia.org/wiki/Dilution_of_precision_(GPS)">HDOP</a>)</li>
		<li><tt>57,M</tt>: Altitude (meters above sea level)</li>
		<li><tt>-34.0,M</tt>: Altitude respect to <a href="http://en.wikipedia.org/wiki/World_Geodetic_System">WGS84</a> reference system</li>
		<li><tt>*70</tt>: Checksum, calculated as a XOR of every byte between $ y *</li>
	</ol>

<p>A simple way to parse the data from a microcontroller is to store every line (from $ until \r\n) in a buffer, and then analize them. This is more complex in low memory devices, since the strings tend to have around 80 characters.<br/>Another way would be to parse the string when it arrives, using a state machine, and in such a way that the interrupt routine remembers in which field it is, and saving all desired data into variables.
