<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Needs'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="needs form large-10 medium-9 columns">
    <?= $this->Form->create($need); ?>
    <fieldset>
        <legend><?= __('Add Need') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('product_id', ['options' => $products]);
            echo $this->Form->input('quantity');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
