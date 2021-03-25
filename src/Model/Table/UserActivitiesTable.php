<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserActivities Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\BusinessReviewsTable&\Cake\ORM\Association\BelongsTo $BusinessReviews
 * @property \App\Model\Table\QuestionsTable&\Cake\ORM\Association\BelongsTo $Questions
 * @property \App\Model\Table\BusinessPhotosTable&\Cake\ORM\Association\BelongsTo $BusinessPhotos
 * @property \App\Model\Table\AnswersTable&\Cake\ORM\Association\BelongsTo $Answers
 * @property \App\Model\Table\BusinessReviewPhotosTable&\Cake\ORM\Association\BelongsTo $BusinessReviewPhotos
 *
 * @method \App\Model\Entity\UserActivity newEmptyEntity()
 * @method \App\Model\Entity\UserActivity newEmptyEntity(array $data, array $options = [])
 * @method \App\Model\Entity\UserActivity[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserActivity get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserActivity findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\UserActivity patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserActivity[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserActivity|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserActivity saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserActivity[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\UserActivity[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\UserActivity[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\UserActivity[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UserActivitiesTable extends Table
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

        $this->setTable('user_activities');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('BusinessReviews', [
            'foreignKey' => 'business_review_id',
        ]);
        $this->belongsTo('Questions', [
            'foreignKey' => 'question_id',
        ]);
        $this->belongsTo('BusinessPhotos', [
            'foreignKey' => 'business_photo_id',
        ]);
        $this->belongsTo('Answers', [
            'foreignKey' => 'answer_id',
        ]);
        $this->belongsTo('BusinessReviewPhotos', [
            'foreignKey' => 'business_review_photo_id',
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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['business_review_id'], 'BusinessReviews'));
        $rules->add($rules->existsIn(['question_id'], 'Questions'));
        $rules->add($rules->existsIn(['business_photo_id'], 'BusinessPhotos'));
        $rules->add($rules->existsIn(['answer_id'], 'Answers'));
        $rules->add($rules->existsIn(['business_review_photo_id'], 'BusinessReviewPhotos'));

        return $rules;
    }
}
