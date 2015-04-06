<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Roles Controller
 *
 * @property \App\Model\Table\RolesTable $Roles
 */
class RolesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('roles', $this->paginate($this->Roles));
        $this->set('_serialize', ['roles']);
    }

    /**
     * View method
     *
     * @param string|null $id Role id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
		//// orig
        //$role = $this->Roles->get($id, [
        //    'contain' => ['Users']
        //]);
        //$this->set('role', $role);
        //$this->set('_serialize', ['role']);
        
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(
			' select r.name r_name, r.description r_description, r.id r_id, r.creation_date r_creation_date  from roles r 
			join users u on r.id = u.role_id
			where r.id = ?', 
			[$id], ['integer']);
        $role = $stmt->fetch('assoc');
        $this->set('role', $role); 
		$stmt = $conn->execute(
			'select u.id u_id, u.description u_description, u.role_id p_role_id, u.creation_date u_creation_date from users u
			join roles r on u.role_id = r.id 
			where r.id = ?', 
			[$id], ['integer']);
        $users = $stmt->fetch('assoc');        
        $this->set('users', $users); 
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $role = $this->Roles->newEntity();
        if ($this->request->is('post')) {
			// prerobit?
            $role = $this->Roles->patchEntity($role, $this->request->data);
            // prerobit?
            if ($this->Roles->save($role)) {
                $this->Flash->success('The role has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The role could not be saved. Please, try again.');
            }
        }
        $this->set(compact('role'));
        $this->set('_serialize', ['role']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Role id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		// prerobit
        $role = $this->Roles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
			// prerobit?
            $role = $this->Roles->patchEntity($role, $this->request->data);
            // prerobit?
            if ($this->Roles->save($role)) {
                $this->Flash->success('The role has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The role could not be saved. Please, try again.');
            }
        }
        $this->set(compact('role'));
        $this->set('_serialize', ['role']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Role id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        // prerobit
        $role = $this->Roles->get($id);
        // prerobit?
        if ($this->Roles->delete($role)) {
            $this->Flash->success('The role has been deleted.');
        } else {
            $this->Flash->error('The role could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
