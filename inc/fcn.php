<?php
	date_default_timezone_set('America/Argentina/Buenos_Aires');

	function loggear($what)	{
		$myFile = "../gzlog.txt";
		$fh = fopen($myFile, 'a');
		if(isset($_SERVER['HTTP_REFERER'])) $referer = $_SERVER['HTTP_REFERER']; else $referer = '';
		fwrite($fh, $_SERVER['REMOTE_ADDR']."@".date(DATE_RFC822)."-".$referer.": ".$what."\n");
		fclose($fh);
	}
	
	function addBox($title, $content){
		return addBoxBeg($title).$content.addBoxEnd();
	}
	
	function addBoxBeg($title){
		return '<div class="w3-card-2 w3-white">

			<header class="w3-container w3-margin-top color_headers">
			  <h2>'.$title.'</h2>
			</header>

			<div class="w3-container">';
	}
	
	function addBoxEnd(){
		return '<div class="w3-container w3-padding-16 w3-right">
					<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4e78041d002782a5" async="async"></script>
					<div class="addthis_sharing_toolbox"></div>
				</div>
			
			</div>

		</div>';
	}
	
	// -- PROJECT BOXES --
	$projects = [];
	
	function addProjectBox($title, $caption, $img, $link){
		global $projects;
		$projects[] = array("title"=>$title, "caption"=>$caption, "img"=>$img, "link"=>$link);
	}
	function getProjectBoxSingle($title, $caption, $img, $link){
		
		
		return '
		
		<div class="w3-row w3-margin w3-card-4">
		  <a href="'.$link.'">
			<div class="w3-third ">
				<img src="'.$img.'" style="width:100%;"/>
			</div>
			<div class="w3-twothird w3-container">
				<p><strong>'.$title.'</strong></p>
				<p>'.$caption.'</p>
			</div>
		  </a>
		</div>
		
		';
	}
	
	function getProjectBoxes(){
		global $projects;
		$ret = '<div class="w3-row w3-margin-top">';
		for($i=count($projects)-1;$i>=0;$i--){
			$ret .= getProjectBoxSingle($projects[$i]['title'], $projects[$i]['caption'], $projects[$i]['img'], $projects[$i]['link']);
		}
		$ret .= '</div>';
		return $ret;
	}	