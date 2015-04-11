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

<div class="products view large-10 medium-9 columns">
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Roles count') ?></h6>
            <p><?= $rolescnt['count'] ?></p>        
            <h6 class="subheader"><?= __('Users count') ?></h6>
            <p><?= $userscnt['count'] ?></p>
            <h6 class="subheader"><?= __('Products count') ?></h6>
            <p><?= $productscnt['count'] ?></p>
            <h6 class="subheader"><?= __('Product categories count') ?></h6>
            <p><?= $productcategoriescnt['count'] ?></p>
			<h6 class="subheader"><?= __('Units count') ?></h6>
            <p><?= $unitscnt['count'] ?></p>       
        </div>
    </div>
</div>

<div class="related row">
    <div class="column large-9">
    <h4 class="subheader"><?= __('Stocks per product') ?></h4>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Product Id') ?></th>
            <th><?= __('Quantity') ?></th>
        </tr>
        <?php foreach ($stocks as $stock): ?>
        <tr>
            <td><?= h($stock['p_name']) ?></td>
            <td><?= h($stock['s_quantity']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    </div>
</div>

