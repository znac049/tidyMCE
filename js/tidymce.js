$(document).ready(function() {
  tinymce.init({
    selector: '#jscontent',
    plugins: 'code emoticons link codesample image lists',
    toolbar: [
                'cut copy paste | formatselect bold italic underline strikethrough subscript superscript | alignleft aligncenter  alignright | link image codesample emoticons | code removeformat', 
                'undo redo | fontselect fontsizeselect | bullist numlist outdent indent blockquote removeformat'
             ],
    menubar: false,
    file_browser_callback: browseServerImages,
    document_base_url: '/bl-content/uploads/',
    relative_urls: true
  });
});

function editorAddImage(filename) {
  tinymce.activeEditor.execCommand('mceInsertContent', false, "Boom '" + filename + "'");
}

function browseServerImages(field_name, url, type, win) {
  tinyMCE.activeEditor.windowManager.open(
    {
      file: '/bl-plugins/tidyMCE/browser.php?type=' + type,
      title: 'Images',
      width: 900,
      height: 600,
      resizable: 'yes',
      plugins: 'media',
      inline: 'yes',
      close_previous: 'no'
    }, 
    {
      window: win,
      input: field_name
    }
  );

  return false;
}