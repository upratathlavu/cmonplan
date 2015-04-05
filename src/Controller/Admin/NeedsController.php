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
        $stmt->execute();
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
        $need = $this->Needs->newEntity();
        if ($this->request->is('post')) {
			// prerobit?
            //$need = $this->Needs->patchEntity($need, $this->request->data);
            $this->log($need['user_id'], 'debug');
            $this->log($need['product_id'], 'debug');
            $this->log($need['quantity'], 'debug');
            $this->log($need['creation_date'], 'debug');
            $this->log($need['user'], 'debug');
            $this->log($need['product'], 'debug');
			$conn = ConnectionManager::get('default');
			$stmt = $conn->execute(
			'insert into needs (user_id, product_id, quantity) values (?, ?, ?)', 
			[$need['user_id'], $need['product_id'], $need['quantity']], ['integer', 'integer', 'integer']);
			$ret = $stmt->execute();            
			$this->log($ret, 'debug');
            // prerobit?
            if ($this->Needs->save($need)) {
                $this->Flash->success('The need has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The need could not be saved. Please, try again.');
            }
        }
        // prerobit
        $users = $this->Needs->Users->find('list', ['limit' => 200]);
        $products = $this->Needs->Products->find('list', ['limit' => 200]);
        $this->set(compact('need', 'users', 'products'));
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
		// prerobit
        $need = $this->Needs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
			// prerobit?
            $need = $this->Needs->patchEntity($need, $this->request->data);
            // prerobit?
            if ($this->Needs->save($need)) {
                $this->Flash->success('The need has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The need could not be saved. Please, try again.');
            }
        }
        // prerobit
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
