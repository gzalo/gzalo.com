---
title: "Cerradura de combinación digital"
summary: "Lógica digital que implementa una cerradura de combinación similar a la usada en hoteles."
thumbnail: "/thumbs/cerradura.png"
aliases: ["/cerradura/"]
date: "2012-01-01"
---

Este proyecto fue armado para la materia Técnica Digital de la facultad, en el año 2012. Básicamente es una cerradura como las de las cajas de seguridad de los hoteles.

Para simplificar el diseño, la clave es de 4 dígitos y módulo 4. A diferencia de otras alarmas que permiten cambiar la clave soldando distintos cables, la idea del proyecto era hacerlo de tal forma que la clave se pudiera *guardar* en un dip switch.

![Diagrama de bloques cerradura](/images/td-diagbloques.png)
![Esquemático cerradura](/images/td-esquema.png)

El circuito fue diseñado para no necesitar clock, es totalmente asincrónico: la señal se extrae de los presiones de los botones. Se usan dos registros de desplazamiento para guardar la clave a medida que se va introduciendo, y un contador modulo 5 para saber en qué estado se encuentra. Luego de introducir los 4 dígitos, se compara lo introducido con lo del dip switch, y en base a eso se enciende un LED rojo o verde. 

Almacenar la clave en los registros de desplazamiento y no compararla a medida que se presiona permite conectar un display e ir mostrando la clave a medida que se va escribiendo. Se aprovechó el hecho de que los registros de desplazamiento poseen dos entradas de datos, que están unidas via una AND interna, para así disminuir la cantidad de lógica extra necesaria.

