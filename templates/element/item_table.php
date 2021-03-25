<div class="table-responsive col-sm-12">
    <table class="table table-striped table-bordered file-export" id="<?=$idtouse?>">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Name</th>
                <!-- <th>Category</th> -->
                <th>Price</th>
                <th>Feat'd</th>
                <?php if (isset($showSku) && $showSku == true): ?> wishlisttable
                <th>SKU</th>
                <?php endif;?>
                <th>Active</th>
                <th>Created</th>
                <th>Modified</th>
                <th width="18%">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $sn = 1;foreach ($items as $item): ?>
            <tr>
                <td>
                    <?=$sn++?>
                </td>
                <td>
                    <?=ucwords($item->name)?>
                </td>
                <td>
                    <?=$naira?>
                    <?=$this->Number->format($item->main_price)?>
                </td>
                <!-- <td>
                                        <?=$this->Number->format($item->other_price)?>
                                    </td> -->
                <td>
                    <?=$item->featured ? "Yes" : "No"?>
                </td>
                <?php if (isset($showSku) && $showSku == true): ?>
                <td>
                    <?=$this->Custom->getSku($item)?>
                </td>
                <?php endif;?>
                <td>
                    <?=$item->active ? "Yes" : "No"?>
                </td>
                <!-- <td>
                 <?=$this->Number->format($this->Custom->getItemStock($item))?>
                                    </td> -->

                <td>
                    <?=$this->Time->timeAgoInWords($item->created)?>
                </td>
                <td>
                    <?=$this->Time->timeAgoInWords($item->modified)?>
                </td>
                <td class="actions">

                    <?=$this->Html->link(__('<i class="fa fa-search"></i>'), ['controller' => 'Items', 'action' => 'view', $item->id], ['class' => 'btn  btn-xs btn-primary btn-raised btn-icon mr-1 btn-sm', 'escape' => false])?>
                    <?=$this->Html->link(__('<i class="fa fa-undo"></i>'), ['controller' => 'Items', 'action' => 'addStock', $item->id], ['class' => 'btn  btn-xs btn-success btn-raised btn-icon mr-1 btn-sm', 'escape' => false])?>
                    <?=$this->Html->link(__('<i class="fa fa-edit"></i>'), ['controller' => 'Items', 'action' => 'edit', $item->id], ['class' => 'btn btn-xs btn-raised btn-warning btn-icon mr-1 btn-sm', 'escape' => false])?>
                    <?php if (isset($wishlist_table) && $wishlist_table == true): ?>

                    <?php else:?>
                    <?=$this->Form->postLink(__('<i class="fas fa-trash-alt"></i>'), ['controller' => 'Items', 'action' => 'delete', $item->id], ['confirm' => __('Are you sure you want to delete # {0}?', $item->id), 'class' => 'btn btn-xs btn btn-raised btn-icon btn-danger mr-1 btn-sm', 'escape' => false])?>
                    <?php endif;?>

                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
        <tfoot>
            <tr>
                <th>S/N</th>
                <th>Name</th>
                <!-- <th>Category</th> -->
                <th>Price</th>
                <th>Feat'd</th>
                <?php if (isset($showSku) && $showSku == true): ?>
                <th>SKU</th>
                <?php endif;?>
                <th>Active</th>
                <th>Created</th>
                <th>Modified</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>
</div>

<!-- File export table -->
<!-- BEGIN PAGE VENDOR JS-->
<!-- END PAGE VENDOR JS-->
<!-- BEGIN APEX JS-->
<!-- END APEX JS-->
<!-- BEGIN PAGE LEVEL JS-->
<!-- <script src="<?=$this->Url->build('/assets/', ['fullbase' => true]);?>js/data-tables/datatable-advanced.js" type="text/javascript"></script> -->
<!-- END PAGE LEVEL JS-->

<?=$this->element('datatable_options', ["record_name" => 'items', "record_count" => count(gettype($items) == 'object' ? $items->toArray() : $items), 'specific_id' => $idtouse])?>
<script>
    $(document).ready(function () {




    });

</script>
