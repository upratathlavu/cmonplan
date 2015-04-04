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
<div class="users index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('username') ?></th>
            <th><?= $this->Paginator->sort('role_id') ?></th>
            <th><?= $this->Paginator->sort('creation_date') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $this->Number->format($user->id) ?></td>
            <td><?= h($user->username) ?></td>
            <td>
                <?= $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?>
            </td>
            <td><?= h($user->creation_date) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
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
