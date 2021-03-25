<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;

/**
 * Stories Controller
 *
 *
 * @method \App\Model\Entity\Story[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StoriesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->Authentication->allowUnauthenticated(['index', 'view']);
        $this->set('page', "stories");
        // if ($this->shouldBeSecure()) {
        //     $this->Security->setConfig('unlockedActions', [
        //         'index'
        //     ]);
        // }
        // if ($this->shouldBeSecure()) {
        //     $this->Security->setConfig('unlockedActions', [
        //         'add', 'edit', 'addReview', 'addPhotos', 'editReview', 'claimSuccess'
        //     ]);
        // }
        // if (!empty($this->currentUser->active_city)) {
        //     $active_city =  $this->Custom->getCity($this->currentUser->active_city);
        //     $this->set('active_city', $active_city);
        // }
        // $userCitiesList = $this->Access->userCities("list");
        // $this->set("userCitiesList", $userCitiesList);
    }

    public function index($tagslug = null)
    {

        $city = $this->Custom->getCityByOptions($this->currentUser, $this->request->getQuery());
        if (!empty($city)) {
            $this->set('city', $city);

            $this->set('latest_posts', $this->Custom->getLatestPosts($city->id));
            $this->set('city_tags', $this->Custom->getTags($city->id));



            $this->Custom->getPostsLogic($tagslug, $city->id);
        }


        $view_tag = null;
        if (!empty($tagslug)) {
            $view_tag  = $this->table('Tags')->find()
                ->where(['slug' => $tagslug])->first();
        }
        $this->set('view_tag', $view_tag);
    }

    public function view($id = null)
    {
        $post = $this->Custom->getPost(null, $id)->first();
        $this->set('post', $post);

        $this->set('latest_posts', $this->Custom->getLatestPosts($post->city_id, 4));
        $this->set('city_tags', $this->Custom->getTags($post->city_id));

        // dd($post);
    }
}
