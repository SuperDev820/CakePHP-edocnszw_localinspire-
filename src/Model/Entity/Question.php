<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Question Entity
 *
 * @property int $id
 * @property int $business_id
 * @property int $user_id
 * @property string|null $question
 * @property bool|null $notify
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Business $business
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Answer[] $answers
 * @property \App\Model\Entity\QuestionReport[] $question_reports
 * @property \App\Model\Entity\Share[] $shares
 * @property \App\Model\Entity\UserActivity[] $user_activities
 */
class Question extends Entity
{
    /**
     * Fields that can be mass assigned using newEmptyEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'business_id' => true,
        'user_id' => true,
        'question' => true,
        'notify' => true,
        'created' => true,
        'modified' => true,
        'business' => true,
        'user' => true,
        'answers' => true,
        'question_reports' => true,
        'shares' => true,
        'user_activities' => true,
    ];
}
