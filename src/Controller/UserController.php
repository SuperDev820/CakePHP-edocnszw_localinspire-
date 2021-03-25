<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * User Controller
 *
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UserController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
        $this->Authentication->allowUnauthenticated([
            'join', 'reviews', 'index', 'businessPhotos', 'collections',
            'collectionView', 'Followers', 'Following'
        ]);
        // if ($this->shouldBeSecure()) {
        //     $this->Security->setConfig('unlockedActions', [
        //         'getCitiesDropdown', 'getCitiesList'
        //     ]);
        // }
    }

    public function join($username)
    {
        if (!empty($this->Authentication->getIdentity())) {
            return $this->redirect(['prefix' => false, 'controller' => 'account', 'action' => 'index']);
        }
        $user = $this->Custom->getUser(null,  $username);
        $this->userStarters($user);
    }

    private function userStarters($user)
    {

        $viewerIsBlocked = !empty($this->Authentication->getIdentity()) ? $this->Custom->viewerIsBlocked($this->Authentication->getIdentity()->getIdentifier(),  $user->id) : false;

        $followsUser =  !empty($this->Authentication->getIdentity()) ?  $this->Custom->followsUser($this->Authentication->getIdentity()->getIdentifier(), $user->id) : false;
        $followedByUser =  !empty($this->Authentication->getIdentity()) ? $this->Custom->followedByUser($this->Authentication->getIdentity()->getIdentifier(), $user->id) : false;
        $blockedUser =  !empty($this->Authentication->getIdentity()) ?  $this->Custom->blockedUser($this->Authentication->getIdentity()->getIdentifier(), $user->id) : false;
        $userBlockedMe = !empty($this->Authentication->getIdentity()) ?  $this->Custom->userBlockedMe($this->Authentication->getIdentity()->getIdentifier(), $user->id) : false;

        $followers = $this->Custom->getFollowers($user->id)->limit(5)->toArray();


        $this->set(compact('user', 'followsUser', 'followedByUser', 'blockedUser', 'userBlockedMe', 'followers'));
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index($username)
    {
        $user = $this->Custom->getUser(null,  $username);
        $this->userStarters($user);

        $this->Custom->getUserActivitiesLogic($user->id);

        if ($this->request->is('ajax')) {
            $this->render('endless_scroll_container');
        }


        // $feeds = array_merge($user->questions, $user->business_reviews, $user->business_photos);
        // $feeds = \Cake\Utility\Hash::sort($feeds, '{n}.created', 'DESC');
        // dd($feeds);

    }


    public function reviews($username)
    {
        $user = $this->Custom->getUser(null,  $username);
        $this->userStarters($user);

        $this->Custom->getUserActivitiesLogic($user->id, true);

        if ($this->request->is('ajax')) {
            $this->render('endless_scroll_container');
        }
    }
    public function businessPhotos($username)
    {
        $user = $this->Custom->getUser(null,  $username);
        $this->userStarters($user);

        $this->Custom->getUserActivitiesLogic($user->id, false, true);

        if ($this->request->is('ajax')) {
            $this->render('endless_scroll_container');
        }
    }
    public function collections($username)
    {
        $user = $this->Custom->getUser(null,  $username);
        $this->userStarters($user);

        $this->Custom->getUserCollectionsLogic($user->id, true);
    }

    public function collectionView($username, $id)
    {
        $user = $this->Custom->getUser(null,  $username);
        $this->set('user', $user);

        $this->userStarters($user);

        $collection = $this->Custom->getUserCollections($user->id, $id)->first();
        $this->set('collection', $collection);

        $loggedInUserCollections = $this->Custom->getUserCollections($this->Authentication->getIdentity()->getIdentifier());
        $this->set('loggedInUserCollections', $loggedInUserCollections);
    }

    public function following($username)
    {
        $user = $this->Custom->getUser(null,  $username);
        $this->set('user', $user);

        $this->userStarters($user);

        $this->Custom->followersLogic($user->id, true);

        $this->set('show_following', true);

        if ($this->request->is('ajax')) {
            $this->render('followers_container');
        }
    }


    public function followers($username)
    {
        $user = $this->Custom->getUser(null,  $username);
        $this->set('user', $user);

        $this->userStarters($user);

        $this->Custom->followersLogic($user->id);
        $this->set('show_following', false);

        if ($this->request->is('ajax')) {
            $this->render('followers_container');
        }
    }
}
