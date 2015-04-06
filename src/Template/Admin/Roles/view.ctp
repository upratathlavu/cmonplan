<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
		<hr>
        <li><?= $this->Html->link(__('Home'), ['prefix' => 'admin', 'controller' => 'Admin', 'action' => 'home']) ?></li>               
        <hr>    
        <!--<li><?//= $this->Html->link(__('Edit Role'), ['action' => 'edit', $role->id]) ?> </li>-->
        <li><?= $this->Html->link(__('Edit Role'), ['action' => 'edit', $role['r_id']]) ?> </li>
        <!--<li><?//= $this->Form->postLink(__('Delete Role'), ['action' => 'delete', $role->id], ['confirm' => __('Are you sure you want to delete # {0}?', $role->id)]) ?> </li>-->
        <li><?= $this->Form->postLink(__('Delete Role'), ['action' => 'delete', $role['r_id']], ['confirm' => __('Are you sure you want to delete # {0}?', $role['r_id'])]) ?> </li>
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
<div class="roles view large-10 medium-9 columns">
    <!--<h2><?//= h($role->name) ?></h2>-->
    <h2><?= h($role['r_name']) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <!--<p><?//= h($role->name) ?></p>-->
            <p><?= h($role['r_name']) ?></p>
            <h6 class="subheader"><?= __('Description') ?></h6>
            <!--<p><?= h($role->description) ?></p>-->
            <p><?= h($role['r_description']) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <!--<p><?//= $this->Number->format($role->id) ?></p>-->
            <p><?= $this->Number->format($role['r_id']) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Creation Date') ?></h6>
            <!--<p><?//= h($role->creation_date) ?></p>-->
            <p><?= h($role['r_creation_date']) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-9">
    <h4 class="subheader"><?= __('Related Users') ?></h4>
    <!--<?php // if (!empty($role->users)): ?>-->
    <?php if (!empty($users)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Username') ?></th>
            <th><?= __('Role Id') ?></th>
            <th><?= __('Creation Date') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <!--<?php // foreach ($role->users as $users): ?>-->
        <?php foreach ($users as $user): ?>
        <tr>
            <!--<td><?//= h($users->id) ?></td>
            <td><?//= h($users->username) ?></td>
            <td><?//= h($users->role_id) ?></td>
            <td><?//= h($users->creation_date) ?></td>-->
            
            <td><?= h($user['u_id']) ?></td>
            <td><?= h($user['u_username']) ?></td>
            <td><?= h($user['u_role_id']) ?></td>
            <td><?= h($user['u_creation_date']) ?></td>

            <td class="actions">
                <!--<?//= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>-->
                <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $user['u_id']]) ?>
                <!--<?//= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>-->
                <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $user['u_id']]) ?>
                <!--<?//= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>-->
				<?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $user['u_id']], ['confirm' => __('Are you sure you want to delete # {0}?', $user['u_id'])]) ?>
            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
