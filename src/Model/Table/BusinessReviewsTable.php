<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BusinessReviews Model
 *
 * @property \App\Model\Table\BusinessesTable&\Cake\ORM\Association\BelongsTo $Businesses
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\BusinessReviewOwnerReportsTable&\Cake\ORM\Association\HasMany $BusinessReviewOwnerReports
 * @property \App\Model\Table\BusinessReviewPhotosTable&\Cake\ORM\Association\HasMany $BusinessReviewPhotos
 * @property \App\Model\Table\BusinessReviewRepliesTable&\Cake\ORM\Association\HasMany $BusinessReviewReplies
 * @property \App\Model\Table\BusinessReviewReportsTable&\Cake\ORM\Association\HasMany $BusinessReviewReports
 * @property \App\Model\Table\FeaturedAdsTable&\Cake\ORM\Association\HasMany $FeaturedAds
 * @property \App\Model\Table\HelpfulReviewsTable&\Cake\ORM\Association\HasMany $HelpfulReviews
 * @property \App\Model\Table\ReviewHistoriesTable&\Cake\ORM\Association\HasMany $ReviewHistories
 * @property \App\Model\Table\ReviewValuesTable&\Cake\ORM\Association\HasMany $ReviewValues
 * @property \App\Model\Table\ShareClicksTable&\Cake\ORM\Association\HasMany $ShareClicks
 * @property \App\Model\Table\SharesTable&\Cake\ORM\Association\HasMany $Shares
 * @property \App\Model\Table\UserActivitiesTable&\Cake\ORM\Association\HasMany $UserActivities
 *
 * @method \App\Model\Entity\BusinessReview newEmptyEntity()
 * @method \App\Model\Entity\BusinessReview newEmptyEntity(array $data, array $options = [])
 * @method \App\Model\Entity\BusinessReview[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BusinessReview get($primaryKey, $options = [])
 * @method \App\Model\Entity\BusinessReview findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\BusinessReview patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BusinessReview[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\BusinessReview|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BusinessReview saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BusinessReview[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BusinessReview[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\BusinessReview[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BusinessReview[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BusinessReviewsTable extends Table
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

        $this->setTable('business_reviews');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Businesses', [
            'foreignKey' => 'business_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('BusinessReviewOwnerReports', [
            'foreignKey' => 'business_review_id',
        ]);
        $this->hasMany('BusinessReviewPhotos', [
            'foreignKey' => 'business_review_id',
        ]);
        $this->hasMany('BusinessReviewReplies', [
            'foreignKey' => 'business_review_id',
        ]);
        $this->hasMany('BusinessReviewReports', [
            'foreignKey' => 'business_review_id',
        ]);
        $this->hasMany('FeaturedAds', [
            'foreignKey' => 'business_review_id',
        ]);
        $this->hasMany('HelpfulReviews', [
            'foreignKey' => 'business_review_id',
        ]);
        $this->hasMany('ReviewHistories', [
            'foreignKey' => 'business_review_id',
        ]);
        $this->hasMany('ReviewValues', [
            'foreignKey' => 'business_review_id',
        ]);
        $this->hasMany('ShareClicks', [
            'foreignKey' => 'business_review_id',
        ]);
        $this->hasMany('Shares', [
            'foreignKey' => 'business_review_id',
        ]);
        $this->hasMany('UserActivities', [
            'foreignKey' => 'business_review_id',
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
            ->scalar('title')
            ->maxLength('title', 100)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('comment')
            // ->maxLength('comment', (int)4294967295)
            ->requirePresence('comment', 'create')
            ->notEmptyString('comment');

        $validator
            ->decimal('star_rating')
            ->requirePresence('star_rating', 'create')
            ->notEmptyString('star_rating');

        $validator
            ->scalar('sort_of_visit')
            ->maxLength('sort_of_visit', 100)
            ->requirePresence('sort_of_visit', 'create')
            ->notEmptyString('sort_of_visit');

        $validator
            ->scalar('visit_time')
            ->maxLength('visit_time', 100)
            ->requirePresence('visit_time', 'create')
            ->notEmptyString('visit_time');

        $validator
            ->scalar('advice')
            ->maxLength('advice', 255)
            ->allowEmptyString('advice');

        $validator
            ->boolean('approved')
            ->allowEmptyString('approved');

        $validator
            ->boolean('recommend')
            ->allowEmptyString('recommend');

        $validator
            ->integer('helpful_count')
            ->allowEmptyString('helpful_count');

        $validator
            ->integer('reply_count')
            ->allowEmptyString('reply_count');

        $validator
            ->boolean('featured')
            ->allowEmptyString('featured');

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
        $rules->add($rules->existsIn(['business_id'], 'Businesses'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
