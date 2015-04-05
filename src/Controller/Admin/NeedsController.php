<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

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
		// prerobit
        //$need = $this->Needs->get($id, [
        //    'contain' => ['Users', 'Products']
        //]);
        
        $test = ['id' => '1', 'user_id' => '1', 'product_id' => '2', 'quantity' => '1', 'creation_date' => '2015-04-04T13:05:37+0000', 'product' => ['id' => '2', 'name' => 'jacket', 'description' => '', 'product_category_id' => '1', 'unit_id' => '11', 'creation_date' => '2015-04-04T12:20:06+0000'], 'user' => ['id' => '1', 'username' => 'rado', 'password' => '$2y$10$g2JGZoRS5o1Sdl6AxdSMYe098IxI4zYaFvp1SiI9N58dOUDcSFxwe', 'role_id' => '1', 'creation_date' => '2015-04-03T22:35:47+0000']];
        
        $need = serialize($test);
        //print_r($need);
        $this->set('need', $need);
        $this->set('_serialize', ['need']);
        $this->debug($need);
        //$this->set('need', { "id": 1, "user_id": 1, "product_id": 2, "quantity": 1, "creation_date": "2015-04-04T13:05:37+0000", "product": { "id": 2, "name": "jacket", "description": "", "product_category_id": 1, "unit_id": 11, "creation_date": "2015-04-04T12:20:06+0000" }, "user": { "id": 1, "username": "rado", "password": "$2y$10$g2JGZoRS5o1Sdl6AxdSMYe098IxI4zYaFvp1SiI9N58dOUDcSFxwe", "role_id": 1, "creation_date": "2015-04-03T22:35:47+0000" } });
        //$need = ["id": 1, "user_id": 1, "product_id": 2, "quantity": 1, "creation_date": "2015-04-04T13:05:37+0000", "product": [ "id": 2, "name": "jacket", "description": "", "product_category_id": 1, "unit_id": 11, "creation_date": "2015-04-04T12:20:06+0000" ], "user": [ "id": 1, "username": "rado", "password": "$2y$10$g2JGZoRS5o1Sdl6AxdSMYe098IxI4zYaFvp1SiI9N58dOUDcSFxwe", "role_id": 1, "creation_date": "2015-04-03T22:35:47+0000" ]];
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
