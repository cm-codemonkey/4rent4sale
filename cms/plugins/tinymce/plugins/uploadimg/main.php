<?php

    include 'lib/config.php';
	include 'lib/funcions.php';

	if ( isset( $_POST['submit'] ) )
        move_uploaded_file($_FILES['file']['tmp_name'], BASE_RUTA.$_FILES['file']['name']);

?>
<html>
	<title>ImageSurfer</title>
	<head>


		<script type="text/javascript">
		// funcion que pasa la ruta de la img seleccionada al textarea
		function insertUrl(url){

		var parentWin = (!window.frameElement && window.dialogArguments) || opener || parent || top;
		   var parentEditor = parentWin.imgsurfer_activeEditor;
		   parentEditor.execCommand('mceInsertRawHTML', false, '<img src="'+url+'">');

		   top.tinymce.activeEditor.windowManager.close();
		}
		</script>
	</head>
<body>
<iframe name="visor" id="visor" width="100%" height="300" src="imglist.php" style="width: 100%;border: none;margin-bottom: 20px;"></iframe>
<form name="f" method="post" enctype="multipart/form-data" action="" style="display: -webkit-box;display: flex;justify-content: space-between;">
    <input name="file" type="file" size="30">
    <input type="submit" name="submit" value="Upload">
</form>
</body>
</html>
