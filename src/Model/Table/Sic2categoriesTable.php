<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sic2categories Model
 *
 * @property \App\Model\Table\BusinessesTable&\Cake\ORM\Association\HasMany $Businesses
 * @property \App\Model\Table\FiltersTable&\Cake\ORM\Association\BelongsToMany $Filters
 * @property \App\Model\Table\Sic4categoriesTable&\Cake\ORM\Association\BelongsToMany $Sic4categories
 *
 * @method \App\Model\Entity\Sic2category newEmptyEntity()
 * @method \App\Model\Entity\Sic2category newEmptyEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Sic2category[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Sic2category get($primaryKey, $options = [])
 * @method \App\Model\Entity\Sic2category findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Sic2category patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Sic2category[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Sic2category|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sic2category saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sic2category[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sic2category[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sic2category[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sic2category[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class Sic2categoriesTable extends Table
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

        $this->setTable('sic2categories');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Businesses', [
            'foreignKey' => 'sic2category_id',
        ]);
        $this->belongsToMany('Filters', [
            'foreignKey' => 'sic2category_id',
            'targetForeignKey' => 'filter_id',
            'joinTable' => 'filters_sic2categories',
        ]);
        $this->belongsToMany('Sic4categories', [
            'foreignKey' => 'sic2category_id',
            'targetForeignKey' => 'sic4category_id',
            'joinTable' => 'sic2categories_sic4categories',
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
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('description')
            // ->maxLength('description', (int)4294967295)
            ->allowEmptyString('description');

        return $validator;
    }
}
