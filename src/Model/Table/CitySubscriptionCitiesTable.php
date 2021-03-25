<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CitySubscriptionCities Model
 *
 * @property \App\Model\Table\CitySubscriptionsTable&\Cake\ORM\Association\BelongsTo $CitySubscriptions
 * @property \App\Model\Table\CitiesTable&\Cake\ORM\Association\BelongsTo $Cities
 *
 * @method \App\Model\Entity\CitySubscriptionCity newEmptyEntity()
 * @method \App\Model\Entity\CitySubscriptionCity newEmptyEntity(array $data, array $options = [])
 * @method \App\Model\Entity\CitySubscriptionCity[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CitySubscriptionCity get($primaryKey, $options = [])
 * @method \App\Model\Entity\CitySubscriptionCity findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\CitySubscriptionCity patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CitySubscriptionCity[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CitySubscriptionCity|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CitySubscriptionCity saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CitySubscriptionCity[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CitySubscriptionCity[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\CitySubscriptionCity[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CitySubscriptionCity[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CitySubscriptionCitiesTable extends Table
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

        $this->setTable('city_subscription_cities');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('CitySubscriptions', [
            'foreignKey' => 'city_subscription_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
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
        $rules->add($rules->existsIn(['city_subscription_id'], 'CitySubscriptions'));
        $rules->add($rules->existsIn(['city_id'], 'Cities'));

        return $rules;
    }
}
