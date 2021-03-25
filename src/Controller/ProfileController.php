<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;

/**
 * Profile Controller
 *
 *
 * @method \App\Model\Entity\Profile[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProfileController extends AppController
{

 public function initialize(): void
    {
        parent::initialize();
        $this->Authentication->allowUnauthenticated(['index']);
        // if ($this->shouldBeSecure()) {
        //     $this->Security->setConfig('unlockedActions', [
        //         'getCitiesDropdown', 'getCitiesList'
        //     ]);
        // }
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
    }

    public function view($id)
    {
        
    }

    public function edit($id)
    {
    }
}
