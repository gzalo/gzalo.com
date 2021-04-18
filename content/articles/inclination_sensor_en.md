---
title: ""
tags: ["articles", "electronics"]
summary: ""
thumbnail: "/thumbs/.png"
aliases: ["/inclination_sensor_en/"]
---
addProjectBox('Homemade inclination sensors', 'How to build small sensors with two states, that can sense the rotation of a board in two axes.','/thumbs/sensores_inclinacion.png','/inclination_sensor_en/');
$tituloPagina = 'Homemade inclination sensors';
<p>For a university project, we decided to make some sensors to detect in which orientation (inside a vertical plane) a board was. Investigating in the Internet we found simple sensors, based in regular 90º double pin strips:<br/>
<img src="/images/sensor0.png" alt="Homemade inclination sensor" style="width:100%;max-width:318px;"/><br/>
Basically there is a small conductive sphere in the middle, which electrically joins the two contacts on any of both sides. Those sensors were built and tested, and they worked erratically. Sometimes it was necessary to make a high lateral force to trigger them, and they didn't get activated by gravity.</p>
<p>
We then decided to built them in other way: using a conductive tube and a sphere connecting it to two lateral terminals.<br/>
<img src="/images/sensor1.png" alt="Homemade inclination sensor (figure)" style="width:100%;max-width:594px;"/><br/>
<img src="/images/sensor2.png" alt="Homemade inclination sensor (built)" style="width:100%;max-width:400px;"/><br/>
</p>
<p>
To detect the project orientation, we used two sensors placed 90 degrees respect to each other, and 45 degrees respect to the board. This configuration allows the detection of the four main axis, since there are always (in theory) 2 sets of contacts connected:<br/>
<img src="/images/sensor3.png" alt="Homemade inclination sensor, gravity detection" style="width:100%;max-width:690px;"/><br/>
</p>
<p>After implementing them, we found two main issues. The first one is that it was necessary to sand the internal face of the cylinder to remove oxide and help conduction. The second one was the bounce of the ball after rotating the board, caused by the physical bounce of the sphere over the contacts. To solve it, the sensors were oversampled and we coded a small software solution that waits until they get into a stable state in order to change the image.</p>
<p>To avoid the bad conduction problem, it might be possible to use optical (reflective) sensors, and a colored sphere in such a way that distance to the ball can be detected. This would be a much more robust system. For higher definition, it would make sense to replace the sensors with a small accelerometer and a microcontroller, which can read the acceleration in each axis and then estimate the more probable orientation.</p>
<p>
<iframe width="420" height="315" src="//www.youtube.com/embed/TV9hBVALbbg" frameborder="0" allowfullscreen></iframe>
</p>