<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Product'), ['action' => 'edit', $product->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Product'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id)]) ?> </li>
		<hr>
        <li><?= $this->Html->link(__('List Needs'), ['prefix' => 'admin', 'controller' => 'Needs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Need'), ['prefix' => 'admin', 'controller' => 'Needs', 'action' => 'add']) ?> </li>
        <hr>
        <li><?= $this->Html->link(__('List Users'), ['prefix' => 'admin', 'controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['prefix' => 'admin', 'controller' => 'Users', 'action' => 'add']) ?> </li>
        <hr>        
        <li><?= $this->Html->link(__('List Roles'), ['prefix' => 'admin', 'controller' => 'Roles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Role'), ['prefix' => 'admin', 'controller' => 'Roles', 'action' => 'add']) ?> </li>        
        <hr>
        <li><?= $this->Html->link(__('List Products'), ['prefix' => 'admin', 'controller' => 'Products', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['prefix' => 'admin', 'controller' => 'Products', 'action' => 'add']) ?> </li>
        <hr>
        <li><?= $this->Html->link(__('List Product Categories'), ['prefix' => 'admin', 'controller' => 'ProductCategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product Category'), ['prefix' => 'admin', 'controller' => 'ProductCategories', 'action' => 'add']) ?> </li>
        <hr>
        <li><?= $this->Html->link(__('List Units'), ['prefix' => 'admin', 'controller' => 'Units', 'action' => 'index']) ?> </li>    
        <li><?= $this->Html->link(__('New Unit'), ['prefix' => 'admin', 'controller' => 'Units', 'action' => 'add']) ?> </li> 
        <hr>
        <li><?= $this->Html->link(__('User Mode'), ['controller' => 'Needs', 'action' => 'list']) ?></li>                 
		<hr>
        <li><?= $this->Html->link(__('Logout'), ['prefix' => 'admin', 'controller' => 'Users', 'action' => 'logout']) ?></li>         
    </ul>
</div>
<div class="products view large-10 medium-9 columns">
    <h2><?= h($product->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($product->name) ?></p>
            <h6 class="subheader"><?= __('Description') ?></h6>
            <p><?= h($product->description) ?></p>
            <h6 class="subheader"><?= __('Product Category') ?></h6>
            <p><?= $product->has('product_category') ? $this->Html->link($product->product_category->name, ['controller' => 'ProductCategories', 'action' => 'view', $product->product_category->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Unit') ?></h6>
            <p><?= $product->has('unit') ? $this->Html->link($product->unit->name, ['controller' => 'Units', 'action' => 'view', $product->unit->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($product->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Creation Date') ?></h6>
            <p><?= h($product->creation_date) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Needs') ?></h4>
    <?php if (!empty($product->needs)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('User Id') ?></th>
            <th><?= __('Product Id') ?></th>
            <th><?= __('Quantity') ?></th>
            <th><?= __('Creation Date') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($product->needs as $needs): ?>
        <tr>
            <td><?= h($needs->id) ?></td>
            <td><?= h($needs->user_id) ?></td>
            <td><?= h($needs->product_id) ?></td>
            <td><?= h($needs->quantity) ?></td>
            <td><?= h($needs->creation_date) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Needs', 'action' => 'view', $needs->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Needs', 'action' => 'edit', $needs->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Needs', 'action' => 'delete', $needs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $needs->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
