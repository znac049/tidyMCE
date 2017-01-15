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

      loadInnerBrowser(url);
    });

    function loadInnerBrowser(url) {
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

      setTitle("Pippi");
    }

    function setSelection(name) {
      var args = top.tinymce.activeEditor.windowManager.getParams();

      win = (args.window);
      input = (args.input);

      name = name.replace('/thumbnails', '');
      win.document.getElementById(input).value = name;

      top.tinymce.activeEditor.windowManager.close();
    };

    function setTitle(title) {
      $(".mce-title").each(function() {
        $(this).text("Bilbo");
      });
    }

    function changeFolder(dest) {
      var url = "/bl-plugins/tidyMCE/browser/images.php?type=image&folder=" + dest;

      loadInnerBrowser(url);
    }

    function dbg(msg) {
      alert(msg);
    }
  </script> 
</html>
