<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;
use Cake\Database\Connection;


/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Roles']
        ];
        $this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
		//// prerobit
        //$user = $this->Users->get($id, [
        //    'contain' => ['Roles', 'Needs']
        //]);
        //$this->set('user', $user);
        //$this->set('_serialize', ['user']);
        
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(
			'select * from users
			where id = ?', 
			[$id], ['integer']);
        $user = $stmt->fetch('assoc');
        $this->set('user', $user);     
        
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(
			'select n.id as u_id, n.user_id as user_id, n.product_id as product_id, n.quantity as quantity, r.id as r_id, r.name as r_name 
			from needs as n
			join users as u on n.user_id = u.id
			join roles as r on u.role_id = r.id
			where n.id = ?', 
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
		
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
			$stmt = $conn->execute(
			'insert into users (username, password, role_id) values (?, ?, ?)', 
			[$user['username'], $user['password'], $user['role_id']], ['string', 'string', 'integer']);
			$errcode = $stmt->errorCode();

            if ($errcode) {
            // orig
            //if ($this->Users->save($user)) {
                $this->Flash->success('The user has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }
        $stmt = $conn->execute('select id, name from roles');
        $tmproles = $stmt->fetchAll('assoc');
        $roles = array();
        foreach($tmproles as $tmprole) {
			$roles += array($tmprole['id'] => $tmprole['name']);
		}
        $this->set('roles', $roles);
        // orig
        //$roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		// prerobit
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
			// prerobit?
            $user = $this->Users->patchEntity($user, $this->request->data);
            // prerobit?
            if ($this->Users->save($user)) {
                $this->Flash->success('The user has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }
        // prerobit
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        // prerobit
        $user = $this->Users->get($id);
        // prerobit?
        if ($this->Users->delete($user)) {
            $this->Flash->success('The user has been deleted.');
        } else {
            $this->Flash->error('The user could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
    
	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		// Allow users to register and logout.
		// You should not add the "login" action to allow list. Doing so would
		// cause problems with normal functioning of AuthComponent.
		$this->Auth->allow(['logout']);
	}

	public function login()
	{
		if ($this->request->is('post')) {
			$user = $this->Auth->identify();
			if ($user) {
				$this->Auth->setUser($user);
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Flash->error(__('Invalid username or password, try again'));
		}
	}

	public function logout()
	{
		return $this->redirect($this->Auth->logout());
	}       
}
