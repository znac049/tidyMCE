tinymce.PluginManager.add('lightbox', function(editor, url) {
  var groupId = 0;
  var imagePrefix = '/bl-content/uploads/';

  function genGroupName() {
    groupId++;

    return 'lb' + groupId;
  }

  function tidyPath(src) {
    console.log("tidyPath() called with '" + src + "'");

    if (src.indexOf(imagePrefix) == 0) {
      src = src.substr(imagePrefix.length);
    }

    console.log("tidyPath='" + src + "'");

    return src;
  }

  function thumbPath(src) {
    var sep = src.lastIndexOf('/');
    var name;
    var prefix = '/bl-content/uploads/';

    console.log("thumbPath() called with '" + src + "'");

    if (sep == -1) {
      src = 'thumbnails/' + src;

      console.log("Thumb (no sep): " + src);
      return src;
    }

    name = src.substr(sep+1);
    src = src.substr(0, sep+1);

    src += 'thumbnails/' + name;

    if (src.indexOf(prefix + prefix) == 0) {
      src = src.substr(prefix.length);
    }

    console.log("thumbPath='" + src + "'");

    return src;
  }

  function genElems(form) {
    var img = tidyPath(form.src);
    var thumb = thumbPath(img);

    var html = '<a class="lightbox-href" href="#" ' +
                  'data-lightbox="' + genGroupName() + '" ' +
	          'data-tidy-src="' + img + '" ' +
                  'data-title="Pippi">';

    html += '<img class="lightbox-img" src="/bl-plugins/tidyMCE/images/singleframe.png" ' +
                  'data-tidy-src="' + thumb + '">';

    html += '</img></a>';

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
