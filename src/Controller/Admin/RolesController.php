<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\Database\Connection;

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
        $this->paginate = [
			'limit' => 15,
			'order' => [
				'Roles.id' => 'asc'
			]
        ];			
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
			'select *
			from roles
			where id = ?', 
			[$id], ['integer']);
        $role = $stmt->fetch('assoc');
        $this->set('role', $role); 
        
		$stmt = $conn->execute(
			// TODO: PREPISAT S POUZITIM NAME NAMIESTO ID		
			'select u.id as u_id, u.username as u_username, u.role_id as u_role_id, u.creation_date as u_creation_date 
			from users as u
			join roles as r on u.role_id = r.id 
			where r.id = ?', 
			[$id], ['integer']);
        $users = $stmt->fetchAll('assoc');        
        $this->set('users', $users); 
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$conn = ConnectionManager::get('default');
		
        $role = $this->Roles->newEntity();
        if ($this->request->is('post')) {
            $role = $this->Roles->patchEntity($role, $this->request->data);
            $conn->begin();
			$stmt = $conn->execute(
			'insert into roles (name, description) values (?, ?)', 
			[$role['name'], $role['description']], ['string', 'string']);
			$conn->commit();
			$errcode = $stmt->errorCode();

            if ($errcode) {            
            // orig
            //if ($this->Roles->save($role)) {
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
		$conn = ConnectionManager::get('default');
		
		//// orig
        //$role = $this->Roles->get($id, [
        //    'contain' => []
        //]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
			// orig
            //$role = $this->Roles->patchEntity($role, $this->request->data);
			$data = $this->request->data;
			$conn->begin();
			$stmt = $conn->execute(
			'update roles set name = coalesce(?, name), description = coalesce(?, description) where id = ?', 
			[$data['name'], $data['description'], $id], ['string', 'string', 'integer']);
			$conn->commit();
			$errcode = $stmt->errorCode();

            if ($errcode) {            
            // orig
            //if ($this->Roles->save($role)) {
                $this->Flash->success('The role has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The role could not be saved. Please, try again.');
            }
        }
		$this->set('role_id', $id);        
        
        //// orig
        //$this->set(compact('role'));
        //$this->set('_serialize', ['role']);
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
        // orig
        //$role = $this->Roles->get($id);
		$conn = ConnectionManager::get('default');	
		$conn->begin();
		$stmt = $conn->execute(
		'delete from roles where id = ?', [$id], ['integer']);
		$conn->commit();
		$errcode = $stmt->errorCode();        
        
        if ($errcode) {        
        // orig
        //if ($this->Roles->delete($role)) {
            $this->Flash->success('The role has been deleted.');
        } else {
            $this->Flash->error('The role could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
