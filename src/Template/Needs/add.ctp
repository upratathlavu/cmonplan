<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Needs'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Admin Mode'), ['prefix' => 'admin', 'controller' => 'Admin', 'action' => 'home']) ?></li>
        <li><?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout']) ?></li>
    </ul>
</div>
<div class="needs form large-10 medium-9 columns">
    <?= $this->Form->create($need); ?>
    <fieldset>
        <legend><?= __('Add Need') ?></legend>
        <?php
            //echo $this->Form->input('user_id', ['options' => $users, 'empty' => '(choose user id)']);
            echo $this->Form->hidden('user_id', ['value' => $authUser['id']]);
            echo $this->Form->input('product_id', ['options' => $products, 'empty' => '(choose product name)']);
            echo $this->Form->input('quantity');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
