function tweakImages()
{
    var n = 1;
    var prevHeight = 1;
    var prevWidth  = 1;

    $(".lightbox-href").each(function(){
      $(this).attr("href", $(this).attr("data-tidy-src"));
      console.log($(this).attr("data-tidy-src"));
    });

    $(".lightbox-img").each(function(){
      $(this).attr("src", $(this).attr("data-tidy-src"));
      console.log($(this).attr("data-tidy-src"));
    });
}

$(document).ready(function() {
    tweakImages();
});
