<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Filter Entity
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $search_keyword_id
 * @property int $category_id
 * @property int $key_order
 * @property int $form_type_id
 * @property string $input_type
 * @property string|null $input_class
 * @property string|null $placeholder
 * @property bool $show_business
 * @property bool $active
 * @property string|null $options
 * @property bool|null $show_filter
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\SearchKeyword $search_keyword
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\FormType $form_type
 * @property \App\Model\Entity\BusinessAdditional[] $business_additionals
 * @property \App\Model\Entity\Sic2category[] $sic2categories
 * @property \App\Model\Entity\Sic4category[] $sic4categories
 * @property \App\Model\Entity\Sic8category[] $sic8categories
 * @property \App\Model\Entity\Subcategory[] $subcategories
 */
class Filter extends Entity
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
        'description' => true,
        'search_keyword_id' => true,
        'category_id' => true,
        'key_order' => true,
        'form_type_id' => true,
        'input_type' => true,
        'input_class' => true,
        'placeholder' => true,
        'show_business' => true,
        'active' => true,
        'options' => true,
        'show_filter' => true,
        'created' => true,
        'modified' => true,
        'search_keyword' => true,
        'category' => true,
        'form_type' => true,
        'business_additionals' => true,
        'sic2categories' => true,
        'sic4categories' => true,
        'sic8categories' => true,
        'subcategories' => true,
    ];
}
