<?php

if(!isset($_COOKIE['id'])) {
	header('Location: https://accounts.borumtech.com/login?redirect=Flytrap');
	exit();
}

$page_title = "My Flytrap";
require('brand_header.html');
require('search.html');

?>
<div class = "nav-container">
	<button class = "new-button" id = 'new-audio-btn'>
		<img id = 'new-audio-icon' src = '/images/NewAudio.png'>
		<span>New Audio</span>
	</button>
	<button class = "new-button" id = 'new-folder-btn' onclick = "createNewFolder(<?php echo '\'' . $_COOKIE['apiKey'] . '\''; ?>)">
		<img id = 'new-folder-icon' src = "/images/NewFolder.png">
		<span>New Folder</span>
	</button>
</div>
<?php

function sortBy($name) {
	if (isset($_GET['sortby'])) {
		switch ($_GET['sortby']) {
			case 'name':
				return " ORDER BY $name";
			case 'time':
				return " ORDER BY time_created DESC";
		}
	}
}

?>
<div class = "file-list-container">
	<ul class = "folders flexbox" style = "<?php echo !isset($_GET['sortby']) ? 'display:flex' : 'display:none'; ?>"></ul>
	<ul class = "files flexbox" style = "<?php echo !isset($_GET['sortby']) ? 'display:flex' : 'display:none'; ?>">
	</ul>
</div>
<div class = "plus-container">
	<a id = "add-audio">+</a>
	<div id = 'plus-between' style="
    width: 40px;
    height: 50px;
		background: none;
		display: none;
    position: absolute;
		"></div>
</div>
<div style = "display: none" class = "new-file-box-container">
	<!-- Record audio -->
	<div>
		<button class = "audio-option" onclick = "startRecording(this)">Record directly</button>
		<button class = "stop-recording" onclick = "stopRecording(this)" disabled aria-disabled="true">Stop Recording</button>
		<ul id='recordings-list'></ul>
	</div>
	<!-- Vertical line -->
	<span class = "vertical-line"></span>
	<!-- Upload file -->
	<form id = 'upload-form' action = '' enctype = 'multipart/form-data'>
		<label class="audio-option custom-file-upload">
	    <input onchange="uploadFile(`<?php echo $_COOKIE['apiKey']; ?>`, this)" multiple id = "audio-files" name = "file" type="file" />
    	Upload mp3, wav, m4a
		</label>
		<img height = "200" id = 'upload-file-arrow' src = "/images/UploadFileArrow.png">
		<progress style = 'display:none' value = "0" max = "100" id = 'upload-file-progress-bar'></progress>
	</form>
</div>
<div class="filter-container">
	<div class="folders">
	</div>
	<div class="files">
	</div>
</div>
<div style = "display: none" class = "action-container rename-container">
	<img src = "/images/Exit.png">
	<input type = "text" value = "">
	<input type = "button" value = "Rename" onclick = "renameAudioFile(`<?php echo $_COOKIE['apiKey']; ?>`, this.parentElement.id)">
</div>
<div style = "display: none" class = "action-container share-container">
	<img src = "/images/Exit.png">
	<input id = 'share-file-email' type = "text" placeholder = "Insert recipient's email">
	<input onclick = "shareAudioFile(`<?php echo $_COOKIE['apiKey']; ?>`, this.parentElement.id)" type = "button" value = "Share">
</div>
<div style = "display: none" class = "action-container delete-container">
	<p>Are you sure you want to <strong>permanently</strong> delete this file? You will not be able to get it back.</p>
	<input type = "button" value = "Cancel" onclick = "this.parentElement.style.display = 'none';">
	<input type = "button" value = "Delete" onclick = "deleteAudioFile(`<?php echo $_COOKIE['apiKey']; ?>`, this.parentElement.id.substring(17))">
</div>
<div style = "display: none" class = "action-container rename-container">
	<img src = "/images/Exit.png">
	<input type = "text" value = "">
	<input type = "button" value = "Rename" onclick = "renameFolder(`<?php echo $_COOKIE['apiKey']; ?>`, this.parentElement.id)">
</div>
<div style = "display: none" class = "action-container share-container">
	<img src = "/images/Exit.png">
	<input type = "text" id = "share-folder-email" placeholder = "Insert recipient's email">
	<input onclick = "shareFolder(`<?php echo $_COOKIE['apiKey']; ?>`, this.parentElement.id)" type = "button" value = "Share">
</div>
<div style = "display: none" class = "action-container delete-container">
	<p>Are you sure you want to <strong>permanently</strong> delete this folder? You will not be able to get it back.</p>
	<input type = "button" value = "Cancel" onclick = "this.parentElement.style.display = 'none';">
	<input type = "button" value = "Delete" onclick = "deleteFolder(`<?php echo $_COOKIE['apiKey']; ?>`, this.parentElement.id.substring(18))">
</div>
<div style = "display: none" class = "action-container create-container">
	<img src = "/images/Exit.png" />
	<label>File Name</label>
	<input name="filename" value="New Audio" focus />
	<button>Cancel</button>
	<button onclick = "createNewFile(`<?php echo $_COOKIE['apiKey']; ?>`, this.previousElementSibling.value)">Create</button>
</div>
<div style = "display: none" class = "action-container create-container">
	<img src = "/images/Exit.png" />
	<label>Folder Name</label>
	<input name="foldername" value="New Folder" focus />
	<button>Cancel</button>
	<button onclick = "createNewFolder('<?php echo $_COOKIE['apiKey']; ?>', this.parentElement.querySelector(`input[name='foldername']`).value)">Create</button>
</div>
<div class = "new-media-btn-container"></div>
<div class = "status-container" style = "display: none"></div>
<?php
include('footer.html');
?>
</div>

<?php 
require('scripts.html');
?>

<script>
getAndDisplayFolderElements('<?php echo $_COOKIE['apiKey']; ?>');
</script>

</body>
</html>
