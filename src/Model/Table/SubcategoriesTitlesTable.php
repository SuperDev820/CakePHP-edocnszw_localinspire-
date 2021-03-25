<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SubcategoriesTitles Model
 *
 * @property \App\Model\Table\SubcategoriesTable&\Cake\ORM\Association\BelongsTo $Subcategories
 * @property \App\Model\Table\TitlesTable&\Cake\ORM\Association\BelongsTo $Titles
 *
 * @method \App\Model\Entity\SubcategoriesTitle newEmptyEntity()
 * @method \App\Model\Entity\SubcategoriesTitle newEmptyEntity(array $data, array $options = [])
 * @method \App\Model\Entity\SubcategoriesTitle[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SubcategoriesTitle get($primaryKey, $options = [])
 * @method \App\Model\Entity\SubcategoriesTitle findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\SubcategoriesTitle patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SubcategoriesTitle[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\SubcategoriesTitle|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SubcategoriesTitle saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SubcategoriesTitle[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SubcategoriesTitle[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\SubcategoriesTitle[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SubcategoriesTitle[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SubcategoriesTitlesTable extends Table
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

        $this->setTable('subcategories_titles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Subcategories', [
            'foreignKey' => 'subcategory_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Titles', [
            'foreignKey' => 'title_id',
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
        $rules->add($rules->existsIn(['subcategory_id'], 'Subcategories'));
        $rules->add($rules->existsIn(['title_id'], 'Titles'));

        return $rules;
    }
}
