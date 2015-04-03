<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Need Entity.
 */
class Need extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'product_id' => true,
        'quantity' => true,
        'creation_date' => true,
        'user' => true,
        'product' => true,
    ];
}
