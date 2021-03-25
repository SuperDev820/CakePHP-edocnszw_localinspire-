<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BusinessReviewPhotos Model
 *
 * @property \App\Model\Table\BusinessReviewsTable&\Cake\ORM\Association\BelongsTo $BusinessReviews
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\FeaturedAdsTable&\Cake\ORM\Association\HasMany $FeaturedAds
 * @property \App\Model\Table\HelpfulReviewPhotosTable&\Cake\ORM\Association\HasMany $HelpfulReviewPhotos
 * @property \App\Model\Table\ReviewPhotoReportsTable&\Cake\ORM\Association\HasMany $ReviewPhotoReports
 * @property \App\Model\Table\SharesTable&\Cake\ORM\Association\HasMany $Shares
 * @property \App\Model\Table\UserActivitiesTable&\Cake\ORM\Association\HasMany $UserActivities
 *
 * @method \App\Model\Entity\BusinessReviewPhoto newEmptyEntity()
 * @method \App\Model\Entity\BusinessReviewPhoto newEmptyEntity(array $data, array $options = [])
 * @method \App\Model\Entity\BusinessReviewPhoto[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BusinessReviewPhoto get($primaryKey, $options = [])
 * @method \App\Model\Entity\BusinessReviewPhoto findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\BusinessReviewPhoto patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BusinessReviewPhoto[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\BusinessReviewPhoto|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BusinessReviewPhoto saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BusinessReviewPhoto[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BusinessReviewPhoto[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\BusinessReviewPhoto[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BusinessReviewPhoto[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BusinessReviewPhotosTable extends Table
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

        $this->setTable('business_review_photos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('BusinessReviews', [
            'foreignKey' => 'business_review_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('FeaturedAds', [
            'foreignKey' => 'business_review_photo_id',
        ]);
        $this->hasMany('HelpfulReviewPhotos', [
            'foreignKey' => 'business_review_photo_id',
        ]);
        $this->hasMany('ReviewPhotoReports', [
            'foreignKey' => 'business_review_photo_id',
        ]);
        $this->hasMany('Shares', [
            'foreignKey' => 'business_review_photo_id',
        ]);
        $this->hasMany('UserActivities', [
            'foreignKey' => 'business_review_photo_id',
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
            ->scalar('photo')
            ->maxLength('photo', 255)
            ->requirePresence('photo', 'create')
            ->notEmptyString('photo');

        $validator
            ->scalar('caption')
            ->maxLength('caption', 255)
            ->requirePresence('caption', 'create')
            ->notEmptyString('caption');

        $validator
            ->boolean('approved')
            ->allowEmptyString('approved');

        $validator
            ->boolean('primary_image')
            ->allowEmptyFile('primary_image');

        $validator
            ->boolean('slide')
            ->allowEmptyString('slide');

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
        $rules->add($rules->existsIn(['business_review_id'], 'BusinessReviews'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
