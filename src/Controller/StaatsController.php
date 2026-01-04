<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Staats Controller
 *
 * @property \App\Model\Table\StaatsTable $Staats
 */
class StaatsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Staats->find();
        $staats = $this->paginate($query);

        $this->set(compact('staats'));
    }

    /**
     * View method
     *
     * @param string|null $id Staat id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $staat = $this->Staats->get($id, contain: []);
        $this->set(compact('staat'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $staat = $this->Staats->newEmptyEntity();
        if ($this->request->is('post')) {
            $staat = $this->Staats->patchEntity($staat, $this->request->getData());
            if ($this->Staats->save($staat)) {
                $this->Flash->success(__('The staat has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The staat could not be saved. Please, try again.'));
        }
        $this->set(compact('staat'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Staat id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $staat = $this->Staats->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $staat = $this->Staats->patchEntity($staat, $this->request->getData());
            if ($this->Staats->save($staat)) {
                $this->Flash->success(__('The staat has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The staat could not be saved. Please, try again.'));
        }
        $this->set(compact('staat'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Staat id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $staat = $this->Staats->get($id);
        if ($this->Staats->delete($staat)) {
            $this->Flash->success(__('The staat has been deleted.'));
        } else {
            $this->Flash->error(__('The staat could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
