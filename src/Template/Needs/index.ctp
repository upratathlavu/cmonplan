<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Need'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout']) ?></li>
    </ul>
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
