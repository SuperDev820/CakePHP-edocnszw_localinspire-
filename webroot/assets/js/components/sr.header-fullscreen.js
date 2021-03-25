/**
 * SRHeaderFullscreen Component.
 *
 * @author StupidRommy
 * @version 1.0
 * @requires SRScrollBar component (hs.malihu-scrollbar.js v1.0.0)
 */
;(function ($) {
  'use strict';

  $.SRCore.components.SRHeaderFullscreen = {

    /**
     * Base configuration.
     *
     * @private
     */
    _baseConfig: {
      afterOpen: function(){},
      afterClose: function(){},
      overlayClass: 'u-fullscreen__overlay',
      sectionsContainerSelector: '.u-fullscreen__content'
    },


    /**
     * Contains all initialized items on the page.
     *
     * @private
     */
    _pageCollection: $(),

    /**
     * Initializes collection.
     *
     * @param {jQuery|HTMLElement} collection
     * @param {Object} config
     * @return {jQuery}
     */
    init: function( collection, config ) {

      var _self = this;

      if(!collection) return $();
      collection = $(collection)

      if(!collection.length) return $();

      config = config && $.isPlainObject(config) ? config : {};

      this._bindGlobalEvents();


      return collection.each(function(i,el){

        var $this = $(this),
            itemConfig = $.extend(true, {}, _self._baseConfig, config, $this.data());

        if( $this.data('SRHeaderFullscreen') ) return;

        $this.data('SRHeaderFullscreen', new SRHeaderFullscreen(
          $this,
          itemConfig,
          new SRHeaderFullscreenOverlayEffect()
        ));

        _self._pageCollection = _self._pageCollection.add($this);

      });

    },

    /**
     * Binds necessary global events.
     *
     * @private
     */
    _bindGlobalEvents: function() {

      var _self = this;


       $(window).on('resize.SRHeaderFullscreen', function() {

        if(_self.resizeTimeOutId) clearTimeout(_self.resizeTimeOutId);

        _self.resizeTimeOutId = setTimeout(function(){

          _self._pageCollection.each(function(i,el){

            var $this = $(el),
                SRHeaderFullscreen = $this.data('SRHeaderFullscreen');

            if(!SRHeaderFullscreen) return;

            SRHeaderFullscreen.update();

          });

        }, 50);

      });

      $(document).on('keyup.SRHeaderFullscreen', function(e){

        if(e.keyCode && e.keyCode == 27) {

          _self._pageCollection.each(function(i,el){

            var $this = $(el),
                SRHeaderFullscreen = $this.data('SRHeaderFullscreen'),
                hamburgers = SRHeaderFullscreen.invoker;

            if(!SRHeaderFullscreen) return;
            if(hamburgers.length && hamburgers.find('.is-active').length) hamburgers.find('.is-active').removeClass('is-active');
            SRHeaderFullscreen.hide();

          });

        }

      });

    }
  };

  /**
   * SRHeaderFullscreen.
   *
   * @param {jQuery} element
   * @param {Object} config
   * @param {Object} effect
   * @constructor
   */
  function SRHeaderFullscreen( element, config, effect ) {

    /**
     * Contains link to the current object.
     * @private
     */
    var _self = this;

    /**
     * Contains link to the current jQuery element.
     * @public
     */
    this.element = element;

    /**
     * Configuration object.
     * @public
     */
    this.config = config;

    /**
     * Object that describes animation of the element.
     * @public
     */
    this.effect = effect;

    /**
     * Contains link to the overlay element.
     * @public
     */
    this.overlay = $('<div></div>', {
      class: _self.config.overlayClass
    });

    Object.defineProperty(this, 'isShown', {
      get: function() {
        return _self.effect.isShown();
      }
    });

    Object.defineProperty(this, 'sections', {
      get: function() {
        return _self.element.find(_self.config.sectionsContainerSelector);
      }
    });

    this.element.append( this.overlay );
    this.effect.init( this.element, this.overlay, this.config.afterOpen, this.config.afterClose );
    this._bindEvents();

    if($.SRCore.components.SRScrollBar && this.sections.length) {

      $.SRCore.components.SRScrollBar.init( this.sections );

    }
  };

  /**
   * Binds necessary events.
   *
   * @public
   * @return {SRHeaderFullscreen}
   */
  SRHeaderFullscreen.prototype._bindEvents = function() {

    var _self = this;

    this.invoker = $('[data-target="#'+ this.element.attr('id') +'"]');

    if(this.invoker.length) {

      this.invoker.off('click.SRHeaderFullscreen').on('click.SRHeaderFullscreen', function(e){

        _self[ _self.isShown ? 'hide' : 'show' ]();

        e.preventDefault();

      });

    }

    return this;

  };

  /**
   * Updates the header.
   *
   * @public
   * @return {SRHeaderFullscreen}
   */
  SRHeaderFullscreen.prototype.update = function() {

    if(!this.effect) return false;

    this.effect.update();

    return this;
  };

  /**
   * Shows the header.
   *
   * @public
   * @return {SRHeaderFullscreen}
   */
  SRHeaderFullscreen.prototype.show = function() {

    if(!this.effect) return false;

    this.effect.show();

    return this;

  };

  /**
   * Hides the header.
   *
   * @public
   * @return {SRHeaderFullscreen}
   */
  SRHeaderFullscreen.prototype.hide = function() {

    // if(this.invoker && this.invoker.length) {
    //   var hamburgers = this.invoker.find('.is-active');
    //   if(hamburgers.length) hamburgers.removeClass('is-active');
    // }

    if(!this.effect) return false;

    this.effect.hide();

    return this;

  };

  /**
   * SRHeaderFullscreenOverlayEffect.
   *
   * @constructor
   */
  function SRHeaderFullscreenOverlayEffect() {
    this._isShown = false;
  };

  /**
   * Initialization of SRHeaderFullscreenOverlayEffect.
   *
   * @param {jQuery} element
   * @param {jQuery} overlay
   * @param {Function} afterOpen
   * @param {Function} afterClose
   * @public
   * @return {SRHeaderFullscreenOverlayEffect}
   */
  SRHeaderFullscreenOverlayEffect.prototype.init = function(element, overlay, afterOpen, afterClose) {

    var _self = this;

    this.element = element;
    this.overlay = overlay;
    this.afterOpen = afterOpen;
    this.afterClose = afterClose;

    this.overlay.on("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend", function(e){

      if(_self.isShown() && e.originalEvent.propertyName == 'transform') {
        _self.afterOpen.call(_self.element, _self.overlay);
      }
      else if(!_self.isShown() && e.originalEvent.propertyName == 'transform') {
        _self.afterClose.call(_self.element, _self.overlay);
      }

      e.stopPropagation();
      e.preventDefault();

    });

    this.update();

    this.overlay.addClass( this.element.data('overlay-classes') );

    return this;
  };

  /**
   * Detroys the overlay effect.
   *
   * @public
   * @return {SRHeaderFullscreenOverlayEffect}
   */
  SRHeaderFullscreenOverlayEffect.prototype.destroy = function() {

    this.overlay.css({
      'width': 'auto',
      'height': 'auto',
    });

    this.element.removeClass('u-fullscreen--showed');

    return this;
  };

  /**
   * Necessary updates which will be applied when window has been resized.
   *
   * @public
   * @return {SRHeaderFullscreenOverlayEffect}
   */
  SRHeaderFullscreenOverlayEffect.prototype.update = function() {

    var $w = $(window),
        $wW = $w.width(),
        $wH = $w.height();

    this.overlay.css({
      width: $wW > $wH ? $wW * 1.5 : $wH * 1.5,
      height: $wW > $wH ? $wW * 1.5 : $wH * 1.5
    });

    return this;
  };

  /**
   * Describes appear of the overlay.
   *
   * @public
   * @return {SRHeaderFullscreenOverlayEffect}
   */
  SRHeaderFullscreenOverlayEffect.prototype.show = function() {

    this.element.addClass('u-fullscreen--showed');
    this._isShown = true;

    return this;
  };

  /**
   * Describes disappearance of the overlay.
   *
   * @public
   * @return {SRHeaderFullscreenOverlayEffect}
   */
  SRHeaderFullscreenOverlayEffect.prototype.hide = function() {

    this.element.removeClass('u-fullscreen--showed');
    this._isShown = false;

    return this;
  };

  /**
   * Returns true if header has been opened, otherwise returns false.
   *
   * @public
   * @return {Boolean}
   */
  SRHeaderFullscreenOverlayEffect.prototype.isShown = function() {

    return this._isShown;
  };

})(jQuery);