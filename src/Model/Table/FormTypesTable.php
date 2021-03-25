<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FormTypes Model
 *
 * @property \App\Model\Table\FiltersTable&\Cake\ORM\Association\HasMany $Filters
 *
 * @method \App\Model\Entity\FormType newEmptyEntity()
 * @method \App\Model\Entity\FormType newEmptyEntity(array $data, array $options = [])
 * @method \App\Model\Entity\FormType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FormType get($primaryKey, $options = [])
 * @method \App\Model\Entity\FormType findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\FormType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FormType[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\FormType|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FormType saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FormType[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\FormType[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\FormType[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\FormType[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class FormTypesTable extends Table
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

        $this->setTable('form_types');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Filters', [
            'foreignKey' => 'form_type_id',
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
            ->integer('placeholder')
            ->allowEmptyString('placeholder');

        $validator
            ->integer('min')
            ->allowEmptyString('min');

        $validator
            ->integer('max')
            ->allowEmptyString('max');

        $validator
            ->integer('step')
            ->allowEmptyString('step');

        return $validator;
    }
}
