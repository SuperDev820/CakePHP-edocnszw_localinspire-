/*=========================================================================================
    File Name: components-modal.js
    Description: Modals are streamlined, but flexible, dialog prompts with the minimum 
				required functionality and smart defaults.
    ----------------------------------------------------------------------------------------
    Item Name: Backend - Responsive Admin Theme
    Version: 2.1
    Author: Pixinvent
    Author URL: hhttp://www.themeforest.net/user/pixinvent
==========================================================================================*/
(function(window, document, $) {
	'use strict';

    // $('#myModal').modal();
    $('.modal').appendTo("body");

     // onShow event
    $('#onshowbtn').on('click', function() {
        $('#onshow').on('show.bs.modal', function() {
            alert('onShow event fired.');
        });
    });

    // onShown event
    $('#onshownbtn').on('click', function() {
        $('#onshown').on('shown.bs.modal', function() {
            alert('onShown event fired.');
        });
    });

    // onHide event
    $('#onhidebtn').on('click', function() {
        $('#onhide').on('hide.bs.modal', function() {
            alert('onHide event fired.');
        });
    });

    // onHidden event
    $('#onhiddenbtn').on('click', function() {
        $('#onhidden').on('hidden.bs.modal', function() {
            alert('onHidden event fired.');
        });
    });
})(window, document, jQuery);