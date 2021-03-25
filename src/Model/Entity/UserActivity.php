<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserActivity Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $business_review_id
 * @property int|null $question_id
 * @property int|null $business_photo_id
 * @property int|null $answer_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int|null $business_review_photo_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\BusinessReview $business_review
 * @property \App\Model\Entity\Question $question
 * @property \App\Model\Entity\BusinessPhoto $business_photo
 * @property \App\Model\Entity\Answer $answer
 * @property \App\Model\Entity\BusinessReviewPhoto $business_review_photo
 */
class UserActivity extends Entity
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
        'question_id' => true,
        'business_photo_id' => true,
        'answer_id' => true,
        'created' => true,
        'modified' => true,
        'business_review_photo_id' => true,
        'user' => true,
        'business_review' => true,
        'question' => true,
        'business_photo' => true,
        'answer' => true,
        'business_review_photo' => true,
    ];
}
