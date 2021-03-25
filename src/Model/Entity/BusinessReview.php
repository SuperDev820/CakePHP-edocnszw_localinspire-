<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BusinessReview Entity
 *
 * @property int $id
 * @property int $business_id
 * @property int $user_id
 * @property string $title
 * @property string $comment
 * @property string $star_rating
 * @property string $sort_of_visit
 * @property string $visit_time
 * @property string|null $advice
 * @property bool|null $approved
 * @property bool|null $recommend
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int|null $helpful_count
 * @property int|null $reply_count
 * @property bool|null $featured
 *
 * @property \App\Model\Entity\Business $business
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\BusinessReviewOwnerReport[] $business_review_owner_reports
 * @property \App\Model\Entity\BusinessReviewPhoto[] $business_review_photos
 * @property \App\Model\Entity\BusinessReviewReply[] $business_review_replies
 * @property \App\Model\Entity\BusinessReviewReport[] $business_review_reports
 * @property \App\Model\Entity\FeaturedAd[] $featured_ads
 * @property \App\Model\Entity\HelpfulReview[] $helpful_reviews
 * @property \App\Model\Entity\ReviewHistory[] $review_histories
 * @property \App\Model\Entity\ReviewValue[] $review_values
 * @property \App\Model\Entity\ShareClick[] $share_clicks
 * @property \App\Model\Entity\Share[] $shares
 * @property \App\Model\Entity\UserActivity[] $user_activities
 */
class BusinessReview extends Entity
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
        'title' => true,
        'comment' => true,
        'star_rating' => true,
        'sort_of_visit' => true,
        'visit_time' => true,
        'advice' => true,
        'approved' => true,
        'recommend' => true,
        'created' => true,
        'modified' => true,
        'helpful_count' => true,
        'reply_count' => true,
        'featured' => true,
        'business' => true,
        'user' => true,
        'business_review_owner_reports' => true,
        'business_review_photos' => true,
        'business_review_replies' => true,
        'business_review_reports' => true,
        'featured_ads' => true,
        'helpful_reviews' => true,
        'review_histories' => true,
        'review_values' => true,
        'share_clicks' => true,
        'shares' => true,
        'user_activities' => true,
    ];
}
