<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ReviewValue Entity
 *
 * @property int $id
 * @property int $business_review_id
 * @property int $review_option_id
 * @property int $value
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\BusinessReview $business_review
 * @property \App\Model\Entity\ReviewOption $review_option
 */
class ReviewValue extends Entity
{
    /**
     * Fields that can be mass assigned using newEmptyEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'business_review_id' => true,
        'review_option_id' => true,
        'value' => true,
        'created' => true,
        'modified' => true,
        'business_review' => true,
        'review_option' => true,
    ];
}
