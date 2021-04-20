---
title: "Homemade inclination sensors"
tags: ["articles", "misc"]
summary: "How to build small sensors with two states, that can sense the rotation of a board in two axes."
thumbnail: "/thumbs/sensores_inclinacion.png"
aliases: ["/inclination_sensor_en/"]
date: "2010-01-01"
---

For a university project, we decided to make some sensors to detect the orientation of a board (inside a vertical plane). Investigating on the Internet we found simple sensors, based on regular 90º double pin strips:

![Homemade inclination sensor](/images/sensor0.png)

There is a small conductive sphere in the middle, which electrically joins the two contacts on both sides. Those sensors were built and tested, and they worked erratically. Sometimes it was necessary to make a high lateral force to trigger them, and they didn't get activated by gravity.

We then decided to built them in other way: using a conductive tube and a sphere connecting it to two lateral pins.

![Homemade inclination sensor (figure)](/images/sensor1.png)
![Homemade inclination sensor (built)](/images/sensor2.png)

To detect the project orientation, we used two sensors placed 90 degrees in respect to each other, and 45 degrees with respect to the board. This configuration allows the detection of the four main axes, since there are always (in theory) 2 sets of contacts connected:

![Homemade inclination sensor, gravity detection](/images/sensor3.png)

After implementing them, we found two main issues. The first one is that it was necessary to sand the inner face of the cylinder to remove oxide and help conduction. The second one was the bounce of the ball after rotating the board, caused by the physical bounce of the sphere over the contacts. To solve it, the sensors were oversampled and we coded a small software solution that waits until they get into a stable state in order to change the image.

To avoid the bad conduction problem caused by oxide, it might be possible to use optical (reflective) sensors, and a colored sphere in such a way that distance to the ball can be detected. That would be a much more robust system. For higher rotation angle resolution, it would make sense to replace the sensors with a small accelerometer and a microcontroller, which can read the acceleration in each axis and then estimate the more likely orientation.

{{< youtube TV9hBVALbbg >}}
