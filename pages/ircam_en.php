<?php
	$descripcionPagina = '';
	$tituloPagina = 'infrared camera';
	$lang = 'en';	
	echo addBoxBeg('Video camera modification to see IR light');
?>
<p>A couple of years ago I found an old video camera: una JVC GR-C7u. It's a camera from the 80s, has a CCD color sensor, autofocus, black and white viewfinder, records in VHSC tapes. Its a very similar model to the one used by Marty in "Back to the future" (gr-c1u) but with a red chassis.</p>
<p>It's widely known that CCD sensors by their construction detect light beyond the human view, specially the so called "near infrared" (which is closed to the red in the wavelength table). This infrared isn't the type emmited by all bodies (medium infrared), which is impossible to see by regular CCD and needs another technology to be fabricated.</p>
<p>This cameras have a IR block filter, which only allows light in the visible range to pass to the sensor. This is needed since otherwise the camera would see images with a reddish hue, and the colors wouldn't exactly match what's seen by the human eye. Removing this filter and replacing it by one that's IR only pass, it's possible for the camera to see IR light.</p>
<p>This filter is typically really close to the sensor:</p>
<p><img src="/images/ircam0.jpg" alt="IR filter" style="width:100%;max-width:300px;"/></p>
<p><img src="/images/ircam3.jpg" alt="IR filter placement" style="width:100%;max-width:650px;"/></p>
<p>After some searching, <a href="http://www.freeservicemanuals.info/en/servicemanuals/">I found the service manual of the camera in this site</a>, which has lots of free manuals. If they don't have it, they scan it after askng them, a really nice free service. The block in red is the filter itself.</p>
<p>To create an IR-pass filter, it's possible to use the internal part of the floppy disks, or the subexposed section (should look black) in photo negatives:</p>
<p><img src="/images/ircam1.jpg" alt="IR-Pass filter" style="width:100%;max-width:350px;"/></p>
<p>To keep the same height of the filter, I used a couple of old glasses of the same size. Varying a bit this dimensions, the camera loses it's parfocal properties (keeping the focus while varying zoom or focal distance), and has problems focusing to close stuff. To focus to infinity, it might be needed to unscrew the outer element past the allowed limits.</p>
<p>Some photos after the modification</p>
<p>Trees and plants look white under the sun:<br/><img src="/images/ir0.jpg" 
alt="Trees under IR light" style="width:100%;max-width:500px;"/></p>
<p>Veins:<br/><img src="/images/ir1.jpg" alt="Veins, skin under IR light" style="width:100%;max-width:500px;"/></p>
<p>The TV control remote looks transparent:<br/><img src="/images/ir2.jpg" alt="TV remote control under IR light" style="width:100%;max-width:500px;"/></p>
<p>The keyboard has some keys of different colors (no idea what causes this):<br/><img src="/images/ir3.jpg" alt="Keyboard under IR light" style="width:100%;max-width:500px;"/></p>
<p>Two argentinian pesos bill looks white: (dollars look fine under IR light)<br/><img src="/images/ir4.jpg" alt="Bill under IR light" style="width:100%;max-width:500px;"/></p>
<p>Eye<br/><img src="/images/ir5.jpg" alt="Eye under IR light" style="width:100%;max-width:500px;"/></p>
<p>Other stuff: Cola drinks look pretty transparent (no photo yet). Some types of clothing are transparent to IR light, so you can see through them. Other things look like lacking a texture, like certain woods, paintings, printings, etc.</p>

<?php echo addBoxEnd();?>