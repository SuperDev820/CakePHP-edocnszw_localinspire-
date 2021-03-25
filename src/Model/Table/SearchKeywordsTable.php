<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SearchKeywords Model
 *
 * @property \App\Model\Table\Sic4categoriesTable&\Cake\ORM\Association\BelongsTo $Sic4categories
 * @property \App\Model\Table\FiltersTable&\Cake\ORM\Association\HasMany $Filters
 *
 * @method \App\Model\Entity\SearchKeyword newEmptyEntity()
 * @method \App\Model\Entity\SearchKeyword newEmptyEntity(array $data, array $options = [])
 * @method \App\Model\Entity\SearchKeyword[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SearchKeyword get($primaryKey, $options = [])
 * @method \App\Model\Entity\SearchKeyword findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\SearchKeyword patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SearchKeyword[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\SearchKeyword|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SearchKeyword saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SearchKeyword[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SearchKeyword[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\SearchKeyword[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SearchKeyword[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class SearchKeywordsTable extends Table
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

        $this->setTable('search_keywords');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Sic4categories', [
            'foreignKey' => 'sic4category_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Filters', [
            'foreignKey' => 'search_keyword_id',
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
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->boolean('enable_business')
            ->allowEmptyString('enable_business');

        $validator
            ->boolean('enable_filter')
            ->allowEmptyString('enable_filter');

        $validator
            ->scalar('icon')
            ->maxLength('icon', 255)
            ->allowEmptyString('icon');

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
        $rules->add($rules->existsIn(['sic4category_id'], 'Sic4categories'));

        return $rules;
    }
}
