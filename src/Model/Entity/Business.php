<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use App\Controller\Component\CustomComponent;
use App\Controller\Component\AccessComponent;
use Cake\Controller\ComponentRegistry;

/**
 * Business Entity
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $name
 * @property string|null $email
 * @property int|null $city_id
 * @property int|null $zip
 * @property string|null $address
 * @property string $phone
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string|null $fax
 * @property string|null $contact_name
 * @property string|null $website
 * @property string $about
 * @property string|null $location_type
 * @property string|null $market_variable
 * @property string|null $annual_revenue
 * @property string|null $Industry
 * @property string|null $additional_address
 * @property string|null $is_closed_move
 * @property bool|null $is_duplicate
 * @property string|null $move_near
 * @property string|null $move_business_name
 * @property string|null $close_till_date
 * @property string|null $facebook_link
 * @property string|null $twitter_link
 * @property string|null $linkedin_link
 * @property string|null $average_rating
 * @property int|null $sic2category_id
 * @property int|null $sic4category_id
 * @property int|null $sic8category_id
 * @property int|null $industry_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int|null $business_role_id
 * @property string|null $description
 * @property bool|null $featured
 * @property bool|null $featured_ad
 * @property bool|null $restricted
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\City $city
 * @property \App\Model\Entity\Sic2category $sic2category
 * @property \App\Model\Entity\Sic4category $sic4category
 * @property \App\Model\Entity\Sic8category $sic8category
 * @property \App\Model\Entity\Industry $industry
 * @property \App\Model\Entity\BusinessRole $business_role
 * @property \App\Model\Entity\Announcement[] $announcements
 * @property \App\Model\Entity\BusinessAdditional[] $business_additionals
 * @property \App\Model\Entity\BusinessEdit[] $business_edits
 * @property \App\Model\Entity\BusinessHour[] $business_hours
 * @property \App\Model\Entity\BusinessPhoto[] $business_photos
 * @property \App\Model\Entity\BusinessReview[] $business_reviews
 * @property \App\Model\Entity\CollectionItem[] $collection_items
 * @property \App\Model\Entity\Cta[] $ctas
 * @property \App\Model\Entity\FeaturedAd[] $featured_ads
 * @property \App\Model\Entity\Offer[] $offers
 * @property \App\Model\Entity\PageView[] $page_views
 * @property \App\Model\Entity\Question[] $questions
 * @property \App\Model\Entity\Reminder[] $reminders
 * @property \App\Model\Entity\ShareClick[] $share_clicks
 * @property \App\Model\Entity\Share[] $shares
 * @property \App\Model\Entity\Subscription[] $subscriptions
 * @property \App\Model\Entity\Category[] $categories
 * @property \App\Model\Entity\Subcategory[] $subcategories
 */
class Business extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'name' => true,
        'email' => true,
        'city_id' => true,
        'zip' => true,
        'address' => true,
        'phone' => true,
        'latitude' => true,
        'longitude' => true,
        'fax' => true,
        'contact_name' => true,
        'website' => true,
        'about' => true,
        'location_type' => true,
        'market_variable' => true,
        'annual_revenue' => true,
        'Industry' => true,
        'additional_address' => true,
        'is_closed_move' => true,
        'is_duplicate' => true,
        'move_near' => true,
        'move_business_name' => true,
        'close_till_date' => true,
        'facebook_link' => true,
        'twitter_link' => true,
        'linkedin_link' => true,
        'average_rating' => true,
        'sic2category_id' => true,
        'sic4category_id' => true,
        'sic8category_id' => true,
        'industry_id' => true,
        'created' => true,
        'modified' => true,
        'business_role_id' => true,
        'description' => true,
        'featured' => true,
        'featured_ad' => true,
        'restricted' => true,
        'user' => true,
        'city' => true,
        'sic2category' => true,
        'sic4category' => true,
        'sic8category' => true,
        'industry' => true,
        'business_role' => true,
        'announcements' => true,
        'business_additionals' => true,
        'business_edits' => true,
        'business_hours' => true,
        'business_photos' => true,
        'business_reviews' => true,
        'collection_items' => true,
        'ctas' => true,
        'featured_ads' => true,
        'offers' => true,
        'page_views' => true,
        'questions' => true,
        'reminders' => true,
        'share_clicks' => true,
        'shares' => true,
        'subscriptions' => true,
        'categories' => true,
        'subcategories' => true,
    ];

    protected $_virtual = ['photo', 'primary_photo', 'ad', 'review_count', 'review_photo', 'questions_count', 'collection_saves', 'last_active_subscription', 'current_subscription', 'active_announcement', 'cta', 'enhanced', 'sponsored'];

    protected function _getEnhanced()
    {
        $controller = new \Cake\Controller\Controller();
        $access = new AccessComponent(new ComponentRegistry($controller));
        return $access->hasEnhanced($this->id);
    }
    protected function _getSponsored()
    {
        $controller = new \Cake\Controller\Controller();
        $access = new AccessComponent(new ComponentRegistry($controller));
        return $access->hasSponsored($this->id);
    }
    protected function _getCta()
    {
        return $photo =  \Cake\Datasource\FactoryLocator::get('Table')->get('Ctas')->find()
            ->where(['business_id' => $this->id, 'active' => true])->first();
    }
    protected function _getActiveAnnouncement()
    {
        return $photo =  \Cake\Datasource\FactoryLocator::get('Table')->get('Announcements')->find()
            ->where(['business_id' => $this->id, 'active' => true])->first();
    }
    protected function _getCurrentSubscription()
    {
        $controller = new \Cake\Controller\Controller();
        $access = new AccessComponent(new ComponentRegistry($controller));
        return $access->currentSubscription($this->id);
    }
    protected function _getLastActiveSubscription()
    {
        $controller = new \Cake\Controller\Controller();
        $access = new AccessComponent(new ComponentRegistry($controller));
        return $access->lastActiveSubscriptions($this->id, true);
    }

    protected function _getPrimaryPhoto()
    {
        $photo =  \Cake\Datasource\FactoryLocator::get('Table')->get('BusinessPhotos')->find()
            ->where(['business_id' => $this->id, 'primary_image' => true])->contain(['Users'])->first();
        if (empty($photo)) {
            $photo =  \Cake\Datasource\FactoryLocator::get('Table')->get('BusinessReviewPhotos')->find()->leftJoinWith('BusinessReviews')
                ->where(['BusinessReviews.business_id' => $this->id, 'primary_image' => true])->contain(['Users'])->first();
        }
        return $photo;
    }
    protected function _getPhoto()
    {
        return \Cake\Datasource\FactoryLocator::get('Table')->get('BusinessPhotos')->find()->where(['business_id' => $this->id])
            ->contain(['Users'])->first();
    }

    protected function _getReviewPhoto()
    {
        return \Cake\Datasource\FactoryLocator::get('Table')->get('BusinessReviewPhotos')->find()
            ->where(['BusinessReviews.business_id' => $this->id])->contain(['BusinessReviews', 'Users'])->first();
    }

    protected function _getAd()
    {
        // return [];
        $controller = new \Cake\Controller\Controller();
        $custom = new CustomComponent(new ComponentRegistry($controller));
        return $custom->getFeaturedAd($this->id, null, false, false, false)->first();
    }

    protected function _getReviewCount()
    {

        $controller = new \Cake\Controller\Controller();
        $custom = new CustomComponent(new ComponentRegistry($controller));
        // $custom = new CustomComponent(new ComponentRegistry());
        return $custom->getBusinessReviews($this->id)->count();
    }
    protected function _getQuestionsCount()
    {
        $controller = new \Cake\Controller\Controller();
        $custom = new CustomComponent(new ComponentRegistry($controller));
        return $custom->getQuestions($this->id)->count();
    }
    protected function _getCollectionSaves()
    {
        $controller = new \Cake\Controller\Controller();
        $custom = new CustomComponent(new ComponentRegistry($controller));
        return $custom->getCollectionSaves($this->id)->count();
    }
}
