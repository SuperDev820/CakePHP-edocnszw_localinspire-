<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Cities Model
 *
 * @property \App\Model\Table\StatesTable&\Cake\ORM\Association\BelongsTo $States
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\BusinessesTable&\Cake\ORM\Association\HasMany $Businesses
 * @property \App\Model\Table\CityOwnerEarningsTable&\Cake\ORM\Association\HasMany $CityOwnerEarnings
 * @property \App\Model\Table\CitySearchesTable&\Cake\ORM\Association\HasMany $CitySearches
 * @property \App\Model\Table\CitySubscriptionCitiesTable&\Cake\ORM\Association\HasMany $CitySubscriptionCities
 * @property \App\Model\Table\PostsTable&\Cake\ORM\Association\HasMany $Posts
 * @property \App\Model\Table\TagsTable&\Cake\ORM\Association\HasMany $Tags
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\City newEmptyEntity()
 * @method \App\Model\Entity\City newEmptyEntity(array $data, array $options = [])
 * @method \App\Model\Entity\City[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\City get($primaryKey, $options = [])
 * @method \App\Model\Entity\City findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\City patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\City[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\City|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\City saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\City[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\City[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\City[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\City[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CitiesTable extends Table
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

        $this->setTable('cities');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Businesses', [
            'foreignKey' => 'city_id',
        ]);
        $this->hasMany('CityOwnerEarnings', [
            'foreignKey' => 'city_id',
        ]);
        $this->hasMany('CitySearches', [
            'foreignKey' => 'city_id',
        ]);
        $this->hasMany('CitySubscriptionCities', [
            'foreignKey' => 'city_id',
        ]);
        $this->hasMany('Posts', [
            'foreignKey' => 'city_id',
        ]);
        $this->hasMany('Tags', [
            'foreignKey' => 'city_id',
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'city_id',
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
            ->scalar('name')
            ->maxLength('name', 50)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('county')
            ->maxLength('county', 50)
            ->requirePresence('county', 'create')
            ->notEmptyString('county');

        $validator
            ->numeric('latitude')
            ->requirePresence('latitude', 'create')
            ->notEmptyString('latitude');

        $validator
            ->numeric('longitude')
            ->requirePresence('longitude', 'create')
            ->notEmptyString('longitude');

        $validator
            ->boolean('featured')
            ->allowEmptyString('featured');

        $validator
            ->scalar('image')
            ->maxLength('image', 255)
            ->allowEmptyFile('image');

        $validator
            ->scalar('description')
            // ->maxLength('description', (int)4294967295)
            ->allowEmptyString('description');

        $validator
            ->integer('population')
            ->allowEmptyString('population');

        $validator
            ->scalar('zip')
            ->maxLength('zip', 255)
            ->allowEmptyString('zip');

        $validator
            ->scalar('ansi')
            ->maxLength('ansi', 255)
            ->allowEmptyString('ansi');

        $validator
            ->scalar('gnsi')
            ->maxLength('gnsi', 255)
            ->allowEmptyString('gnsi');

        $validator
            ->decimal('price')
            ->notEmptyString('price');

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
        $rules->add($rules->existsIn(['state_id'], 'States'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
