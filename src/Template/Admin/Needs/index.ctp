<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
		<hr>
        <li><?= $this->Html->link(__('Home'), ['prefix' => 'admin', 'controller' => 'Admin', 'action' => 'home']) ?></li>                   
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
        <li><?= $this->Html->link(__('User Mode'), ['prefix' => '/', 'controller' => 'Needs', 'action' => 'index']) ?></li>                 
		<hr>
        <li><?= $this->Html->link(__('Logout'), ['prefix' => 'admin', 'controller' => 'Users', 'action' => 'logout']) ?></li>         
    </ul>
</div>

<div class="related row">
    <div class="column large-9">
    <h4 class="subheader"><?= __('Stocks per product') ?></h4>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Product Id') ?></th>
            <th><?= __('Quantity') ?></th>
        </tr>
        <?php foreach ($stocks_u as $stock): ?>
        <tr>
            <td><?= h($stock['p_name']) ?></td>
            <td><?= h($stock['s_quantity']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    </div>
</div>

<div class="related row">
    <div class="column large-9">
    <h4 class="subheader"><?= __('Stocks per user') ?></h4>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('User Id') ?></th>
            <th><?= __('Quantity') ?></th>
        </tr>
        <?php foreach ($stocks_p as $stock): ?>
        <tr>
            <td><?= h($stock['u_username']) ?></td>
            <td><?= h($stock['s_quantity']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    </div>
</div>

<div class="needs index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('username') ?></th>
            <th><?= $this->Paginator->sort('product_id') ?></th>
            <th><?= $this->Paginator->sort('quantity') ?></th>
            <th><?= $this->Paginator->sort('creation_date') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($needs as $need): ?>
        <tr>
            <td><?= $this->Number->format($need->id) ?></td>
            <td>
                <?= $need->has('user') ? $this->Html->link($need->user->username, ['controller' => 'Users', 'action' => 'view', $need->user->id]) : '' ?>
            </td>
            <td>
                <?= $need->has('product') ? $this->Html->link($need->product->name, ['controller' => 'Products', 'action' => 'view', $need->product->id]) : '' ?>
            </td>
            <td><?= $this->Number->format($need->quantity) ?></td>
            <td><?= h($need->creation_date) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $need->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $need->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $need->id], ['confirm' => __('Are you sure you want to delete # {0}?', $need->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
