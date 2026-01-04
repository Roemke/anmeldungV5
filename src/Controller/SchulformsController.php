<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Schulforms Controller
 *
 * @property \App\Model\Table\SchulformsTable $Schulforms
 */
class SchulformsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Schulforms->find();
        $schulforms = $this->paginate($query);

        $this->set(compact('schulforms'));
    }

    /**
     * View method
     *
     * @param string|null $id Schulform id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $schulform = $this->Schulforms->get($id, contain: []);
        $this->set(compact('schulform'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $schulform = $this->Schulforms->newEmptyEntity();
        if ($this->request->is('post')) {
            $schulform = $this->Schulforms->patchEntity($schulform, $this->request->getData());
            if ($this->Schulforms->save($schulform)) {
                $this->Flash->success(__('The schulform has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The schulform could not be saved. Please, try again.'));
        }
        $this->set(compact('schulform'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Schulform id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $schulform = $this->Schulforms->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $schulform = $this->Schulforms->patchEntity($schulform, $this->request->getData());
            if ($this->Schulforms->save($schulform)) {
                $this->Flash->success(__('The schulform has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The schulform could not be saved. Please, try again.'));
        }
        $this->set(compact('schulform'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Schulform id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $schulform = $this->Schulforms->get($id);
        if ($this->Schulforms->delete($schulform)) {
            $this->Flash->success(__('The schulform has been deleted.'));
        } else {
            $this->Flash->error(__('The schulform could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
