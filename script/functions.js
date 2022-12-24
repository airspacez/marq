function openEditor() {
	document.getElementById('editor').style.display = "flex";
}

function closeEditor() {
	document.getElementById('editor').style.display = "none";
}

function openEditnote() {
	document.getElementById('editnote').style.display = "flex";
}

function closeEditnote() {
	document.getElementById('editnote').style.display = "none";
}

function getNoteID() {
	let noteList = document.querySelectorAll('.note');
	noteList.forEach((note) => {
		let res = note.querySelector('.idNote').value;
		note.addEventListener('click', () => {
			openEditnote();
			let editNote = document.getElementById('editnote');
			editNote.querySelector('.id_note').value = res;
			editNote.querySelector('.editnote-title').value = note.querySelector('.note-title').innerHTML;
			editNote.querySelector('.editnote-text').value = note.querySelector('.note-preview').innerHTML;
		})
	})

}

getNoteID();
