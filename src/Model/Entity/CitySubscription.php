<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CitySubscription Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $coupon_id
 * @property int $duration
 * @property string $amount
 * @property string $discount
 * @property string $start_timestamp
 * @property string $end_timestamp
 * @property string|null $snapshot
 * @property string|null $stripe_info
 * @property bool|null $active
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property bool|null $paid
 * @property string|null $sessionid
 * @property string $transactionid
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Coupon $coupon
 * @property \App\Model\Entity\CitySubscriptionCity[] $city_subscription_cities
 */
class CitySubscription extends Entity
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
        'user_id' => true,
        'coupon_id' => true,
        'duration' => true,
        'amount' => true,
        'discount' => true,
        'start_timestamp' => true,
        'end_timestamp' => true,
        'snapshot' => true,
        'stripe_info' => true,
        'active' => true,
        'created' => true,
        'modified' => true,
        'paid' => true,
        'sessionid' => true,
        'transactionid' => true,
        'user' => true,
        'coupon' => true,
        'city_subscription_cities' => true,
    ];
}
