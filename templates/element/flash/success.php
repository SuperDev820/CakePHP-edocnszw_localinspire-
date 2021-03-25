<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>


    <!-- <div class="message success" onclick="this.classList.add('hidden')"><?=$message?></div> -->

    <div class="alert alert-success alert-dismissible mb-2" role="alert" style="text-align: center;color:black !important">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <!-- <strong>Success! </strong> -->
        <?=$message?>
    </div>
