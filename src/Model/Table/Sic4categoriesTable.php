<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sic4categories Model
 *
 * @property \App\Model\Table\BusinessesTable&\Cake\ORM\Association\HasMany $Businesses
 * @property \App\Model\Table\SearchKeywordsTable&\Cake\ORM\Association\HasMany $SearchKeywords
 * @property \App\Model\Table\SubcategoriesTable&\Cake\ORM\Association\HasMany $Subcategories
 * @property \App\Model\Table\FiltersTable&\Cake\ORM\Association\BelongsToMany $Filters
 * @property \App\Model\Table\Sic2categoriesTable&\Cake\ORM\Association\BelongsToMany $Sic2categories
 * @property \App\Model\Table\Sic8categoriesTable&\Cake\ORM\Association\BelongsToMany $Sic8categories
 *
 * @method \App\Model\Entity\Sic4category newEmptyEntity()
 * @method \App\Model\Entity\Sic4category newEmptyEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Sic4category[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Sic4category get($primaryKey, $options = [])
 * @method \App\Model\Entity\Sic4category findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Sic4category patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Sic4category[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Sic4category|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sic4category saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sic4category[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sic4category[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sic4category[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sic4category[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class Sic4categoriesTable extends Table
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

        $this->setTable('sic4categories');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Businesses', [
            'foreignKey' => 'sic4category_id',
        ]);
        $this->hasMany('SearchKeywords', [
            'foreignKey' => 'sic4category_id',
        ]);
        $this->hasMany('Subcategories', [
            'foreignKey' => 'sic4category_id',
        ]);
        $this->belongsToMany('Filters', [
            'foreignKey' => 'sic4category_id',
            'targetForeignKey' => 'filter_id',
            'joinTable' => 'filters_sic4categories',
        ]);
        $this->belongsToMany('Sic2categories', [
            'foreignKey' => 'sic4category_id',
            'targetForeignKey' => 'sic2category_id',
            'joinTable' => 'sic2categories_sic4categories',
        ]);
        $this->belongsToMany('Sic8categories', [
            'foreignKey' => 'sic4category_id',
            'targetForeignKey' => 'sic8category_id',
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
