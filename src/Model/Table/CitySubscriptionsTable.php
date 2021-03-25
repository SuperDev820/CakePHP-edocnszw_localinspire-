<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CitySubscriptions Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\CouponsTable&\Cake\ORM\Association\BelongsTo $Coupons
 * @property \App\Model\Table\CitySubscriptionCitiesTable&\Cake\ORM\Association\HasMany $CitySubscriptionCities
 *
 * @method \App\Model\Entity\CitySubscription newEmptyEntity()
 * @method \App\Model\Entity\CitySubscription newEmptyEntity(array $data, array $options = [])
 * @method \App\Model\Entity\CitySubscription[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CitySubscription get($primaryKey, $options = [])
 * @method \App\Model\Entity\CitySubscription findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\CitySubscription patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CitySubscription[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CitySubscription|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CitySubscription saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CitySubscription[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CitySubscription[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\CitySubscription[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CitySubscription[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CitySubscriptionsTable extends Table
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

        $this->setTable('city_subscriptions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Coupons', [
            'foreignKey' => 'coupon_id',
        ]);
        $this->hasMany('CitySubscriptionCities', [
            'foreignKey' => 'city_subscription_id',
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
            ->integer('duration')
            ->notEmptyString('duration');

        $validator
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmptyString('amount');

        $validator
            ->decimal('discount')
            ->requirePresence('discount', 'create')
            ->notEmptyString('discount');

        $validator
            ->scalar('start_timestamp')
            ->maxLength('start_timestamp', 255)
            ->requirePresence('start_timestamp', 'create')
            ->notEmptyString('start_timestamp');

        $validator
            ->scalar('end_timestamp')
            ->maxLength('end_timestamp', 255)
            ->requirePresence('end_timestamp', 'create')
            ->notEmptyString('end_timestamp');

        $validator
            ->scalar('snapshot')
            // ->maxLength('snapshot', (int)4294967295)
            ->allowEmptyString('snapshot');

        $validator
            ->scalar('stripe_info')
            // ->maxLength('stripe_info', (int)4294967295)
            ->allowEmptyString('stripe_info');

        $validator
            ->boolean('active')
            ->allowEmptyString('active');

        $validator
            ->boolean('paid')
            ->allowEmptyString('paid');

        $validator
            ->scalar('sessionid')
            ->maxLength('sessionid', 255)
            ->allowEmptyString('sessionid');

        $validator
            ->scalar('transactionid')
            ->maxLength('transactionid', 255)
            ->requirePresence('transactionid', 'create')
            ->notEmptyString('transactionid');

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
        $rules->add($rules->existsIn(['coupon_id'], 'Coupons'));

        return $rules;
    }
}
