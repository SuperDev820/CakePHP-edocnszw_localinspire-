<div id="sharereviewModal" class="js-modal-window u-modal-window" style="width: 575px;">
    <div class="card mb-9 pt-3">
        <!-- Header -->
        <header class="bg-white py-3 px-5">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="h5 mb-0 bold">Share review</h3>

                <button type="button" class="close text-darker" aria-label="Close" onclick="Custombox.modal.close();">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </header>
        <!-- End Header -->

        <div class="card-body bg-white">
            <div class="text-center pr-3 pl-3">

                <a data-js="facebook-share" class="sharereviewfb facebookshare" href="" target="_blank" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;">
                    <button type="button" class="btn btn-soft-facebookreg mb-1 mr-2 pr-5 pl-5"><i class="fab fa-facebook-f mr-2"></i> Share on Facebook</button>
                </a>
                <a href="" target="_blank" class="twittershare sharereviewtwitter" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;">
                    <button type="button" class="btn pr-5 pl-5 btn-soft-twitterreg mb-1"><i class="fab fa-twitter mr-2"></i> Share on Twitter</button>
                </a>
            </div>

            <!-- End Progress Step Form -->

            <!-- Clipboard Input -->
            <form>
               <div class="js-focus-state pr-3 pl-3 mb-3 mt-3">
                <div class="input-group ">
                        <input id="referralLink" type="text" class="form-control" value="<?= $this->Url->build($this->request->getRequestTarget(), ['fullBase' => true]); ?>">
                        <div class="input-group-append">
                            <a class="js-clipboard input-group-text" data-toggle="tooltip" data-placement="top" title="" data-original-title="Copy Url" onclick="$('input[id=referralLink]').select();document.execCommand('copy');" href="javascript:;" data-content-target="#referralLink" data-class-change-target="#linkIcon" data-default-class="fas fa-clone" data-success-class="fas fa-check">
                                <span id="linkIcon" class="fas fa-clone"></span>
                            </a>
                        </div>
                    </div>
                    <small class="form-text text-center text-graylt">Want to link to it instead? Copy the above URL!</small>
                </div>
            </form>

            <input type="hidden" name="review_id" value="">
            <input type="hidden" name="business_id" value="">

        </div>
    </div>
</div>