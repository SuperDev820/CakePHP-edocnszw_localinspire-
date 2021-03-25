<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BusinessPhoto Entity
 *
 * @property int $id
 * @property int $business_id
 * @property int $user_id
 * @property string $photo
 * @property string $caption
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property bool|null $approved
 * @property bool|null $primary_image
 * @property bool|null $slide
 *
 * @property \App\Model\Entity\Business $business
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\FeaturedAd[] $featured_ads
 * @property \App\Model\Entity\HelpfulPhoto[] $helpful_photos
 * @property \App\Model\Entity\PhotoReport[] $photo_reports
 * @property \App\Model\Entity\Share[] $shares
 * @property \App\Model\Entity\UserActivity[] $user_activities
 */
class BusinessPhoto extends Entity
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
        'photo' => true,
        'caption' => true,
        'created' => true,
        'modified' => true,
        'approved' => true,
        'primary_image' => true,
        'slide' => true,
        'business' => true,
        'user' => true,
        'featured_ads' => true,
        'helpful_photos' => true,
        'photo_reports' => true,
        'shares' => true,
        'user_activities' => true,
    ];
    protected $_virtual = ['helpful_count'];

    protected function _getHelpfulCount()
    {
        // $custom = new CustomComponent(new ComponentRegistry());
        // return $custom->getBusinessReviews($this->id)->count();
        return \Cake\Datasource\FactoryLocator::get('Table')->get('HelpfulPhotos')->find()->where(['business_photo_id' => $this->id])->count();
    }
}
