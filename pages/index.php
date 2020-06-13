<?php
	$descripcionPagina = 'Sitio personal de Gonzalo Ávila Alterach, con artículos de electrónica y programación';
	$tituloPagina = 'Programación, Electrónica y otras cosas';
	$comentariosActivados = false;
?>
<div class="w3-card-2 w3-white">

	<header class="w3-container w3-margin-top color_headers">
	  <h2>Últimas novedades</h2>
	</header>

	<div class="w3-container">
		<ul class="w3-ul w3-hoverable">
		<li>Agregado proyecto: <a href="https://github.com/gzalo/bla">Biblioteca liviana para Reconocimiento de Habla en español</a>.</li>
		<li>Actualizado diseño.</li>
		<li>Agregado nuevo proyecto: <a href="https://casa.gzalo.com/habla/">reconocedor de habla usando HTK</a>.</li>
		</ul>
	</div>

</div>

<div class="w3-card-2 w3-margin-top w3-hide-medium w3-hide-small w3-white">

	<header class="w3-container color_headers">
	  <h2>Último video subido</h2>
	</header>

	<div class="w3-container w3-center">
	  <div id="ytplayer"></div>
	</div>

</div>

<script>
	var tag = document.createElement('script');
	tag.src = "https://www.youtube.com/iframe_api";
	var firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

	var player;
	function onYouTubeIframeAPIReady() {
		player = new YT.Player('ytplayer', {
			height: '340',
			width: '600',
			videoId: 'ew01l9rJP_8',
			playerVars: {
				listType:'user_uploads',
				list: 'gzaloprgm',
			},
			events: {
				'onReady': onPlayerReady,
			}
		});
	}
	function onPlayerReady(event) {
		event.target.playVideo();
		event.target.mute();
	}

//InstantClick.on('change', ytVideoAutoPlayCallback);
	
</script>

