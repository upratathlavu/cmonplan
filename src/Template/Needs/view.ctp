<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Need'), ['action' => 'edit', $need->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Need'), ['action' => 'delete', $need->id], ['confirm' => __('Are you sure you want to delete # {0}?', $need->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Needs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Need'), ['action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('Admin Mode'), ['prefix' => 'admin', 'controller' => 'Admin', 'action' => 'home']) ?></li>
        <li><?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout']) ?></li>
    </ul>
</div>
<div class="needs view large-10 medium-9 columns">
    <h2><?= h($need->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('User') ?></h6>
            <p><?= $need->has('user') ? $this->Html->link($need->user->username, ['controller' => 'Users', 'action' => 'view', $need->user->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Product') ?></h6>
            <p><?= $need->has('product') ? $this->Html->link($need->product->name, ['controller' => 'Products', 'action' => 'view', $need->product->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($need->id) ?></p>
            <h6 class="subheader"><?= __('Quantity') ?></h6>
            <p><?= $this->Number->format($need->quantity) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Creation Date') ?></h6>
            <p><?= h($need->creation_date) ?></p>
        </div>
    </div>
</div>
