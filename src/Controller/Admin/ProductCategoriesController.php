<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ProductCategories Controller
 *
 * @property \App\Model\Table\ProductCategoriesTable $ProductCategories
 */
class ProductCategoriesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('productCategories', $this->paginate($this->ProductCategories));
        $this->set('_serialize', ['productCategories']);
    }

    /**
     * View method
     *
     * @param string|null $id Product Category id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $productCategory = $this->ProductCategories->get($id, [
            'contain' => ['Products']
        ]);
        $this->set('productCategory', $productCategory);
        $this->set('_serialize', ['productCategory']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $productCategory = $this->ProductCategories->newEntity();
        if ($this->request->is('post')) {
            $productCategory = $this->ProductCategories->patchEntity($productCategory, $this->request->data);
            if ($this->ProductCategories->save($productCategory)) {
                $this->Flash->success('The product category has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The product category could not be saved. Please, try again.');
            }
        }
        $this->set(compact('productCategory'));
        $this->set('_serialize', ['productCategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Product Category id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $productCategory = $this->ProductCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $productCategory = $this->ProductCategories->patchEntity($productCategory, $this->request->data);
            if ($this->ProductCategories->save($productCategory)) {
                $this->Flash->success('The product category has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The product category could not be saved. Please, try again.');
            }
        }
        $this->set(compact('productCategory'));
        $this->set('_serialize', ['productCategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Product Category id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $productCategory = $this->ProductCategories->get($id);
        if ($this->ProductCategories->delete($productCategory)) {
            $this->Flash->success('The product category has been deleted.');
        } else {
            $this->Flash->error('The product category could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
