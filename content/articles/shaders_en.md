---
title: ""
tags: ["articles", "electronics"]
summary: ""
thumbnail: "/thumbs/.png"
aliases: ["/shaders_en/"]
---

addProjectBox('Introduction to GLSL Shaders', 'A small article that can help people that want to get into the world of graphic shaders development.','/thumbs/shaders.png','/shaders_en/');
$tituloPagina = 'Introduction to GLSL Shaders';
	
This doesn't pretend to be a complete tutorial about shaders but a simple explanation on how to make some visual effects typically used in games.<br /><br />A shader is a small program that executes directly on the GPU (graphics card). This allows to do complex effects with little impact on performance. CPUs aren't suitable for graphics, vector and matrix math, while GPUs have native instructions that allow them, while also being suitable for parallel works.<br/><br/>Currently, nearly all graphic cards (incuding the low-tier ones) support some type of shaders. They can also be used to do normal data processing, particularly operations that can be easily parallelized. For that type of applications, it's best to use OpenCL and not standard shaders.<br /><br />In most graphics applications, there are three types of shaders:<br />Vertex Shaders: They execute once per vertex of the element to be rendered. They can be used to move the vertices, for instance to create a distorsion (ocean waves), making skeletal interpolations. Their return value is the transformed vertex position.<br /><br />Pixel Shaders (in OpenGL they are called Fragment Shader): they are executed once per each visible fragment of the image (the actual amount ends up demending on the camera view, object sizes and other factors). Their return value is the color of the resulting pixels. With the help of vertex shaders, they can be used for simulating illumination, techniques such as cell shading, bump mapping, and lots of post processing filters such as blur, depth of field, motion blur, bloom, hdr, etc. <br /><br />Geometry Shaders: they execute once per each face of the object to be rendered. They have a different output than the other two, since they can output new vertices. That allows them to do more complex effects such as grass, hair, projected shadows, reflections, without needing for the CPU to generate the new vertices.<br /><br />There are various languages to develop shaders, this tutorial focus on GLSL because its style is similar to C/C++, and it's very easy to learn.<br /><br />To try the codes, it's possible to use a tool like RenderMonkey or ShaderToy (online service). In this tutorial we'll create a simple effect: an ambient light.<br /><br />Ambient light denotes every light that's present in a scene. In real life, it doesn't exist, but in graphics it's always beneficial for every object to be lit, even if they have no near lights. This is required because the light bounces aren't being considered, modern engines do not raytrace.<br /><br />The basic formula for ambient light is:<br /><br />I = Object.AmbientColor * Light.AmbientColor<br /><br />Where both colors are 3 coordinate vectors (R,G,B), corresponding to the object color and the ambient light color. I is the resulting color. <br /><br />Source code:<br />Vertex Shader:<br /><blockquote>void main()<br />{&nbsp;&nbsp;&nbsp; <br />&nbsp;&nbsp;&nbsp; gl_Position = ftransform();<br />}&nbsp; </blockquote>Pixel Shader:<br /><blockquote>void main()<br />{<br />&nbsp;&nbsp;&nbsp; vec4 color = gl_FrontMaterial.ambient * gl_LightSource[0].ambient;<br /><br />&nbsp;&nbsp;&nbsp; color.a = 1.0;<br />&nbsp;&nbsp;&nbsp; gl_FragColor = color;<br />}</blockquote>&nbsp;Screenshot:<br /><br /><div class="separator" style="clear: both; text-align: left;"><a href="http://4.bp.blogspot.com/_i7DtQvb7RtE/Sz2ltNlAJEI/AAAAAAAADts/pNrrpKLkZdQ/s1600-h/screen1.png" imageanchor="1" style="margin-left: 1em; margin-right: 1em;"><img border="0" src="http://4.bp.blogspot.com/_i7DtQvb7RtE/Sz2ltNlAJEI/AAAAAAAADts/pNrrpKLkZdQ/s320/screen1.png" /></a></div>As can be seen from the image, the ambient light is purely red (1.0,0.0,0.0) and the object color is gray (0.5,0.5,0.5).
Hence the output pixels get that color (0.5, 0.0, 0.0). 
<br/><br/>
<h2>Directional lights</h2>
<p>Directional lights are supposed to be at an infinite distance, so they don't have a position, only a direction, since all of their rays are parallel.</p>
<p>The diffuse component of a light is the first term of the approximation, where it's assumed that the intensity depends only on the normal of the surface in that point and the direction vector of the light.</p>
<p>The reflected light value will be higher when the angle between the light and the normal to the surface is smaller. When the vectors are parallel, the diffuse component will have a maximum, and when they are orthogonal the contribution will be zero.</p>
<p><a href="http://3.bp.blogspot.com/_i7DtQvb7RtE/Sz2pk6gEICI/AAAAAAAADt0/G0zxdebPoZQ/s1600-h/imagen1.png" imageanchor="1" style="clear: left; float: left; margin-bottom: 1em; margin-right: 1em;"><img border="0" src="http://3.bp.blogspot.com/_i7DtQvb7RtE/Sz2pk6gEICI/AAAAAAAADt0/G0zxdebPoZQ/s400/imagen1.png" /></a></p>
<p>To calculate the angle between the light and the normal, the inner product (dot product) can be used. It returns |LightDir| x |Normal| x cos(angle).</p>
<p>To avoid having to divide by both norms, both vectors are normalized before doing the dot product. Since the cosine of the angle can be negative, we clamp the value to a number between 0 and 1.</p>

<p>The formula looks like this:
 I = Object.AmbientColor * Light.AmbientColor + Object.DiffuseColor * Light.DiffuseColor *  clamp(dot(Face.Normal, Light.Direction))</p>

Source code:<br />Vector Shader:<br /><blockquote>varying vec3 normal;<br /><br />void main()<br />{&nbsp;&nbsp;&nbsp; <br />&nbsp;&nbsp;&nbsp; normal = gl_Normal;<br />&nbsp;&nbsp;&nbsp; gl_Position = ftransform();<br />} </blockquote>varying vec3 normal;<br /><br />void main()<br />{<br />&nbsp;&nbsp;&nbsp; vec4 color = gl_FrontMaterial.ambient * gl_LightSource[0].ambient + gl_FrontMaterial.diffuse * gl_LightSource[0].diffuse * clamp(dot(normalize(gl_LightSource[0].position), normalize(normal)));<br /><br />&nbsp;&nbsp;&nbsp; color.a = 1.0;<br />&nbsp;&nbsp;&nbsp; gl_FragColor = color;<br />} </blockquote>

<p>Screenshot:
<a href="http://3.bp.blogspot.com/_i7DtQvb7RtE/Sz2rjM_DiGI/AAAAAAAADt8/Bi0b93L9kOU/s1600-h/screen2.png" imageanchor="1" style="clear: left; float: left; margin-bottom: 1em; margin-right: 1em;"><img border="0" src="http://3.bp.blogspot.com/_i7DtQvb7RtE/Sz2rjM_DiGI/AAAAAAAADt8/Bi0b93L9kOU/s320/screen2.png" /></a></p>

<p>The light used is green, shining from above, and it can be seen that the places more lit are those whose normal is similar to the light direction.</p>

<p>A varying type variable is used to pass data from the vertex shader to the pixel shader (in this case the normal of each vertex), which implies that OpenGL interpolates it. This allows for a "per pixel" illumination. If the color was calculated in the vertex shader and then interpolated, it would look different (second screenshot).</p>

<a href="http://1.bp.blogspot.com/_i7DtQvb7RtE/Sz2uF0FWrsI/AAAAAAAADuE/Xg_XyH_3OrA/s1600-h/screen3.png" imageanchor="1" style="clear: left; float: left; margin-bottom: 1em; margin-right: 1em;"><img border="0" src="http://1.bp.blogspot.com/_i7DtQvb7RtE/Sz2uF0FWrsI/AAAAAAAADuE/Xg_XyH_3OrA/s320/screen3.png" /></a>

<h2>Types of Lighting</h2>
<p><b>Static Lighting:</b> The light effects (as well as the shadows) are prerendered when the models are built, and then combined with the diffuse texture of the object, as well as the ambiental occlusion. This method mostly works for still rigid objects, and it's impossible to move the lights, since they are pre baked as textures. Creating the textures may take a long time, since raytracing-like algorithms are used, but a higher realism may be achieved.</p>

<p><b>Dynamic Lighting (per vertex):</b> This is the basic illumination included in older OpenGL. The normals of each vertex are used to calculate the incidence of light, and then the colors are interpolating along the face.</p>

<p><b>Dynamic Lighting (per píxel):</b> Similar to the previous one, but the normal is interpolated instead of the color. Has a higher quality than per vertex.</p>

<p><b>Deferred Lighting:</b> If multiple lights are desired (more than 4/5), both previous methods are quite slow, because the scene has to be rendered multiple times and the lights should get "accumulated". The idea of this method is to store the information of the scene (depth map, normal, diffuse texture of each pixel of the screen). And then lots of simple passes use that information to calculate the contribution of each light. This method is quite fast, especially when it's an indoor map with lots of point lights or spot lights. As a disadvantage, this method doesn't allow for translucid materials nor for antialiasing, and it needs a high amount of GPU memory, proportional to the resolution of the screen.</p>

<p>There are other methods based on the last one, that use the precalculation of the screne as seen by the camera to avoid multiple geometry passes.</p>

<p>Methods to render shadows</p>
<p><b>Pre baked shadows:</b> Calculated while doing the map and static objects, they can't be moved, deform or destroy, and the light positions have to remain static to keep the illusion.</p>

<p><b>Fake shadows:</b> Bellow each object that needs a shadow a small sprite is drawn, typically a round black image with blurred borders. It's a very fast way to draw shadows, but not really used due because it's not realis.t</p>

<p><b>Shadow mapping:</b> The scene is rendered from the light viewpoint, and then in the eye object the depth that the camera sees gets compared to the depth seen by the light. If one is greater than the other, its shadowed, otherwise it isn't. It is a relatively fast method, and can be used for point lights with a technique such as <i>dual paraboloid mapping</i> and other methods such as <i>cascaded shadow maps</i></p>

<p><b>Shadow volume:</b>This method founds the borders of the geometry as seen by the light, and then proyects it to the back of the scene. It isn't very used since it heavily depends on the geometry, and more vertices are generated for the shadows. </p>

<p>There are other methods based on shadow mapping that allow for better quality and higher performance. Some of them split the shadow map into multiple ones, in order to keep a constant quality for far and near shadows.</p>