<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\CitiesTable&\Cake\ORM\Association\BelongsTo $Cities
 * @property \App\Model\Table\RevesTable&\Cake\ORM\Association\BelongsTo $Reves
 * @property \App\Model\Table\AnswerReportsTable&\Cake\ORM\Association\HasMany $AnswerReports
 * @property \App\Model\Table\AnswersTable&\Cake\ORM\Association\HasMany $Answers
 * @property \App\Model\Table\BlockListsTable&\Cake\ORM\Association\HasMany $BlockLists
 * @property \App\Model\Table\BusinessEditsTable&\Cake\ORM\Association\HasMany $BusinessEdits
 * @property \App\Model\Table\BusinessPhotosTable&\Cake\ORM\Association\HasMany $BusinessPhotos
 * @property \App\Model\Table\BusinessReviewOwnerReportsTable&\Cake\ORM\Association\HasMany $BusinessReviewOwnerReports
 * @property \App\Model\Table\BusinessReviewPhotosTable&\Cake\ORM\Association\HasMany $BusinessReviewPhotos
 * @property \App\Model\Table\BusinessReviewRepliesTable&\Cake\ORM\Association\HasMany $BusinessReviewReplies
 * @property \App\Model\Table\BusinessReviewReportsTable&\Cake\ORM\Association\HasMany $BusinessReviewReports
 * @property \App\Model\Table\BusinessReviewsTable&\Cake\ORM\Association\HasMany $BusinessReviews
 * @property \App\Model\Table\BusinessesTable&\Cake\ORM\Association\HasMany $Businesses
 * @property \App\Model\Table\CitiesTable&\Cake\ORM\Association\HasMany $Cities
 * @property \App\Model\Table\CityOwnerEarningsTable&\Cake\ORM\Association\HasMany $CityOwnerEarnings
 * @property \App\Model\Table\CitySearchesTable&\Cake\ORM\Association\HasMany $CitySearches
 * @property \App\Model\Table\CitySubscriptionsTable&\Cake\ORM\Association\HasMany $CitySubscriptions
 * @property \App\Model\Table\CollectionsTable&\Cake\ORM\Association\HasMany $Collections
 * @property \App\Model\Table\ConversationsTable&\Cake\ORM\Association\HasMany $Conversations
 * @property \App\Model\Table\CouponsTable&\Cake\ORM\Association\HasMany $Coupons
 * @property \App\Model\Table\FollowersTable&\Cake\ORM\Association\HasMany $Followers
 * @property \App\Model\Table\HelpfulAnswersTable&\Cake\ORM\Association\HasMany $HelpfulAnswers
 * @property \App\Model\Table\HelpfulPhotosTable&\Cake\ORM\Association\HasMany $HelpfulPhotos
 * @property \App\Model\Table\HelpfulReviewPhotosTable&\Cake\ORM\Association\HasMany $HelpfulReviewPhotos
 * @property \App\Model\Table\HelpfulReviewsTable&\Cake\ORM\Association\HasMany $HelpfulReviews
 * @property \App\Model\Table\MergesTable&\Cake\ORM\Association\HasMany $Merges
 * @property \App\Model\Table\MessagesTable&\Cake\ORM\Association\HasMany $Messages
 * @property \App\Model\Table\NotificationSettingsTable&\Cake\ORM\Association\HasMany $NotificationSettings
 * @property \App\Model\Table\NotificationsTable&\Cake\ORM\Association\HasMany $Notifications
 * @property \App\Model\Table\PageViewsTable&\Cake\ORM\Association\HasMany $PageViews
 * @property \App\Model\Table\PhotoReportsTable&\Cake\ORM\Association\HasMany $PhotoReports
 * @property \App\Model\Table\PostsTable&\Cake\ORM\Association\HasMany $Posts
 * @property \App\Model\Table\ProfileReportsTable&\Cake\ORM\Association\HasMany $ProfileReports
 * @property \App\Model\Table\QuestionReportsTable&\Cake\ORM\Association\HasMany $QuestionReports
 * @property \App\Model\Table\QuestionsTable&\Cake\ORM\Association\HasMany $Questions
 * @property \App\Model\Table\ReviewPhotoReportsTable&\Cake\ORM\Association\HasMany $ReviewPhotoReports
 * @property \App\Model\Table\ShareClicksTable&\Cake\ORM\Association\HasMany $ShareClicks
 * @property \App\Model\Table\SharesTable&\Cake\ORM\Association\HasMany $Shares
 * @property \App\Model\Table\StripeCustomersTable&\Cake\ORM\Association\HasMany $StripeCustomers
 * @property \App\Model\Table\UnhelpfulAnswersTable&\Cake\ORM\Association\HasMany $UnhelpfulAnswers
 * @property \App\Model\Table\UserActivitiesTable&\Cake\ORM\Association\HasMany $UserActivities
 * @property \App\Model\Table\UserEmailsTable&\Cake\ORM\Association\HasMany $UserEmails
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEmptyEntity(array $data, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('name_desc');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
        ]);
        $this->belongsTo('Reves', [
            'foreignKey' => 'ref_id',
        ]);
        $this->hasMany('AnswerReports', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Answers', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('BlockLists', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('BusinessEdits', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('BusinessPhotos', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('BusinessReviewOwnerReports', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('BusinessReviewPhotos', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('BusinessReviewReplies', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('BusinessReviewReports', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('BusinessReviews', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Businesses', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Cities', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('CityOwnerEarnings', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('CitySearches', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('CitySubscriptions', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Collections', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Conversations', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Coupons', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Followers', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('HelpfulAnswers', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('HelpfulPhotos', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('HelpfulReviewPhotos', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('HelpfulReviews', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Merges', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Messages', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('NotificationSettings', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Notifications', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('PageViews', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('PhotoReports', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Posts', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('ProfileReports', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('QuestionReports', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Questions', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('ReviewPhotoReports', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('ShareClicks', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Shares', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('StripeCustomers', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('UnhelpfulAnswers', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('UserActivities', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('UserEmails', [
            'foreignKey' => 'user_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('username')
            ->maxLength('username', 255)
            ->requirePresence('username', 'create')
            ->notEmptyString('username');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password');

        $validator
            ->scalar('firstname')
            ->maxLength('firstname', 255)
            ->requirePresence('firstname', 'create')
            ->notEmptyString('firstname');

        $validator
            ->scalar('lastname')
            ->maxLength('lastname', 255)
            ->requirePresence('lastname', 'create')
            ->notEmptyString('lastname');

        $validator
            ->scalar('othername')
            ->maxLength('othername', 255)
            ->allowEmptyString('othername');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 255)
            ->allowEmptyString('phone');

        $validator
            ->scalar('gender')
            ->maxLength('gender', 255)
            ->allowEmptyString('gender');

        $validator
            ->date('dob')
            ->allowEmptyDate('dob');

        $validator
            ->boolean('active')
            ->allowEmptyString('active');

        $validator
            ->scalar('email_verification_token')
            ->maxLength('email_verification_token', 255)
            ->allowEmptyString('email_verification_token');

        $validator
            ->boolean('email_verification_status')
            ->allowEmptyString('email_verification_status');

        $validator
            ->scalar('phone_verification_token')
            ->maxLength('phone_verification_token', 255)
            ->allowEmptyString('phone_verification_token');

        $validator
            ->boolean('phone_verification_status')
            ->allowEmptyString('phone_verification_status');

        $validator
            ->scalar('uniqueid')
            ->maxLength('uniqueid', 255)
            ->allowEmptyString('uniqueid');

        $validator
            ->scalar('image')
            ->maxLength('image', 255)
            ->allowEmptyFile('image');

        $validator
            ->boolean('moderator')
            ->allowEmptyString('moderator');

        $validator
            ->boolean('admin')
            ->allowEmptyString('admin');

        $validator
            ->boolean('sa')
            ->allowEmptyString('sa');

        $validator
            ->scalar('timeout')
            ->maxLength('timeout', 255)
            ->allowEmptyString('timeout');

        $validator
            ->scalar('social_email')
            ->maxLength('social_email', 255)
            ->allowEmptyString('social_email');

        $validator
            ->scalar('google_email')
            ->maxLength('google_email', 255)
            ->allowEmptyString('google_email');

        $validator
            ->scalar('facebook_email')
            ->maxLength('facebook_email', 255)
            ->allowEmptyString('facebook_email');

        $validator
            ->scalar('twitter_email')
            ->maxLength('twitter_email', 255)
            ->allowEmptyString('twitter_email');

        $validator
            ->scalar('hometown')
            ->maxLength('hometown', 255)
            ->allowEmptyString('hometown');

        $validator
            ->date('anniversary')
            ->allowEmptyDate('anniversary');

        $validator
            ->scalar('about_me')
            // ->maxLength('about_me', (int)4294967295)
            ->allowEmptyString('about_me');

        $validator
            ->scalar('sayings')
            // ->maxLength('sayings', (int)4294967295)
            ->allowEmptyString('sayings');

        $validator
            ->scalar('login_method')
            ->maxLength('login_method', 255)
            ->allowEmptyString('login_method');

        $validator
            ->scalar('facebook_link')
            ->maxLength('facebook_link', 255)
            ->allowEmptyString('facebook_link');

        $validator
            ->scalar('twitter_link')
            ->maxLength('twitter_link', 255)
            ->allowEmptyString('twitter_link');

        $validator
            ->scalar('google_link')
            ->maxLength('google_link', 255)
            ->allowEmptyString('google_link');

        $validator
            ->scalar('facebook_image')
            ->maxLength('facebook_image', 255)
            ->allowEmptyFile('facebook_image');

        $validator
            ->scalar('twitter_image')
            ->maxLength('twitter_image', 255)
            ->allowEmptyFile('twitter_image');

        $validator
            ->scalar('google_image')
            ->maxLength('google_image', 255)
            ->allowEmptyFile('google_image');

        $validator
            ->scalar('instagram_link')
            ->maxLength('instagram_link', 255)
            ->allowEmptyString('instagram_link');

        $validator
            ->scalar('instagram_image')
            ->maxLength('instagram_image', 255)
            ->allowEmptyFile('instagram_image');

        $validator
            ->boolean('auto_follow_fb_friends')
            ->notEmptyString('auto_follow_fb_friends');

        $validator
            ->boolean('share_review_fb')
            ->notEmptyString('share_review_fb');

        $validator
            ->boolean('share_business_photo_fb')
            ->notEmptyString('share_business_photo_fb');

        $validator
            ->boolean('auto_tweet_review')
            ->notEmptyString('auto_tweet_review');

        $validator
            ->boolean('is_connect_google')
            ->allowEmptyString('is_connect_google');

        $validator
            ->boolean('is_connect_fb')
            ->allowEmptyString('is_connect_fb');

        $validator
            ->boolean('is_connect_twitter')
            ->allowEmptyString('is_connect_twitter');

        $validator
            ->scalar('select_photo')
            ->maxLength('select_photo', 20)
            ->allowEmptyString('select_photo');

        $validator
            ->scalar('last_active_time')
            ->maxLength('last_active_time', 255)
            ->allowEmptyString('last_active_time');

        $validator
            ->boolean('auto_tweet_photo')
            ->allowEmptyString('auto_tweet_photo');

        $validator
            ->scalar('googleid')
            ->maxLength('googleid', 255)
            ->allowEmptyString('googleid');

        $validator
            ->scalar('facebookid')
            ->maxLength('facebookid', 255)
            ->allowEmptyString('facebookid');

        $validator
            ->scalar('twitterid')
            ->maxLength('twitterid', 255)
            ->allowEmptyString('twitterid');

        $validator
            ->integer('active_business')
            ->allowEmptyString('active_business');

        $validator
            ->integer('active_city')
            ->allowEmptyString('active_city');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {

        $rules->add($rules->isUnique(['email'], 'Email is already in use. Did you forget your password? You can use the forgot password option to get a new one'));
        // $rules->add($rules->isUnique(['phone'], 'Phone number is already in use'));
        $rules->add($rules->isUnique(['username'], 'This username is already in use'));
        $rules->add($rules->existsIn(['city_id'], 'Cities'));

        return $rules;
    }
    public function validationPassword(Validator $validator)
    {
        $validator
            ->add('old_password', 'custom', [
                'rule' => function ($value, $context) {
                    $user = $this->get($context['data']['id']);
                    if ($user) {
                        if ((new \Cake\Auth\DefaultPasswordHasher)->check($value, $user->password)) {
                            return true;
                        }
                    }
                    return false;
                },
                'message' => 'The old password does not match the current password!',
            ])
            ->notEmpty('old_password');

        $validator
            ->add('password1', [
                'length' => [
                    'rule' => ['minLength', 6],
                    'message' => 'The password has to be at least 6 characters!',
                ],
            ])
            ->add('password1', [
                'match' => [
                    'rule' => ['compareWith', 'password2'],
                    'message' => 'The passwords do not match!',
                ],
            ])
            ->notEmpty('password1');
        $validator
            ->add('password2', [
                'length' => [
                    'rule' => ['minLength', 6],
                    'message' => 'The password has to be at least 6 characters!',
                ],
            ])
            ->add('password2', [
                'match' => [
                    'rule' => ['compareWith', 'password1'],
                    'message' => 'The passwords do not match!',
                ],
            ])
            ->notEmpty('password2');

        return $validator;
    }
}
