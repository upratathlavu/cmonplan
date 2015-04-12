<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\Database\Connection;

/**
 * ProductCategories Controller
 *
 * @property \App\Model\Table\ProductCategoriesTable $ProductCategories
 */
class ProductCategoriesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
			'limit' => 15,
			'order' => [
				'ProductCategories.id' => 'asc'
			]
        ];		
        $this->set('productCategories', $this->paginate($this->ProductCategories));
        $this->set('_serialize', ['productCategories']);
    }

    /**
     * View method
     *
     * @param string|null $id Product Category id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
		// orig
        //$productCategory = $this->ProductCategories->get($id, [
        //    'contain' => ['Products']
        //]);
        //$this->set('productCategory', $productCategory);
        //$this->set('_serialize', ['productCategory']);
        
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(
			'select * 
			from product_categories
			where id = ?', 
			[$id], ['integer']);
        $productCategory = $stmt->fetch('assoc');
        $this->set('productCategory', $productCategory);  
        
        $stmt = $conn->execute(
			// TODO: PREPISAT S POUZITIM NAME NAMIESTO ID        
			'select p.id as p_id, p.name as p_name, p.description as p_description, p.product_category_id as p_product_category_id, p.unit_id as p_unit_id, p.creation_date as p_creation_date 
			from products as p 
			join product_categories as pc on p.product_category_id = pc.id 
			where pc.id = ?', 
			[$id], ['integer']);
        $products = $stmt->fetchAll('assoc');        
        $this->set('products', $products);        
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$conn = ConnectionManager::get('default');

        $productCategory = $this->ProductCategories->newEntity();
        if ($this->request->is('post')) {
            $productCategory = $this->ProductCategories->patchEntity($productCategory, $this->request->data);
            $conn->begin();
			$stmt = $conn->execute(
			'insert into product_categories (name, description) values (?, ?)', 
			[$productCategory['name'], $productCategory['description']]);
			$conn->commit();
			$errcode = $stmt->errorCode();

            if ($errcode) {            
            // orig
            //if ($this->ProductCategories->save($productCategory)) {
                $this->Flash->success('The product category has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The product category could not be saved. Please, try again.');
            }
        }
        $this->set(compact('productCategory'));
        $this->set('_serialize', ['productCategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Product Category id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$conn = ConnectionManager::get('default');
		
		//// orig
        //$productCategory = $this->ProductCategories->get($id, [
        //    'contain' => []
        //]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
			// orig
            //$productCategory = $this->ProductCategories->patchEntity($productCategory, $this->request->data);
			$data = $this->request->data;
			$conn->begin();
			$stmt = $conn->execute(
			'update product_categories set name = coalesce(?, name), description = coalesce(?, description) where id = ?', 
			[$data['name'], $data['description'], $id], ['string', 'string', 'integer']);
			$conn->commit();
			$errcode = $stmt->errorCode();

            if ($errcode) {            
            // orig
            //if ($this->ProductCategories->save($productCategory)) {
                $this->Flash->success('The product category has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The product category could not be saved. Please, try again.');
            }
        }
        $this->set('product_category_id', $id);
        
        //$this->set(compact('productCategory'));
        //$this->set('_serialize', ['productCategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Product Category id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        // orig
        //$productCategory = $this->ProductCategories->get($id);
		$conn = ConnectionManager::get('default');	
		$conn->begin();
		$stmt = $conn->execute(
		'delete from product_categories where id = ?', [$id], ['integer']);
		$conn->commit();
		$errcode = $stmt->errorCode();        
        
        if ($errcode) {        
        // orig
        //if ($this->ProductCategories->delete($productCategory)) {
            $this->Flash->success('The product category has been deleted.');
        } else {
            $this->Flash->error('The product category could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
