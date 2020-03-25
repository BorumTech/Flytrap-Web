function deleteAudioFile(user_id, audio_id) {
	fetch(`/ajax/deleteaudio.php?user_id=${user_id}&audio_id=${audio_id}`, {method: 'get'}).then(response => {
		if (response.status >= 200 && response.status < 300) {
			return response.text();
		}
	}).then(response => {
		document.querySelector('.delete-container').textContent = response;
	});
}

function shareAudioFile(user_id, audio_id, share_id) {
	function deleteAudioFile(user_id, audio_id) {
		fetch(`/ajax/shareaudio.php?user_id=${user_id}&audio_id=${audio_id}`, {method: 'get'}).then(response => {
			if (response.status >= 200 && response.status < 300) {
				return response.text();
			}
		}).then(response => {
			document.querySelector('.share-container').style.display = 'none';
		});
	}
}