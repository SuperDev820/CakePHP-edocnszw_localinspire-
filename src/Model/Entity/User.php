<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $firstname
 * @property string $lastname
 * @property string|null $othername
 * @property string|null $phone
 * @property string|null $gender
 * @property \Cake\I18n\FrozenDate|null $dob
 * @property bool|null $active
 * @property string|null $email_verification_token
 * @property bool|null $email_verification_status
 * @property string|null $phone_verification_token
 * @property bool|null $phone_verification_status
 * @property string|null $uniqueid
 * @property string|null $image
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property bool|null $moderator
 * @property bool|null $admin
 * @property bool|null $sa
 * @property string|null $timeout
 * @property string|null $social_email
 * @property string|null $google_email
 * @property string|null $facebook_email
 * @property string|null $twitter_email
 * @property int|null $city_id
 * @property string|null $hometown
 * @property \Cake\I18n\FrozenDate|null $anniversary
 * @property string|null $about_me
 * @property string|null $sayings
 * @property string|null $login_method
 * @property string|null $facebook_link
 * @property string|null $twitter_link
 * @property string|null $google_link
 * @property string|null $facebook_image
 * @property string|null $twitter_image
 * @property string|null $google_image
 * @property string|null $instagram_link
 * @property string|null $instagram_image
 * @property bool $auto_follow_fb_friends
 * @property bool $share_review_fb
 * @property bool $share_business_photo_fb
 * @property bool $auto_tweet_review
 * @property bool|null $is_connect_google
 * @property bool|null $is_connect_fb
 * @property bool|null $is_connect_twitter
 * @property string|null $select_photo
 * @property string|null $last_active_time
 * @property bool|null $auto_tweet_photo
 * @property string|null $googleid
 * @property string|null $facebookid
 * @property string|null $twitterid
 * @property int|null $ref_id
 * @property int|null $active_business
 * @property int|null $active_city
 *
 * @property \App\Model\Entity\City[] $cities
 * @property \App\Model\Entity\Ref $ref
 * @property \App\Model\Entity\AnswerReport[] $answer_reports
 * @property \App\Model\Entity\Answer[] $answers
 * @property \App\Model\Entity\BlockList[] $block_lists
 * @property \App\Model\Entity\BusinessEdit[] $business_edits
 * @property \App\Model\Entity\BusinessPhoto[] $business_photos
 * @property \App\Model\Entity\BusinessReviewOwnerReport[] $business_review_owner_reports
 * @property \App\Model\Entity\BusinessReviewPhoto[] $business_review_photos
 * @property \App\Model\Entity\BusinessReviewReply[] $business_review_replies
 * @property \App\Model\Entity\BusinessReviewReport[] $business_review_reports
 * @property \App\Model\Entity\BusinessReview[] $business_reviews
 * @property \App\Model\Entity\Business[] $businesses
 * @property \App\Model\Entity\CityOwnerEarning[] $city_owner_earnings
 * @property \App\Model\Entity\CitySearch[] $city_searches
 * @property \App\Model\Entity\CitySubscription[] $city_subscriptions
 * @property \App\Model\Entity\Collection[] $collections
 * @property \App\Model\Entity\Conversation[] $conversations
 * @property \App\Model\Entity\Coupon[] $coupons
 * @property \App\Model\Entity\Follower[] $followers
 * @property \App\Model\Entity\HelpfulAnswer[] $helpful_answers
 * @property \App\Model\Entity\HelpfulPhoto[] $helpful_photos
 * @property \App\Model\Entity\HelpfulReviewPhoto[] $helpful_review_photos
 * @property \App\Model\Entity\HelpfulReview[] $helpful_reviews
 * @property \App\Model\Entity\Merge[] $merges
 * @property \App\Model\Entity\Message[] $messages
 * @property \App\Model\Entity\NotificationSetting[] $notification_settings
 * @property \App\Model\Entity\Notification[] $notifications
 * @property \App\Model\Entity\PageView[] $page_views
 * @property \App\Model\Entity\PhotoReport[] $photo_reports
 * @property \App\Model\Entity\Post[] $posts
 * @property \App\Model\Entity\ProfileReport[] $profile_reports
 * @property \App\Model\Entity\QuestionReport[] $question_reports
 * @property \App\Model\Entity\Question[] $questions
 * @property \App\Model\Entity\ReviewPhotoReport[] $review_photo_reports
 * @property \App\Model\Entity\ShareClick[] $share_clicks
 * @property \App\Model\Entity\Share[] $shares
 * @property \App\Model\Entity\StripeCustomer[] $stripe_customers
 * @property \App\Model\Entity\UnhelpfulAnswer[] $unhelpful_answers
 * @property \App\Model\Entity\UserActivity[] $user_activities
 * @property \App\Model\Entity\UserEmail[] $user_emails
 */
class User extends Entity
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
        'username' => true,
        'email' => true,
        'password' => true,
        'firstname' => true,
        'lastname' => true,
        'othername' => true,
        'phone' => true,
        'gender' => true,
        'dob' => true,
        'active' => true,
        'email_verification_token' => true,
        'email_verification_status' => true,
        'phone_verification_token' => true,
        'phone_verification_status' => true,
        'uniqueid' => true,
        'image' => true,
        'created' => true,
        'modified' => true,
        'moderator' => true,
        'admin' => true,
        'sa' => true,
        'timeout' => true,
        'social_email' => true,
        'google_email' => true,
        'facebook_email' => true,
        'twitter_email' => true,
        'city_id' => true,
        'hometown' => true,
        'anniversary' => true,
        'about_me' => true,
        'sayings' => true,
        'login_method' => true,
        'facebook_link' => true,
        'twitter_link' => true,
        'google_link' => true,
        'facebook_image' => true,
        'twitter_image' => true,
        'google_image' => true,
        'instagram_link' => true,
        'instagram_image' => true,
        'auto_follow_fb_friends' => true,
        'share_review_fb' => true,
        'share_business_photo_fb' => true,
        'auto_tweet_review' => true,
        'is_connect_google' => true,
        'is_connect_fb' => true,
        'is_connect_twitter' => true,
        'select_photo' => true,
        'last_active_time' => true,
        'auto_tweet_photo' => true,
        'googleid' => true,
        'facebookid' => true,
        'twitterid' => true,
        'ref_id' => true,
        'active_business' => true,
        'active_city' => true,
        'cities' => true,
        'ref' => true,
        'answer_reports' => true,
        'answers' => true,
        'block_lists' => true,
        'business_edits' => true,
        'business_photos' => true,
        'business_review_owner_reports' => true,
        'business_review_photos' => true,
        'business_review_replies' => true,
        'business_review_reports' => true,
        'business_reviews' => true,
        'businesses' => true,
        'city_owner_earnings' => true,
        'city_searches' => true,
        'city_subscriptions' => true,
        'collections' => true,
        'conversations' => true,
        'coupons' => true,
        'followers' => true,
        'helpful_answers' => true,
        'helpful_photos' => true,
        'helpful_review_photos' => true,
        'helpful_reviews' => true,
        'merges' => true,
        'messages' => true,
        'notification_settings' => true,
        'notifications' => true,
        'page_views' => true,
        'photo_reports' => true,
        'posts' => true,
        'profile_reports' => true,
        'question_reports' => true,
        'questions' => true,
        'review_photo_reports' => true,
        'share_clicks' => true,
        'shares' => true,
        'stripe_customers' => true,
        'unhelpful_answers' => true,
        'user_activities' => true,
        'user_emails' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];

    protected $_virtual = ['city','business_review_photos_count', 'business_reviews_count', 'business_photos_count', 'followers_count', 'business_count', 'questions_count'];

    protected function _getQuestionsCount()
    {
        return $this->table('Questions')->find()->where(['user_id' => $this->id])->count();
    }
    protected function _getBusinessCount()
    {
        return $this->table('Businesses')->find()->where(['user_id' => $this->id])->count();
    }
    protected function _getFollowersCount()
    {
        return $this->table('Followers')->find()->where(['user_id' => $this->id])->count();
    }

    protected function _getBusinessReviewPhotosCount()
    {
        return $this->table('BusinessReviewPhotos')->find()->where(['user_id' => $this->id])->count();
    }

    protected function _getBusinessPhotosCount()
    {
        return $this->table('BusinessPhotos')->find()->where(['user_id' => $this->id])->count();
    }

    protected function _getBusinessReviewsCount()
    {
        return $this->table('BusinessReviews')->find()->where(['user_id' => $this->id])->count();
    }
    // Automatically hash passwords when they are changed.
    protected function _setPassword(string $password)
    {
        $hasher = new \Authentication\PasswordHasher\DefaultPasswordHasher();
        return $hasher->hash($password);
    }

    protected function _getNameDesc()
    {
        // dd($this);
        return ucfirst($this->firstname) . ' ' . ucfirst($this->lastname[0] . ".");
        //    ucfirst( $this->_properties['firstname']) . ' ' . $this->_properties['lastname'];
        //$this->_properties['firstname'] . ' ' . $this->_properties['lastname'] .', User Id: '. $this->_properties['id'];
    }
    private function table($model)
    {
        return  \Cake\Datasource\FactoryLocator::get('Table')->get($model);
    }
    protected function _getCity()
    {
        return !empty($this->city_id) ? $this->table("Cities")->find()
            ->where(['Cities.id' => $this->city_id])->contain(['States'])->leftJoinWith('States')->first() : null;
    }
}
