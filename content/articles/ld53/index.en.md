---
title: "Ludum Dare 53 - Energy delivery"
tags: ["articles", "games"]
summary: "Game developed in 48 hs for the Ludum Dare game jam"
thumbnail: "/thumbs/ld53.jpg"
date: "2023-05-01"
---

## [Play now](https://dare.gzalo.com/)

### [View source code](https://github.com/gzalo/ld53)

On the 28th and 29th of April 2023, I participated in Ludum Dare 53, a global game jam where games are built in 48 hours. In the mode I participated in (Compo), you work alone and have to create all the game resources within those hours (except for fonts, which can be reused). You can also remix resources designed previously, as long as the remix is significant.

Although I haven't participated in programming competitions for years, the feeling was very similar. Working in bursts similar to a hackathon. Out of the 48 hours, I probably worked for about 19 effective hours. I streamed for 14 hours, and the other 5 were used for brainstorming ideas and implementations, creating sounds, improving icons, and working on menus.

Some thoughts about the process:

Idea: 
- It was a bit challenging to come up with an idea that fit this time's theme (Delivery). Someone from the stream suggested the concept of cables that wear out over time, and I liked it, so I incorporated it into the game.
- Initially, my idea was to have cables of different thicknesses that the user could choose depending on the situation, but I couldn't figure out how to integrate a budget system for purchasing cables.
- The game I ended up making is a bit difficult: I couldn't fine-tune the difficulty well, and it's a bit fast-paced. The tutorial should have been more interactive and comprehensive.
- Originally, I had implemented a scrolling screen, but later I decided it was a bit complicated to have connections that weren't visible on the screen, as there wouldn't be a mechanism to tell the player to pay attention to something outside the screen.

Code:
- I implemented it in C++17, although I didn't use many of its features. Even though it's been many years since I coded in C++ like this, `CLion` and the `SonarLint` extension were quite helpful.
- The "New UI" in JetBrains IDEs is very interesting; it allows you to work without many distractions by hiding menus that aren't typically used.
- The feedback loop of compiling after each change or switching images was a bit tedious; for next time, I would have preferred a language or engine that supports autoreloading (ideally in less than a second).
- I used a little bit of OOP, but my code was quite procedural with a "god-class" Game that handles all the game logic, event handling, and rendering, both for the game itself and the menus.
- I'm using emscripten to compile the code for the web, and it works well except for a few details:
    - WebGL calls don't support textures with dimensions that aren't powers of two. For backgrounds (which are 800x600), I ended up creating textures of 1024x1024, adjusting the coordinates when displaying them to avoid distortion. It's a hack, not very efficient, but it gets the job done.
    - The line thickness I draw is fixed, and its implementation depends on the browser.
    - Due to browser limitations, the music doesn't always play when the game loads, as it requires user interaction. For next time, I'll need to hide the game canvas and have the user press a button to start the game.
- Adding sound and music was straightforward; SDL2_Mixer provides intuitive functions for that. The only downside was that my game logic was somewhat duplicated, so I had to make sure that all the events that should trigger sounds or music were properly handled.

Logic:
- Almost all the logic is based on random numbers: the placements of elements, initial energy, energy changes, cable destruction, element type selection, etc. All calculations are executed twice per second, except for the level up, which happens every 5 seconds.
- I had to think through the main logic on paper to determine if a destination is being powered correctly or not. I reached the conclusion that it's a problem without a unique solution: it's like having multiple ideal current sources in parallel and multiple sinks acting as constant current loads; the circuit matrix leads to an indeterminate solution. Therefore, I ended up implementing a simple but effective solution:
    - For each source, I check how many cables come out of that source and try to distribute the energy equally among them. If any cable gets more than it needs, the excess is redistributed among all the other cables. It's not the optimal algorithm, but it's easy to understand and implement.
    - For each sink, I check if I managed to power it correctly. I added a generous epsilon to the comparison to avoid numerical rounding issues since I use doubles in most places.
    - There's an implicit priority based on the order of sources and cables. I can't do anything or randomize it in each iteration because it would be strange and might cause temporal inconsistencies.
- I needed to add a state machine for menus, pause, and game over. I hadn't done this before; I started with a couple of bools (one for paused, another for game over), but finally, with an enum class, it was easier to handle all the cases. I would have preferred having separate classes for each state, and each one handling event management and rendering for its menu/state.
- Detecting collisions between the mouse and rectangular elements (e.g., to add a cable between two points) is straightforward. However, to detect if the mouse is over a cable, it was necessary to apply more complex mathematics. In the end, the distance_between_line_and_point function was entirely generated by ChatGPT, using the prompt `Snippet to calculate the distance between a line (defined by two points) and a point and... can you make it so that points outside the defined ones work as pills?`. It took two attempts to come up with something that worked.

Rendering:
- Rendering the cables was a bit tricky because there can be multiple cables between the same source and destination, and it's necessary to draw them without overlap. To handle this, I added an "offset" value to the cables, which only has three possible values. This limitation ensures that there can be at most three cables between the same source and destination. When adding or removing a new cable, I had to add logic to update the bitmap of possible values for that source and destination. To render it, I had to apply an offset to the cable coordinates in the normal direction, which required some math but nothing too complex.
- Initially, I needed to add dynamic text and used an 8x8 pixel font that I had created around 10 years ago for an experiment. I printed the characters in a monospaced manner, which didn't look very good. Towards the end of the competition, I adapted another piece of code that calculates the width of each character by examining the white vs. transparent pixels. It uses this new width instead of a fixed width. This significantly improved the quality of the text.
- To render the health and energy bars of the elements, I used two images, modifying the texture coordinates based on the required fractions for each case.
- I spent quite a few hours trying to use OpenGL, only to realize that the SDL2 library doesn't support changing the thickness of the drawn lines. As I mentioned earlier, when compiling for the web, this doesn't matter, so it was time wasted unnecessarily. Additionally, I used legacy OpenGL functions, making the code rather ugly. For the next time, I'd like to do something 3D or at least 2D with more modern code. This would allow me to compile directly to WebGL/OpenGL ES.

Graphics:
- I used Photoshop mainly because I've been using it for nearly 20 years. It was a poor choice for creating pixel art; I should have used Aseprite.
- Figma: I used it primarily for creating menu images.
- I took inspiration from Dall·E for some things. Unfortunately, I ran out of tokens, so I couldn't do much with it. The openjourney v4 didn't convince me; it produced results in a few seconds but everything was of very low quality. For the next time, I'd like to use models like those more, or even try Leonardo AI or Midjourney.
- Some images from Shutterstock served as inspiration for the 8-bit icons (I didn't directly copy them).

Sonido:
- [JSFXR](https://sfxr.me/): I used this 8-bit style sound generator to create all the game's sound effects. In about 15 minutes of pressing buttons, I managed to generate them; I only had to redo one because it had too high volume and was annoying.
- It might have been interesting to record realistic sound effects using objects from around the house; that's definitely feasible.
 
Music:
- [BoscaCeoil](https://boscaceoil.net/): Even though I don't have much musical knowledge, this tool helped me compose the music for both the menus and the actual game. It has a mode where you can see the chords, making it easy to create songs that sound good. The only downside is that it doesn't have an undo button; I accidentally deleted a really good arrangement once.

Some improvements for the future:
- Using a better programming language. Something strictly typed with autoreload support would be much better. For this type of 2D game, high performance isn't necessary, so an interpreted language like TypeScript or Lua could work well.
- Using a better sprite editor and creating a full mock/layout of the entire game while programming.
- Leveraging more AI tools for the artistic part, particularly for the icons and images in the game.
- Streaming in a visually appealing way, showing what I want to implement and the current progress through screenshots or even live updates in another window.