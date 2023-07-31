/**
 * @file
 * Contain code for header elements
 */

(function ($, Drupal) {

  // Configure header Category block.


  // Configure header search block.
  Drupal.behaviors.dempoHeaderSearchBlock = {
    attach: function (context) {
      // var $searchBlock = $('header.navbar .block-search-navigation', context);
      var $searchBlock = $('.search-block-form', context);
      $('.search-icon', $searchBlock).on('click', function () {
        $('.search-contents', $searchBlock).toggle();
        $(this).toggleClass('active');
        return FALSE;
      });
    }
  };

  // Configure main menu for mobile screen.
 

})(window.jQuery, window.Drupal);
