---
title: "Sensores de inclinación caseros"
tags: ["articles", "misc"]
summary: "Cómo construir un pequeño sensor de dos estados para sensar la orientación en el espacio de una placa."
thumbnail: "/thumbs/sensores_inclinacion.png"
aliases: ["/sensores_inclinacion/"]
date: "2010-01-01"
---

Para un proyecto de la facultad, decidimos hacer unos sensores para detectar en qué orientación (dentro de un plano vertical) estaba un proyecto. Investigando encontramos unos simples sensores, basados en las comunes tiras de pines: 

![Sensor de inclinacion sencillo](/images/sensor0.png)

Basicamente son dos pares de tiras, con una esfera conductora en el medio. Dichos sensores fueron armados y funcionaban más o menos, a veces era necesario hacer mucha fuerza lateral para activarlos, por lo que no se suelen activar solo con la gravedad.

Por lo tanto decidimos rearmarlos de otra forma: con un tubo conductivo y una esfera que conecta el tubo con dos terminales laterales.

![Sensor de inclinacion casero (figura)](/images/sensor1.png)
![Sensor de inclinacion casero armado](/images/sensor2.png)


Para detectar en qué posición está el proyecto, se utilizaron dos de estos sensores, ubicados a 90º, a 45º respecto de la placa. De esta forma en cada una de las 4 posibles orientaciones siempre hay 2 contactos conectados:

![Sensor inclinación casero, detectando gravedad](/images/sensor3.png)

A la hora de implementarlo, se encontraron con dos problemas principales: El primero es que es necesario lijar el tubo de forma tal de eliminar el óxido y así ayudar a la conducción. El segundo es el rebote luego de girada la placa, causado por el propio rebote de la esfera sobre los contactos. Para resolverlo, se sobremuestrearon los sensores y se esperó a que ambos estuvieran en un estado estable durante un cierto tiempo para cambiar la imagen. 

Para evitar el problema de la mala conducción, es posible usar sensores ópticos reflectivos, y una esfera coloreada de tal forma que se detecte la distancia a la esfera. Con eso podría implementarse un sistema más robusto, aunque quizás convenga reemplazarlos directamente por un acelerómetro y un microcontrolador que lea la aceleración en cada eje y estime la rotación de la placa.

{{< youtube TV9hBVALbbg >}}

