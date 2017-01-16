tinymce.PluginManager.add('lightbox', function(editor, url) {
  var groupId = 0;

  function genGroupName() {
    groupId++;

    return 'lb' + groupId;
  }

  function genElems(form) {
    var html = '<a href="' + form.src + '" ' +
                  'data-lightbox="' + genGroupName() + '" ' +
                  'data-title="Pippi">';

    html += '<img src="' + form.src + '"></img>';

    html += '</a>';

    alert("Woo: " + form.src);

    return html;
  } 

  // Add a button that opens a window
  editor.addButton('lightbox', {
    text: 'Lightbox',
    icon: false,
    onclick: function() {
      // Open window
      editor.windowManager.open({
        title: 'Single Lightbox Image',
        body: [
	  {
	    name: 'src', 
	    type: 'filepicker', 
	    filetype: 'image',
            label: 'Source'
	  },
          {
            name: 'title', 
	    type: 'textbox',
            label: 'Title'
          }
        ],
        onsubmit: function(e) {
          // Insert content when the window form is submitted
          editor.insertContent(genElems(e.data));
        }
      });
    }
  });
});
