---
title: "Comprimiendo imágenes monocromáticas usando RLE (Run-length encoding)"
tags: ["articles", "programming"]
summary: "Pequeña explicación y código en Java mostrando cómo funciona este tipo de compresión sin pérdida."
thumbnail: "/thumbs/rle.png"
date: "2021-10-11"
---

RLE (Run-length encoding) es una forma muy sencilla de comprimir datos sin pérdida (se puede descomprimir la salida y generar la entrada original sin ninguna diferencia). Básicamente se basa en reemplazar cada símbolo repetido por un valor único y la cantidad de veces que este se repite. Por ejemplo, si se tiene la cadena ´`AAAABBBCAAAC`, la misma se comprimiría como `4A3B1C3A1C`. Como se observa, siempre que la cadena de entrada tenga muchas "tiras" de un mismo valor, la compresión será eficiente y la salida será más corta que la entrada.

Esta compresión también puede ser usada para comprimir otro estilo de cadenas, por ejemplo secuencias de ADN (que solo usan 4 letras, A, C, G, T) que puedan tener muchos nucleótidos repetidos, secuencias temporales que no tengan períodos en los que se mantengan estables o constantes, entre otros.

Para hacer el ejemplo más sencillo, se comprimiran los datos una vez convertidos a cadenas de texto (ej `000010100100001010000000` comprime como `41-11-10-11-20-11-40-11-10-11-70`), 

La lógica de compresión es bastante sencilla:
- Almacenamos el valor actual y el anterior (este último inicializado al primer valor de la entrada)
- Iteramos desde el segundo valor (índice 1) de la entrada hasta el final inclusive
  - Si el valor actual es distinto al anterior, o llegamos al límite de longitud de una tira, almacenamos en la salida el valor anterior y la cantidad de veces que lo vimos en esta tira. Luego reiniciamos dicho contador para que no continúe acumulando de más
  - Si, por el contrario, los valores son iguales, incrementamos un contador
  - Guardamos el valor actual como anterior

Luego de esta secuencia tendremos la cadena original comprimida en nuestra lista de salida.

```java

    private static String intToBinaryString(final int[] in){
        final StringBuilder builder = new StringBuilder();

        for (int i = 0; i < in.length; i++) {
            builder.append(String.format("%8s", Integer.toBinaryString(in[i])).replace(" ", "0"));
        }

        return builder.toString();
    }

    private static List<Integer> compressString(String in){
        char lastChar = in.charAt(0);
        int count = 1;
        List<Integer> ret = new ArrayList<>();

        for (int i = 1; i <= in.length(); i++) {
            char currentChar;
            if(i == in.length())
                currentChar = -1; // Add fake character to force the ending to be written
            else
                currentChar = in.charAt(i);

            if (currentChar != lastChar || count > 128-2) {
                ret.add(currentChar);
                ret.add(count);
                count = 1;
            }else{
                count++;
            }

            lastChar = currentChar;
        }

        return ret;
    }

    private static int[] decompressString(List<Integer> compressed, int len) {
        int[] out = new int[len];
        int off = 0;

        for(int i=0;i<compressed.size();i+=2){
            int count = compressed.get(i);
            int val = compressed.get(i+1);

            for(int j=0;j<count;j++)
                out[off+j] = val;
            off += count;
        }

        return out;
    }

    private static List<Integer> processFile(String filename) {
        List<Integer> compressed = new ArrayList<>();
        int[] data;

        try {
            data = MonocromeImageLoader.load(filename);
        } catch (IOException e) {
            e.printStackTrace();
        }

        return compressString(intToBinaryString(data));
    }

```

- `intToBinaryString` convierte un array de `int` en un string con todos ellos convertidos a dígitos binarios concatenados (aprovechando los formatos de `String.format` y `toBinaryString`).
- `compressString` comprime un string usando RLE. Para ello se queda con el valor anterior y el actual. Si estos dos valores en algún momento difieren, es porque se terminó una tira, y en ese momento escribe el valor anterior y la cantidad de veces que se vio el mismo. Para asegurarnos que el último valor se escribe correctamente y que no se intenten acceder a elementos fuera del final de la lista, se "simula" como si el último valor fuera un `-1`, que siempre va a ser distinto a todos los elementos de la entrada.
- `decompressString` descomprime una tira de enteros comprimidas. Básicamente agarra de a dos elementos de la entrada, llamémoslos X e Y, y luego llena los próximos X elementos de la salida con el valor Y. Es casi trivial, usa una variable para ir almacenando el _offset_ a medida que se llena la salida.
- `processFile` muestra cómo se haría para comprimir los datos de una imagen monocromática (cargada con el código de abajo).

Para cargar una imagen en memoria y luego comprimirla, podemos usar el siguiente código, que puede leer formatos bmp, jpg, png, entre otros. Básicamente genera un array de `int` cuyos valores corresponden a los datos de la imagen, separada en fragmentos de 1x8 (de izquierda a derecha y arriba a abajo), que es una de las formas más comunes con las que se muestran imágenes en LCDs gráficos.

```java
public class MonocromeImageLoader {
    public static int[] load(final String filename) throws IOException {
        File imgPath = new File(filename);
        BufferedImage bufferedImage = ImageIO.read(imgPath);

        final int elementsPerByte = 8;

        int outLen = bufferedImage.getHeight() * bufferedImage.getWidth() / elementsPerByte;
        int[] out = new int[outLen];
        int idx = 0;

        for(int y=0;y<bufferedImage.getHeight() / elementsPerByte;y++) {
            for (int x=0;x<bufferedImage.getWidth();x++) {
                int val = 0;

                for(int z=0;z<elementsPerByte;z++) {
                    int rVal = bufferedImage.getRGB(x, y*elementsPerByte+z) & 0xFF;

                    if(rVal == 0)
                        val |= 1<<z;
                }
                out[idx++] = val;
            }
        }
        return out;
    }
}
```
