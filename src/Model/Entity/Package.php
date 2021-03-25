<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Package Entity
 *
 * @property int $id
 * @property string $name
 * @property string $price_per_month
 * @property string $price_per_year
 * @property string $description
 * @property int|null $percentage
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $stripe_productid
 * @property string $stripe_monthly_plan
 * @property string $stripe_yearly_plan
 *
 * @property \App\Model\Entity\Subscription[] $subscriptions
 */
class Package extends Entity
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
        'name' => true,
        'price_per_month' => true,
        'price_per_year' => true,
        'description' => true,
        'percentage' => true,
        'created' => true,
        'modified' => true,
        'stripe_productid' => true,
        'stripe_monthly_plan' => true,
        'stripe_yearly_plan' => true,
        'subscriptions' => true,
    ];
}
