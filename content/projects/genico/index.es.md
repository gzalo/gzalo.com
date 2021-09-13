---
title: "Genico - Generador de íconos numéricos"
summary: "Un generador de íconos numéricos, muy útil para trabajar con pantallas HMI tipo DGUS (DWIN) / SGUS / VGUS"
thumbnail: "/thumbs/genico.png"
date: "2019-01-01"
---

Este es un pequeño proyecto realizado para poder realizar sets de íconos que contengan todos los números, el punto y el símbolo menos. Es muy útil para trabajar con pantallas HMI tipo DGUS (DWIN) / SGUS / VGUS, las cuales por defecto no poseen tipografías de alta calidad, especialmente para mostrar números.

El código es muy sencillo y está en un único archivo, es posible modificarlo de forma muy sencilla para aumentar los límites de las variables y agregar nuevas tipografías (que pueden estar instaladas localmente en el sistema). 

Usa la biblioteca Vue para actualizar todos los íconos (que se dibujan con Canvas) cuando se modifica cualquier parámetro. Al presionar el botón de guardar, usa `FileSaver.js` para exportar los 12 archivos generados en formato PNG.

**[Abrir generador de íconos](https://genico.gzalo.com/)**

**[Acceder al repositorio para descargar el código](https://github.com/gzalo/genico/) (Licencia: MIT)**
