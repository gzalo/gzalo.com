---
title: "Video camera modification to see IR light"
tags: ["articles", "misc"]
summary: "How to modify an ordinary video camera to increase the spectrum of the light it can see, allowing the visualization of near-infrared."
thumbnail: "/thumbs/ircam.jpg"
aliases: ["/ircam_en/"]
date: "2013-01-01"
---
A couple of years ago I found an old video camera: a JVC GR-C7u. It's a camera from the 80s, has a CCD color sensor, autofocus, black and white viewfinder, records in VHSC tapes. It is a very similar model to the one used by Marty in *Back to the future* (gr-c1u), the one with the red chassis.

It's widely known that CCD sensors detect light beyond the human view, especially the so-called *near-infrared* (which is closed to the red in the wavelength table). This infrared isn't the type emitted by all bodies (medium infrared), which is impossible to see by regular CCD and needs another technology to be fabricated.

These cameras have an IR blocking filter, which only allows light in the visible range to pass to the sensor. This is needed since otherwise the camera would see images with a reddish hue, and the colors wouldn't exactly match what's seen by the human eye. Removing this filter and replacing it by an IR only filter, it's possible for the camera to detect only IR light.

This filter is typically really close to the sensor:

![IR filter](/images/ircam0.jpg)
![IR filter placement](/images/ircam3.jpg)

After some searching, [https://www.freeservicemanuals.info/en/servicemanuals/](I found the service manual of the camera on this site), which has lots of free manuals. If they don't have it, they scan it after asking them, a nice free service. The block in red is the filter itself.

To create an IR-pass filter, it's possible to use the internal part of the floppy disks, or the subexposed section of photo negatives (the part that looks black):

![IR-Pass filter](/images/ircam1.jpg)

To keep the original height of the filter, I used a couple of old glass panes, cut to the same size. Even if you manage to come up to a similar glass thickness, the camera loses its parfocal properties (it struggles to keep the image in focus while varying zoom or focal distance), and has problems focusing into close stuff. To focus to infinity, it might be needed to unscrew the outer element past the allowed limits.

Some photos after the modification:

Trees and plants look white under the sun:\
![Trees under IR light](/images/ir0.jpg)

Veins:\
![Veins, skin under IR light](/images/ir1.jpg)

The TV control remote looks transparent:\
![TV remote control under IR light](/images/ir2.jpg)

The keyboard has some keys of different colors (no idea what causes this):\
![Keyboard under IR light](/images/ir3.jpg)

Two Argentinian pesos bill looks white: (dollars look fine under IR light)\
![Bill under IR light](/images/ir4.jpg)

Eye:\
![Eye under IR light](/images/ir5.jpg) 

Other stuff: Cola drinks look pretty transparent (no photo yet). Some types of clothing are transparent to IR light, so you can see through them. Other things look like lacking a texture, like certain woods, paintings, printings, etc.
