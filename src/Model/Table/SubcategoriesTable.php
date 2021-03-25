<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Subcategories Model
 *
 * @property \App\Model\Table\CategoriesTable&\Cake\ORM\Association\BelongsTo $Categories
 * @property \App\Model\Table\Sic4categoriesTable&\Cake\ORM\Association\BelongsTo $Sic4categories
 * @property \App\Model\Table\BusinessesTable&\Cake\ORM\Association\BelongsToMany $Businesses
 * @property \App\Model\Table\FiltersTable&\Cake\ORM\Association\BelongsToMany $Filters
 * @property \App\Model\Table\TitlesTable&\Cake\ORM\Association\BelongsToMany $Titles
 *
 * @method \App\Model\Entity\Subcategory newEmptyEntity()
 * @method \App\Model\Entity\Subcategory newEmptyEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Subcategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Subcategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\Subcategory findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Subcategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Subcategory[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Subcategory|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Subcategory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Subcategory[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Subcategory[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Subcategory[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Subcategory[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SubcategoriesTable extends Table
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

        $this->setTable('subcategories');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Sic4categories', [
            'foreignKey' => 'sic4category_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsToMany('Businesses', [
            'foreignKey' => 'subcategory_id',
            'targetForeignKey' => 'business_id',
            'joinTable' => 'businesses_subcategories',
        ]);
        $this->belongsToMany('Filters', [
            'foreignKey' => 'subcategory_id',
            'targetForeignKey' => 'filter_id',
            'joinTable' => 'filters_subcategories',
        ]);
        $this->belongsToMany('Titles', [
            'foreignKey' => 'subcategory_id',
            'targetForeignKey' => 'title_id',
            'joinTable' => 'subcategories_titles',
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
        $rules->add($rules->existsIn(['category_id'], 'Categories'));
        $rules->add($rules->existsIn(['sic4category_id'], 'Sic4categories'));

        return $rules;
    }
}
