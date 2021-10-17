---
title: "Compuertas lógicas en Java y Kotlin"
tags: ["articles", "programming"]
summary: "Código en Java y Kotlin para representar compuertas lógicas y recalcular el estado de sus salidas."
thumbnail: "/thumbs/logicgate.png"
date: "2021-02-01"
---

En este pequeño artículo se describirá una forma sencilla para representar compuertas lógicas usando objetos, y permitiendo recalcular el estado de salida de las mismas usando recursivdad. Hay que tener en cuenta que no se soportarán dependencias circulares (retroalimentaciones que pueden tener memoria) ni una gran cantidad de compuertas, ya que eso podría causar un `StackOverflowError`. Es posible reescribir el código para que no use recursividad, pero se deja como ejercicio para el lector. 

Empezamos definiendo un enum para identificar a los distintos tipos de compuertas. En Java:

```java
package com.gzalo.logicgates;

public enum GateType {
    TRUE, FALSE, AND, OR, NOT
}
```

y en Kotlin:

```kotlin
enum class GateType {
    TRUE, FALSE, AND, OR, NOT
}
```

Definimos unos tipos especiales `TRUE` y `FALSE` que representaran compuertas con una salida que siempre devolverá verdadero o falso, respectivamente.

Y a continuación intentamos definir un caso de ejemplo de uso de las compuertas cuya implementación definiremos después. En Java:

```java
package com.gzalo.logicgates;

import java.util.Arrays;
import java.util.List;

public class GateTest {
    public static void main(String[] args) {
        final Gate gateA = Gate.builder().type(GateType.TRUE).build();
        final Gate gateB = Gate.builder().type(GateType.TRUE).build();
        final Gate gateC = Gate.builder().type(GateType.OR).inputs(Arrays.asList(gateA, gateB)).build();
        final Gate gateD = Gate.builder().type(GateType.TRUE).build();
        final Gate gateE = Gate.builder().type(GateType.AND).inputs(Arrays.asList(gateC, gateD)).build();
        final Gate gateF = Gate.builder().type(GateType.NOT).inputs(Arrays.asList(gateE)).build();

        final List<Gate> gates = Arrays.asList(gateA, gateB, gateC, gateD, gateE, gateF);
        gates.forEach(Gate::calculate);
    }
}
```

y en Kotlin:
```kotlin
fun main() {
    val gateA = Gate(type = GateType.TRUE)
    val gateB = Gate(type = GateType.TRUE)
    val gateC = Gate(type = GateType.OR, inputs = listOf(gateA, gateB))
    val gateD = Gate(type = GateType.TRUE)
    val gateE = Gate(type = GateType.AND, inputs = listOf(gateC, gateD))
    val gateF = Gate(type = GateType.NOT, inputs = listOf(gateE))

    listOf(gateA, gateB, gateC, gateD,gateE, gateF).forEach(Gate::calculate)
}
```

Básicamente definimos 6 compuertas (algunas que siempre devuelven un valor fijo `TRUE` y una `AND`, `OR` y `NOT`) y las interconectamos entre sí. Posteriormente llamamos al método calculate de cada una de ellas, que se encargará de evaluarlas en el orden correcto y propagar los resultados.

No se muestra en el ejemplo pero el valor de salida de cada compuerta podría verse llamando al getter _getOutput()_ de cada compuerta.

Como se observa, el código en Kotlin es más mucho más claro ya que aprovecha el uso de los _named arguments_ en el constructor de cada puerta lógica, que está reemplazando el patrón _builder_ usado en el ejemplo escrito en Java. 

Respecto a la implementación de cada puerta lógica, el siguiente código muestra cómo se haría. En Java:

```java
package com.gzalo.logicgates;

import lombok.Builder;
import lombok.Data;

import java.util.ArrayList;
import java.util.List;
import java.util.stream.Collectors;

@Data
@Builder
public class Gate {
    private final GateType type;
    @Builder.Default private final List<Gate> inputs = new ArrayList<>();
    @Builder.Default private boolean calculating = false;
    @Builder.Default private Boolean output = null;

    private List<Boolean> calcInputs(){
        inputs.forEach(Gate::calculate);
        return inputs.stream().map(input -> input.output).collect(Collectors.toList());
    }

    private boolean calcOutput(){
        if(type == GateType.TRUE){
            return true;
        } else if(type == GateType.FALSE){
            return false;
        } else if(type == GateType.AND){
            return calcInputs().stream().allMatch(input -> input);
        } else if(type == GateType.OR){
            return calcInputs().stream().anyMatch(input -> input);
        } else if(type == GateType.NOT){
            return calcInputs().stream().noneMatch(input -> input);
        }
        throw new IllegalArgumentException("No such gate type " + type);
    }

    public void calculate() {
        if (this.output != null) {
            return;
        }
        if (calculating) {
            throw new RuntimeException("Loop detected");
        }
        this.calculating = true;
        this.output = calcOutput();
        this.calculating = false;
    }
}
```

y en Kotlin:
```kotlin
data class Gate(val type: GateType, val inputs: List<Gate> = listOf(), var calculating: Boolean = false, var output: Boolean? = null){

    private fun calcInputs(): List<Boolean> {
        inputs.forEach(Gate::calculate)
        return inputs.map { input -> input.output!! }
    }

    private fun calcOutput(): Boolean {
        return when (type){
            GateType.TRUE -> true
            GateType.FALSE -> false
            GateType.AND -> calcInputs().all {inp -> inp}
            GateType.OR -> calcInputs().any {inp -> inp}
            GateType.NOT -> calcInputs().none {inp -> inp}
        }
    }

    fun calculate() {
        if (output != null) {
            return
        }
        if (calculating) {
            throw RuntimeException("Loop detected")
        }
        calculating = true
        output = calcOutput()
        calculating = false
    }
}
```

Básicamente en ambos casos definimos una _data class_ en los que el tipo de la compuerta y la lista de entradas es constante (definido al instanciar la clase) y tenemos un campo `boolean` indicando si se está calculando actualmente el estado de salida de la compuerta (para detectar si hay alguna dependencia circular) y otro campo `Boolean` que tiene tres estados: `null` si todavía no hay una salida definida (estado inicial), y `false`/`true` si ya se calculó el estado y dio ese valor.

Como se observa en el código, la lógica para calcular el valor de salida de una compuerta es bastante sencilla:
- Primero revisamos si ya calculamos la salida de esta compuerta (comparando `output` con el valor `null`). Si eso es verdad, no tenemos que hacer nada y termina ahó el método.
- Luego revisamos si esta compuerta ya se está calculando en este momento. Eso podría darse solamente si hay dependencias circulares entre compuertas, por lo que lanzamos una excepción.
- Caso contrario, marcamos que estamos calculando esa compuerta, y procedemos a calcular el estado de la salida.
  - Según el tipo de compuerta usamos una lógica distinta para calcular el estado de salida.
  - En el caso de una `AND` devolvemos un valor que solo es `true` si todas las entradas son `true`.
  - En el caso de una `OR` devolvemos un valor que es `true` si al menos una de las entradas es `true`.
  - En el caso de una `NOT` devolvemos un valor que solo es `true` si todas las entradas son `false` (esto se comporta más como una `NOR`, pero si solo definimos una única entrada en una compuerta se comportará como `NOT`).
  - En los casos de las compuertas `TRUE` y `FALSE` devolvemos directamente ese valor sin mirar (ni calcular) las entradas.
  - Para calcular las entradas, llamamos recursivamente al método `calculate` de cada una de ellas, y luego hacemos una lista con las salidas de las mismas.
- Marcamos que ya terminamos de calcular esta compuerta.

Al implementar la lógica de esta manera es posible calcular la salida de cualquier cantidad de compuertas procesándolas en cualquier orden, ya que las llamadas recursivas se aseguran que el estado de las entradas de una compuerta esté presente cuando es el momento de calcular su salida.

En el caso de Java aprovechamos las anotaciones del preprocesador [Lombok](https://projectlombok.org/) para simplificar considerablemente el código, mientras que en el de Kotlin la mayoría de las mismas ya está soportada nativamente por el lenguaje. Por ejemplo, `@Data` genera automáticamente los métodos _toString_ (útil para debugging), _equals_ y _hashCode_ (necesarios si en algún momento queremos comparar dos puertas lógicas para saber si son idénticas), _getters_ en todos los fields, y _setters_ en los fields no constantes, así como un constructor que acepta todos los fields no constantes. Por otro lado `@Builder` genera automáticamente un _builder_ para todos los fields no constantes de la clase (que se puede obtener usando el método estático `Gate.builder()`) y `@Builder.Default` permite definir valores predeterminados (distintos de null) para algunos determinados fields.

Se observa también la sintaxis del bloque `when` de Kotlin, que reduce la necesidad de usar una serie de ifs (o un switch con muchos cases y breaks), y que la mayoría de los métodos de un `stream` de Java están nativos en listas y otras collections de Kotlin.

Si agregamos un _breakpoint_ al final del _main_ y corremos el programa, podemos observar que las salidas de todas las compuertas obtuvieron el valor esperado:

![Validación de valores de salida](/images/logicgate.png)
