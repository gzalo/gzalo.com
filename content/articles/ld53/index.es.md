---
title: "Ludum Dare 53 - Energy delivery"
tags: ["articles", "games"]
summary: "Juego desarrollado en 48 horas para la competencia Ludum Dare"
thumbnail: "/thumbs/ld53.jpg"
date: "2023-05-01"
---

## [Jugar ahora](https://dare.gzalo.com/)

### [Ver código fuente](https://github.com/gzalo/ld53)

En los días 28 y 29 de abril de 2023 participé en la Ludum Dare 53, una _game jam_ global en la que se construyen juegos en 48 hs. En el modo en el que participé (_Compo_), uno trabaja solo y tiene que crear todos los recursos del juego en esas horas (excepto tipografías, que se pueden reusar). También se pueden _remixear_ recursos diseñados anteriormente, siempre que el remix sea importante. 

Si bien hace años que no participo en competencias de programación, la sensación me resultó muy parecida. Trabajar en _ráfaga_ de forma similar a una _hackathon_. De las 48 horas habré trabajado unas 19 horas efectivas. _Streameé_ 14 horas, las otras 5 fueron usadas para pensar ideas e implementaciones, crear sonidos, mejorar los íconos y seguir con los menúes. 

Algunos pensamientos sobre el proceso:

Idea: 
- Costó un poco encontrar una idea que fuera con el tema de esta vez (_Delivery_). Alguien del stream sugirió que los cables que se vayan gastando, me gustó y la incorporé.
- Al principio mi idea era tener distintos grosores de cable y que el usuario pudiera elegir dependiendo de la circunstancia, pero no logré encontrar forma de integrar un presupuesto para comprar cables.
- El juego que terminé haciendo es un poco difícil: no logré tunear bien la dificultad, es un poco rápido. El tutorial también tendría que haber sido interactivo y más exhaustivo.
- Originalmente había hecho que la pantalla pudiera scrollear, luego decidí que era un poco complicado tener conexiones que no se vieran, ya que no habría mecanismo para decirle al jugador que tiene que prestar atención a algo fuera de la pantalla.

Código:
- Lo realicé en C++17, aunque no usé muchas features del mismo. Si bien hace muchos años que no codeaba así en C++, `CLion` y la extensión de `SonarLint` ayudaron bastante. 
- La _New UI_ de los IDEs de Jetbrains es muy interesante, permite trabajar sin muchas distracciones ocultando menúes que no se suelen usar. 
- El _feedback loop_ de compilar luego de un cambio o cambiar imágenes fue un poco tedioso, para la próxima hubiese preferido un lenguaje o motor que soporte autoreload (idealmente en menos de un segundo).
- Usé poco de OOP, hice un código bastante procedural con una _god-class_ `Game` que maneja toda la lógica de juego, manejo de eventos y renderizado, tanto del juego en sí como de los menúes.
- Estoy usando _emscripten_ para compilar el código a web, funciona bien excepto por algunos detalles:
    - Las llamadas de WebGL no soporta texturas con dimensiones que no sean potencias de dos. Para los fondos (que son de 800x600) terminé haciendo texturas de 1024x1024, adaptando las coordenadas a la hora de mostrarlas para que no se deformen. Es un _hack_ no es muy eficiente pero funciona.
    - El grosor de las líneas que dibujo está fijo, y su implementación depende del browser
    - Por limitaciones del browser, la música no siempre se reproduce al cargar el juego, ya que necesita interacción del usuario. Para la próxima hay que ocultar el canvas del juego y hacer que el usuario presione un botón para iniciar el juego.
- Agregar sonido y música fue muy sencillo, _SDL2_Mixer_ provee funciones intuitivas para ello. La única desventaja es que mi lógica de juego estaba un poco duplicada, así que tuve que asegurarme que todos los eventos que deberían disparar sonidos o música lo hicieran.

Lógica:
- Casi toda la lógica está basada en números aleatorios: Las ubicaciones de elementos, energía inicial, cambios de energía, destrucción de cables, elección de tipos de elemento, ... Todos los cálculos se ejecutan 2 veces por segundo, excepto el _level up_ que ocurre cada 5 segundos.
- Tuve que pensar con papel y lapiz la lógica principal para calcular si un destino está siendo alimentado correctamente o no. Llegué a la conclusión de que es un problema sin solución única: es como tener varias fuentes de corriente ideales en paralelo y varios sumideros que actúan como cargas de corriente constantes, la matriz del circuito da una indeterminación. Por eso terminé implementando una solución _sencilla_ pero efectiva:
    - Por cada fuente, veo cuantos cables salen de esa fuente e intento distribuir la energía en partes iguales entre los mismos. Si alguno cubre más de lo que necesita, la parte que sobra se vuelve a dividir entre todos los otros. No es el algoritmo óptimo pero es fácil de entender e implementar.
    - Por cada sumidero, veo si logré alimentarlo correctamente. A la comparación le agregué un _epsilon_ generoso para evitar problemas de redondeo númerico, ya que uso _doubles_ en casi todos los lugares.
    - Hay una _prioridad_ implícita según el órden de las fuentes y cables, no puedo hacer nada ni randomizarlo en cada iteración porque sería raro y quizás cause inconsistencias temporales.
- Necesité agregar una máquina de estados para los menúes, pausa y gameover. Nunca lo había hecho, empecé con un par de `bools` (uno para paused, otro para game over) pero finalmente con una `enum class` fue más sencillo contemplar todos los casos. Hubiese preferido tener distintas clases para cada estado y que cada una se encargara de el manejo de eventos y rendering de su menú/estado.
- Detectar colisiones entre el mouse y los elementos rectangulares (por ejemplo para agregar un cable entre dos) es muy sencillo. Pero para detectar si el mouse está sobre un cable fue necesario aplicar algo de matemática más complicada. Finalmente la función `distance_between_line_and_point` me la generó completamente el ChatGPT, usando el prompt `Snippet to calculate distance between line (defined by two points) and a point and... can you make it so that points ouside the defined ones work as pills?`. Tomó dos intentos llegar a algo que funcionara. 

Render:
- Renderizar los cables fue un poco _tricky_ ya pueden existir varios entre el mismo origen y destino, y es necesario graficarlos sin que se solapen. Para ello agregué un valor `offset` a los mismos, que solo tiene tres valores. De esta forma se impone una limitación de que solo puedan existir hasta tres cables entre mismo origen y destino. Al agregar o sacar un nuevo cable tuve que agregar lógica para actualizar el bitmap de los valores posibles para ese origen y destino. Para graficarlo tuve que hacerle un offset a las coordenadas del cable en la dirección normal, lo que requirió algo de matemática pero nada muy complejo.
- Al principio necesité agregar texto dinámico, y me traje una tipografía pixel de 8x8 que había hecho como hace 10 años para un experimento. Imprimí los caracteres de forma monoespaciada, lo que no se veía muy bien. Cerca del final de la competencia adapté otro código que básicamente calcula el ancho de cada caracter, mirando los píxeles blancos vs transparentes. Usa este nuevo ancho en lugar del ancho fijo. Con esto mejoró bastante la calidad del texto.
- Para renderizar las barras de salud y energía de los elementos usé dos imágenes, modificando las coordenadas de las texturas en base a las fracciones requeridas para cada caso.
- Perdí variashoras para usar OpenGL, sólo porque la biblioteca SDL2 no soporta cambiar el grosor de las líneas dibujadas. Como comenté más arriba, cuando compilo para web esto ni importa así que fue tiempo gastado innecesariamente. Encima usé las funciones de OpenGL legacy así que esun código bastante feo. Para la próxima me gustaría hacer algo 3D o aunque sea 2D pero con código más moderno. Esto me dejaría compilar directo a WebGL/OpenGL ES.

Gráficos:
- Photoshop: solo lo usé porque lo vengo usando hace casi 20 años. Fue una mala decisión para hacer pixel art, debería haber usado el [Aseprite](https://www.aseprite.org/).
- Figma: lo usé principalmente para crear las imágenes de los menúes.
- Usé Dall·E como inspiración para algunas cosas. Justo me quedé sin tokens así que no pude hacer mucho. El openjourney v4 no me convenció, daba resultados en pocos segundos pero todo era de muy baja calidad. Para la próxima me gustaría usar más esos modelos, o también Leonardo AI o Midjourney.
- Algunas imágenes de Shutterstock sirvieron como inspiración de los íconos 8 bit (no las copié directamente).

Sonido:
- [JSFXR](https://sfxr.me/): usé este generador de sonidos estilo 8-bits para generar todos los efectos de sonido del juego. En aproximadamente 15 mins apretando botones logré generarlos, solo tuve que rehacer uno porque tenía un volumen demasiado alto y era molesto.
- Podría haber estado interesante grabar efectos de sonido realistas usando objetos de la casa, seguro es factible.
 
Música:
- [BoscaCeoil](https://boscaceoil.net/): si bien no tengo muchos conocimientos musicales, esta herramienta me ayudó a componer la música para los menúes y el juego propiamente dicho. Al tener un modo en el que pueden ver los acordes, es sencillo hacer canciones que suenen bien. La única desventaja es que no tiene botón de deshacer, me pasó de tener una arreglo muy bueno y borrarlo sin querer.

Algunas mejoras para el futuro:
- Usar un mejor lenguaje. Si es _strictly-typed_ y soporta autoreload mucho mejor. Para este estilo de juegos 2D no es necesaria tanta performance así que puede ser un lenguaje interpretado tipo TS o Lua.
- Usar mejor editor de _sprites_, armar un _mock_/_layout_ completo de todo el juego mientras se programa.
- Usar más herramientas de inteligencia artificial para la parte artística, en particular los íconos e imágenes del juego.
- Streamear de forma que sea más atractiva visualmente, mostrando lo que quiero implementar y el progreso actual en forma de screenshot o incluso en vivo en otra ventana que se vaya actualizando.