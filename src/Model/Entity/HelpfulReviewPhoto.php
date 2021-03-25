<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * HelpfulReviewPhoto Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $business_review_photo_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\BusinessReviewPhoto $business_review_photo
 */
class HelpfulReviewPhoto extends Entity
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
        'user_id' => true,
        'business_review_photo_id' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'business_review_photo' => true,
    ];
}
