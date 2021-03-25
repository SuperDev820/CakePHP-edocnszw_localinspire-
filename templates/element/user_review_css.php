
<style>
	/* for shadow */
.dropdown-menu::before {
    border-bottom: 9px solid rgba(0, 0, 0, 0.2);
    border-left: 9px solid rgba(0, 0, 0, 0);
    border-right: 9px solid rgba(0, 0, 0, 0);
    content: "";
    display: inline-block;
    left: 80%; /* position */
    position: absolute;
    top: -8px;
}

.dropdown-menu::after {
    border-bottom: 8px solid #FFFFFF;
    border-left: 9px solid rgba(0, 0, 0, 0);
    border-right: 9px solid rgba(0, 0, 0, 0);
    content: "";
    display: inline-block;
    left: 80%; /* position */
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
		height:250px;

	}
	.pagination {
		flex-wrap: wrap;
	}
	.review-image-gallery-item{
		background-repeat: no-repeat;
		background-size: cover;
		background-position: center;
		height:300px;
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
	.over_photo{
		display: flex;
		color: white;
		font-weight: bold;
		position: absolute;
		top: 0;
		width: 100%;
		height: 100%;
		font-size: 19px;
		background: rgba(0, 138, 230,.5);
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
		color: #0073ca!important;
	}
	.ungive_helpful span {
		color: #0073ca!important;
		font-weight: bold;
	}
	#qa_for_business .gave_helpful {
		color: #0073ca!important;
		font-weight: bold;
	}
	#qa_for_business .gave_unhelpful {
		color: #0073ca!important;
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
		.lg-outer.lg-css3 .lg-prev-slide, .lg-outer.lg-css3 .lg-current, .lg-outer.lg-css3 .lg-next-slide {
			display: flex !important;
			justify-content: center;
			flex-direction: column;
		}
		.lg-outer .lg-item, .lg-outer .lg-img-wrap {
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
</style>
<style>
	.morecontent span {
		display: none;
	}
	.morelink {
		display: block;
	} /* Fading animation */
    .showanimation {
        -webkit-animation-name: showanimation;
        -webkit-animation-duration: 1.5s;
        animation-name: showanimation;
        animation-duration: 1.5s;
    }

    @-webkit-keyframes showanimation {
        from {opacity: .4}
        to {opacity: 1}
    }

    @keyframes showanimation {
        from {opacity: .4}
        to {opacity: 1}
    }
    /* Number text (1/3 etc) */
    .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
    }

    /* The dots/bullets/indicators */
    .dot {
        padding: 4px;
        cursor: pointer;
        height: 3px;
        width: 3px;
        margin: 0 5px;
        background-color: #c9cccf;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
    }

    .active, .dot:hover {
        background-color: white;
    }
    /* Next & previous buttons */
    .prev, .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        padding: 16px;
        margin-top: -22px;
        font-weight: bold;
        font-size: 18px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        user-select: none;
        color: white!important;
        display: none;
        background-color: rgba(0,0,0,0.8);
    }
    .review-image-gallery-item:hover > a.prev, .review-image-gallery-item:hover > a.next{
        display:block;
    }
    /*.review_image_gallery:hover > .dot_container{*/
    /*display: block;*/
    /*}*/
    .dot_container{
        position: absolute;
        bottom: 12px;
        left: 50%;
        transform: translate(-50%, 0);
        /*display: none;*/
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 5px;
    }
    .review-image-gallery-item {display: none}

    a.next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }


    .prev:hover, .next:hover {
        background-color: rgba(0,0,0,0.8);
        color: white!important;
    }

</style>