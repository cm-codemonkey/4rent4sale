tinymce.PluginManager.add('uploadimg', function(editor, url) {
	// Add a button that opens a window
	editor.addButton('uploadimg', {
		text: 'Uploads',
		icon: 'image',
		onclick: function() {
			// Open window
			editor.windowManager.open({
				title: 'Images uploads',
				width: 500,
			    height: 415,
			    file: url + "/main.php"
			});

			window.imgsurfer_activeEditor = editor;
		}
	});

});
