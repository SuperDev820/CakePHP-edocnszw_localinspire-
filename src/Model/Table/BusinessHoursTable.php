<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BusinessHours Model
 *
 * @property \App\Model\Table\DaysTable&\Cake\ORM\Association\BelongsTo $Days
 * @property \App\Model\Table\BusinessesTable&\Cake\ORM\Association\BelongsTo $Businesses
 *
 * @method \App\Model\Entity\BusinessHour newEmptyEntity()
 * @method \App\Model\Entity\BusinessHour newEmptyEntity(array $data, array $options = [])
 * @method \App\Model\Entity\BusinessHour[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BusinessHour get($primaryKey, $options = [])
 * @method \App\Model\Entity\BusinessHour findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\BusinessHour patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BusinessHour[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\BusinessHour|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BusinessHour saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BusinessHour[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BusinessHour[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\BusinessHour[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BusinessHour[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BusinessHoursTable extends Table
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

        $this->setTable('business_hours');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Days', [
            'foreignKey' => 'day_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Businesses', [
            'foreignKey' => 'business_id',
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
            ->scalar('opening_time')
            ->maxLength('opening_time', 255)
            ->allowEmptyString('opening_time');

        $validator
            ->scalar('closing_time')
            ->maxLength('closing_time', 255)
            ->allowEmptyString('closing_time');

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
        $rules->add($rules->existsIn(['day_id'], 'Days'));
        $rules->add($rules->existsIn(['business_id'], 'Businesses'));

        return $rules;
    }
}
