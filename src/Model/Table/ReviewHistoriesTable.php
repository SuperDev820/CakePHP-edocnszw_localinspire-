<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ReviewHistories Model
 *
 * @property \App\Model\Table\BusinessReviewsTable&\Cake\ORM\Association\BelongsTo $BusinessReviews
 *
 * @method \App\Model\Entity\ReviewHistory newEmptyEntity()
 * @method \App\Model\Entity\ReviewHistory newEmptyEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ReviewHistory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ReviewHistory get($primaryKey, $options = [])
 * @method \App\Model\Entity\ReviewHistory findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ReviewHistory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ReviewHistory[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ReviewHistory|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReviewHistory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReviewHistory[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ReviewHistory[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ReviewHistory[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ReviewHistory[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ReviewHistoriesTable extends Table
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

        $this->setTable('review_histories');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('BusinessReviews', [
            'foreignKey' => 'business_review_id',
            'joinType' => 'INNER',
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
            ->scalar('review_values_json')
            ->maxLength('review_values_json', (int)4294967295)
            ->allowEmptyString('review_values_json');

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

        return $rules;
    }
}
