/**
 * Background video wrapper.
 *
 * @author StupidRommy
 * @version 1.0
 *
 */
;(function ($) {
  'use strict';

  $.SRCore.components.SRBgVideo = {
    /**
     * Rating.
     *
     * @return undefined
     */
    init: function (el) {
      var $selector = $(el);

      $selector.srBgVideo();
    }
  };
})(jQuery);
