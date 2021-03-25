<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ReviewHistory Entity
 *
 * @property int $id
 * @property int $business_review_id
 * @property string $title
 * @property string $comment
 * @property string $star_rating
 * @property string $sort_of_visit
 * @property string $visit_time
 * @property string|null $advice
 * @property bool|null $approved
 * @property bool|null $recommend
 * @property string|null $review_values_json
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\BusinessReview $business_review
 */
class ReviewHistory extends Entity
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
        'title' => true,
        'comment' => true,
        'star_rating' => true,
        'sort_of_visit' => true,
        'visit_time' => true,
        'advice' => true,
        'approved' => true,
        'recommend' => true,
        'review_values_json' => true,
        'created' => true,
        'modified' => true,
        'business_review' => true,
    ];
}
