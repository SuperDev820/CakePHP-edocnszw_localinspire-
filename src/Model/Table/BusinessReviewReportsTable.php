<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BusinessReviewReports Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\BusinessReviewsTable&\Cake\ORM\Association\BelongsTo $BusinessReviews
 *
 * @method \App\Model\Entity\BusinessReviewReport newEmptyEntity()
 * @method \App\Model\Entity\BusinessReviewReport newEmptyEntity(array $data, array $options = [])
 * @method \App\Model\Entity\BusinessReviewReport[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BusinessReviewReport get($primaryKey, $options = [])
 * @method \App\Model\Entity\BusinessReviewReport findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\BusinessReviewReport patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BusinessReviewReport[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\BusinessReviewReport|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BusinessReviewReport saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BusinessReviewReport[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BusinessReviewReport[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\BusinessReviewReport[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BusinessReviewReport[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BusinessReviewReportsTable extends Table
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

        $this->setTable('business_review_reports');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
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
            ->scalar('why_do')
            ->maxLength('why_do', 255)
            ->requirePresence('why_do', 'create')
            ->notEmptyString('why_do');

        $validator
            ->scalar('specific_detail')
            // ->maxLength('specific_detail', (int)4294967295)
            ->requirePresence('specific_detail', 'create')
            ->notEmptyString('specific_detail');

        $validator
            ->boolean('treated')
            ->allowEmptyString('treated');

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
        $rules->add($rules->existsIn(['business_review_id'], 'BusinessReviews'));

        return $rules;
    }
}
