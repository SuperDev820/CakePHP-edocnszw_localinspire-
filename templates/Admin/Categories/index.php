<?php $this->assign('title', 'Categories'); ?>
<style>
    td {
        text-align: left;
    }
</style>
<!-- File export table -->
<section id="file-export">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title"> Categories</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="<?= $this->Url->build(['action' => 'add']); ?>" class="btn round btn-raised btn-dark">
                                <i class="fa fa-plus"></i>&nbsp; New Category
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">
                        <!-- <p class="card-text">Exporting data from a table can often be a key part of a complex application. The Buttons extension
                            for DataTables provides three plug-ins that provide overlapping functionality for data export.</p> -->

                        <table class="table table-striped table-bordered file-export index_table custom_table" id="categories_table">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <!-- <th>SKU</th> -->
                                    <!-- <th>Description</th> -->
                                    <!-- <th>Active</th> -->
                                    <!-- <th>Featured</th> -->
                                    <th>Created</th>
                                    <th>Modified</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sn = 1;
                                foreach ($categories as $category) : ?>
                                    <tr>
                                        <td>
                                            <?= $sn++ ?>
                                        </td>
                                        <td>
                                            <?= h($category->name) ?>
                                        </td>
                                        <!-- <td>
                                        <?= h($category->sku) ?>
                                    </td> -->
                                        <!-- <td>
                                        <?= $this->Text->autoParagraph(h($category->description)); ?>
                                    </td> -->
                                        <!-- <td>
                                        <?= $category->active ? "Yes" : "No" ?>
                                    </td>
                                    <td>
                                        <?= $category->featured ? "Yes" : "No" ?>
                                    </td> -->
                                        <td>
                                            <?= $this->Time->timeAgoInWords($category->created) ?>
                                        </td>
                                        <td>
                                            <?= $this->Time->timeAgoInWords($category->modified) ?>
                                        </td>
                                        <td class="actions">

                                            <?= $this->Html->link(__('<i class="fa fa-edit"></i>'), ['action' => 'edit', $category->id], ['class' => 'btn btn-xs btn-raised btn-warning btn-icon mr-1 btn-sm', 'escape' => false]) ?>
                                            <?= $this->Form->postLink(__('<i class="fas fa-trash-alt"></i>'), ['action' => 'delete', $category->id], ['confirm' => __('Are you sure you want to delete # {0}?', $category->id), 'class' => 'btn btn-xs btn btn-raised btn-icon btn-danger mr-1 btn-sm', 'escape' => false]) ?>


                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <!-- <th>SKU</th> -->
                                    <!-- <th>Description</th> -->
                                    <!-- <th>Active</th> -->
                                    <!-- <th>Featured</th> -->
                                    <th>Created</th>
                                    <th>Modified</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- File export table -->
<!-- BEGIN PAGE LEVEL JS-->
<!-- <script src="<?= $this->Url->build('/backend/', ['fullBase' => true]); ?>app-assets/js/data-tables/datatable-advanced.js" type="text/javascript"></script> -->
<!-- END PAGE LEVEL JS-->
<?= $this->element('datatable_options', ["record_name" => 'categories', 'specific_id' => "categories_table", "record_count" => count($categories)]) ?>
<script>
    $(document).ready(function() {

    });
</script>