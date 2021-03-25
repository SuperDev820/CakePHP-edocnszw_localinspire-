<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Reminder Entity
 *
 * @property int $id
 * @property int $business_id
 * @property int|null $number_of_times
 * @property int $reminder_status_id
 * @property int $reminder_schedule_id
 * @property string|null $content
 * @property bool|null $active
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Business $business
 * @property \App\Model\Entity\ReminderStatus $reminder_status
 * @property \App\Model\Entity\ReminderSchedule $reminder_schedule
 * @property \App\Model\Entity\RemindersSent[] $reminders_sent
 */
class Reminder extends Entity
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
        'number_of_times' => true,
        'reminder_status_id' => true,
        'reminder_schedule_id' => true,
        'content' => true,
        'active' => true,
        'created' => true,
        'modified' => true,
        'business' => true,
        'reminder_status' => true,
        'reminder_schedule' => true,
        'reminders_sent' => true,
    ];
}
