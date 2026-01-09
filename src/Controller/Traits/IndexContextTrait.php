<?php
declare(strict_types=1);
/*
    In php ein special um eine Klasse gezielt zu erweitern:
    Ein Trait ist:
        keine Klasse
        kein Interface
        nicht instanziierbar
        ein Code-Baustein, der in Klassen eingemischt wird

    Der Code des Traits wird zur Compile-Zeit in die Klasse kopiert.
*/


namespace App\Controller\Traits;
use Cake\Http\Response;
use Cake\Event\EventInterface;

trait IndexContextTrait
{
    /**
     * Erzeugt den "back"-Parameter aus der aktuellen Index-Query
     */
    protected function encodeIndexContext(): string
    {
        return base64_encode(
            http_build_query($this->getRequest()->getQueryParams())
        );
    }

    /**
     * Redirect zurück zur Index-Action unter Wiederherstellung
     * von Sortierung, Paging, Filtern
     */
    protected function redirectBackToIndex(): Response
    {
        $back = $this->getRequest()->getQuery('back');

        if (is_string($back) && $back !== '') {
            parse_str(base64_decode($back), $params);

            return $this->redirect([
                'action' => 'index',
                '?' => $params,
            ]);
        }
        return $this->redirect(['action' => 'index']);
    }

    public function beforeRender(EventInterface $event)
    {
        parent::beforeRender($event);

        // Nur bei index() den back-Parameter setzen
        if ($this->getRequest()->getParam('action') === 'index') {
            $this->set('back', $this->encodeIndexContext());
            //das kann ich dann im template abrufen.
        }
    }
}
