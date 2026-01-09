<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\Utility\Security;
use App\Service\SchildExportService;
use Cake\Http\Response;
use App\Controller\Traits\IndexContextTrait; //könnte man auch in App-Controller packen
use Cake\Http\Exception\NotFoundException;
/**
 * Antrags Controller
 *
 * @property \App\Model\Table\AntragsTable $Antrags
 */
class AntragsController extends AppController
{
    use IndexContextTrait;
    //zugang ohne login erlauben, Antrag einreichen
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        // Öffentliche Seite
        $this->Authentication->addUnauthenticatedActions(['add','result']);
    }

    /**
     * Add method, diese ist von mir verändert
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->viewBuilder()->setLayout('public');

        $session = $this->request->getSession();
        if (!$session->check('antrag_token')) {
            $session->write('antrag_token', Security::randomString(32));
        }
        $antragToken = $session->read('antrag_token');
        $antrag = $this->fetchTable('Antrags')->newEmptyEntity();
        //wenn folgendes nicht, dann anscheinend Default aus DB
        if (!$this->request->is('post')) {
            $antrag->foerderBedarf = '';
        }
        // Lookup-Daten für das Formular
        $this->set([
            'antrag' => $antrag,
            'antragToken' => $antragToken,
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

    public function print(int $id)
    {
        // Admin: Login erforderlich (keine Ausnahme in beforeFilter!)

        $this->viewBuilder()
            ->setLayout('public')   // identisch zum Public-Result
            ->setTemplate('result'); // exakt dieselbe View

        $antrag = $this->Antrags->get($id, [
            'contain' => [
                'Schulforms',
                'Staats',
                'Konfessions',
                'LastSchulForms',
            ],
        ]);


        $this->set(compact('antrag'));
    }


    //reset download counter

    public function resetDownload(int $id)
    {
        // Nur POST erlauben (kein GET!)
        $this->request->allowMethod(['post']);

        $antrag = $this->Antrags->get($id);
        if (!$antrag) {
            throw new NotFoundException();
        }

        $antrag->downloads = 0;
        $antrag->lastDownload = null;

        $this->Antrags->saveOrFail($antrag);

        $this->Flash->success('Download-Zähler zurückgesetzt.');

        return $this->redirectBackToIndex();
    }


    //folgendes per cake bake generiert, evtl. anpassen
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

        $query = $this->Antrags->find()
            ->contain(['Schulforms', 'LastSchulForms', 'Staats', 'Konfessions']);
        $antrags = $this->paginate($query);

        $this->set(compact('antrags'));
    }

    /**
     * View method
     *
     * @param string|null $id Antrag id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $antrag = $this->Antrags->get($id, contain: ['Schulforms', 'LastSchulForms', 'Staats', 'Konfessions']);
        $this->set(compact('antrag'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Antrag id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $antrag = $this->Antrags->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $antrag = $this->Antrags->patchEntity($antrag, $this->request->getData());
            if ($this->Antrags->save($antrag)) {
                $this->Flash->success(__('The antrag has been saved.'));

                return $this->redirectBackToIndex();
            }
            $this->Flash->error(__('The antrag could not be saved. Please, try again.'));
        }
        $schulforms = $this->Antrags->Schulforms->find('list', limit: 200)->all();
        $lastSchulForms = $this->Antrags->LastSchulForms->find('list', limit: 200)->all();
        $staats = $this->Antrags->Staats->find('list', limit: 200)->all();
        $konfessions = $this->Antrags->Konfessions->find('list', limit: 200)->all();
        $this->set(compact('antrag', 'schulforms', 'lastSchulForms', 'staats', 'konfessions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Antrag id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $antrag = $this->Antrags->get($id);
        if ($this->Antrags->delete($antrag)) {
            $this->Flash->success(__('The antrag has been deleted.'));
        } else {
            $this->Flash->error(__('The antrag could not be deleted. Please, try again.'));
        }

        return  $this->redirectBackToIndex();
    }

    public function export(string $mode): Response
    {
        $this->request->allowMethod(['get']);

        $service = new SchildExportService($this->fetchTable('Antrags'));

        // ZIP bauen (enthält die 4 .dat Dateien in Windows-1252)
        $zipBinary = $service->buildZip($mode);

        // Daten als "gedownloadet" markieren (downloads++, lastDownload=now)
        $service->markDownloaded($mode);

        $filename = $mode === 'new'
            ? 'schild_export_new.zip'
            : 'schild_export_all.zip';

        return $this->response
            ->withType('application/zip')
            ->withHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->withStringBody($zipBinary);
    }

}
