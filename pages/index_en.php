<?php
	$descripcionPagina = 'Personal website of Gonzalo Ávila Alterach, with electronics and programming articles.';
	$tituloPagina = 'Programming, electronics and other stuff';
	$comentariosActivados = false;
	$lang = 'en';
	
?>
<div class="w3-card-2 w3-white">

	<header class="w3-container w3-margin-top color_headers">
	  <h2>Latest news</h2>
	</header>

	<div class="w3-container">
		<ul class="w3-ul w3-hoverable">
		<li>Added new project: <a href="https://github.com/gzalo/bla">Lightweight speech recognition library</a> (spanish only).</li>
		<li>Updated design.</li>
		<li>Added new project: <a href="https://casa.gzalo.com/habla">Speech recognition using HTK</a> (temporarily disabled) </li>
		</ul>
	</div>

</div>

<div class="w3-card-2 w3-margin-top w3-hide-medium w3-hide-small w3-white">

	<header class="w3-container color_headers">
	  <h2>Latest video</h2>
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
</script>
