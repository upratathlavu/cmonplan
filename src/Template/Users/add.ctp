<div class="users form large-10 medium-9 columns">
    <?= $this->Form->create($user); ?>
    <fieldset>
        <legend><?= __('Create Account') ?></legend>
        <?php
            echo $this->Form->input('username');
            echo $this->Form->input('password');
            //echo $this->Form->select('role_id', ['2' => 'user']);
            echo $this->Form->hidden('role_id', ['value' => '2']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
