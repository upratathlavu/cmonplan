<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\Database\Connection;


class AdminController extends AppController
{
    public function home()
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(
			'select count(*)
			from users');
        $userscnt = $stmt->fetch();
        $this->set('userscnt', $userscnt);  

        $stmt = $conn->execute(
			'select count(*)
			from products');
        $productscnt = $stmt->fetch();
        $this->set('productscnt', $productscnt);         
        
        $stmt = $conn->execute(
			'select p.name as p_name, sum(n.quantity) as n_cnt 
			from needs as n 
			join products as p on n.product_id = p.id 
			group by p.name');
        $stocks = $stmt->fetchAll('assoc');
        $this->set('stocks', $stocks);        
    }
}
