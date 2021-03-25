var srYTPlayers = {},
  srVimeoPlayers = {},
  srYTInit = (function () {
    var onReady_funcs = [],
      api_isReady = false;

    return function (func, b_before) {
      if (func === true) {
        api_isReady = true;
        for (var i = 0; i < onReady_funcs.length; i++) {
          onReady_funcs.shift()();
        }
      }
      else if (typeof func == "function") {
        if (api_isReady) func();
        else onReady_funcs[b_before ? "unshift" : "push"](func);
      }
    }
  })(),
  srVimeoInit = (function () {
    var onReady_funcs = [],
      api_isReady = false;

    return function (func, b_before) {
      if (func === true) {
        api_isReady = true;
        for (var i = 0; i < onReady_funcs.length; i++) {
          onReady_funcs.shift()();
        }
      }
      else if (typeof func == "function") {
        if (api_isReady) func();
        else onReady_funcs[b_before ? "unshift" : "push"](func);
      }
    }
  })();

$.fn.srBgVideo = function (options) {
  srYTAPICreate();
  srVimeoAPICreate();

  var YTVideo = $('[data-sr-bgv-type="youtube"]'),
    VimeoVideo = $('[data-sr-bgv-type="vimeo"]'),
    defaultVideo = $(this);

  if (YTVideo.length) {
    YTVideo.each(function (i) {
      var $this = $(this),
        ID = $this.data('sr-bgv-id'),
        loop = $this.data('sr-bgv-loop') ? 1 : 0,
        preview = $('<div class="sr-video-preview" style="background-image: url(//img.youtube.com/vi/' + ID + '/maxresdefault.jpg);"></div>');

      $this
        .css('position', 'relative')
        .prepend(preview)
        .prepend('<div id="srYTPlayer' + i + '" class="sr-youtube sr-bg-video" data-sr-bgv-id="' + ID + '" data-sr-bgv-loop="' + loop + '"></div>');
    });

    srYTInit(function () {
      if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) return;

      $('.sr-youtube').each(function (i) {
        var ID = $(this).attr('id'),
          videoID = $(this).data('sr-bgv-id'),
          loop = $(this).data('sr-bgv-loop') ? 1 : 0;

        return srYTPlayers[i] = new YT.Player(ID, {
          videoId: videoID,
          playerVars: {
            autoplay: 1,
            controls: 0,
            showinfo: 0,
            enablejsapi: 1,
            modestbranding: 1,
            iv_load_policy: 3,
            loop: loop,
            playlist: videoID
          },
          events: {
            'onReady': srYTReady,
            'onStateChange': srYTPlay
          }
        });
      });
    });
  }

  if (VimeoVideo.length) {
    VimeoVideo.each(function (i) {
      var $this = $(this),
        ID = $this.data('sr-bgv-id'),
        loop = $this.data('sr-bgv-loop') ? 1 : 0;

      function getComputerName() {
        $.getJSON('//www.vimeo.com/api/v2/video/' + ID + '.json?callback=?', function (data) {
          var preview = data[0].thumbnail_large;

          $this.prepend('<div class="sr-video-preview" style="background-image: url(' + preview + ');"></div>');
        });
      }

      getComputerName();

      $this
        .css('position', 'relative')
        .prepend('<div id="srVimeoPlayer' + i + '" class="sr-vimeo sr-bg-video" data-sr-bgv-id="' + ID + '" data-sr-bgv-loop="' + loop + '"></div>');
    });

    srVimeoInit(function () {
      if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) return;

      $('.sr-vimeo').each(function (i) {
        var ID = $(this).attr('id'),
          videoID = $(this).data('sr-bgv-id'),
          loop = $(this).data('sr-bgv-loop') ? 1 : 0;

        srVimeoPlayers[i] = new Vimeo.Player(ID, {
          id: videoID,
          loop: loop,
          title: false,
          portrait: false,
          byline: false,
          autoplay: true,
          autopause: false
        });

        srVimeoPlayers[i].setVolume(0);

        srVimeoPlayers[i].play().then(function () {
          var thisW = srVimeoPlayers[i].element.width,
            thisH = srVimeoPlayers[i].element.height,
            ratio = thisW / thisH;

          ratioCalc(srVimeoPlayers[i].element, ratio);

          $(window).resize(function () {
            ratioCalc(srVimeoPlayers[i].element, ratio);
          });

          $('*').on('blur change click dblclick error focus focusin focusout hover keydown keypress keyup load mousedown mouseenter mouseleave mousemove mouseout mouseover mouseup resize scroll select submit', function () {
            ratioCalc(srVimeoPlayers[i].element, ratio);
          });

          setTimeout(function () {
            $('#' + ID).prev().fadeOut(400);
          }, 3000);
        });
      });
    });
  }

  if (defaultVideo.length) {
    defaultVideo.not('[data-sr-bgv-type]').each(function () {
      var $this = $(this),
        path = $this.data('sr-bgv-path'),
        loop = $this.data('sr-bgv-loop') ? 'loop ' : '',
        template = '<video ' +
          'class="sr-html5 sr-bg-video"' +
          ' poster="" autoplay muted ' + loop + '>' +
          '<source src="' + path + '.mp4" type="video/mp4">' +
          '<source src="' + path + '.webm" type="video/webm">' +
          '<source src="' + path + '.ogv" type="video/ogg">' +
          'Your browser doesn\'t support HTML5 video.' +
          '</video>';

      $this
        .css('position', 'relative')
        .prepend(template);
    });
  }
};

//Ratio
function ratioCalc(target, ratio) {
  var windW = window.innerWidth,
    containerH = $(target).parents('[data-sr-bgv-id]').outerHeight(),
    containerW = $(target).parent('[data-sr-bgv-id]').outerWidth(),
    newW = ratio * containerH,
    newH = ratio * containerW;


  if (containerH > containerW) {
    $(target).css({
      'width': newW,
      'height': '130%'
    });
  } else {
    $(target).css({
      'width': newH,
      'height': windW > 1600 ? newH * .4 : newW
    });
  }
}

//YouTube
function srYTAPICreate() {
  if ($('[data-sr-bgv-type="youtube"]').length) {
    var script = document.createElement('script');
    script.src = '//www.youtube.com/player_api';

    var before = document.getElementsByTagName('script')[0];
    before.parentNode.insertBefore(script, before);
  }
}

function srYTReady(e) {
  e.target.mute();

  var thisW = e.target.a.width,
    thisH = e.target.a.height,
    ratio = thisW / thisH;

  ratioCalc(e.target.a, ratio);

  $(window).resize(function () {
    ratioCalc(e.target.a, ratio);
  });

  $('*').on('blur change click dblclick error focus focusin focusout hover keydown keypress keyup load mousedown mouseenter mouseleave mousemove mouseout mouseover mouseup resize scroll select submit', function () {
    ratioCalc(e.target.a, ratio);
  });
}

function srYTPlay(e) {
  if (e.data == YT.PlayerState.PLAYING) {
    setTimeout(function () {
      $(e.target.a).next().fadeOut(400);
    }, 3000);
  }
}

function onYouTubePlayerAPIReady() {
  srYTInit(true);
}

//Vimeo
function srVimeoAPICreate() {
  if ($('[data-sr-bgv-type="vimeo"]').length) {
    var script = document.createElement('script');
    script.src = '//player.vimeo.com/api/player.js';

    var before = document.getElementsByTagName('script')[0];
    before.parentNode.insertBefore(script, before);
  }
}

srVimeoInit(true);