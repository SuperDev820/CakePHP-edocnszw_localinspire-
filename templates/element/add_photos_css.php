<style>
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
</style>


<style>
    .photoUploader-dialog {
        width: 860px;
        height: 100%;
        box-sizing: border-box;
    }

    .photoUploader-header {
        height: 48px;
        line-height: 48px;
        background: #E9E8E3;
    }

    .photoUpload-heading {
        float: left;
        color: #000;
        font-size: 14px;
        line-height: 30px;
        white-space: nowrap;
        text-overflow: ellipsis;
        font-weight: bold;
    }

    .photoUpload-closebtn {
        line-height: 36px;
        color: #0069b5;
        opacity: 1;
        font-size: 26px;
    }

    .photoUploader-content {
        background: #F4F3F0;
        border-radius: 0;
    }

    .startScreen {
        text-align: center;
        background: #fff;
        box-sizing: border-box;
        border: 1px dashed #ccc;
    }

    .startScreen:before {
        content: '';
        display: inline-block;
        height: 100%;
        vertical-align: middle;
    }

    .startScreen .inner {
        display: inline-block;
        vertical-align: middle;
        font-size: 12px;
        width: 100%;
        margin-top: 170px;
        margin-bottom: 170px;
    }


    /* Important part */
    .photoUploader-dialog {
        overflow-y: initial !important
    }

    .photoUpload-body {
        height: 400px;
        overflow-y: auto;

    }

    .uploadimg {
        transform: rotate(0deg);
        background: #ccc;
        vertical-align: middle;
        max-width: 100%;
        max-height: 100%;
    }

    .itemRow {
        clear: both;
        margin: 5px 0px;
        padding: 6px;
        background: #FFF;
        border-width: 1px;
        border-style: solid;
        border-color: #ECEAE2 #ECEAE2 #DDDBD0 #ECEAE2;
    }

    .itemRow .preview {
        position: relative;
        float: left;
        width: 330px;
        height: 250px;
        overflow: hidden;
    }

    .imgcontainer {
        position: relative;
        height: 100%;
        width: 100%;
        text-align: center;
        background: #F4F3F0;
    }

    .imgcontainer:before {
        content: "";
        display: inline-block;
        height: 100%;
        vertical-align: middle;
    }

    .imgcontainer img {
        vertical-align: middle;
        max-width: 100%;
        max-height: 100%;
        transform: rotate(0deg);

    }

    /*.photoUploader-header
	{
	  position: relative;
		margin-top: -12px;
		display: block;
		height: 50px;
		width: 100%;
		line-height: 48px;
		background: #E9E8E3;
	}
	.photoUpload-heading {
		float: left;
		position: relative;
		color: #000;
		font-size: 14px;
		line-height: 46px;
		max-width: 65%;
		overflow: hidden;
		white-space: nowrap;
		text-overflow: ellipsis;
		font-weight:bold;
	}
	.photoUpload-closebtn
	{
		line-height: 50px;
		color: #0069b5;
		opacity: 1;
		font-size:26px;
	}
	.photoUploader-content
	{
		position: absolute;
		overflow: hidden;
		width: 100%;
		top: 48px;
		bottom: 0;
		box-sizing: border-box;
		background: #F4F3F0;
	}
	.startScreen
	{
	display: block;
	position: relative;
		text-align: center;
		background: #fff;
		height: 100%;
		box-sizing: border-box;
		font-size: 0;
			border: 1px dashed #ccc;
	}
	.startScreen:before {
		content: '';
		display: inline-block;
		height: 100%;
		vertical-align: middle;
	}
	.startScreen .inner {
		display: inline-block;
		vertical-align: middle;
		font-size: 12px;
		width: 100%;
	}
	.ui_button {
		font-family: Arial, Tahoma, "Bitstream Vera Sans", sans-serif;
	}
	.ui_button.primary {
		border-color: #00a680 #267060 #267060 #00a680;
		background-color: #00a680;
		color: #fff;
	}
	.ui_button.primary {
		border-color: #00a680 #267060 #267060 #00a680;
		background-color: #00a680;
		color: #fff;
	}*/
    .br0 {
        border-radius: 0;
    }

    .photouploaderlabel {
        font-size: 12px;
        line-height: 16px;
        color: #4a4a4a;
    }

    .itemRow:hover {
        box-shadow: 0 3px 20px 0 rgba(0, 0, 0, 0.2);
    }

    .action {
        display: none;
    }

    .itemRow:hover .action {
        display: block;
    }

    .ui_close_x {
        position: absolute;
        right: 3px;
    }

    .photouploader-footer {
        /*position: absolute;*/
        bottom: 0;
        left: 0;
        width: 100%;
        height: 72px;
        padding-left: 18px;
        box-sizing: border-box;
        overflow: hidden;
        border: 0;
        background: #FFF;
        /*box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.25);*/
        background: #FFF;
        /*box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.25);*/
    }

    .fileup {
        position: relative;
        overflow: hidden;
    }

    .phupload {
        position: absolute;
        font-size: 50px;
        opacity: 0;
        right: 0;
        top: 0;
    }

    .uploadlistcontainer {}

    .uploadlistcontainer:last-child {
        margin-bottom: 90px;
    }

    .errorMsg {
        background: #fce6e8;
        border: 1px solid #e43a42;
        color: #e43a42;
        font-weight: bold;
        padding: 12px;
    }

    #uploadedcontainer img {
        height: 60px;
        width: 60px;
    }

    .smallicon {
        font-size: 10px;
        vertical-align: middle;
        line-height: 0;
        margin-top: -3px;
        color: #4a4a4a;
    }

    .border0-table>tbody>tr>td,
    .border0-table>tbody>tr>th,
    .border0-table>tfoot>tr>td,
    .border0-table>tfoot>tr>th,
    .border0-table>thead>tr>td,
    .border0-table>thead>tr>th {
        padding: 4px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 0px solid #ddd;
    }

    /* for shadow */
    .dropdown-menu::before {
        border-bottom: 9px solid rgba(0, 0, 0, 0.2);
        border-left: 9px solid rgba(0, 0, 0, 0);
        border-right: 9px solid rgba(0, 0, 0, 0);
        content: "";
        display: inline-block;
        left: 15%;
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
        left: 15%;
        /* position */
        position: absolute;
        top: -7px;
    }
</style>
<!-- Add Review Photo Modal Window -->