<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\Utility\Security;

final class AntragsController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        // Öffentliche Seite
        $this->Authentication->addUnauthenticatedActions(['add','result']);
    }

    public function add()
    {
        $this->viewBuilder()->setLayout('public');

        $session = $this->request->getSession();
        if (!$session->check('antrag_token')) {
            $session->write('antrag_token', Security::randomString(32));
        }

        $antrag = $this->fetchTable('Antrags')->newEmptyEntity();
        // Lookup-Daten für das Formular
        $this->set([
            'antrag' => $antrag,
            'schulforms' => $this->fetchTable('Schulforms')->find('forSelect'),
            'lastSchoolForms' => $this->fetchTable('LastSchulForms')->find('forSelect'),
            'konfessions' => $this->fetchTable('Konfessions')->find('forSelect'),
            'staats' => $this->fetchTable('Staats')->find('forSelect'),
        ]);


        if ($this->request->is('post')) {
            // Token prüfen
            $session = $this->request->getSession();
            $postedToken = $this->request->getData('antrag_token');

            if ($postedToken !== $session->read('antrag_token')) {
            // ungültig oder doppelt abgeschickt
                return $this->redirect(['action' => 'add']);
            }
            $antrag = $this->fetchTable('Antrags')
                ->patchEntity($antrag, $this->request->getData());
            if ($this->fetchTable('Antrags')->save($antrag)) {
                // Token ENTWERTEN
                $session->delete('antrag_token');

                return $this->redirect([
                    'action' => 'result',
                    $antrag->id,
                ]);
            }
        }


    }

    //ergenisanzeige nach Antragstellung
    public function result(int $id)
    {
        $this->viewBuilder()->setLayout('public');

        $antrag = $this->fetchTable('Antrags')->get($id, [
            'contain' => [
                'Schulforms',
                'Staats',
                'Konfessions',
                'LastSchulForms',
            ],
        ]);

        $this->set(compact('antrag'));
    }

    //und die methoden, erstmal leer, um mit bin/cake bake template Antrags arbeiten zu können
    public function index()
    {
        $this->viewBuilder()->setLayout('default');

        $query = $this->fetchTable('Antrags')
            ->find()
            ->contain(['Schulforms', 'Staats'])
            ->orderByDesc('Antrags.created');

        $this->set([
            'antrags' => $query->all(),
        ]);
    }


    public function view(int $id)
    {
        // Admin-Detail
    }

    public function edit(int $id)
    {
        // Admin-Edit
    }

    public function delete(int $id)
    {
        // Admin-Delete
    }

}
