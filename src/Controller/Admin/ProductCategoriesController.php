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
			'select * from product_categories
			where u.id = ?', 
			[$id], ['integer']);
        $productCategory = $stmt->fetch('assoc');
        $stmt = $conn->execute(
			'select p.id p_id, p.description p_description, p.product_category_id p_product_category_id, p.unit_id p_udnit_id, p.creation_date p_creation_date from products p 
			join product_categories pc on p.product_category_id = pc.id 
			where pc.id = ?', 
			[$id], ['integer']);
        $products = $stmt->fetch('assoc');        
        $this->set('products', $products);        
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $productCategory = $this->ProductCategories->newEntity();
        if ($this->request->is('post')) {
			// prerobit?
            $productCategory = $this->ProductCategories->patchEntity($productCategory, $this->request->data);
            // prerobit?
            if ($this->ProductCategories->save($productCategory)) {
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
		// prerobit
        $productCategory = $this->ProductCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
			// prerobit?
            $productCategory = $this->ProductCategories->patchEntity($productCategory, $this->request->data);
            // prerobit?
            if ($this->ProductCategories->save($productCategory)) {
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
     * Delete method
     *
     * @param string|null $id Product Category id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        // prerobit
        $productCategory = $this->ProductCategories->get($id);
        // prerobit?
        if ($this->ProductCategories->delete($productCategory)) {
            $this->Flash->success('The product category has been deleted.');
        } else {
            $this->Flash->error('The product category could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
