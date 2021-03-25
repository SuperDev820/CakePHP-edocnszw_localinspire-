<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Businesses Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\CitiesTable&\Cake\ORM\Association\BelongsTo $Cities
 * @property \App\Model\Table\Sic2categoriesTable&\Cake\ORM\Association\BelongsTo $Sic2categories
 * @property \App\Model\Table\Sic4categoriesTable&\Cake\ORM\Association\BelongsTo $Sic4categories
 * @property \App\Model\Table\Sic8categoriesTable&\Cake\ORM\Association\BelongsTo $Sic8categories
 * @property \App\Model\Table\IndustriesTable&\Cake\ORM\Association\BelongsTo $Industries
 * @property \App\Model\Table\BusinessRolesTable&\Cake\ORM\Association\BelongsTo $BusinessRoles
 * @property \App\Model\Table\AnnouncementsTable&\Cake\ORM\Association\HasMany $Announcements
 * @property \App\Model\Table\BusinessAdditionalsTable&\Cake\ORM\Association\HasMany $BusinessAdditionals
 * @property \App\Model\Table\BusinessEditsTable&\Cake\ORM\Association\HasMany $BusinessEdits
 * @property \App\Model\Table\BusinessHoursTable&\Cake\ORM\Association\HasMany $BusinessHours
 * @property \App\Model\Table\BusinessPhotosTable&\Cake\ORM\Association\HasMany $BusinessPhotos
 * @property \App\Model\Table\BusinessReviewsTable&\Cake\ORM\Association\HasMany $BusinessReviews
 * @property \App\Model\Table\CollectionItemsTable&\Cake\ORM\Association\HasMany $CollectionItems
 * @property \App\Model\Table\CtasTable&\Cake\ORM\Association\HasMany $Ctas
 * @property \App\Model\Table\FeaturedAdsTable&\Cake\ORM\Association\HasMany $FeaturedAds
 * @property \App\Model\Table\OffersTable&\Cake\ORM\Association\HasMany $Offers
 * @property \App\Model\Table\PageViewsTable&\Cake\ORM\Association\HasMany $PageViews
 * @property \App\Model\Table\QuestionsTable&\Cake\ORM\Association\HasMany $Questions
 * @property \App\Model\Table\RemindersTable&\Cake\ORM\Association\HasMany $Reminders
 * @property \App\Model\Table\ShareClicksTable&\Cake\ORM\Association\HasMany $ShareClicks
 * @property \App\Model\Table\SharesTable&\Cake\ORM\Association\HasMany $Shares
 * @property \App\Model\Table\SubscriptionsTable&\Cake\ORM\Association\HasMany $Subscriptions
 * @property \App\Model\Table\CategoriesTable&\Cake\ORM\Association\BelongsToMany $Categories
 * @property \App\Model\Table\SubcategoriesTable&\Cake\ORM\Association\BelongsToMany $Subcategories
 *
 * @method \App\Model\Entity\Business newEmptyEntity()
 * @method \App\Model\Entity\Business newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Business[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Business get($primaryKey, $options = [])
 * @method \App\Model\Entity\Business findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Business patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Business[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Business|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Business saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Business[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Business[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Business[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Business[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BusinessesTable extends Table
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

        $this->setTable('businesses');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
        ]);
        $this->belongsTo('Sic2categories', [
            'foreignKey' => 'sic2category_id',
        ]);
        $this->belongsTo('Sic4categories', [
            'foreignKey' => 'sic4category_id',
        ]);
        $this->belongsTo('Sic8categories', [
            'foreignKey' => 'sic8category_id',
        ]);
        $this->belongsTo('Industries', [
            'foreignKey' => 'industry_id',
        ]);
        $this->belongsTo('BusinessRoles', [
            'foreignKey' => 'business_role_id',
        ]);
        $this->hasMany('Announcements', [
            'foreignKey' => 'business_id',
        ]);
        $this->hasMany('BusinessAdditionals', [
            'foreignKey' => 'business_id',
        ]);
        $this->hasMany('BusinessEdits', [
            'foreignKey' => 'business_id',
        ]);
        $this->hasMany('BusinessHours', [
            'foreignKey' => 'business_id',
        ]);
        $this->hasMany('BusinessPhotos', [
            'foreignKey' => 'business_id',
        ]);
        $this->hasMany('BusinessReviews', [
            'foreignKey' => 'business_id',
        ]);
        $this->hasMany('CollectionItems', [
            'foreignKey' => 'business_id',
        ]);
        $this->hasMany('Ctas', [
            'foreignKey' => 'business_id',
        ]);
        $this->hasMany('FeaturedAds', [
            'foreignKey' => 'business_id',
        ]);
        $this->hasMany('Offers', [
            'foreignKey' => 'business_id',
        ]);
        $this->hasMany('PageViews', [
            'foreignKey' => 'business_id',
        ]);
        $this->hasMany('Questions', [
            'foreignKey' => 'business_id',
        ]);
        $this->hasMany('Reminders', [
            'foreignKey' => 'business_id',
        ]);
        $this->hasMany('ShareClicks', [
            'foreignKey' => 'business_id',
        ]);
        $this->hasMany('Shares', [
            'foreignKey' => 'business_id',
        ]);
        $this->hasMany('Subscriptions', [
            'foreignKey' => 'business_id',
        ]);
        $this->belongsToMany('Categories', [
            'foreignKey' => 'business_id',
            'targetForeignKey' => 'category_id',
            'joinTable' => 'businesses_categories',
        ]);
        $this->belongsToMany('Subcategories', [
            'foreignKey' => 'business_id',
            'targetForeignKey' => 'subcategory_id',
            'joinTable' => 'businesses_subcategories',
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->integer('zip')
            ->allowEmptyString('zip');

        $validator
            ->scalar('address')
            // ->maxLength('address', 4294967295)
            ->allowEmptyString('address');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 13)
            ->requirePresence('phone', 'create')
            ->notEmptyString('phone');

        $validator
            ->scalar('latitude')
            ->maxLength('latitude', 50)
            ->allowEmptyString('latitude');

        $validator
            ->scalar('longitude')
            ->maxLength('longitude', 50)
            ->allowEmptyString('longitude');

        $validator
            ->scalar('fax')
            ->maxLength('fax', 200)
            ->allowEmptyString('fax');

        $validator
            ->scalar('contact_name')
            ->maxLength('contact_name', 255)
            ->allowEmptyString('contact_name');

        $validator
            ->scalar('website')
            ->maxLength('website', 255)
            ->allowEmptyString('website');

        $validator
            ->scalar('about')
            // ->maxLength('about', 4294967295)
            ->requirePresence('about', 'create')
            ->notEmptyString('about');

        $validator
            ->scalar('location_type')
            ->maxLength('location_type', 255)
            ->allowEmptyString('location_type');

        $validator
            ->scalar('market_variable')
            ->maxLength('market_variable', 4)
            ->allowEmptyString('market_variable');

        $validator
            ->scalar('annual_revenue')
            ->maxLength('annual_revenue', 255)
            ->allowEmptyString('annual_revenue');

        $validator
            ->scalar('Industry')
            ->maxLength('Industry', 255)
            ->allowEmptyString('Industry');

        $validator
            ->scalar('additional_address')
            ->maxLength('additional_address', 255)
            ->allowEmptyString('additional_address');

        $validator
            ->scalar('is_closed_move')
            ->maxLength('is_closed_move', 255)
            ->allowEmptyString('is_closed_move');

        $validator
            ->boolean('is_duplicate')
            ->allowEmptyString('is_duplicate');

        $validator
            ->scalar('move_near')
            ->maxLength('move_near', 255)
            ->allowEmptyString('move_near');

        $validator
            ->scalar('move_business_name')
            ->maxLength('move_business_name', 255)
            ->allowEmptyString('move_business_name');

        $validator
            ->scalar('close_till_date')
            ->maxLength('close_till_date', 255)
            ->allowEmptyString('close_till_date');

        $validator
            ->scalar('facebook_link')
            ->maxLength('facebook_link', 200)
            ->allowEmptyString('facebook_link');

        $validator
            ->scalar('twitter_link')
            ->maxLength('twitter_link', 200)
            ->allowEmptyString('twitter_link');

        $validator
            ->scalar('linkedin_link')
            ->maxLength('linkedin_link', 200)
            ->allowEmptyString('linkedin_link');

        $validator
            ->decimal('average_rating')
            ->allowEmptyString('average_rating');

        $validator
            ->scalar('description')
            // ->maxLength('description', 4294967295)
            ->allowEmptyString('description');

        $validator
            ->boolean('featured')
            ->allowEmptyString('featured');

        $validator
            ->boolean('featured_ad')
            ->allowEmptyString('featured_ad');

        $validator
            ->boolean('restricted')
            ->allowEmptyString('restricted');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['city_id'], 'Cities'));
        $rules->add($rules->existsIn(['sic2category_id'], 'Sic2categories'));
        $rules->add($rules->existsIn(['sic4category_id'], 'Sic4categories'));
        $rules->add($rules->existsIn(['sic8category_id'], 'Sic8categories'));
        $rules->add($rules->existsIn(['industry_id'], 'Industries'));
        $rules->add($rules->existsIn(['business_role_id'], 'BusinessRoles'));

        return $rules;
    }
}
