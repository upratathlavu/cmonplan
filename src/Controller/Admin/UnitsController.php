<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

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
		// prerobit
        $unit = $this->Units->get($id, [
            'contain' => ['Products']
        ]);
        $this->set('unit', $unit);
        $this->set('_serialize', ['unit']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $unit = $this->Units->newEntity();
        if ($this->request->is('post')) {
			// prerobit?
            $unit = $this->Units->patchEntity($unit, $this->request->data);
            // prerobit?
            if ($this->Units->save($unit)) {
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
		// prerobit
        $unit = $this->Units->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
			// prerobit?
            $unit = $this->Units->patchEntity($unit, $this->request->data);
            // prerobit?
            if ($this->Units->save($unit)) {
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
     * Delete method
     *
     * @param string|null $id Unit id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        // prerobit
        $unit = $this->Units->get($id);
        // prerobit?
        if ($this->Units->delete($unit)) {
            $this->Flash->success('The unit has been deleted.');
        } else {
            $this->Flash->error('The unit could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
