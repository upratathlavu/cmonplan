<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\Database\Connection;
use Cake\Log\Log;

/**
 * Needs Controller
 *
 * @property \App\Model\Table\NeedsTable $Needs
 */
class NeedsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Products']
        ];
        $this->set('needs', $this->paginate($this->Needs));
        $this->set('_serialize', ['needs']);
    }

    /**
     * View method
     *
     * @param string|null $id Need id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
		// orig
        //$need = $this->Needs->get($id, [
        //    'contain' => ['Users', 'Products']
        //]);
        //$this->set('need', $need);
        //$this->set('_serialize', ['need']);
        
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(
			'select n.id n_id, n.creation_date n_creation_date, n.quantity n_quantity, u.id u_id, u.username u_username, p.id p_id, p.name p_name from needs as n 
			join users as u on n.user_id = u.id 
			join products p on n.product_id = p.id 
			where u.id = ?', 
			[$id], ['integer']);
        $need = $stmt->fetch('assoc');
        $this->set('need', $need);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$conn = ConnectionManager::get('default');

        $need = $this->Needs->newEntity();
        if ($this->request->is('post')) {
            $need = $this->Needs->patchEntity($need, $this->request->data);
			$stmt = $conn->execute(
			'insert into needs (user_id, product_id, quantity) values (?, ?, ?)', 
			[$need['user_id'], $need['product_id'], $need['quantity']], ['integer', 'integer', 'integer']);
			$errcode = $stmt->errorCode();

            if ($errcode) {
            // orig
            //if ($this->Needs->save($need)) {				
                $this->Flash->success('The need has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The need could not be saved. Please, try again.');
            }
        }
        $stmt = $conn->execute('select id, username from users');
        $tmpusers = $stmt->fetchAll('assoc');
        $stmt = $conn->execute('select id, name from products');
        $tmpproducts = $stmt->fetchAll('assoc');
        $users = array();
        foreach($tmpusers as $tmpuser) {
			$users += array($tmpuser['id'] => $tmpuser['username']);
		}
		$products = array();
        foreach($tmpproducts as $tmpproduct) {
			$products += array($tmpproduct['id'] => $tmpproduct['name']);
		}
        $this->set('users', $users);
        $this->set('products', $products);
        // orig
        //$users = $this->Needs->Users->find('list', ['limit' => 200]);
        //$products = $this->Needs->Products->find('list', ['limit' => 200]);
		//$this->set(compact('need', 'users', 'products'));
        $this->set(compact('need'));
        $this->set('_serialize', ['need']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Need id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$conn = ConnectionManager::get('default');
		
		//// orig
        //$need = $this->Needs->get($id, [
        //    'contain' => []
        //]);     
        
        if ($this->request->is(['patch', 'post', 'put'])) {
			// orig
            //$need = $this->Needs->patchEntity($need, $this->request->data);

			$data = $this->request->data;
			$stmt = $conn->execute(
			'update needs set (user_id, product_id, quantity) = (?, ?, ?) where id = ?', 
			[$data['user_id'], $data['product_id'], $data['quantity'], $id], ['integer', 'integer', 'integer', 'integer']);
			$errcode = $stmt->errorCode();

            if ($errcode) {
			// orig			
            //if ($this->Needs->save($need)) {
                $this->Flash->success('The need has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The need could not be saved. Please, try again.');
            }
        }
        // prerobit
		$this->set('need_id', $id);
        $users = $this->Needs->Users->find('list', ['limit' => 200]);
        $products = $this->Needs->Products->find('list', ['limit' => 200]);
        $this->set(compact('need', 'users', 'products'));
        $this->set('_serialize', ['need']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Need id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        // prerobit
        $need = $this->Needs->get($id);
        // prerobit?
        if ($this->Needs->delete($need)) {
            $this->Flash->success('The need has been deleted.');
        } else {
            $this->Flash->error('The need could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
