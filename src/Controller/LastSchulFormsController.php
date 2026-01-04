<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * LastSchulForms Controller
 *
 * @property \App\Model\Table\LastSchulFormsTable $LastSchulForms
 */
class LastSchulFormsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->LastSchulForms->find();
        $lastSchulForms = $this->paginate($query);

        $this->set(compact('lastSchulForms'));
    }

    /**
     * View method
     *
     * @param string|null $id Last Schul Form id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lastSchulForm = $this->LastSchulForms->get($id, contain: []);
        $this->set(compact('lastSchulForm'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lastSchulForm = $this->LastSchulForms->newEmptyEntity();
        if ($this->request->is('post')) {
            $lastSchulForm = $this->LastSchulForms->patchEntity($lastSchulForm, $this->request->getData());
            if ($this->LastSchulForms->save($lastSchulForm)) {
                $this->Flash->success(__('The last schul form has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The last schul form could not be saved. Please, try again.'));
        }
        $this->set(compact('lastSchulForm'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Last Schul Form id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lastSchulForm = $this->LastSchulForms->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lastSchulForm = $this->LastSchulForms->patchEntity($lastSchulForm, $this->request->getData());
            if ($this->LastSchulForms->save($lastSchulForm)) {
                $this->Flash->success(__('The last schul form has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The last schul form could not be saved. Please, try again.'));
        }
        $this->set(compact('lastSchulForm'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Last Schul Form id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lastSchulForm = $this->LastSchulForms->get($id);
        if ($this->LastSchulForms->delete($lastSchulForm)) {
            $this->Flash->success(__('The last schul form has been deleted.'));
        } else {
            $this->Flash->error(__('The last schul form could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
