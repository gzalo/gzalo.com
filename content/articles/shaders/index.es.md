---
title: "Introducción a Shaders GLSL"
tags: ["articles", "programming"]
summary: "Un pequeño artículo para personas que deseen entrar en el mundo de la programación de shaders gráficos."
thumbnail: "/thumbs/shaders.png"
aliases: ["/shaders/"]
date: "2010-01-01"
---

Esto no pretender ser un tutorial acerca de shaders si no dar una explicación sencilla de como hacer algunos efectos vistosos generalmente utilizados en juegos.

Un shader es un pequeño programa que se ejecuta directamente en el procesador de la placa de video (GPU). Esto permite hacer efectos gráficos con muy poco impacto en el rendimiento. Las CPUs no están orientadas a gráficos, matemática de vectores, matrices, mientras que las GPUs sí, y además están pensadas para trabajar de forma paralela.

Actualmente la mayoría (por no decir todas) las placas gráficas desde la gama baja soportan algun tipo de shaders. Los shaders también se pueden usar para hacer procesamiento general de datos, aprovechando el gran poder de cálculo en paralelo que poseen las placas gráficas. Para ese tipo de aplicaciones se deberia usar OpenCL y no shaders normales.

Básicamente hay tres tipos de shaders:\
Vertex Shaders: se ejecutan una vez por cada vértice que forma parte del elemento que se quiere renderizar. Permiten hacer efectos sobre los propios vértices, es decir, moverlos para hacer algún efecto de distorsión (aplicar una función trigonométrica como seno podría servir para simular las olas de un océano, por ejemplo). Su valor de *retorno* es la posición del vértice procesada.

Pixel Shaders (en OpenGL los llaman Fragment Shader): se ejecutan una vez por cada fragmento visible de la imagen (es decir, la cantidad de veces que se ejecuten depende de la vista de cámara, tamaño del objeto y otros factores más). Su valor de *retorno* es el color del pixel resultante. Con la ayuda de los vertex shaders, permiten hacer efectos vistosos como iluminación, cel shading, bump mapping, y una gran cantidad de filtros de post-procesamiento como desenfoque, profundidad de campo, desenfoque de movimiento, bloom, hdr, entre otros. 

Geometry Shaders: se ejecutan por cada cara del modelo que se quiere renderizar. Tienen la particularidad que pueden *crear* nuevos vértices por lo que son muy útiles para generar efectos como pasto, pelo, sombras proyectadas, reflejos, etc. 

Hay varios lenguajes en los que se pueden programar shaders, éste pseudo tutorial mostrará código en GLSL porque es similar a C/C++ y muy sencillo de aprender y similar al HLSL de DirectX.

Para probarlo, es posible usar una herramienta instalable como RenderMonkey o alguna online como ShaderToy. Hoy veremos cómo hacer un efecto sencillo: una luz ambiente.

La luz ambiente es aquellas que está presente siempre en una escena. En la vida real la luz ambiente NO existe, pero en nuestro programa servirá para asegurarnos que incluso los objetos que no están iluminados tengan algo de luz. Esto es necesario porque no estamos teniendo en cuenta los reflejos de los rayos de luz (raytracing), cosa que es muy lento para hacerlo en tiempo real

La fórmula básica para luz ambiente es:

I = Objeto.ColorAmbiente * Luz.ColorAmbiente

Donde ambos valores son vectores de 3 coordenadas (R,G,B), correspondientes al color del objeto y el color de la luz ambiente. I es el color resultante. 

Código fuente:

Vertex Shader:

```c
void main() {   
  gl_Position = ftransform();
} 
```

Pixel Shader:

```c
void main(){
  vec4 color = gl_FrontMaterial.ambient * gl_LightSource[0].ambient;
  color.a = 1.0;
  gl_FragColor = color;
}
```

Screenshot:

[![](https://4.bp.blogspot.com/_i7DtQvb7RtE/Sz2ltNlAJEI/AAAAAAAADts/pNrrpKLkZdQ/s320/screen1.png)](https://4.bp.blogspot.com/_i7DtQvb7RtE/Sz2ltNlAJEI/AAAAAAAADts/pNrrpKLkZdQ/s1600-h/screen1.png)

Como se puede ver, estoy usando un color de luz ambiente puramente rojo (1.0,0.0,0.0) y gris como color del objeto (0.5,0.5,0.5).

Esto hace que los pixeles resultantes del objeto (en este caso, la tetera) se iluminen de color (0.5, 0.0, 0.0). 

## Luces direccionales
Las luces del tipo direccional están ubicadas a infinita distancia, por lo que no tienen posición si no únicamente dirección, ya que sus rayos son todos paralelos.

La componente difusa es una aproximación a la luz que choca en un objeto, depende únicamente de la normal de la superficie y del vector dirección de la luz.

El valor de luz reflejada será mayor a medida que el ángulo entre la luz y la normal de la superficie sea cada vez más chica. Cuando el vector de la luz sea paralelo a la normal la componente difusa será máxima y cuando los vectores sean perpendiculares será nula.

[![](https://3.bp.blogspot.com/_i7DtQvb7RtE/Sz2pk6gEICI/AAAAAAAADt0/G0zxdebPoZQ/s400/imagen1.png)](https://3.bp.blogspot.com/_i7DtQvb7RtE/Sz2pk6gEICI/AAAAAAAADt0/G0zxdebPoZQ/s1600-h/imagen1.png)

Para calcular el ángulo entre la luz y la normal de la superficie es posible utilizar el producto escalar entre ambos vectores. El producto escalar *devuelve* lo siguiente: |Luz| x |Normal| x cos(angulo).

Para evitar tener que dividir por el largo de ambos vectores, los normalizamos antes de hacer la cuenta. Como el coseno del ángulo puede ser negativo (cuando el ángulo es mayor a 180º), restringimos el valor a un número entre 0 y 1.

La cuenta queda así entonces:
 I = Objeto.ColorAmbiente * Luz.ColorAmbiente + Objeto.ColorDifuso * Luz.ColorDifuso *  clamp(Cara.Normal X Luz.Dirección)

Código Fuente:

Vector Shader:

```c
varying vec3 normal;

void main()
{   
    normal = gl_Normal;
    gl_Position = ftransform();
}
```

Fragment Shader:

```c
varying vec3 normal;

void main()
{
    vec4 color = gl_FrontMaterial.ambient * gl_LightSource[0].ambient + gl_FrontMaterial.diffuse * gl_LightSource[0].diffuse * clamp(dot(normalize(gl_LightSource[0].position), normalize(normal)));

    color.a = 1.0;
    gl_FragColor = color;
}
```

Screenshot:

[![](https://3.bp.blogspot.com/_i7DtQvb7RtE/Sz2rjM_DiGI/AAAAAAAADt8/Bi0b93L9kOU/s320/screen2.png)](https://3.bp.blogspot.com/_i7DtQvb7RtE/Sz2rjM_DiGI/AAAAAAAADt8/Bi0b93L9kOU/s1600-h/screen2.png)

Como se puede ver, estoy usando una luz difusa verde, directamente desde arriba, por lo que se puede ver claramente que los lugares más iluminados los que cuya normal coincide con la dirección de la luz.

Estoy usando una variable varying para pasar información del vertex shader (en este caso la normal de cada vértice del objeto), lo que implica que OpenGL la interpola cuando la pasa al pixel shader. Esto logra una *iluminación por pixel*. Si en lugar de hacer esto calculásemos el color del pixel resultante en cada llamada al vertex shader, obtendríamos un resultado como el siguiente, donde se nota la baja calidad en la iluminación.

[![](https://1.bp.blogspot.com/_i7DtQvb7RtE/Sz2uF0FWrsI/AAAAAAAADuE/Xg_XyH_3OrA/s320/screen3.png)](https://1.bp.blogspot.com/_i7DtQvb7RtE/Sz2uF0FWrsI/AAAAAAAADuE/Xg_XyH_3OrA/s1600-h/screen3.png)

De lejos la diferencia entre ambas es mínima, pero de cerca se nota. En este caso la iluminación por vértice no salió tan mal porque OpenGL interpola los valores de color al pasarlos del vertex al pixel shader (interpolación de Gouraud). Por ejemplo, en la parte superior del asa, se ve que hay pocos vértices en esa zona y por eso se nota algo raro en la iluminación.

Como verán este es un buen método para iluminar cosas. Si usamos iluminación difusa por pixel, los modelos no necesitan tener una gran cantidad de polígonos. En cualquier caso, es mucho mejor que el iluminador propio de OpenGL, que ilumina por vértices y usa parte de la CPU para calcular las luces.

## Tipos de iluminación
**Iluminación estática:** Se prerenderiza los efectos de la luz (sombras también) al momento de armar los modelos, y se combina la textura difusa del objeto con la de la oclusión ambiental y sombreado. Este método solamente sirve para objetos quietos (y rígidos), y es imposible mover las luces. Preparar las texturas puede tardar bastante (se usan algoritmos que rebotan rayos de luz, al estilo de raytracing). A la hora de mostrar los objetos, este es el método más rápido, solamente requiere una textura extra con las luces y sombras.

**Iluminación dinámica (por vértice):** Es la iluminación básica que está incluida en OpenGL. Usa las normales de cada vértice para calcular la incidencia de la luz, y luego interpola los colores a lo largo de toda la cara.

**Iluminación dinámica (por píxel):** Es similar a la anterior, con la diferencia que lo que se interpola es la normal. Tiene una calidad superior, aunque usa más GPU.

**Iluminación deferida:** Si se intentan renderizar varias luces (más de 5), los dos métodos anteriores son demasiado lentos, porque habría que renderizar la escena varias veces y acumular las luces. La idea de iluminación deferida es guardar información de la escena como se ve desde la cámara. Es decir, se guarda la profundidad, normal, textura difusa de cada pixel de la pantalla. Finalmente se van haciendo pases sencillos donde se usa esa información para calcular la contribución de cada luz. Este método es bastante más rápido, especialmente cuando se tiene un escenario en el interior, con muchas luces punto y reflectores. Como desventaja, si se usa este método no podrán usarse materiales transparentes ni activar el antialiasing. Este método necesita memoria proporcional al tamaño de la pantalla.

Hay otros métodos similares a este último, que aprovechan el precálculo de la escena vista por la cámara, evitando así tener que volver a renderizarla.

Métodos para renderizar sombras:

**Sombras precalculadas:** Se precalculan al momento de hacer el escenario y objetos estáticos. Tiene de problema que no puede moverse, deformarse o destruirse nada, y la posición de las luces tiene que permanecer estática para mantener la ilusión.

**Sombras falsas:** Abajo del objeto a sombrear se dibuja un sprite, una pequeña imagen negra con los bordes difuminados. Es una técnica muy rápida, pero ya no se utiliza más por su poco realismo.

**Sombras proyectadas (shadow mapping)**  Básicamente se renderiza la escena desde la vista de la luz, y luego en el espacio de ojo se compara si el valor de profundidad de un punto en la escena es menor al que ve la cámara. Permite renderizar sombras relativamente rápido, se puede usar el método de *dual paraboloid mapping* para renderizar sombras de luces punto, y otros métodos como *cascaded shadow maps* para renderizar sombras de luces paralelas sin perder resolución en la imagen.

**Volúmenes de sombras (shadow volume)**  El método se basa en encontrar los bordes de la geometría vista desde la luz, y proyectar las sombras hacia el fondo. No es muy usado por depender de la geometría, y además genera más geometría para las sombras.
