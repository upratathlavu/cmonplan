<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Need'), ['action' => 'edit', $need->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Need'), ['action' => 'delete', $need->id], ['confirm' => __('Are you sure you want to delete # {0}?', $need->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Needs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Need'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?> </li>
    </ul>
</div>
