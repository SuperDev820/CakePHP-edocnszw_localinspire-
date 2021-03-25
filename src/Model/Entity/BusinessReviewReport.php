<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BusinessReviewReport Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $business_review_id
 * @property string $why_do
 * @property string $specific_detail
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property bool|null $treated
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\BusinessReview $business_review
 */
class BusinessReviewReport extends Entity
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
        'business_review_id' => true,
        'why_do' => true,
        'specific_detail' => true,
        'created' => true,
        'modified' => true,
        'treated' => true,
        'user' => true,
        'business_review' => true,
    ];
}
