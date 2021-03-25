<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Reviews Controller
 *
 *
 * @method \App\Model\Entity\Review[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReviewsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->set('page', "reviews");
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
