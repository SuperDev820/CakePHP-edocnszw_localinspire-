<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CitySubscriptionCity Entity
 *
 * @property int $id
 * @property int $city_subscription_id
 * @property int $city_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\CitySubscription $city_subscription
 * @property \App\Model\Entity\City $city
 */
class CitySubscriptionCity extends Entity
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
        'city_subscription_id' => true,
        'city_id' => true,
        'created' => true,
        'modified' => true,
        'city_subscription' => true,
        'city' => true,
    ];
}
