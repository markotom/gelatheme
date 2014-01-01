jQuery(document).ready(function($) {
  // carousel home
  $('#carousel').carousel();

  // carousel jellies
  $('.jelly .carousel').carousel({
    pause: true,
    interval: false
  });
});
