<?php
declare(strict_types=1);

namespace App\Controller;

final class DevController extends AppController
{
    public function index()
    {

        $konfessions = $this->fetchTable('Konfessions')
            ->find('forSelect')
            ->toArray();

        debug($konfessions);


        $schulforms = $this->fetchTable('Schulforms')
        ->find('forSelect')
        ->toArray();
        debug($schulforms);

        $lastSchoolForms = $this->fetchTable('LastSchulForms')
        ->find('forSelect')
        ->toArray();

        debug($lastSchoolForms);

        $staats = $this->fetchTable('Staats')
            ->find('forSelect')
            ->toArray();

        debug($staats);

        $antrag = $this->fetchTable('Antrags')->newEmptyEntity();
        debug($antrag->getErrors());
        
        die;
    }
}
