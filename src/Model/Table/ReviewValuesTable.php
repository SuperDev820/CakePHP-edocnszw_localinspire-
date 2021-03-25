<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ReviewValues Model
 *
 * @property \App\Model\Table\BusinessReviewsTable&\Cake\ORM\Association\BelongsTo $BusinessReviews
 * @property \App\Model\Table\ReviewOptionsTable&\Cake\ORM\Association\BelongsTo $ReviewOptions
 *
 * @method \App\Model\Entity\ReviewValue newEmptyEntity()
 * @method \App\Model\Entity\ReviewValue newEmptyEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ReviewValue[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ReviewValue get($primaryKey, $options = [])
 * @method \App\Model\Entity\ReviewValue findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ReviewValue patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ReviewValue[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ReviewValue|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReviewValue saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReviewValue[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ReviewValue[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ReviewValue[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ReviewValue[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ReviewValuesTable extends Table
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

        $this->setTable('review_values');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('BusinessReviews', [
            'foreignKey' => 'business_review_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ReviewOptions', [
            'foreignKey' => 'review_option_id',
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
            ->integer('value')
            ->requirePresence('value', 'create')
            ->notEmptyString('value');

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
        $rules->add($rules->existsIn(['review_option_id'], 'ReviewOptions'));

        return $rules;
    }
}
