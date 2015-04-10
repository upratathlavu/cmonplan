<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\Database\Connection;

/**
 * Units Controller
 *
 * @property \App\Model\Table\UnitsTable $Units
 */
class UnitsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('units', $this->paginate($this->Units));
        $this->set('_serialize', ['units']);
    }

    /**
     * View method
     *
     * @param string|null $id Unit id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
		//// orig
        //$unit = $this->Units->get($id, [
        //    'contain' => ['Products']
        //]);
        //$this->set('unit', $unit);
        //$this->set('_serialize', ['unit']);

        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(
			'select * 
			from units
			where id = ?', 
			[$id], ['integer']);
        $unit = $stmt->fetch('assoc');
        $this->set('unit', $unit);        
        
        $stmt = $conn->execute(
			'select p.id as id, p.name as name, p.description as description, p.product_category_id as product_category_id, p.unit_id as unit_id, p.creation_date as creation_date 
			from products as p
			join units as u on p.unit_id = u.id
			where u.id = ?', 
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
		
        $unit = $this->Units->newEntity();
        if ($this->request->is('post')) {
            $unit = $this->Units->patchEntity($unit, $this->request->data);
			$stmt = $conn->execute(
			'insert into units (name, abbreviation) values (?, ?)', 
			[$unit['name'], $unit['abbreviation']], ['string', 'string']);
			$errcode = $stmt->errorCode();

            if ($errcode) {
            // orig
            //if ($this->Units->save($unit)) {
                $this->Flash->success('The unit has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The unit could not be saved. Please, try again.');
            }
        }
        $this->set(compact('unit'));
        $this->set('_serialize', ['unit']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Unit id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$conn = ConnectionManager::get('default');
		
		//// orig
        //$unit = $this->Units->get($id, [
        //    'contain' => []
        //]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
			// orig
            //$unit = $this->Units->patchEntity($unit, $this->request->data);
			$data = $this->request->data;
			$stmt = $conn->execute(
			'update units set name = coalesce(?, name), abbreviation = coalesce(?, abbreviation) where id = ?', 
			[$data['name'], $data['abbreviation'], $id], ['string', 'string', 'integer']);
			$errcode = $stmt->errorCode();

            if ($errcode) {            
            // orig
            //if ($this->Units->save($unit)) {
                $this->Flash->success('The unit has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The unit could not be saved. Please, try again.');
            }
        }
        
		$this->set('unit_id', $id);
        
        //// orig
        //$this->set(compact('unit'));
        //$this->set('_serialize', ['unit']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Unit id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        // orig
        //$unit = $this->Units->get($id);
		$conn = ConnectionManager::get('default');	
		$stmt = $conn->execute(
		'delete from units where id = ?', [$id], ['integer']);
		$errcode = $stmt->errorCode();        
        
        if ($errcode) {        
        // orig
        //if ($this->Units->delete($unit)) {
            $this->Flash->success('The unit has been deleted.');
        } else {
            $this->Flash->error('The unit could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
