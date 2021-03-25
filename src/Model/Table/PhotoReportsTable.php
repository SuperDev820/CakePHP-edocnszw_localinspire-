<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PhotoReports Model
 *
 * @property \App\Model\Table\BusinessPhotosTable&\Cake\ORM\Association\BelongsTo $BusinessPhotos
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\PhotoReport newEmptyEntity()
 * @method \App\Model\Entity\PhotoReport newEmptyEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PhotoReport[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PhotoReport get($primaryKey, $options = [])
 * @method \App\Model\Entity\PhotoReport findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PhotoReport patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PhotoReport[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PhotoReport|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PhotoReport saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PhotoReport[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PhotoReport[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PhotoReport[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PhotoReport[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PhotoReportsTable extends Table
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

        $this->setTable('photo_reports');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('BusinessPhotos', [
            'foreignKey' => 'business_photo_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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

        $validator
            ->scalar('why')
            ->maxLength('why', 100)
            ->requirePresence('why', 'create')
            ->notEmptyString('why');

        $validator
            ->scalar('specific_detail')
            // ->maxLength('specific_detail', (int)4294967295)
            ->allowEmptyString('specific_detail');

        $validator
            ->boolean('treated')
            ->allowEmptyString('treated');

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
        $rules->add($rules->existsIn(['business_photo_id'], 'BusinessPhotos'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
