<?php $this->assign('title', 'Add Package'); ?>
<section id="horizontal-form-layouts">
    <div class="row">
        <div class="col-sm-12">
            <div class="content-header">Add Package</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <!-- <h4 class="card-title" id="horz-layout-basic">Project Info</h4>
	                <p class="mb-0">This is the basic horizontal form with labels on left and form controls on right in one line. Add <code>.form-horizontal</code> class to the form tag to have horizontal form styling. To define form sections use <code>form-section</code> class with any heading tags.</p> -->
                </div>
                <div class="card-body">
                    <div class="px-3">
                        <?php echo $this->element('package_form') ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

</section>