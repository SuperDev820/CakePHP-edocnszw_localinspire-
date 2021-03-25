<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Questions Controller
 *
 * @property \App\Model\Table\QuestionsTable $Questions
 *
 * @method \App\Model\Entity\Question[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class QuestionsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->set('page', "questions");
        // if ($this->shouldBeSecure()) {
        //     $this->Security->setConfig(
        //         'unlockedActions',
        //         ['add', 'toggleStatus']
        //     );
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
}
