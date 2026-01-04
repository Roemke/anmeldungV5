<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Konfessions Controller
 *
 * @property \App\Model\Table\KonfessionsTable $Konfessions
 */
class KonfessionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Konfessions->find();
        $konfessions = $this->paginate($query);

        $this->set(compact('konfessions'));
    }

    /**
     * View method
     *
     * @param string|null $id Konfession id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $konfession = $this->Konfessions->get($id, contain: []);
        $this->set(compact('konfession'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $konfession = $this->Konfessions->newEmptyEntity();
        if ($this->request->is('post')) {
            $konfession = $this->Konfessions->patchEntity($konfession, $this->request->getData());
            if ($this->Konfessions->save($konfession)) {
                $this->Flash->success(__('The konfession has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The konfession could not be saved. Please, try again.'));
        }
        $this->set(compact('konfession'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Konfession id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $konfession = $this->Konfessions->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $konfession = $this->Konfessions->patchEntity($konfession, $this->request->getData());
            if ($this->Konfessions->save($konfession)) {
                $this->Flash->success(__('The konfession has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The konfession could not be saved. Please, try again.'));
        }
        $this->set(compact('konfession'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Konfession id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $konfession = $this->Konfessions->get($id);
        if ($this->Konfessions->delete($konfession)) {
            $this->Flash->success(__('The konfession has been deleted.'));
        } else {
            $this->Flash->error(__('The konfession could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
