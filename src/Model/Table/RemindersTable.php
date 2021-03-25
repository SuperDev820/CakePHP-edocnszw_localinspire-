<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Reminders Model
 *
 * @property \App\Model\Table\BusinessesTable&\Cake\ORM\Association\BelongsTo $Businesses
 * @property \App\Model\Table\ReminderStatusesTable&\Cake\ORM\Association\BelongsTo $ReminderStatuses
 * @property \App\Model\Table\ReminderSchedulesTable&\Cake\ORM\Association\BelongsTo $ReminderSchedules
 * @property \App\Model\Table\RemindersSentTable&\Cake\ORM\Association\HasMany $RemindersSent
 *
 * @method \App\Model\Entity\Reminder newEmptyEntity()
 * @method \App\Model\Entity\Reminder newEmptyEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Reminder[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Reminder get($primaryKey, $options = [])
 * @method \App\Model\Entity\Reminder findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Reminder patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Reminder[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Reminder|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Reminder saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Reminder[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Reminder[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Reminder[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Reminder[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RemindersTable extends Table
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

        $this->setTable('reminders');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Businesses', [
            'foreignKey' => 'business_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ReminderStatuses', [
            'foreignKey' => 'reminder_status_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ReminderSchedules', [
            'foreignKey' => 'reminder_schedule_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('RemindersSent', [
            'foreignKey' => 'reminder_id',
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
            ->integer('number_of_times')
            ->allowEmptyString('number_of_times');

        $validator
            ->scalar('content')
            // ->maxLength('content', (int)4294967295)
            ->allowEmptyString('content');

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
        $rules->add($rules->existsIn(['reminder_status_id'], 'ReminderStatuses'));
        $rules->add($rules->existsIn(['reminder_schedule_id'], 'ReminderSchedules'));

        return $rules;
    }
}
