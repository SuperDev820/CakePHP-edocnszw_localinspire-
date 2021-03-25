<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Filters Model
 *
 * @property \App\Model\Table\SearchKeywordsTable&\Cake\ORM\Association\BelongsTo $SearchKeywords
 * @property \App\Model\Table\CategoriesTable&\Cake\ORM\Association\BelongsTo $Categories
 * @property \App\Model\Table\FormTypesTable&\Cake\ORM\Association\BelongsTo $FormTypes
 * @property \App\Model\Table\BusinessAdditionalsTable&\Cake\ORM\Association\HasMany $BusinessAdditionals
 * @property \App\Model\Table\Sic2categoriesTable&\Cake\ORM\Association\BelongsToMany $Sic2categories
 * @property \App\Model\Table\Sic4categoriesTable&\Cake\ORM\Association\BelongsToMany $Sic4categories
 * @property \App\Model\Table\Sic8categoriesTable&\Cake\ORM\Association\BelongsToMany $Sic8categories
 * @property \App\Model\Table\SubcategoriesTable&\Cake\ORM\Association\BelongsToMany $Subcategories
 *
 * @method \App\Model\Entity\Filter newEmptyEntity()
 * @method \App\Model\Entity\Filter newEmptyEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Filter[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Filter get($primaryKey, $options = [])
 * @method \App\Model\Entity\Filter findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Filter patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Filter[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Filter|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Filter saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Filter[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Filter[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Filter[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Filter[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FiltersTable extends Table
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

        $this->setTable('filters');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('SearchKeywords', [
            'foreignKey' => 'search_keyword_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('FormTypes', [
            'foreignKey' => 'form_type_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('BusinessAdditionals', [
            'foreignKey' => 'filter_id',
        ]);
        $this->belongsToMany('Sic2categories', [
            'foreignKey' => 'filter_id',
            'targetForeignKey' => 'sic2category_id',
            'joinTable' => 'filters_sic2categories',
        ]);
        $this->belongsToMany('Sic4categories', [
            'foreignKey' => 'filter_id',
            'targetForeignKey' => 'sic4category_id',
            'joinTable' => 'filters_sic4categories',
        ]);
        $this->belongsToMany('Sic8categories', [
            'foreignKey' => 'filter_id',
            'targetForeignKey' => 'sic8category_id',
            'joinTable' => 'filters_sic8categories',
        ]);
        $this->belongsToMany('Subcategories', [
            'foreignKey' => 'filter_id',
            'targetForeignKey' => 'subcategory_id',
            'joinTable' => 'filters_subcategories',
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
            ->maxLength('name', 200)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('description')
            ->maxLength('description', 200)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->integer('key_order')
            ->requirePresence('key_order', 'create')
            ->notEmptyString('key_order');

        $validator
            ->scalar('input_type')
            ->notEmptyString('input_type');

        $validator
            ->scalar('input_class')
            ->maxLength('input_class', 255)
            ->allowEmptyString('input_class');

        $validator
            ->scalar('placeholder')
            ->maxLength('placeholder', 255)
            ->allowEmptyString('placeholder');

        $validator
            ->boolean('show_business')
            ->notEmptyString('show_business');

        $validator
            ->boolean('active')
            ->notEmptyString('active');

        $validator
            ->scalar('options')
            // ->maxLength('options', (int)4294967295)
            ->allowEmptyString('options');

        $validator
            ->boolean('show_filter')
            ->allowEmptyString('show_filter');

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
        $rules->add($rules->existsIn(['search_keyword_id'], 'SearchKeywords'));
        $rules->add($rules->existsIn(['category_id'], 'Categories'));
        $rules->add($rules->existsIn(['form_type_id'], 'FormTypes'));

        return $rules;
    }
}
