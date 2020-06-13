<?php
	$descripcionPagina = '';
	$tituloPagina = 'Introduction to SDL, simple pixel font editor';
	$lang = 'en';	

	echo addBoxBeg('Introduction to SDL, developing a simple pixel font editor');
?>
<p>This small tutorial will show how to develop a small 8x8 pixel font editor, useful for designing small fonts with a pixel style. C++ y SDL will be used. C/C++ knowledge is recommended.</p>
<p><img src="/images/sdleditor.png" alt="8x8 pixel font editor" style="width:100%;max-width:304px;"/></p>
<p>First we need to include all the header files (.h extension) of all the libraries that we'll use in the editor. This inclusions are needed so that the compiler can correctly reference the functions we'll use.</p>
<p><pre><code>#include &lt;SDL/SDL.h&gt;
#include &lt;fstream&gt;
#include &lt;iostream&gt;
using namespace std;
</code></pre></p>
<p><pre><code>int font[8][8];</code></pre>We declare a 2D array of integers, which will contain the values of each cell (1 if cell is black, 0 if cell is white). To keep the things simple, every glyph size will be fixed at 8x8.</p>
<p><pre><code>int main(int argc, char* args[]){
	if(SDL_Init(SDL_INIT_EVERYTHING) != 0){
		cerr << "Error init SDL" << endl;
		return -1;
	}</code></pre>
We declare the main function of the program, and try to initialize the library. If it fails, we print an error and return</p>

<p>
<pre><code>	SDL_Surface *screen = SDL_SetVideoMode( 8*32, 8*32, 32, SDL_SWSURFACE );
	
	if(screen == NULL){
		cerr << "Error creating video surface" << endl;
		return -1;
	}</code></pre>
	We try to create a 256x256 pixel window, with 32 bit depth of color and no hardware acceleration. if it fails, we write an error message.</p>
<p><pre><code>	SDL_WM_SetCaption("Font Editor",NULL);</code></pre>
We change the title of the window.</p>

<p><pre><code>
	bool quit=false;	
	int pressedButton = 0;
	</code></pre>We declare two vaiables, one bool that will indicate if the program is still running and other one that indicates if any mouse button is down (0=none, 1=left, 2=right).</p>
<p><pre><code>
	while(!quit){
</code></pre>While the window is still open, we keep doing the main loop.</p>	
	<p><pre><code>
		SDL_Event event;
		while(SDL_PollEvent(&event)){ 
		</code></pre>While there are available events, we process them.</p>
			<p><pre><code>
			if(event.type == SDL_QUIT)
				quit = true;
			</code></pre>If the X of the window got pressed we proceed to quit in the next frame, by setting the variable "quit" to true.</p>
				
			<p><pre><code>
			if(event.type == SDL_MOUSEBUTTONDOWN){
				if(event.button.button == SDL_BUTTON_LEFT)
					pressedButton = 1;
				else if(event.button.button == SDL_BUTTON_RIGHT)
					pressedButton = 2;	
			}
			</code></pre>If a button got pressed, we remember which button it was.</p>
			
			<p><pre><code>
			if(event.type == SDL_MOUSEBUTTONUP)
				pressedButton = 0;
			</code></pre>If a button got released, we remember it.</p>
			
			<p><pre><code>
			if(pressedButton != 0){ 
				int posX = event.motion.x; 
				int posY = event.motion.y; 
				</code></pre>If there is a button press, we store the position of the mouse.</p>
				<p><pre><code>
				if(posX<32*8 && posY<32*8){
					int cellX = posX/32;
					int cellY = posY/32;
					
					if(pressedButton == 1){
						font[cellY][cellX] = 1;
					}else{
						font[cellY][cellX] = 0;
					}
				}
				
			}
		}
		</code></pre>If the mouse is inside the window, we calculate to which cell that position corresponds, by dividing the position by the cell size (32 px in this case). If the left button is pressed, we set a value of 1, otherwise a 0.</p>
		
		<p><pre><code>
		for(int y=0;y<8;y++){
			for(int x=0;x<8;x++){
			
				SDL_Rect rect;
				rect.x = x*32;
				rect.y = y*32;
				rect.h = 32;
				rect.w = 32;
				</code></pre>We iterate through the 64 cells and calculate the position of each square.</p>
				
				<p><pre><code>
				if(font[y][x]==0){
					SDL_FillRect(screen,&rect,0x00FFFFFF);
				}else{
					SDL_FillRect(screen,&rect,0x00000000);
				}
			}
		}
		</code></pre>If the value of the cell was in 0, we paint the corresponding rectangle with white, otherwise we paint it black.</p>
		<p><pre><code>
		SDL_Flip(screen);
		SDL_Delay(1);
	}
	</code></pre>We force the window to redraw, and wait some time to avoid hogging the CPU.</p>
	
	<p><pre><code>
	ofstream of("output.txt");
	for(int y=0;y<8;y++){
		for(int x=0;x<8;x++){
			of << font[y][x] << ",";
		}
	}
	of.close();
	</code></pre>If we got outside the loop, it's because the app got closed, so we open the file "output.txt" as output, and we save the state of each cell. Finally we close the file.</p>

	<p><pre><code>
	SDL_Delay(100);
	system("notepad output.txt");
	</code></pre>We wait a while and we open the file with notepad. It's not a very elegant solution but it works correctly, and allows for a fast copy of the values of the pixels.</p>
<p><pre><code>
	SDL_Quit();
	return 0;
}
</code></pre>We let SDL free every piece of memory it's used, and we tell the operating system that the process finished correctly.</p>
<p>To compile the code in Windows, it's possible to use mingw directly, or an IDE such as CodeBlocks or Dev-Cpp. It's needed to install the SDL library (the -devel version, including the headers and lib files) and add "-lsdlmain -lsdl" to the compiler line, to include the libraries in the linking process.</p>

<p><a href="/downloads/editorfonts.zip" data-no-instant>Download source code and executable</a></p>

<?php echo addBoxEnd();?>