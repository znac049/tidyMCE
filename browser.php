<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="/bl-plugins/tidyMCE/css/browser.css">
    <link rel="stylesheet" type="text/css" href="/bl-plugins/tidyMCE/css/browser.css">
  </head>
  <body>
    <div id="tidy-browser">
      Loading...
    </div>
  </body>

  <script src="/bl-plugins/tidyMCE/js/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
      var url = "/bl-plugins/tidyMCE/browser/images.php?type=image&folder=uploads";

      loadInnerBrowser(url, 'uploads');
    });

    function loadInnerBrowser(url, title) {
      $("#tidy-browser").load(url, function() {
        $(".tidymde-picker").click(function(){
          var url = $(this).attr("src");
          setSelection(url);
        });

        $(".tidymde-folder").click(function(){
          var folder = $(this).closest("div").attr("data-folder");
	  changeFolder(folder);
        });

        $(".tidy-inline").hover(
          function() { $(this).addClass("tidy-hover"); },
          function() { $(this).removeClass("tidy-hover"); }
        )
      });

      setTitle(title);
    }

    function setSelection(name) {
      var args = top.tinymce.activeEditor.windowManager.getParams();

      win = (args.window);
      input = (args.input);

      name = name.replace('/thumbnails', '');
      win.document.getElementById(input).value = name;

      top.tinymce.activeEditor.windowManager.close();
    };

    function changeFolder(dest) {
      var url = "/bl-plugins/tidyMCE/browser/images.php?type=image&folder=" + dest;

      loadInnerBrowser(url, dest);
    }

    function setTitle(title) {
      var args = top.tinymce.activeEditor.windowManager.getParams();
      var divs;

      win = (args.window);
      divs = win.document.getElementsByClassName("mce-title");

      // There should be two divs found, the "Insert Image" dialog and the 
      // Browser dialog. We rely on ours being the last item in the
      // array.
      divs[divs.length - 1].innerText = title;
    }
  </script> 
</html>
