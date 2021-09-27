/************ ReplaceAllTextareas ***************/
window.onload = function()
{	// replace all of the textareas
	var allTextAreas = document.getElementsByTagName("textarea");
	for (var i=0; i<allTextAreas.length; i++)
	{	if(allTextAreas[i].getAttribute("noneEditor") == null)
		{	
			var oFCKeditor = CKEDITOR.replace(allTextAreas[i].name);
			CKFinder.setupCKEditor( oFCKeditor, CKEDITOR.basePath+'ckfinder/' );
			CKEDITOR.dtd.a.div = 1;
			CKEDITOR.dtd.a.p = 1;
		}
	}
}

function setEditorValue(instanceName, text)
{	// Get the editor instance that we want to interact with.
	var oEditor = CKEDITOR.instances[instanceName];
	// Set the editor contents.
	oEditor.setData(text);
}