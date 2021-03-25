<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FeaturedAds Model
 *
 * @property \App\Model\Table\BusinessesTable&\Cake\ORM\Association\BelongsTo $Businesses
 * @property \App\Model\Table\BusinessReviewsTable&\Cake\ORM\Association\BelongsTo $BusinessReviews
 * @property \App\Model\Table\BusinessPhotosTable&\Cake\ORM\Association\BelongsTo $BusinessPhotos
 * @property \App\Model\Table\BusinessReviewPhotosTable&\Cake\ORM\Association\BelongsTo $BusinessReviewPhotos
 *
 * @method \App\Model\Entity\FeaturedAd newEmptyEntity()
 * @method \App\Model\Entity\FeaturedAd newEmptyEntity(array $data, array $options = [])
 * @method \App\Model\Entity\FeaturedAd[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FeaturedAd get($primaryKey, $options = [])
 * @method \App\Model\Entity\FeaturedAd findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\FeaturedAd patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FeaturedAd[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\FeaturedAd|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FeaturedAd saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FeaturedAd[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\FeaturedAd[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\FeaturedAd[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\FeaturedAd[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FeaturedAdsTable extends Table
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

        $this->setTable('featured_ads');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Businesses', [
            'foreignKey' => 'business_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('BusinessReviews', [
            'foreignKey' => 'business_review_id',
        ]);
        $this->belongsTo('BusinessPhotos', [
            'foreignKey' => 'business_photo_id',
        ]);
        $this->belongsTo('BusinessReviewPhotos', [
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
            ->boolean('active')
            ->allowEmptyString('active');

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
        $rules->add($rules->existsIn(['business_review_id'], 'BusinessReviews'));
        $rules->add($rules->existsIn(['business_photo_id'], 'BusinessPhotos'));
        $rules->add($rules->existsIn(['business_review_photo_id'], 'BusinessReviewPhotos'));

        return $rules;
    }
}
