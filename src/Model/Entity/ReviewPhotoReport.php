<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ReviewPhotoReport Entity
 *
 * @property int $id
 * @property int $business_review_photo_id
 * @property int $user_id
 * @property string $why
 * @property string|null $specific_detail
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property bool|null $treated
 *
 * @property \App\Model\Entity\BusinessReviewPhoto $business_review_photo
 * @property \App\Model\Entity\User $user
 */
class ReviewPhotoReport extends Entity
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
        'business_review_photo_id' => true,
        'user_id' => true,
        'why' => true,
        'specific_detail' => true,
        'created' => true,
        'modified' => true,
        'treated' => true,
        'business_review_photo' => true,
        'user' => true,
    ];
}
