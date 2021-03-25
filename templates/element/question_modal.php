<div id="questionModal" class="js-modal-window u-modal-window" style="width: 670px;">
    <div class="card">
        <!-- Header -->
        <header class="bg-white mt-3 py-3 px-5">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="h5 mb-0 bold"><i class="fas fa-question-circle txt-18"></i> Tips for submitting a good question</h3>

                <button type="button" class="close text-darker" aria-label="Close" onclick="Custombox.modal.close();">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </header>
        <!-- End Header -->

        <!-- Body -->
        <div class="card-body p-4 small">
            <p class="h6 bold">Make sure you follow the guidelines for asking questions...


                <div class="mb-2 mt-3"><i class="fas fa-circle txt-8"></i>&nbsp;&nbsp; Keep your question specific to <b><?= $business->name ?>'s</b> page. For example, 'Will the business make menu changes to accommodate dietary restrictions?'</div>

                <div class="mb-2"><i class="fas fa-circle txt-8"></i>&nbsp;&nbsp; Your question will be posted publicly. Please don't submit any personal information you don't want revealed.</div>

                <div class="mb-2"><i class="fas fa-circle txt-8"></i>&nbsp;&nbsp; This is NOT a place to vent, keep questions useful.</div>

                <div class="mb-2"><i class="fas fa-circle txt-8"></i>&nbsp;&nbsp; If you have a customer service issue or a complaint, please contact <b><?= $business->name ?></b> directly.</div>

                <div class="mb-2"><i class="fas fa-circle txt-8"></i>&nbsp;&nbsp; We do not tolerate filthy talk, cursing, threats, harassment, lewdness, hate speech, and other displays of bigotry, so leave it out.</div>

                <div class="mb-2"><i class="fas fa-circle txt-8"></i>&nbsp;&nbsp; The point of questions and answers is to help people get a better idea of where they are visiting, so please be as specific as you can. </div>
            </p>
        </div>
        <!-- End Body -->
    </div>
</div>