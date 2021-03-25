<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FiltersSic4categories Model
 *
 * @property \App\Model\Table\FiltersTable&\Cake\ORM\Association\BelongsTo $Filters
 * @property \App\Model\Table\Sic4categoriesTable&\Cake\ORM\Association\BelongsTo $Sic4categories
 *
 * @method \App\Model\Entity\FiltersSic4category newEmptyEntity()
 * @method \App\Model\Entity\FiltersSic4category newEmptyEntity(array $data, array $options = [])
 * @method \App\Model\Entity\FiltersSic4category[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FiltersSic4category get($primaryKey, $options = [])
 * @method \App\Model\Entity\FiltersSic4category findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\FiltersSic4category patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FiltersSic4category[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\FiltersSic4category|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FiltersSic4category saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FiltersSic4category[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\FiltersSic4category[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\FiltersSic4category[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\FiltersSic4category[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FiltersSic4categoriesTable extends Table
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

        $this->setTable('filters_sic4categories');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Filters', [
            'foreignKey' => 'filter_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Sic4categories', [
            'foreignKey' => 'sic4category_id',
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
        $rules->add($rules->existsIn(['filter_id'], 'Filters'));
        $rules->add($rules->existsIn(['sic4category_id'], 'Sic4categories'));

        return $rules;
    }
}
