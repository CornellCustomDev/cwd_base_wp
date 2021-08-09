(function ($) {
  "use strict";
  console.log("loaded");
  $("#cd_news_expand").on("click", function () {
    $(".cd-news-show").toggle();
  });
})(jQuery);
