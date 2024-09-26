---
title: "Doom on Verifone VX820 POS"
summary: "Port of the game DOOM to a payment terminal"
thumbnail: "/thumbs/doom-posnet.jpg"
date: "2024-02-01"
---

In September 2023, I found this Verifone payment terminal (_posnet_) on the street. Someone had thrown it away, probably because the casing was broken.

![verifone vx820 running basic program](/images/pos-doom.jpg)

After searching a bit online, I discovered that someone had already managed to run Doom on the same device: [Thomas Rinsma](https://th0mas.nl/2022/07/18/porting-doom-to-a-payment-terminal/), so I decided to follow in his footsteps and ended up doing something similar, with a few extras:

- Using the device’s buttons isn't ideal since they only detect one button at a time, so I decided to use an external arcade joystick with buttons.

- Doors open by swiping a magnetic card.

## [Video showing it in action](https://www.youtube.com/watch?v=WlOgtZLBNoE)
## [Source code](https://github.com/gzalo/doomgeneric-vx)

Thanks to [OZKL](https://github.com/ozkl/doomgeneric) for the generic Doom easily ported to any platform,, [Thomas Rinsma](https://th0mas.nl/2022/07/18/porting-doom-to-a-payment-terminal/) for the idea, and to [paymentvillage](https://www.paymentvillage.org/resources), [denisdemaisbr](https://github.com/denisdemaisbr), [Mats Engstrom](https://x.com/matseng) who provided a lot of critical information for the project..

To compile it, you need the official Verix ARM SDK and compiler, and it uses an external microcontroller to detect and send key presses via RS232.