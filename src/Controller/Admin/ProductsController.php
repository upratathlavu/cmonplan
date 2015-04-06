<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\Database\Connection;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 */
class ProductsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ProductCategories', 'Units']
        ];
        $this->set('products', $this->paginate($this->Products));
        $this->set('_serialize', ['products']);
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
		// orig
        //$product = $this->Products->get($id, [
        //    'contain' => ['ProductCategories', 'Units', 'Needs']
        //]);
        //$this->set('product', $product);
        //$this->set('_serialize', ['product']);
        
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(
			'select p.name p_name, p.description p_description, pc.name pc_name, u.name u_name, p.id p_id, pc.id pc_id, u.id u_id, p.creation_date p_creation_date from products p 
			join product_categories pc on p.product_category_id = pc.id 
			join units u on p.unit_id = u.id 
			where p.id = ?', 
			[$id], ['integer']);
        $product = $stmt->fetch('assoc');
        $this->set('product', $product);
        
        $stmt = $conn->execute(
			'select * from needs', 
			[$id], ['integer']);
        $needs = $stmt->fetch('assoc');
        $this->set('needs', $needs);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$conn = ConnectionManager::get('default');

        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->data);
			$stmt = $conn->execute(
			'insert into products (name, description, poduct_category_id, unit_id) values (?, ?, ?, ?)', 
			[$product['name'], $product['description'], $product['product_category_id'], $product['unit_id']], ['string', 'string', 'integer', 'integer']);
			$errcode = $stmt->errorCode();

            if ($errcode) {        			
            // orig
            //if ($this->Products->save($product)) {
                $this->Flash->success('The product has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The product could not be saved. Please, try again.');
            }
        }
        $stmt = $conn->execute('select id, name from product_categories');
        $tmpproductCategories = $stmt->fetchAll('assoc');
        $stmt = $conn->execute('select id, name from units');
        $tmpunits = $stmt->fetchAll('assoc');
        $productCategories = array();
        foreach($tmpproductCategories as $tmpproductCategory) {
			$productCategories += array($tmpproductCategory['id'] => $tmpproductCategory['name']);
		}
		$units = array();
        foreach($tmpunits as $tmpunit) {
			$units += array($tmpunit['id'] => $tmpunit['name']);
		}
        $this->set('productCategories', $productCategories);
        $this->set('units', $units);        
        // orig
        //$productCategories = $this->Products->ProductCategories->find('list', ['limit' => 200]);
        //$units = $this->Products->Units->find('list', ['limit' => 200]);
        //$this->set(compact('product', 'productCategories', 'units'));
        //$this->set('_serialize', ['product']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		// prerobit
        $product = $this->Products->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
			// prerobit?
            $product = $this->Products->patchEntity($product, $this->request->data);
            // prerobit?
            if ($this->Products->save($product)) {
                $this->Flash->success('The product has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The product could not be saved. Please, try again.');
            }
        }
        // prerobit
        $productCategories = $this->Products->ProductCategories->find('list', ['limit' => 200]);
        $units = $this->Products->Units->find('list', ['limit' => 200]);
        $this->set(compact('product', 'productCategories', 'units'));
        $this->set('_serialize', ['product']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        // prerobit
        $product = $this->Products->get($id);
        // prerobit
        if ($this->Products->delete($product)) {
            $this->Flash->success('The product has been deleted.');
        } else {
            $this->Flash->error('The product could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
