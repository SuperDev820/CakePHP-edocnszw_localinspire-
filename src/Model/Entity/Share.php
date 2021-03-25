<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Share Entity
 *
 * @property int $id
 * @property int|null $business_id
 * @property int|null $user_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int|null $business_review_id
 * @property int|null $business_photo_id
 * @property int|null $question_id
 * @property int|null $business_review_photo_id
 * @property bool|null $facebook
 * @property bool|null $twitter
 * @property bool|null $email
 *
 * @property \App\Model\Entity\Business $business
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\BusinessReview $business_review
 * @property \App\Model\Entity\BusinessPhoto $business_photo
 * @property \App\Model\Entity\Question $question
 * @property \App\Model\Entity\BusinessReviewPhoto $business_review_photo
 */
class Share extends Entity
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
        'business_id' => true,
        'user_id' => true,
        'created' => true,
        'modified' => true,
        'business_review_id' => true,
        'business_photo_id' => true,
        'question_id' => true,
        'business_review_photo_id' => true,
        'facebook' => true,
        'twitter' => true,
        'email' => true,
        'business' => true,
        'user' => true,
        'business_review' => true,
        'business_photo' => true,
        'question' => true,
        'business_review_photo' => true,
    ];
}
