<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity.
 */
class Product extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'description' => true,
        'product_category_id' => true,
        'unit_id' => true,
        'creation_date' => true,
        'product_category' => true,
        'unit' => true,
        'needs' => true,
    ];
}
