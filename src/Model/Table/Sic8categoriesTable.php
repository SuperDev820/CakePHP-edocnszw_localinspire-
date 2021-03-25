<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sic8categories Model
 *
 * @property \App\Model\Table\BusinessesTable&\Cake\ORM\Association\HasMany $Businesses
 * @property \App\Model\Table\FiltersTable&\Cake\ORM\Association\BelongsToMany $Filters
 * @property \App\Model\Table\Sic4categoriesTable&\Cake\ORM\Association\BelongsToMany $Sic4categories
 *
 * @method \App\Model\Entity\Sic8category newEmptyEntity()
 * @method \App\Model\Entity\Sic8category newEmptyEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Sic8category[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Sic8category get($primaryKey, $options = [])
 * @method \App\Model\Entity\Sic8category findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Sic8category patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Sic8category[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Sic8category|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sic8category saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sic8category[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sic8category[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sic8category[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sic8category[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class Sic8categoriesTable extends Table
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

        $this->setTable('sic8categories');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Businesses', [
            'foreignKey' => 'sic8category_id',
        ]);
        $this->belongsToMany('Filters', [
            'foreignKey' => 'sic8category_id',
            'targetForeignKey' => 'filter_id',
            'joinTable' => 'filters_sic8categories',
        ]);
        $this->belongsToMany('Sic4categories', [
            'foreignKey' => 'sic8category_id',
            'targetForeignKey' => 'sic4category_id',
            'joinTable' => 'sic4categories_sic8categories',
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
