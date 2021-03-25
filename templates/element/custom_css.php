<style type="text/css">
    html,
    body {
        overflow-x: hidden;
    }

    .selectimage {
        border: 4px solid red !important;
    }

    p#googlebuttonclick {
        cursor: pointer;
    }

    .fb_hidden {
        position: absolute;
        top: -10000px;
        z-index: 10001
    }

    .fb_reposition {
        overflow: hidden;
        position: relative
    }

    .fb_invisible {
        display: none
    }

    .fb_reset {
        background: none;
        border: 0;
        border-spacing: 0;
        color: #000;
        cursor: auto;
        direction: ltr;
        font-family: "lucida grande", tahoma, verdana, arial, sans-serif;
        font-size: 11px;
        font-style: normal;
        font-variant: normal;
        font-weight: normal;
        letter-spacing: normal;
        line-height: 1;
        margin: 0;
        overflow: visible;
        padding: 0;
        text-align: left;
        text-decoration: none;
        text-indent: 0;
        text-shadow: none;
        text-transform: none;
        visibility: visible;
        white-space: normal;
        word-spacing: normal
    }

    .fb_reset>div {
        overflow: hidden
    }

    @keyframes fb_transform {
        from {
            opacity: 0;
            transform: scale(.95)
        }

        to {
            opacity: 1;
            transform: scale(1)
        }
    }

    .fb_animate {
        animation: fb_transform .3s forwards
    }

    .fb_dialog {
        background: rgba(82, 82, 82, .7);
        position: absolute;
        top: -10000px;
        z-index: 10001
    }

    .fb_dialog_advanced {
        border-radius: 8px;
        padding: 10px
    }

    .fb_dialog_content {
        background: #fff;
        color: #373737
    }

    .fb_dialog_close_icon {
        background: url(https://static.xx.fbcdn.net/rsrc.php/v3/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 0 transparent;
        cursor: pointer;
        display: block;
        height: 15px;
        position: absolute;
        right: 18px;
        top: 17px;
        width: 15px
    }

    .fb_dialog_mobile .fb_dialog_close_icon {
        left: 5px;
        right: auto;
        top: 5px
    }

    .fb_dialog_padding {
        background-color: transparent;
        position: absolute;
        width: 1px;
        z-index: -1
    }

    .fb_dialog_close_icon:hover {
        background: url(https://static.xx.fbcdn.net/rsrc.php/v3/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 -15px transparent
    }

    .fb_dialog_close_icon:active {
        background: url(https://static.xx.fbcdn.net/rsrc.php/v3/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 -30px transparent;
    }

    .fb_dialog_iframe {
        line-height: 0
    }

    .fb_dialog_content .dialog_title {
        background: #6d84b4;
        border: 1px solid #365899;
        color: #fff;
        font-size: 14px;
        font-weight: bold;
        margin: 0;
    }

    .fb_dialog_content .dialog_title>span {
        background: url(https://static.xx.fbcdn.net/rsrc.php/v3/yd/r/Cou7n-nqK52.gif) no-repeat 5px 50%;
        float: left;
        padding: 5px 0 7px 26px
    }

    body.fb_hidden {
        height: 100%;
        left: 0;
        margin: 0;
        overflow: visible;
        position: absolute;
        top: -10000px;
        transform: none;
        width: 100%;
    }

    .fb_dialog.fb_dialog_mobile.loading {
        background: url(https://static.xx.fbcdn.net/rsrc.php/v3/ya/r/3rhSv5V8j3o.gif) white no-repeat 50% 50%;
        min-height: 100%;
        min-width: 100%;
        overflow: hidden;
        position: absolute;
        top: 0;
        z-index: 10001;
    }

    .fb_dialog.fb_dialog_mobile.loading.centered {
        background: none;
        height: auto;
        min-height: initial;
        min-width: initial;
        width: auto;
    }

    .fb_dialog.fb_dialog_mobile.loading.centered #fb_dialog_loader_spinner {
        width: 100%;
    }

    .fb_dialog.fb_dialog_mobile.loading.centered .fb_dialog_content {
        background: none;
    }

    .loading.centered #fb_dialog_loader_close {
        clear: both;
        color: #fff;
        display: block;
        font-size: 18px;
        padding-top: 20px;
    }

    #fb-root #fb_dialog_ipad_overlay {
        background: rgba(0, 0, 0, .4);
        bottom: 0;
        left: 0;
        min-height: 100%;
        position: absolute;
        right: 0;
        top: 0;
        width: 100%;
        z-index: 10000
    }

    #fb-root #fb_dialog_ipad_overlay.hidden {
        display: none;
    }

    .fb_dialog.fb_dialog_mobile.loading iframe {
        visibility: hidden;
    }

    .fb_dialog_mobile .fb_dialog_iframe {
        position: sticky;
        top: 0;
    }

    .fb_dialog_content .dialog_header {
        background: linear-gradient(from(#738aba), to(#2c4987));
        border-bottom: 1px solid;
        border-color: #1d3c78;
        box-shadow: white 0 1px 1px -1px inset;
        color: #fff;
        font: bold 14px Helvetica, sans-serif;
        text-overflow: ellipsis;
        text-shadow: rgba(0, 30, 84, .296875) 0 -1px 0;
        vertical-align: middle;
        white-space: nowrap;
    }

    .fb_dialog_content .dialog_header table {
        height: 43px;
        width: 100%;
    }

    .fb_dialog_content .dialog_header td.header_left {
        font-size: 12px;
        padding-left: 5px;
        vertical-align: middle;
        width: 60px;
    }

    .fb_dialog_content .dialog_header td.header_right {
        font-size: 12px;
        padding-right: 5px;
        vertical-align: middle;
        width: 60px;
    }

    .fb_dialog_content .touchable_button {
        background: linear-gradient(from(#4267B2), to(#2a4887));
        background-clip: padding-box;
        border: 1px solid #29487d;
        border-radius: 3px;
        display: inline-block;
        line-height: 18px;
        margin-top: 3px;
        max-width: 85px;
        padding: 4px 12px;
        position: relative
    }

    .fb_dialog_content .dialog_header .touchable_button input {
        background: none;
        border: none;
        color: #fff;
        font: bold 12px Helvetica, sans-serif;
        margin: 2px -12px;
        padding: 2px 6px 3px 6px;
        text-shadow: rgba(0, 30, 84, .296875) 0 -1px 0
    }

    .fb_dialog_content .dialog_header .header_center {
        color: #fff;
        font-size: 16px;
        font-weight: bold;
        line-height: 18px;
        text-align: center;
        vertical-align: middle;
    }

    .fb_dialog_content .dialog_content {
        background: url(https://static.xx.fbcdn.net/rsrc.php/v3/y9/r/jKEcVPZFk-2.gif) no-repeat 50% 50%;
        border: 1px solid #4a4a4a;
        border-bottom: 0;
        border-top: 0;
        height: 150px;
    }

    .fb_dialog_content .dialog_footer {
        background: #f5f6f7;
        border: 1px solid #4a4a4a;
        border-top-color: #ccc;
        height: 40px;
    }

    #fb_dialog_loader_close {
        float: left;
    }

    .fb_dialog.fb_dialog_mobile .fb_dialog_close_button {
        text-shadow: rgba(0, 30, 84, .296875) 0 -1px 0;
    }

    .fb_dialog.fb_dialog_mobile .fb_dialog_close_icon {
        visibility: hidden;
    }

    #fb_dialog_loader_spinner {
        animation: rotateSpinner 1.2s linear infinite;
        background-color: transparent;
        background-image: url(https://static.xx.fbcdn.net/rsrc.php/v3/yD/r/t-wz8gw1xG1.png);
        background-position: 50% 50%;
        background-repeat: no-repeat;
        height: 24px;
        width: 24px
    }

    @keyframes rotateSpinner {
        0% {
            transform: rotate(0deg)
        }

        100% {
            transform: rotate(360deg)
        }
    }

    .fb_iframe_widget {
        display: inline-block;
        position: relative
    }

    .fb_iframe_widget span {
        display: inline-block;
        position: relative;
        text-align: justify
    }

    .fb_iframe_widget iframe {
        position: absolute
    }

    .fb_iframe_widget_fluid_desktop,
    .fb_iframe_widget_fluid_desktop span,
    .fb_iframe_widget_fluid_desktop iframe {
        max-width: 100%
    }

    .fb_iframe_widget_fluid_desktop iframe {
        min-width: 220px;
        position: relative
    }

    .fb_iframe_widget_lift {
        z-index: 1
    }

    .fb_iframe_widget_fluid {
        display: inline
    }

    .fb_iframe_widget_fluid span {
        width: 100%
    }

    .alert-warning {
        color: #856404;
        background-color: #fff3cd;
        border-color: #ffeeba;
        z-index: 999;
    }

    li.label.small.font-weight-bold.text-body.text-left.mb-1 {
        display: none;
    }

    #explore-by {
        border-radius: 5px;
    }

    #suggestion_contianer {
        max-height: 300px;
        /*box-shadow: 0 1px 5px black;*/
    }

    #location_contianer {
        max-height: 300px;
        /*overflow: hidden;*/
        /*overflow-y: scroll;*/
    }

    #location_pretext {
        max-height: 300px;
    }



    .select2-selection__rendered {
        display: block !important;
    }

    /* This clears selected options from the list */

    .select2-results__option[aria-selected=true] {
        display: none;
    }


    .select2-container--open {
        z-index: 10000000000;
    }

    /*
                Custom Radio Styling
        */

    @keyframes click-wave {
        0% {
            height: 40px;
            width: 40px;
            opacity: 0.35;
            position: relative;
        }

        100% {
            height: 110px;
            width: 110px;
            margin-left: -50px;
            margin-top: -50px;
            opacity: 0;
        }
    }

    .option-input {
        -webkit-appearance: none;
        -moz-appearance: none;
        -ms-appearance: none;
        -o-appearance: none;
        appearance: none;
        position: relative;
        top: 13.33333px;
        right: 0;
        bottom: 0;
        left: 0;
        height: 40px;
        width: 40px;
        transition: all 0.15s ease-out 0s;
        background: #cbd1d8;
        border: none;
        color: #fff;
        cursor: pointer;
        display: inline-block;
        margin-right: 0.5rem;
        outline: none;
        position: relative;
        z-index: 1000;
    }

    .option-input:hover {
        /* background: #9faab7; */
        /* background: #01D8DA */
        /* ; */
        background: #FF6D02;

    }

    .option-input:checked {
        /* background: #40e0d0; */
        /* background: #01D8DA; */
        /* background: #FF6D02; */
        background: #008AE6;

    }

    .option-input:checked::before {
        height: 40px;
        width: 40px;
        position: absolute;
        content: '✔';
        display: inline-block;
        font-size: 26.66667px;
        text-align: center;
        line-height: 40px;
    }

    .option-input:checked::after {
        -webkit-animation: click-wave 0.65s;
        -moz-animation: click-wave 0.65s;
        animation: click-wave 0.65s;
        background: #40e0d0;
        content: '';
        display: block;
        position: relative;
        z-index: 100;
    }

    .option-input.radio {
        border-radius: 50%;
    }

    .option-input.radio::after {
        border-radius: 50%;
    }

    .error-message {
        color: red;
    }

    .dtp-buttons .dtp-btn-clear {
        margin-right: 10px !important;
    }

    .dtp-buttons .dtp-btn-cancel {
        margin-right: 10px !important;
    }

    .dtp-buttons .dtp-btn-ok:hover {
        background: #8BC34A;
    }

    .dtp-buttons .dtp-btn-cancel:hover {
        background: #8BC34A;
    }

    .datepicker td,
    .datepicker th {
        padding: 10px;
    }

    table.dataTable tbody>tr.selected,
    table.dataTable tbody>tr>.selected {
        background-color: cadetblue;
    }

    #search_list {
        /* width: 100%; */
        max-height: 300px;
        overflow: hidden;
        overflow-y: scroll;
        height: auto;
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
        border: 1px solid #e7e7e7;

    }

    .search_list {
        top: 50px;
        left: 15px;
        width: 100%;
        position: absolute;
        z-index: 999;
        display: none;
    }

    #explore-by .sub_cate {
        background: #fff;
        padding: 6px 10px;
        margin-bottom: 0px;
        text-align: left;
    }

    #explore-by li {
        list-style: none;
    }

    /* .cate_remove:hover {} */

    #another_cate {}

    .one_cate {
        display: flex;
    }

    .one_cate>div {
        padding: 5px 10px 5px 0;
    }

    .u-range-slider .irs-from,
    .u-range-slider .irs-to {
        background-color: #008ae6;
        color: white !important;
    }

    .u-range-slider .irs-slider {
        border: 3px solid #008ae6;
    }

    .u-slick {
        background: url(<?= $this->Url->build('/svg/', ['fullBase' => true]); ?>circle-preloader.svg) no-repeat 50% 50%;
    }

    .svg-preloader {
        z-index: -1;
        background: #fff url(<?= $this->Url->build('/svg/', ['fullBase' => true]); ?>circle-preloader.svg) center no-repeat !important;
        overflow: hidden;
        transition: all 0.4s ease-in;
    }


    .timerangepicker-container {
        display: flex;
        position: absolute;
    }

    .timerangepicker-label {
        display: block;
        line-height: 2em;
        background-color: #c8c8c880;
        padding-left: 1em;
        border-bottom: 1px solid grey;
        margin-bottom: 0.75em;
    }

    .timerangepicker-from,
    .timerangepicker-to {
        border: 1px solid grey;
        padding-bottom: 0.75em;
    }

    .timerangepicker-from {
        border-right: none;
    }

    .timerangepicker-display {
        box-sizing: border-box;
        display: inline-block;
        width: 2.5em;
        height: 2.5em;
        border: 1px solid grey;
        line-height: 2.5em;
        text-align: center;
        position: relative;
        margin: 1em 0.175em;
    }

    .timerangepicker-display .increment,
    .timerangepicker-display .decrement {
        cursor: pointer;
        position: absolute;
        font-size: 1.5em;
        width: 1.5em;
        text-align: center;
        left: 0;
    }

    .timerangepicker-display .increment {
        margin-top: -0.25em;
        top: -1em;
    }

    .timerangepicker-display .decrement {
        margin-bottom: -0.25em;
        bottom: -1em;
    }

    .timerangepicker-display.hour {
        margin-left: 1em;
    }

    .timerangepicker-display.period {
        margin-right: 1em;
    }

    .datepicker,
    .blockUI {
        z-index: 999999999 !important;
    }
</style>

<style>
    /* for shadow */
    .dropdown-menu::before {
        border-bottom: 9px solid rgba(0, 0, 0, 0.2);
        border-left: 9px solid rgba(0, 0, 0, 0);
        border-right: 9px solid rgba(0, 0, 0, 0);
        content: "";
        display: inline-block;
        left: 10%;
        /* position */
        position: absolute;
        top: -8px;
    }

    .dropdown-menu::after {
        border-bottom: 8px solid #FFFFFF;
        border-left: 9px solid rgba(0, 0, 0, 0);
        border-right: 9px solid rgba(0, 0, 0, 0);
        content: "";
        display: inline-block;
        left: 10%;
        /* position */
        position: absolute;
        top: -7px;

    }

    .photo_helpful {
        display: inline-block;
    }

    .photo_helpful .tooltiptext {
        font-size: 12px;
        display: none;
        width: 120px;
        background-color: black;
        color: #fff;
        text-align: center;
        padding: 3px 5px;
        position: relative;
        z-index: 1;
        bottom: 150%;
        left: 10%;
    }

    .photo_helpful .tooltiptext::before {
        content: "";
        position: absolute;
        top: 26%;
        left: 0%;
        margin-left: -10px;
        border-width: 5px;
        border-style: solid;
        border-color: transparent black transparent transparent;
    }

    .report_helpful_gallery {
        position: absolute;
        right: 370px;
        bottom: 100px;
        font-size: 16px;
    }

    .report_helpful_gallery button {

        height: 40px;
        margin: 6px;
    }

    .image-gallery-item {
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        height: 250px;

    }

    .pagination {
        flex-wrap: wrap;
    }

    .review-image-gallery-item {
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        height: 150px;
    }

    .space1 {
        padding-right: 1px !important;
        padding-left: 1px !important;
        border-radius: 0px !important;
    }

    .spaceb {
        padding-bottom: 1px !important;
    }

    .imgh {
        width: 100%;
        height: 250px;
    }

    .rimgh {
        width: 100%;
        height: 150px;
    }

    .rimgh1 {
        width: 100%;
        height: 150px;
    }

    .over_photo {
        display: flex;
        color: white;
        font-weight: bold;
        position: absolute;
        top: 0;
        width: 100%;
        height: 100%;
        font-size: 19px;
        background: rgba(0, 138, 230, .5);
        justify-content: center;
        align-items: center;
    }


    /*light gallery */
    .lg-outer .lg-thumb-outer {

        width: calc(100% - 350px);
        /*z-index: 1050;*/
        overflow: hidden;
    }

    .lg-outer.fb-comments .fb-comments {
        width: 350px;
    }

    .lg-outer.fb-comments .lg-img-wrap {
        padding-right: 350px !important;
    }

    .lg-outer.fb-comments .lg-toolbar {
        right: 350px;
    }

    .lg-outer.fb-comments .lg-actions .lg-next {
        right: 370px;
    }


    /* helpful */
    .ungive_helpful {
        color: #0073ca !important;
    }

    .ungive_helpful span {
        color: #0073ca !important;
        font-weight: bold;
    }

    #qa_for_business .gave_helpful {
        color: #0073ca !important;
        font-weight: bold;
    }

    #qa_for_business .gave_unhelpful {
        color: #0073ca !important;
        font-weight: bold;
    }

    #review_pagination .btn-xs {
        padding-top: 0.6rem;
        padding-bottom: 0.6rem;
    }

    #pills-one .custom-control-label::after {
        top: 0;
    }

    #pills-one .custom-control-label::before {
        top: 0;
    }

    @media only screen and (max-width: 900px) {
        .lg-outer .lg-img-wrap {
            position: unset;
        }

        .lg-outer.fb-comments .lg-img-wrap {
            padding-right: 0px !important;
        }

        .lg-outer.fb-comments .fb-comments {
            position: unset;
            /*width: 100%;*/
            padding: 10px 20px;
            background: black;
        }

        .lg-outer.lg-css3 .lg-prev-slide,
        .lg-outer.lg-css3 .lg-current,
        .lg-outer.lg-css3 .lg-next-slide {
            display: flex !important;
            justify-content: center;
            flex-direction: column;
        }

        .lg-outer .lg-item,
        .lg-outer .lg-img-wrap {
            height: auto;
        }

        .lg-outer .lg {
            width: 100%;
            height: 100%;
            overflow: hidden;
            overflow-y: scroll;
        }

        .lg-outer .lg-img-wrap {
            padding: 0px 0px;
        }

        .lg-outer.fb-comments .lg-toolbar {
            right: 0;
        }
    }

    .tooltip-inner {
        padding: 9px !important;
        max-width: 450px;
        /* set this to your maximum fitting width */
        width: inherit;
        /* will take up least amount of space */
    }


    .space8 {
        /*padding-right: 5px !important;*/
        /*padding-left: 4px !important;*/
        /*padding-bottom: 10px !important;*/
        padding: 10px;
        border-radius: 0px !important;
    }
</style>

<style>
    .review-image-gallery-item {
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        height: 150px;
        width: 200px;
    }

    #review_image_gallery {
        display: flex;
        justify-content: start;
        flex-wrap: wrap;

    }

    .photo_helpful {
        display: inline-block;
    }

    .photo_helpful .tooltiptext {
        font-size: 12px;
        display: none;
        width: 120px;
        background-color: black;
        color: #fff;
        text-align: center;
        padding: 3px 5px;
        position: relative;
        z-index: 1;
        bottom: 150%;
        left: 10%;
    }

    .photo_helpful .tooltiptext::before {
        content: "";
        position: absolute;
        top: 26%;
        left: 0%;
        margin-left: -10px;
        border-width: 5px;
        border-style: solid;
        border-color: transparent black transparent transparent;
    }

    .report_helpful_gallery {
        position: absolute;
        right: 370px;
        bottom: 100px;
        font-size: 16px;
    }

    .report_helpful_gallery button {

        height: 40px;
        margin: 6px;
    }

    .image-gallery-item {
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        height: 250px;

    }

    .pagination {
        flex-wrap: wrap;
    }

    .review-image-gallery-item {
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        height: 150px;
    }

    .space1 {
        padding-right: 1px !important;
        padding-left: 1px !important;
        border-radius: 0px !important;
    }

    .spaceb {
        padding-bottom: 1px !important;
    }

    .imgh {
        width: 100%;
        height: 250px;
    }

    .rimgh {
        width: 100%;
        height: 150px;
    }

    .rimgh1 {
        width: 100%;
        height: 150px;
    }

    .over_photo {
        display: flex;
        color: white;
        font-weight: bold;
        position: absolute;
        top: 0;
        width: 100%;
        height: 100%;
        font-size: 19px;
        background: rgba(0, 138, 230, .5);
        justify-content: center;
        align-items: center;
    }


    /*light gallery */
    .lg-outer .lg-thumb-outer {

        width: calc(100% - 350px);
        /*z-index: 1050;*/
        overflow: hidden;
    }

    .lg-outer.fb-comments .fb-comments {
        width: 350px;
    }

    .lg-outer.fb-comments .lg-img-wrap {
        padding-right: 350px !important;
    }

    .lg-outer.fb-comments .lg-toolbar {
        right: 350px;
    }

    .lg-outer.fb-comments .lg-actions .lg-next {
        right: 370px;
    }


    /* helpful */
    .ungive_helpful {
        color: #0073ca !important;
    }

    .ungive_helpful span {
        color: #0073ca !important;
        font-weight: bold;
    }

    #qa_for_business .gave_helpful {
        color: #0073ca !important;
        font-weight: bold;
    }

    #qa_for_business .gave_unhelpful {
        color: #0073ca !important;
        font-weight: bold;
    }

    #review_pagination .btn-xs {
        padding-top: 0.6rem;
        padding-bottom: 0.6rem;
    }

    #pills-one .custom-control-label::after {
        top: 0;
    }

    #pills-one .custom-control-label::before {
        top: 0;
    }

    @media only screen and (max-width: 900px) {
        .lg-outer .lg-img-wrap {
            position: unset;
        }

        .lg-outer.fb-comments .lg-img-wrap {
            padding-right: 0px !important;
        }

        .lg-outer.fb-comments .fb-comments {
            position: unset;
            /*width: 100%;*/
            padding: 10px 20px;
            background: black;
        }

        .lg-outer.lg-css3 .lg-prev-slide,
        .lg-outer.lg-css3 .lg-current,
        .lg-outer.lg-css3 .lg-next-slide {
            display: flex !important;
            justify-content: center;
            flex-direction: column;
        }

        .lg-outer .lg-item,
        .lg-outer .lg-img-wrap {
            height: auto;
        }

        .lg-outer .lg {
            width: 100%;
            height: 100%;
            overflow: hidden;
            overflow-y: scroll;
        }

        .lg-outer .lg-img-wrap {
            padding: 0px 0px;
        }

        .lg-outer.fb-comments .lg-toolbar {
            right: 0;
        }
    }

    .space8 {
        /*padding-right: 5px !important;*/
        /*padding-left: 4px !important;*/
        /*padding-bottom: 10px !important;*/
        padding: 10px;
        border-radius: 0px !important;
    }
</style>

<style>
    .rating:not(:checked)>input {
        position: absolute;
        top: 0;
        clip: rect(0, 0, 0, 0);
    }

    .select_rating .rating:not(:checked)>label {
        padding-left: 3px;
        padding-right: 3px;
        margin-right: 3px;
        font-size: 100%;
        margin-bottom: 0;
    }

    .image-desc-row {
        padding: 5px 5px;
        background: #FFF;
        border-width: 1px;
        border-style: solid;
        border-color: #ECEAE2 #ECEAE2 #DDDBD0 #ECEAE2;
        margin-top: 5px;
        margin-bottom: 5px;
    }

    .image-desc-row:hover {
        box-shadow: 0 3px 15px 0 rgba(0, 0, 0, 0.2);
    }

    .image-desc-row .image-part {
        padding: 5px;
    }

    .image-desc-row .desc-part {
        padding: 5px;
    }

    .image-desc-row:hover .action {
        display: block;
    }

    .ui_close_x {
        position: absolute;
        right: 25px !important;
    }

    .reviewphoto {
        border-radius: 5px;
    }

    #uploadedcontainer .list-group-item {
        padding: 10px;
    }

    #uploadedcontainer h5 {
        font-size: 14px;
    }

    .spinner-border {
        display: inline-block;
        width: 2rem;
        height: 2rem;
        vertical-align: text-bottom;
        border: .25em solid currentColor;
        border-right-color: transparent;
        border-radius: 50%;
        -webkit-animation: spinner-border .75s linear infinite;
        animation: spin .75s linear infinite;
    }

    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .upload_preload {
        position: absolute;
        width: 100%;
        height: 100%;
        display: none;
        /* text-align: center; */
        justify-content: center;
        align-items: center;
        z-index: 2000;
        background: rgba(255, 255, 255, 0.6);
    }

    .sort_of_visit>.btn {
        margin: 2.5px;
    }

    .sort_of_visit {
        justify-content: space-between;
        flex-wrap: wrap;
        margin-right: -2.5px;
        margin-left: -2.5px;
    }
</style>
<style>
    .morecontent span {
        display: none;
    }

    .morelink {
        display: block;
    }


    .daterangepicker {
        z-index: 9999999;
    }


    .answer_form .invalid-feedback {
        margin-left: 45px;
    }


    .sr-sub-menu,
    .sr-sub-menu-opened {
        z-index: 9999999 !important;
    }

    .accountnav {
        z-index: 1 !important;
    }

    .secondary_email_action {
        margin-right: 5px;
    }

    #btnGroupDrop1menu {
        left: -80px !important;
    }

    .notification_link {
        cursor: pointer;
    }

    .unread {
        background-color: #F0F8FF;
    }

    .new_notification_dot,
    .new_message_dot {
        margin-left: 12px;
        /* display: none; */
    }

    .cakedate select {
        /* height: 40px;
        padding: 10px; */

        /* display: block; */
        /* width: 100%; */
        height: calc(3rem + 2px);
        padding: 0.75rem 1rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #1e2022;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #d5dae2;
        border-radius: 0.25rem;
    }

    /* .readmorelink {
        overflow: hidden;
    } */

    /* .badge-pos {
        right: 15px;
    } */

    /* .u-header__nav-item,
    #breadcrumbNavBar,
    .u-header */

    .shadow-sm {
        box-shadow: 0 0 5px #ccc !important;
    }

    .card-img-top {
        min-height: 180px;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .tooltip-inner {
        padding: 5px !important;
        max-width: 450px;
        /* set this to your maximum fitting width */
        width: inherit;
        /* will take up least amount of space */
    }

    /* @group Blink */
    .blink {
        -webkit-animation: blink .75s linear infinite;
        -moz-animation: blink .75s linear infinite;
        -ms-animation: blink .75s linear infinite;
        -o-animation: blink .75s linear infinite;
        animation: blink .75s linear infinite;
    }

    @-webkit-keyframes blink {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 1;
        }

        50.01% {
            opacity: 0;
        }

        100% {
            opacity: 0;
        }
    }

    @-moz-keyframes blink {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 1;
        }

        50.01% {
            opacity: 0;
        }

        100% {
            opacity: 0;
        }
    }

    @-ms-keyframes blink {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 1;
        }

        50.01% {
            opacity: 0;
        }

        100% {
            opacity: 0;
        }
    }

    @-o-keyframes blink {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 1;
        }

        50.01% {
            opacity: 0;
        }

        100% {
            opacity: 0;
        }
    }

    @keyframes blink {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 1;
        }

        50.01% {
            opacity: 0;
        }

        100% {
            opacity: 0;
        }
    }

    /* @end */
</style>