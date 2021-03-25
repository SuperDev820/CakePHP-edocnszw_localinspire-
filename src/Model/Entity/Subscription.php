<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Subscription Entity
 *
 * @property int $id
 * @property int $business_id
 * @property int|null $coupon_id
 * @property int $package_id
 * @property int $duration
 * @property string $amount
 * @property string|null $discount
 * @property string $start_timestamp
 * @property string $end_timestamp
 * @property string|null $snapshot
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string|null $stripe_info
 * @property bool|null $active
 * @property int|null $package_percent
 * @property string|null $city_owner_amount
 *
 * @property \App\Model\Entity\Business $business
 * @property \App\Model\Entity\Coupon $coupon
 * @property \App\Model\Entity\Package $package
 * @property \App\Model\Entity\CityOwnerEarning[] $city_owner_earnings
 */
class Subscription extends Entity
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
        'coupon_id' => true,
        'package_id' => true,
        'duration' => true,
        'amount' => true,
        'discount' => true,
        'start_timestamp' => true,
        'end_timestamp' => true,
        'snapshot' => true,
        'created' => true,
        'modified' => true,
        'stripe_info' => true,
        'active' => true,
        'package_percent' => true,
        'city_owner_amount' => true,
        'business' => true,
        'coupon' => true,
        'package' => true,
        'city_owner_earnings' => true,
    ];
}
