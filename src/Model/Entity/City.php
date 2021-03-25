<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * City Entity
 *
 * @property int $id
 * @property int $state_id
 * @property string $name
 * @property string $county
 * @property float $latitude
 * @property float $longitude
 * @property bool|null $featured
 * @property string|null $image
 * @property string|null $description
 * @property int|null $population
 * @property string|null $zip
 * @property string|null $ansi
 * @property string|null $gnsi
 * @property string $price
 * @property int|null $user_id
 *
 * @property \App\Model\Entity\State $state
 * @property \App\Model\Entity\User[] $users
 * @property \App\Model\Entity\Business[] $businesses
 * @property \App\Model\Entity\CityOwnerEarning[] $city_owner_earnings
 * @property \App\Model\Entity\CitySearch[] $city_searches
 * @property \App\Model\Entity\CitySubscriptionCity[] $city_subscription_cities
 * @property \App\Model\Entity\Post[] $posts
 * @property \App\Model\Entity\Tag[] $tags
 */
class City extends Entity
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
        'state_id' => true,
        'name' => true,
        'county' => true,
        'latitude' => true,
        'longitude' => true,
        'featured' => true,
        'image' => true,
        'description' => true,
        'population' => true,
        'zip' => true,
        'ansi' => true,
        'gnsi' => true,
        'price' => true,
        'user_id' => true,
        'state' => true,
        'users' => true,
        'businesses' => true,
        'city_owner_earnings' => true,
        'city_searches' => true,
        'city_subscription_cities' => true,
        'posts' => true,
        'tags' => true,
    ];

    protected $_virtual = ['user'];

    protected function _getCode()
    {
        return \Cake\Datasource\FactoryLocator::get('Table')->get('Users')->find()->where(['id' => $this->user_id])->first();
    }
}
