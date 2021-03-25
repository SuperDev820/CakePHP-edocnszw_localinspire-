<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Coupon Entity
 *
 * @property int $id
 * @property string $code
 * @property string|null $expiration
 * @property string|null $description
 * @property string $amount
 * @property bool|null $active
 * @property bool|null $percentage_voucher
 * @property bool|null $used
 * @property int|null $percent
 * @property int|null $user_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\CitySubscription[] $city_subscriptions
 * @property \App\Model\Entity\Subscription[] $subscriptions
 */
class Coupon extends Entity
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
        'code' => true,
        'expiration' => true,
        'description' => true,
        'amount' => true,
        'active' => true,
        'percentage_voucher' => true,
        'used' => true,
        'percent' => true,
        'user_id' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'city_subscriptions' => true,
        'subscriptions' => true,
    ];
}
