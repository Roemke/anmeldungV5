<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

final class UsersController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        // Login darf ohne Auth aufgerufen werden
        $this->Authentication->addUnauthenticatedActions(['login']);
    }

    public function login()
    {
        $this->request->allowMethod(['get', 'post']);

        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            return $this->redirect('/');
        }

        if ($this->request->is('post')) {
            $this->Flash->error('Login fehlgeschlagen');
        }
    }

    public function logout()
    {
        $this->Authentication->logout();
        return $this->redirect('/login');
    }
}
