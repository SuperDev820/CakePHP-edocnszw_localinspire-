<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FormType Entity
 *
 * @property int $id
 * @property string $name
 * @property int|null $placeholder
 * @property int|null $min
 * @property int|null $max
 * @property int|null $step
 *
 * @property \App\Model\Entity\Filter[] $filters
 */
class FormType extends Entity
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
        'placeholder' => true,
        'min' => true,
        'max' => true,
        'step' => true,
        'filters' => true,
    ];
}
