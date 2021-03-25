<div class="px-3">
    <?php echo $this->Form->create($order, ['class' => 'form form-horizontal', 'enctype' => 'multipart/form-data']) ?>

    <div class="form-body">
        <!-- <h4 class="form-section"><i class="ft-user"></i> Personal Info</h4> -->
        <?php if (isset($show_user) && $show_user == false): ?>

        <?php else: ?>

        <?php if (isset($user_to_order_for)): ?>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="user_id">User:
            </label>
            <div class="col-md-6">
                <?=$this->Form->hidden('user_id', ['value' => $user_to_order_for->id])?>
                <p>
                    <?=$user_to_order_for->name_desc?>
                </p>
            </div>
        </div>


        <div class="form-group row">
            <label class="col-md-3 label-control" for="address_id">Address
                <span class="required" aria-required="true"> * </span>
            </label>
            <div class="col-md-6">
                <?=$this->Form->control('address_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $user_addresses, 'empty' => true, 'label' => false, 'class' => 'select2 form-control', "style" => "width: 100%",'required']);?>
            </div>
            <div class="col-md-3">
                <?=$this->Html->link(__('<i class="fa fa-map-marker-alt"></i> New Address for user'), ['controller' => 'customers', 'action' => 'address', $user_to_order_for->id], ['target' => '_blank', 'class' => 'btn btn-xs btn-info btn-raised btn-icon mr-1 btn-sm', 'escape' => false])?>
            </div>
        </div>

        <?php else: ?>


        <div class="form-group row">
            <label class="col-md-3 label-control" for="user_id">User
                <span class="required" aria-required="true"> * </span>
            </label>
            <div class="col-md-6">
                <?=$this->Form->control('user_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' => [], 'empty' => true, 'label' => false, 'class' => 'form-control select2', "style" => "width: 100%"]);?>
            </div>
        </div>
        <?php endif;?>
        <?php endif;?>

        <?php if (isset($new_customer_order) && $new_customer_order == true): ?>

        <?=$this->Form->hidden('cart_id', ['value' => $customer_cart->id])?>



        <div class="form-group row">
            <label class="col-md-3 label-control" for="item_id">Item
            </label>
            <div class="col-md-6">
                <?=$this->Form->control('item_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' => [], 'empty' => true, 'label' => false, 'class' => 'form-control item_id', "id" => "item_id", "style" => "width: 100%"]);?>
            </div>
            <div class="col-md-3">

                <a href="javascript:void(0);" title="Add to Cart" itemid="" userid="<?=$user_to_order_for->id?>" id="add_to_cart_btn"
                    class="btn btn-xs btn-info btn-raised btn-icon mr-1 btn-sm"><i class="fa fa-plus"></i>
                    Add to Cart</a>

            </div>
        </div>




        <div class="row">
            <div class="col-12 col-md-12 ">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h4 class="card-title">
                                        <?=$user_to_order_for->firstname ."'s"?> Cart</h4>
                                </div>
                                <div class="col-5">
                                    <h4 class="card-title text-right">Current Total: <span id="customer_cart_total">
                                            <?="&#8358;" . number_format($customer_cart_total)?></span></h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body collapse show">
                            <div class="card-block card-dashboard">
                                <?=$this->element('cart_table_ajax', ['cart' => $customer_cart, 'tableid'=>'customer_cart_table'])?>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <?php endif;?>

        <div class="form-group row">
            <label class="col-md-3 label-control" for="payment_option_id">Payment Option
                <span class="required" aria-required="true"> * </span>
            </label>
            <div class="col-md-6">
                <?=$this->Form->control('payment_option_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $paymentOptions, 'empty' => true, 'label' => false, 'class' => 'select2 form-control', "style" => "width: 100%",'required']);?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 label-control" for="promo" style="margin-top: 20px;">Paid
            </label>
            <div class="col-md-6">
                <?=$this->Form->checkbox('paid', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'option-input radio', isset($order->paid) && $order->paid == true ? 'checked="checked"' : ''])?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 label-control" for="delivery_option_id">Delivery Option
                <span class="required" aria-required="true"> * </span>
            </label>
            <div class="col-md-6">
                <?=$this->Form->control('delivery_option_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $deliveryOptions, 'empty' => true, 'label' => false, 'class' => 'select2 form-control', "style" => "width: 100%",'required']);?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 label-control" for="order_status_id">Status
                <span class="required" aria-required="true"> * </span>
            </label>
            <div class="col-md-6">
                <?=$this->Form->control('order_status_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $orderStatuses, 'empty' => true, 'label' => false, 'class' => 'select2 form-control', "style" => "width: 100%",'required']);?>
            </div>
        </div>


    </div>

    <div class="form-actions">


        <div class="row clearfix">
            <div class="col-sm-9 offset-3">
                <?=$this->Form->button(__('Save'), ['class' => 'btn btn-raised btn-primary', 'confirm' => __('Are you sure? A delivered or cancelled order can no longer be modified.')]);?>

            </div>
        </div>

    </div>
    <?=$this->Form->end()?>
</div>

<?=$this->element('ajax_dropdown', [
    'ajax_url' => $this->Url->build(['prefix' => false, 'controller' => 'GeneralActions', 'action' => 'getItems']),
    'ajax_placeholder' => 'Find an item',
    'select_id' => 'item_id'
])?>

<script>
    jQuery(document).ready(function () {


        $('#add_to_cart_btn').on('click', function () {
            var itemid = $(this).attr('itemid');
            if (itemid) {
                addToCartInit(this, true); //true means it has cart table
            } else {
                toastr.info("Please find an item on the list");
            }

        });




        if ($('input[name=active2]').is(':checked')) {
            //alert("YES");
            $('input[name=active]').val(1);
        } else {
            //alert("NO");
            $('input[name=active]').val(0);
        }

        $('#active').change(function () {
            //$('input[name=high_priority]').val($('input[name=high_priority2]:checked').val());

            if ($(this).is(':checked')) {
                $('input[name=active]').val(1);
            } else {
                $('input[name=active]').val(0);
            }
        });
        $('#featured2').change(function () {
            //$('input[name=high_priority]').val($('input[name=high_priority2]:checked').val());

            if ($(this).is(':checked')) {
                $('input[name=featured]').val(1);
            } else {
                $('input[name=featured]').val(0);
            }
        });
    });

</script>
