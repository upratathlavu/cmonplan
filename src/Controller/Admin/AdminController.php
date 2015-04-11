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
			from roles');
        $rolescnt = $stmt->fetch('assoc');
        $this->set('rolescnt', $rolescnt);  

        $stmt = $conn->execute(
			'select count(*)
			from users');
        $userscnt = $stmt->fetch('assoc');
        $this->set('userscnt', $userscnt);  

        $stmt = $conn->execute(
			'select count(*)
			from products');
        $productscnt = $stmt->fetch('assoc');
        $this->set('productscnt', $productscnt);         

        $stmt = $conn->execute(
			'select count(*)
			from product_categories');
        $productcategoriescnt = $stmt->fetch('assoc');
        $this->set('productcategoriescnt', $productcategoriescnt);          
        
        $stmt = $conn->execute(
			'select count(*)
			from units');
        $unitscnt = $stmt->fetch('assoc');
        $this->set('unitscnt', $unitscnt);          
        
        $stmt = $conn->execute(
			'select p.name as p_name, sum(n.quantity) as s_quantity 
			from needs as n 
			join products as p on n.product_id = p.id 
			group by p.name');
        $stocks = $stmt->fetchAll('assoc');
        $this->set('stocks', $stocks);        
    }
}
