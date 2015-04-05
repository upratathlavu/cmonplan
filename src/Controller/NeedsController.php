<?php
namespace App\Controller;

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
        $need = $this->Needs->get($id, [
            'contain' => ['Users', 'Products']
        ]);
        $this->set('need', $need);
        $this->set('_serialize', ['need']);
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
        $this->set('authUser', $this->Auth->user());
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
    
	public function isAuthorized($user)
	{
		// All registered users can add needs
		if ($this->request->action === 'add' || $this->request->action === 'index') {
			return true;
		}

		return parent::isAuthorized($user);
	}	
    
}
