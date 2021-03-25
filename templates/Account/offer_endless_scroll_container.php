<?php $this->disableAutoLayout(); ?>
<?php echo $this->element('user_offers', ['offersArray' => $offers, 'offers_total_count' => $offers_total_count]) ?>