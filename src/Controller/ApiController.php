<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Api Controller
 *
 * @method \App\Model\Entity\Api[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApiController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        // $this->loadComponent('Security');
        $this->Authentication->allowUnauthenticated($this->unockedActions());
    }

    // public function beforeFilter(\Cake\Event\EventInterface $event)
    // {
    //     parent::beforeFilter($event);

    //     $this->Security->setConfig('unlockedActions', $this->unockedActions());
    // }

    private function unockedActions()
    {
        return [
            'getCitiesDropdown', 'getCitiesList', 'getCitiesSelect', 'searchKeywordList', 'userLogin', 'userRegister', 'getFilters', 'getSubcategoriesDropdown', 'updateUserData', 'userImageAjaxUpload', 'getCollections', 'reportReview', 'reportOwnerReply', 'unfollowUser', 'followUser', 'blockUser', 'unblockUser', 'reportProfile', 'sendUserMessage', 'saveCollection', 'uploadPhotos', 'uploadReviewPhotos', 'reportPhoto', 'helpfulPhoto', 'addReviews', 'removeBusiness', 'sendConfirmationEmail', 'getBusinessReviews', 'replyReview', 'helpfulReview', 'postQuestion', 'getQuestions', 'saveBusinessToCollection', 'helpfulAnswer', 'reportQuestion', 'submitAnswer', 'reportAnswer', 'updateSocialOptions', 'getBlockUnblockBox', 'updateNotificationOptions', 'deletePhoto', 'viewedNotification', 'markAllAsRead', 'getSubcatsJson', 'addSubcategory', 'getUsers', 'getCurrentUser', 'saveShare', 'setPrimary', 'setSlide', 'removeSlide', 'getOfferIcon', 'subscribe', 'confirmSubscription', 'showReviewPreview', 'showBizPreview', 'saveFeaturedAd', 'cancelSubscription', 'removeRestriction', 'restrictAccess', 'getSic4categories', 'getSic8categories', 'calculateCityPrices', 'getTagsJson', 'addTag', 'messagelistener', 'notificationslistener', 'logout'

        ];
    }

    public function addTag()
    {

        $this->request->allowMethod('ajax');
        $response = [
            "success" => false,
            "message" => 'Oops! Something went wrong. Please try again later'
        ];
        // dd($this->request->getData());
        if (!empty($this->request->getData()['name'])) {
            $tag = $this->table('Tags')->find()->where([
                'name' => $this->request->getData()['name'], 'city_id' => $this->currentUser->active_city
            ])->first();
            if (empty($tag)) {
                $tag = $this->table('Tags')->newEmptyEntity();
                $tag = $this->table('Tags')->patchEntity($tag, $this->request->getData());
                $tag->city_id = $this->currentUser->active_city;
                $sluggedTitle = \Cake\Utility\Text::slug(strtolower($tag->name));
                // trim slug to maximum length defined in schema
                $tag->slug = substr($sluggedTitle, 0, 255);
            }
            if ($this->table('Tags')->save($tag)) {
                $response['success'] = true;
                $response['message'] = "Done";
                $response['tag'] = $tag;
            }
        }

        $this->Custom->jsonResponse($response);
    }
    public function getTagsJson()
    {

        $this->request->allowMethod('ajax');
        $response = [
            "success" => true,
        ];

        // debug($this->request->getQuery());
        // dd($this->request->getAttribute('params'));

        $query = $this->table('Tags')->find()->where(['city_id' => $this->currentUser->active_city]);

        if (!empty($this->request->getQuery()['q'])) {

            $search_term = $this->Custom->escapeString($this->request->getQuery()['q']);

            $query->where([
                'OR' => [
                    ['Tags.name LIKE' => "%" . $search_term . "%"],
                ],
            ]);
        }

        $data = $query->toArray();

        // dd($query);

        $query_data = [];
        if (!empty($data)) {
            foreach ($data as $value) {
                $query_data[] = [
                    'id' => $value['id'],
                    'name' => $value['name'],
                ];
            }
        }

        // dd($user_data);

        $response['data'] = $query_data;
        $response['total_count'] = count($data);

        $this->Custom->jsonResponse($response);
    }

    public function calculateCityPrices()
    {
        $this->request->allowMethod('ajax');
        $response = ["success" => false];


        // dd($this->request->getData());
        if (!empty($this->request->getData()['selections'])) {
            $options = $this->Custom->getOptions();
            $cities_ids = json_decode($this->request->getData()['selections'], true);
            $city_id = $this->request->getData()['city_id'];
            // $city = $this->Custom->getCity($city_id);
            if (!in_array($city_id, $cities_ids)) {
                $cities_ids[] = $city_id;
            }
            $citiesQuery = $this->Custom->citiesQuery()->where(['Cities.id IN' => $cities_ids]);
            $cities =  $citiesQuery->toArray();
            $full_price =  $citiesQuery->sumOf('price');
            $price =  $this->Custom->getPercentage($full_price, $options->city_discount);
            $savings =  ($full_price - $price);

            $checkout = (!empty($this->request->getData()['checkout']) and $this->request->getData()['checkout'] == "true" and $this->request->getData()['checkout'] != "false") ? true : false;

            $response['full_price'] = number_format($full_price, 2);
            $response['price'] = number_format($price, 2);
            $response['price_unformated'] = round($price, 2);
            $response['savings'] = number_format($savings, 2);

            if (!empty($this->Authentication->getIdentity()) and $checkout) {
                $response['stripe'] = $this->Access->citySubscribeAjax($this->Authentication->getIdentity()->getIdentifier(), $cities, $price, $savings);
            }

            $response['success'] = true;
            $response['isBusinessOwner'] = $this->isBusinessOwner;
        }
        $this->Custom->jsonResponse($response);
    }
    public function saveFeaturedAd()
    {
        $this->request->allowMethod('ajax');
        $response = ["success" => false];
        if (!empty($this->request->getData()['business_id'])) {
            $business = $this->Custom->getBusiness($this->request->getData()['business_id']);
            if (isset($this->request->getData()['description']) and !empty($this->request->getData()['description'])) {
                $business->description = $this->request->getData()['description'];
                if ($this->table('Businesses')->save($business)) {
                    // $response['success'] = true;
                }
            }
            $ad = $this->Custom->getFeaturedAd($business->id)->first();
            if (empty($ad)) {
                $ad =  $this->table('FeaturedAds')->newEmptyEntity();
            }
            $ad->business_id = $business->id;
            $ad->business_review_id = (!empty($this->request->getData()['selectedreview']) and ($this->request->getData()['selectedreview'] != "false")) ? $this->request->getData()['selectedreview'] : null;
            if (isset($this->request->getData()['is_review_photo']) and $this->request->getData()['is_review_photo'] == "1") {
                $ad->business_review_photo_id = $this->request->getData()['image_id'];
                $ad->business_photo_id = null;
            } else {
                $ad->business_review_photo_id = null;
                $ad->business_photo_id = $this->request->getData()['image_id'];
            }
            if ($this->table('FeaturedAds')->save($ad)) {
                $response['success'] = true;
            }
        }
        $this->Custom->jsonResponse($response);
    }

    public function removeRestriction($id = null)
    {
        $business = $this->Custom->getBusiness($id);
        $business->restricted = false;
        if ($this->table('Businesses')->save($business)) {
            $this->Flash->success(__('The business owner\'s access has been restored'));
        } else {
            $this->Flash->error(__('Something went wrong. Please, try again.'));
        }
        return $this->redirect($this->referer());
    }

    public function restrictAccess($id = null)
    {

        $business = $this->Custom->getBusiness($id);
        $business->restricted = true;
        if ($this->table('Businesses')->save($business)) {
            $this->Flash->success(__('The business owner\'s access has been restricted'));
        } else {
            $this->Flash->error(__('Something went wrong. Please, try again.'));
        }
        return $this->redirect($this->referer());
        // return $this->redirect(['action' => 'index']);
    }
    public function confirmSubscription()
    {
        $this->request->allowMethod('ajax');
        $response = ["success" => false];
        if (!empty($this->request->getData()['subscription_id'])) {
            $response['success'] = $this->Access->confirmSubscription($this->request->getData()['subscription_id']);
            if ($response['success']) {
                $business = $this->Custom->getBusiness($this->request->getData()['business_id']);
                $package = $this->table('Packages')->find()->where(['id' => $this->request->getData()['package_id']])->first();
                $this->Flash->success(__('Thank you for subscribing. ' . $business->name . " has been upgraded with " . $package->name . " package"));
            }
        }
        $this->Custom->jsonResponse($response);
    }
    public function subscribe()
    {
        $this->request->allowMethod('ajax');
        $response = ["success" => false, 'message' => "Oops! Something went wrong with the payment. Please try again"];
        // dd($this->request->getData());
        if (!empty($this->request->getData()['payment_method'])) {

            // $this->Custom->doLog('subscribe.txt', 'has payment method');
            $package = $this->table('Packages')->find()->where(['id' => $this->request->getData()['package_id']])->first();
            if (!empty($package)) {
                // $this->Custom->doLog('subscribe.txt', 'has package');
                $business_id = $this->request->getData()['business_id'];
                $business = $this->Custom->getBusiness($business_id);
                $payment_method = $this->request->getData()['payment_method'];
                $duration = !empty($this->request->getData()['duration']) ? $this->request->getData()['duration'] : '';
                $pricing = $duration == "yearly" ? $package->price_per_year : $package->price_per_month;


                if (getEnv('SERVER_NAME') == "inspire4.local") {

                    // $this->Custom->doLog('subscribe.txt', 'doing local pay');
                    if ($this->Access->subscribe($business->id, $package->id, $duration, null)) {
                        $response['success'] = true;
                        $this->Flash->success(__('Thank you for subscribing. ' . $business->name . " has been upgraded with " . $package->name . " package"));
                    }
                } else {
                    // $this->Custom->doLog('subscribe.txt', 'doing stripe pay');

                    $stripeSubscription = $this->Access->subscribeAjax($package, $payment_method, $pricing, $duration);
                    if ($stripeSubscription) {
                        // $this->Custom->doLog('subscribe.txt', 'stripe subcsription successful');
                        // $this->Custom->doLog('stripe.txt', json_encode($stripeSubscription));
                        $response['stripe_subscription'] = $stripeSubscription;
                        $this->Custom->setActiveBusiness($business->id);
                        if ($stripeSubscription['status'] == "active") {
                            $response['success'] = true;
                            if ($this->Access->subscribe($business->id, $package->id, $duration, $stripeSubscription)) {
                                // $this->Custom->doLog('subscribe.txt', 'access subscribe');
                                $this->Flash->success(__('Thank you for subscribing. ' . $business->name . " has been upgraded with " . $package->name . " package"));
                            }
                        } elseif (
                            $stripeSubscription['status']  === 'requires_action' or
                            (isset($stripeSubscription['latest_invoice']['payment_intent']['status']) and $stripeSubscription['latest_invoice']['payment_intent']['status']  === 'requires_action')
                        ) {
                            $response['requires_action'] = true;
                            $response['success'] = true;
                            $response['client_secret'] = $stripeSubscription['latest_invoice']['payment_intent']['client_secret'];
                            $subscription = $this->Access->subscribe($business->id, $package->id, $duration, $stripeSubscription, false);
                            if ($subscription) {
                                $response['subscription'] = $subscription;
                            }
                        }
                    }
                }
                // dd(json_encode($stripeSubscription));
            }
        }
        $this->Custom->jsonResponse($response);
    }


    public function getOfferIcon()
    {
        $this->request->allowMethod('ajax');
        $response = ["success" => true];
        $response['icon'] = $this->Cu->getOfferIcon($this->request->getData());
        $this->Custom->jsonResponse($response);
    }
    public function removeSlide()
    {

        $active_business = $this->Custom->getBusiness($this->currentUser->active_business);

        $this->request->allowMethod('ajax');
        $response = [
            "success" => false,
        ];
        $model = "BusinessPhotos";
        if ($this->request->getData()['is_review_photo'] == "1") {
            $model = "BusinessReviewPhotos";
        }
        $photo = $this->table($model)->find()->where(['id' => $this->request->getData()['photo_id']])->first();
        $photo->slide = false;
        if ($this->table($model)->save($photo)) {
            $response['success'] = true;
        }
        $this->Custom->jsonResponse($response);
    }
    public function setSlide()
    {

        $active_business = $this->Custom->getBusiness($this->currentUser->active_business);
        $this->request->allowMethod('ajax');

        $response = [
            "success" => false,
            "upgrade" => false,
        ];
        if (!$this->Access->businessHasAccess($this->currentUser->active_business, $this->Access->enhanced_plan, true)) {
            $response['upgrade'] = true;
            $response['success'] = true;
        } else {
            $model = "BusinessPhotos";
            if ($this->request->getData()['is_review_photo'] == "1") {
                $model = "BusinessReviewPhotos";
            }
            $photo = $this->table($model)->find()->where(['id' => $this->request->getData()['photo_id']])->first();
            $photo->slide = true;
            if ($this->table($model)->save($photo)) {
                $response['success'] = true;
            }
        }

        $this->Custom->jsonResponse($response);
    }
    public function setPrimary()
    {

        $active_business = $this->Custom->getBusiness($this->currentUser->active_business);

        $this->request->allowMethod('ajax');
        $response = [
            "success" => false,
        ];
        $this->table('BusinessPhotos')->updateAll(
            ['primary_image' => false], // fields
            ['business_id' => $active_business->id]
        );


        // $this->table('BusinessReviewPhotos')->updateAll(
        //     ['primary_image' => false], // fields
        //     ['business_id' => $active_business->id, 'model' => 'BusinessReviews']
        // )->contain('BusinessReviews');


        // $this->table('BusinessReviewPhotos')
        //     ->query()
        //     ->update()
        //     ->set(['primary_image' => false])
        //     ->contain('BusinessReviews')
        //     ->where(['BusinessReviews.business_id' => $active_business->id])
        //     ->execute();


        $review_photos = $this->table('BusinessReviewPhotos')->find()
            ->where(['BusinessReviews.business_id' => $active_business->id])
            ->leftJoinWith('BusinessReviews')
            ->toArray();
        if (!empty($review_photos)) {
            foreach ($review_photos as $key => $photo) {
                $photo->primary_image = false;
                $this->table('BusinessReviewPhotos')->save($photo);
            }
        }

        $model = "BusinessPhotos";
        if ($this->request->getData()['is_review_photo'] == "1") {
            $model = "BusinessReviewPhotos";
        }
        $photo = $this->table($model)->find()->where(['id' => $this->request->getData()['photo_id']])->first();
        $photo->primary_image = true;
        if ($this->table($model)->save($photo)) {
            $response['success'] = true;
            $response['message'] = "primary photo updated";
            $this->Flash->success(__('Primary photo updated'));
        }
        $this->Custom->jsonResponse($response);
    }
    public function saveShare()
    {
        $this->request->allowMethod('ajax');
        $response = [
            "success" => false,
        ];
        $data = $this->request->getData();
        $data['facebook'] = isset($data['facebook']) ? (bool) $data['facebook'] : false;
        $data['twitter'] = isset($data['twitter']) ? (bool) $data['twitter'] : false;
        $share = $this->table('Shares')->newEmptyEntity();
        $share = $this->table('Shares')->patchEntity($share,  $data);
        $share->user_id = !empty($this->Authentication->getIdentity()) ? $this->Authentication->getIdentity()->getIdentifier() : null;
        if ($this->table('Shares')->save($share)) {
            $response['success'] = true;
        }
        $this->Custom->jsonResponse($response);
    }
    public function getCurrentUser()
    {
        $this->request->allowMethod('ajax');
        $response = [
            "success" => false,
        ];


        if (!empty($this->Authentication->getIdentity())) {
            $response['user'] = $this->currentUser;
            $response['success'] = true;
        }

        $this->Custom->jsonResponse($response);
    }
    public function getUsers()
    {
        $this->request->allowMethod('ajax');
        $response = [
            "success" => true,
        ];

        // debug($this->request->getQuery());
        // dd($this->request->getAttribute('params'));

        $query = $this->table('Users')->find();

        if (!empty($this->request->getQuery()['q'])) {

            $search_term = $this->Custom->escapeString($this->request->getQuery()['q']);

            $query->where([
                'OR' => $this->Custom->userFullTextQuery($search_term)
            ]);
        }

        $users = $query->toArray();

        $user_data = [];
        if (!empty($users)) {
            foreach ($users as $user) {
                $user_data[] = [
                    'id' => $user['id'],
                    'name' => $user['name_desc'],
                ];
            }
        }

        // dd($user_data);

        $response['data'] = $user_data;
        $response['total_count'] = count($users);

        $this->Custom->jsonResponse($response);
    }
    public function addSubcategory()
    {
        $this->request->allowMethod('ajax');
        $response = [
            "success" => false,
            "info" => false,
        ];

        $subcategory = $this->table('Subcategories')->find()->where(['name' => $this->request->getData()['name']])->first();
        if (empty($subcategory)) {
            $subcategory = $this->table('Subcategories')->newEmptyEntity();
            if (!empty($this->request->getData())) {
                $subcategory = $this->table('Subcategories')->patchEntity($subcategory, $this->request->getData());
                // $account->password = null;
                //$department->name = null;
                if ($this->table('Subcategories')->save($subcategory)) {
                    $response['success'] = true;
                    $response['message'] = "Added " . $subcategory->name;
                    $response['subcategory'] = $subcategory;
                } else {
                    // $errors = $supplier->getErrors();
                    $message = "An error occured. Please try again";
                    $response['message'] = $message;
                    $response['data'] = $this->request->getData();
                }
                //$this->response->withStringBody(json_encode($response));

            }
        } else {
            $response['info'] = true;
            $response['message'] = "Tag aready exists";
            $response['subcategory'] = $subcategory;
        }


        $this->Custom->jsonResponse($response);
    }
    public function getSubcatsJson()
    {

        $this->request->allowMethod('ajax');
        $response = [
            "success" => true,
        ];

        // debug($this->request->getQuery());
        // dd($this->request->getAttribute('params'));

        $query = $this->table('Subcategories')->find();

        if (!empty($this->request->getQuery()['q'])) {

            $search_term = $this->Custom->escapeString($this->request->getQuery()['q']);

            $subcatQuery = $this->Custom->subcatFullTextQuery($search_term);
            // $mergeQuery = array_merge($catQuery, $subcatQuery);

            $query->where([
                'OR' => $subcatQuery,
            ]);
        }

        $data = $query->toArray();

        // dd($query);

        $query_data = [];
        if (!empty($data)) {
            foreach ($data as $value) {
                $query_data[] = [
                    'id' => $value['id'],
                    'name' => $value['name'],
                ];
            }
        }

        // dd($user_data);

        $response['data'] = $query_data;
        $response['total_count'] = count($data);

        $this->Custom->jsonResponse($response);
    }
    public function messagelistener()
    {
    }
    public function notificationslistener()
    {
    }

    public function deletePhoto()
    {
        $this->request->allowMethod('ajax');
        $response = [
            "success" => false,
            "message" => 'Oops! Something went wrong. Please try again later'
        ];
        if ($this->currentUser->sa || $this->currentUser->admin) {
            if (!empty($this->request->getData()['photo_id'])) {

                // dd($this->request->getData()['is_review_photo']);
                $model = "BusinessPhotos";
                if ($this->request->getData()['is_review_photo'] == "1") {
                    $model = "BusinessReviewPhotos";
                }
                $photo = $this->table($model)->find()->where(['id' => $this->request->getData()['photo_id']])->first();
                if (!empty($photo)) {
                    $photo = $this->table($model)->delete($photo);
                    $this->Flash->success(__('Photo has been removed'));
                }
                $response['success'] = true;
                $response['message'] = "done";
            }
        }

        $this->Custom->jsonResponse($response);
    }
    public function sendConfirmationEmail()
    {
        $this->request->allowMethod('ajax');
        $response = [
            "success" => false,
            "message" => 'Oops! Something went wrong. Please try again later'
        ];
        $user = $this->Custom->getUser($this->Authentication->getIdentity()->getIdentifier());
        $user_email = $this->table('UserEmails')->find()->where(['id' => $this->request->getData()['id']])->first();
        if (empty(!$user_email)) {
            if ($this->Custom->sendConfirmationEmail($user, $user_email)) {
                $response['success'] = true;
                $response['message'] = "Confirmation mail has been sent to " . $user_email->email;
            }
        }
        $this->Custom->jsonResponse($response);
    }
    public function showBizPreview()
    {
        $this->request->allowMethod('ajax');
        $selectedImage = null;
        // debug($this->request->getData());
        if (!empty($this->request->getData()['image_id'])) {
            $image_id = $this->request->getData()['image_id'];
            $business = $this->Custom->getBusiness($this->request->getData()['business_id']);
            if ($this->request->getData()['is_review_photo'] == "1") {
                $selectedImage = $this->Custom->getBusinessReviewPhotos(null, false, $image_id)->first();
            } else {
                $selectedImage = $this->Custom->getBusinessPhotos(null, null, $image_id)->first();
            }
            // dd( $selectedImage );
        }
        $this->set('business', $business);
        $this->set('selectedImage', $selectedImage);
    }

    public function showReviewPreview()
    {
        $this->request->allowMethod('ajax');
        $review = null;
        if (!empty($this->request->getData()['selectedreview'])) {
            $reviewid = (!empty($this->request->getData()['selectedreview']) and ($this->request->getData()['selectedreview'] != "false")) ? $this->request->getData()['selectedreview'] : null;
            if (!empty($reviewid)) {
                $review = $this->Custom->getBusinessReviews(null, $reviewid)->first();
            }
            $description = !empty($this->request->getData()['description']) ? $this->request->getData()['description'] : '';
            $this->set('description', $description);
        }
        $this->set('review', $review);
    }
    public function getCitiesDropdown()
    {
        $this->request->allowMethod('ajax');
        if (!empty($this->request->getData()['selected_state_id'])) {
            $state_id = $this->request->getData()['selected_state_id'];
            $city_id = $this->request->getData()['city_id'];
            // debug($city_id);
            $cities = $this->table('Cities')->find('list')
                ->where([
                    'state_id' => $state_id,
                    // 'selected_state_id IN' => $selected_categories,
                ]);
            //dd(count($subcategories));

            //$lgas = $this->Lgas->find('list', ['limit' => 200])->where(['state_id' => $this->request->getData()['state_id']]);
            // $lga_id = !empty($this->request->getData()['lga_id']) ? $this->request->getData()['lga_id'] : null;
            // $this->set('selected_subcategories', $selected_subcategories);
            $this->set('cities', $cities);
            $this->set('city_id', $city_id);
        }
    }
    public function getBlockUnblockBox()
    {
        $this->request->allowMethod('ajax');
        if (!empty($this->request->getData()['user_id'])) {
            $targetUser = $this->Custom->getUser($this->request->getData()['user_id']);
            $targetUser->blockedUser = $this->Custom->blockedUser($this->Authentication->getIdentity()->getIdentifier(), $targetUser->id);
            $this->set('targetUser', $targetUser);
        }
    }


    public function updateSocialOptions()
    {
        $this->request->allowMethod('ajax');
        $response = [
            "success" => false,
        ];
        $user = $this->Custom->getUser($this->Authentication->getIdentity()->getIdentifier());
        $user = $this->table('Users')->patchEntity($user, $this->request->getData());
        if ($this->table('Users')->save($user)) {
            $response['success'] = true;
            $response['message'] = !empty($this->request->getData()['message']) ? $this->request->getData()['message'] : "Selection updated";
            $response['create_password'] = !empty($this->request->getData()['create_password']) ? true : false;
        }

        $this->Custom->jsonResponse($response);
    }

    public function updateNotificationOptions()
    {
        $this->request->allowMethod('ajax');
        $response = [
            "success" => false,
        ];
        $settings = $this->table('NotificationSettings')->find()->where(['user_id' => $this->Authentication->getIdentity()->getIdentifier()])->first();
        if (empty($settings)) {
            $settings = $this->table('NotificationSettings')->newEmptyEntity();
            $settings->user_id = $this->Authentication->getIdentity()->getIdentifier();
        }

        $settings = $this->table('NotificationSettings')->patchEntity($settings, $this->request->getData());
        if ($this->table('NotificationSettings')->save($settings)) {
            $response['success'] = true;
            $response['message'] = !empty($this->request->getData()['message']) ? $this->request->getData()['message'] : "Selection updated";
        }

        $this->Custom->jsonResponse($response);
    }

    public function getCitiesSelect()
    {
        $this->request->allowMethod('ajax');
        $response = [
            "success" => true,
        ];
        $query = $this->table('Cities')->find();
        if (!empty($this->request->getQuery()['q'])) {
            $search_term = strtolower($this->Custom->escapeString($this->request->getQuery()['q']));
            $query->where([
                'OR' => [
                    ['LOWER(Cities.name) LIKE' => "%" . $search_term . "%"],
                    // ["MATCH(Cities.name) AGAINST('{$search_term}' IN BOOLEAN MODE)"],
                ],
            ]);
        }

        $items = $query->toArray();
        $items_data = [];
        if (!empty($items)) {
            foreach ($items as $item) {
                $items_data[] = [
                    'id' => $item['id'],
                    'name' => $item['name']
                    // 'name' => $item['name'] . ' (' . number_format($item['main_price']) . ')',
                    // 'price' => $item['main_price'],
                ];
            }
        }

        // dd($user_data);

        $response['data'] = $items_data;
        $response['total_count'] = count($items);

        $this->Custom->jsonResponse($response);
    }

    public function getCitiesList()
    {
        $data = $this->request->getData(); //keyword
        //$data['keyword'] = "los angeles,ca";
        $result = [];
        $keyword = $this->request->getData()['keyword'];
        $usingRecent = true;

        if (!empty($keyword) and \strlen($keyword) > 2) {
            $usingRecent = false;
            $query = $this->table('Cities')->find()->contain('States');

            // if (isset($data['keyword']) && $data['keyword'] != "") {
            $search_term = strtolower($this->Custom->escapeString($this->request->getData()['keyword']));
            $query->where([
                'OR' => [
                    ['LOWER(Cities.name) LIKE' => "%" . $search_term . "%"],
                    ["MATCH(Cities.name) AGAINST('{$search_term}' IN BOOLEAN MODE)"],
                ],
            ]);
            $query->order(['Cities.id' => 'DESC']);
            $result = $query->toArray();
        } else {

            if (!empty($this->Authentication->getIdentity())) {
                $query = $this->table('CitySearches')->find()->contain('Cities.States');
                $query->order(['CitySearches.count' => 'DESC']);
                $query->limit(5);
                $query->where(["CitySearches.user_id" => $this->Authentication->getIdentity()->getIdentifier()]);
                $result = $query->toArray();
            }
        }
        $this->set('usingRecent', $usingRecent);
        $this->set('result', $result);
        $this->set('keyword', $keyword);
    }

    public function searchKeywordList() //TODO
    {

        $this->request->allowMethod('ajax');
        $response = [
            "success" => false,
            "result" => ""
        ];
        $return = [];

        $query = $this->table('SearchKeywords')->find();
        $items = $query->toArray();
        if (!empty($items)) {
            foreach ($items as $item) {
                $item['type'] = "0";
                $return[] = $item;
            }
        }

        $query2 = $this->table('Subcategories')->find();
        if (!empty($this->request->getData()['keyword'])) {
            $search_term = strtolower($this->Custom->escapeString($this->request->getData()['keyword']));
            $query2->where([
                'OR' => [
                    ['LOWER(Subcategories.name) LIKE' => "%" . $search_term . "%"],
                    // ["MATCH(Cities.name) AGAINST('{$search_term}' IN BOOLEAN MODE)"],
                ],
            ]);
            $items2 = $query2->toArray();
            if (!empty($items2)) {
                foreach ($items2 as $item) {
                    $item['type'] = "1";
                    $return[] = $item;
                }
            }
        }

        $query3 = $this->table('Categories')->find();
        if (!empty($this->request->getData()['keyword'])) {
            $search_term = strtolower($this->Custom->escapeString($this->request->getData()['keyword']));
            $query3->where([
                'OR' => [
                    ['LOWER(Categories.name) LIKE' => "%" . $search_term . "%"],
                    // ["MATCH(Cities.name) AGAINST('{$search_term}' IN BOOLEAN MODE)"],
                ],
            ]);
            $items3 = $query3->toArray();
            if (!empty($items3)) {
                foreach ($items3 as $item) {
                    $item['type'] = "2";
                    $item['category_id'] = $item['id'];
                    $return[] = $item;
                }
            }
        }

        $response['success'] =  true;
        $response['result'] =  $return;

        $this->Custom->jsonResponse($response);
    }

    public function userRegister()
    {
        $response = [
            "success" => false,
            "message" => "Incorrect username or password"
        ];

        $response = $this->Custom->newUser($this->request->getData());
        if ($response['success']) {
            $this->currentUser = $this->Custom->getUser($response['user']->id);
            $this->currentUser->image = $this->Custom->getDp($this->currentUser->image, 'users', '350x250');
            $this->Authentication->setIdentity($this->currentUser);
            // $this->Authentication->setIdentity($response['user']);
            $this->Notify->newUser($response['user']);
        }

        $this->Custom->jsonResponse($response);
    }


    public function userLogin()
    {
        $response = [
            "success" => false,
            "message" => "Incorrect username or password"
        ];
        $this->session->destroy(); //this solves the could not detroy session php error
        // dd($this->request->getData());
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $response['success'] = true;
            // $this->currentUser = $this->Custom->getUser($this->Authentication->getIdentity()->getIdentifier());
            $this->currentUser = $this->Custom->getUserLogin($this->Authentication->getIdentity()->getIdentifier());
            $this->currentUser->image = $this->Custom->getDp($this->currentUser->image, 'users', '350x250');
            $this->Authentication->setIdentity($this->currentUser);
            $response['user'] = $this->currentUser;
            // $response['user'] = [
            //     'id' => $this->Authentication->getIdentity()->getIdentifier(),
            //     'data' => $this->Custom->getUserLogin($this->Authentication->getIdentity()->getIdentifier())
            // ];
        }
        
        $this->Custom->jsonResponse($response);
    }

    public function getSubcategoriesDropdown()
    {
        $this->request->allowMethod('ajax');
        if (!empty($this->request->getData()['selected_categories'])) {
            $selected_categories = $this->request->getData()['selected_categories'];
            $selected_subcategories = !empty($this->request->getData()['selected_subcategories']) ? $this->request->getData()['selected_subcategories'] : null;

            $subcategories = $this->table('Subcategories')->find('list')
                ->where([
                    'category_id IN' => $selected_categories,
                ]);
            //dd(count($subcategories));

            //$lgas = $this->Lgas->find('list', ['limit' => 200])->where(['state_id' => $this->request->getData()['state_id']]);
            // $lga_id = !empty($this->request->getData()['lga_id']) ? $this->request->getData()['lga_id'] : null;
            $this->set('selected_subcategories', $selected_subcategories);
            $this->set('subcategories', $subcategories);
            //$this->set(compact('subcategories'));
            //$this->set('_serialize', $subcategories);

            //$this->render('subcategories_dropdown');
            //$this->render('ajax' . DS . 'subcategories_dropdown');

        }
    }

    public function updateUserData()
    {
        $response = [
            "success" => false,
            "message" => "Oops! Something went wrong"
        ];

        $this->request->allowMethod('ajax');
        if (!empty($this->request->getData())) {
            $user = $this->Custom->getUser($this->Authentication->getIdentity()->getIdentifier());
            $user = $this->table('Users')->patchEntity($user, $this->request->getData());
            if ($this->table('Users')->save($user)) {
                $response['message'] = "Profile updated";
                $response['success'] = true;
            }
        }
        $this->Custom->jsonResponse($response);
    }

    public function userImageAjaxUpload()
    {
        $response = [
            "success" => false,
            "message" => "Oops! Something went wrong"
        ];

        // dd($this->request->getData());

        $this->request->allowMethod('ajax');
        if (!empty($this->request->getData()['file'])) {
            $file = $this->request->getData()['file'];
            $new_file = $this->Custom->uploadBase64File($file, "users");
            if ($new_file) {
                // dd($this->currentUser);

                $user = $this->Custom->getUser($this->Authentication->getIdentity()->getIdentifier());
                $user->image = $new_file;
                $user->select_photo = 'upload';
                if ($this->table('Users')->save($user)) {
                    $response['message'] = "Profile Image updated";
                    $response['success'] = true;
                }
            }
        } else {
            // $this->out("could not upload file");
            $response['message'] = "could not upload file";
        }

        $this->Custom->jsonResponse($response);
    }

    public function getFilters()
    {
        $this->request->allowMethod('ajax');
        if (!empty($this->request->getData()['sic4category_id'])) {
            $sic4category_id = $this->request->getData()['sic4category_id'];
            $selected_subcategories = !empty($this->request->getData()['selected_subcategories']) ? $this->request->getData()['selected_subcategories'] : null;


            $subcategories = $this->table('Subcategories')->find('list')
                ->where(['sic4category_id' => $sic4category_id]);
            //dd(count($subcategories));

            $business = null;
            if (!empty($this->request->getData()['business_id'])) {
                $business = $this->Custom->getBusiness($this->request->getData()['business_id']);
            }

            $filters = $this->table('Filters')->find()
                ->contain(['Subcategories', 'FormTypes'])->order(['Filters.key_order' => 'ASC'])
                // ->where(['Filters.category_id IN' => $selected_categories])
                ->matching('Sic4categories', function ($q) use ($sic4category_id) {
                    return $q->where(['Sic4categories.id' => $sic4category_id]);
                })
                ->toArray();

            $this->set('selected_subcategories', $selected_subcategories);
            $this->set('subcategories', $subcategories);
            $this->set('filters', $filters);
            $this->set('business', $business);
        }
    }

    public function getSic4categories()
    {
        $this->request->allowMethod('ajax');
        if (!empty($this->request->getData()['sic2category_id'])) {
            $sic2category_id = $this->request->getData()['sic2category_id'];
            $sic4categories = $this->table('Sic4categories')->find('list')
                ->matching('Sic2categories', function ($q) use ($sic2category_id) {
                    return $q->where(['Sic2categories.id' => $sic2category_id]);
                });

            $business = null;
            if (!empty($this->request->getData()['business_id'])) {
                $business = $this->Custom->getBusiness($this->request->getData()['business_id']);
            }
            $this->set('business', $business);
            $this->set('sic2category_id', $sic2category_id);
            $this->set('sic4categories', $sic4categories);
        }
    }
    public function getSic8categories()
    {
        $this->request->allowMethod('ajax');
        if (!empty($this->request->getData()['sic4category_id'])) {
            $sic4category_id = $this->request->getData()['sic4category_id'];
            $sic8categories = $this->table('Sic8categories')->find('list')
                ->matching('Sic4categories', function ($q) use ($sic4category_id) {
                    return $q->where(['Sic4categories.id' => $sic4category_id]);
                });

            $business = null;
            if (!empty($this->request->getData()['business_id'])) {
                $business = $this->Custom->getBusiness($this->request->getData()['business_id']);
            }
            $this->set('business', $business);
            $this->set('sic4category_id', $sic4category_id);
            $this->set('sic8categories', $sic8categories);
        }
    }

    public function followUser()
    {
        $this->request->allowMethod('ajax');
        $targetUser = null;
        if (!empty($this->request->getData()['user_id'])) {
            $targetUser = $this->Custom->getUser($this->request->getData()['user_id']);
        }
        $follow = $this->table('Followers')->find()->where(['user_id' => $targetUser->id, 'follow_id' => $this->Authentication->getIdentity()->getIdentifier()])->first();
        if (!empty($this->Authentication->getIdentity()) and empty($follow) and $targetUser->id != $this->Authentication->getIdentity()->getIdentifier()) {
            $follow = $this->table('Followers')->newEmptyEntity();
            $follow->user_id = $targetUser->id;
            $follow->follow_id = $this->Authentication->getIdentity()->getIdentifier();
            if ($this->table('Followers')->save($follow)) {
                $this->Notify->follow($follow);
            }
        }
        $this->set('random_id_target', $this->request->getData()['random_id_target']);
        $this->set('targetUser', $targetUser);
        $followsUser = $this->Custom->followsUser($this->Authentication->getIdentity()->getIdentifier(), $targetUser->id);
        $this->set('followsUser', $followsUser);
        $followedByUser = $this->Custom->followedByUser($this->Authentication->getIdentity()->getIdentifier(), $targetUser->id);
        $this->set('followedByUser', $followedByUser);
    }

    public function unfollowUser()
    {
        $this->request->allowMethod('ajax');
        $targetUser = null;
        if (!empty($this->request->getData()['user_id'])) {
            $targetUser = $this->Custom->getUser($this->request->getData()['user_id']);
        }

        if (!empty($this->Authentication->getIdentity())) {
            $follow = $this->table('Followers')->find()->where(['user_id' => $targetUser->id, 'follow_id' => $this->Authentication->getIdentity()->getIdentifier()])->first();
            if (!empty($follow)) {
                if ($this->table('Followers')->delete($follow)) {
                }
            }
        }

        $this->set('random_id_target', $this->request->getData()['random_id_target']);
        $this->set('targetUser', $targetUser);
        $followsUser = $this->Custom->followsUser($this->Authentication->getIdentity()->getIdentifier(), $targetUser->id);
        $this->set('followsUser', $followsUser);
        $followedByUser = $this->Custom->followedByUser($this->Authentication->getIdentity()->getIdentifier(), $targetUser->id);
        $this->set('followedByUser', $followedByUser);
    }

    public function getCollections()
    {
        $this->request->allowMethod('ajax');
        $collections = $this->table('Collections')->find()->contain(['CollectionItems'])->where(['user_id' => $this->Authentication->getIdentity()->getIdentifier()]);
        $this->set('collections', $collections);

        if (!empty($this->request->getData()['business_id'])) {
            $business = $this->Custom->getBusiness($this->request->getData()['business_id']);
            $this->set('business', $business);
        }
    }

    public function getBusinessReviews()
    {
        $this->request->allowMethod('ajax');
        // dd($this->request->getQuery()['filters']);

        $this->Custom->getBusinessReviewsLogic($this->request->getQuery()['business_id'], $this->request->getQuery()['tips'], null, $this->request->getQuery());
        $business = $this->Custom->getBusiness($this->request->getQuery()['business_id']);
        $this->set('business', $business);
    }

    public function getQuestions()
    {
        $this->request->allowMethod('ajax');
        $this->Custom->getQuestionsLogic($this->request->getQuery()['business_id']);
        $business = $this->Custom->getBusiness($this->request->getQuery()['business_id']);
        $this->set('business', $business);
    }

    public function saveCollection()
    {
        // debug($this->request->getData());
        // die();
        $this->request->allowMethod('ajax');
        $response = [
            "success" => false,
            "message" => "Oops! Something went wrong"
        ];

        $collection = $this->table('Collections')->newEmptyEntity();
        $collection = $this->table('Collections')->patchEntity($collection, $this->request->getData());
        $collection->user_id = $this->Authentication->getIdentity()->getIdentifier();
        if ($this->table('Collections')->save($collection)) {
            $response['message'] = "The collection has been saved.";
            $response['success'] = true;
        }
        $this->Custom->jsonResponse($response);
    }


    public function postQuestion()
    {
        // dd($this->request->getData());
        $this->request->allowMethod('ajax');
        $response = [
            "success" => false,
            "message" => "Oops! Something went wrong"
        ];

        if (!empty($this->request->getData()['question'])) {
            $question = $this->table('Questions')->newEmptyEntity();
            $question->user_id = $this->Authentication->getIdentity()->getIdentifier();
            $question->business_id = $this->request->getData()['business_id'];
            $question->question = $this->request->getData()['question'];
            $question->notify = $this->request->getData()['notify'];
            if ($this->table('Questions')->save($question)) {
                $response['message'] = "The question has been saved.";
                $response['success'] = true;
                $business = $this->Custom->getBusiness($question->business_id);

                $response['url'] = \Cake\Routing\Router::url(['prefix' => false, 'controller' => 'businesses', 'action' => 'singleQuestion', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $this->Custom->truncate(\Cake\Utility\Text::slug(strtolower($question->question)), 70), $question->id], true);

                $this->Custom->addUserActivity([
                    'user_id' => $question->user_id,
                    'question_id' => $question->id,
                ]);

                $this->Notify->newQuestion($question);

                $this->Flash->success(__('Your question has been submitted.'));
            }
        }
        $this->Custom->jsonResponse($response);
    }

    public function markAllAsRead($id = null)
    {
        $this->table('Notifications')->updateAll(
            ['viewed' => 1], // fields
            ['user_id' => !empty($id) ? $id : $this->Authentication->getIdentity()->getIdentifier()]
            //['user_id' => $this->Authentication->getIdentity()->getIdentifier(), 'notification_type_id IS NOT' => 7]// conditions
        );
        return $this->redirect($this->referer());
    }
    public function viewedNotification()
    {
        $this->request->allowMethod('ajax');
        $response = [
            "success" => false,
            "message" => "Oops! Something went wrong"
        ];

        if (!empty($this->request->getData()['id'])) {
            $notification = $this->table('Notifications')->get($this->request->getData()['id']);
            $notification->viewed = 1;
            if ($this->table('Notifications')->save($notification)) {
                $response['success'] = true;
            }
        }
        $this->Custom->jsonResponse($response);
    }

    public function blockUser()
    {
        // dd($this->request->getData());
        $this->request->allowMethod('ajax');
        $response = [
            "success" => false,
            "message" => "Oops! Something went wrong"
        ];

        if (!empty($this->request->getData()['user_id'])) {
            $check = $this->table('BlockLists')->find()->where(['user_id' => $this->Authentication->getIdentity()->getIdentifier(), 'blocked_user_id' => $this->request->getData()['user_id']])->first();
            if (empty($check)) {
                $block = $this->table('BlockLists')->newEmptyEntity();
                $block->user_id = $this->Authentication->getIdentity()->getIdentifier();
                $block->blocked_user_id = $this->request->getData()['user_id'];
                if ($this->table('BlockLists')->save($block)) {
                    $response['success'] = true;
                    $response['message'] = "success";
                }
            }
        }
        $this->Custom->jsonResponse($response);
    }

    public function unblockUser()
    {
        // dd($this->request->getData());
        $this->request->allowMethod('ajax');
        $response = [
            "success" => false,
            "message" => "Oops! Something went wrong"
        ];

        if (!empty($this->request->getData()['user_id'])) {
            $check = $this->table('BlockLists')->find()->where(['user_id' => $this->Authentication->getIdentity()->getIdentifier(), 'blocked_user_id' => $this->request->getData()['user_id']])->first();
            if (!empty($check)) {
                if ($this->table('BlockLists')->delete($check)) {
                    $response['success'] = true;
                    $response['message'] = "done";
                }
            }
        }
        $this->Custom->jsonResponse($response);
    }


    public function saveBusinessToCollection()
    {
        // debug($this->request->getData());
        // die();
        $this->request->allowMethod('ajax');
        $response = [
            "success" => false,
            "message" => "Oops! Something went wrong"
        ];

        $collectionItem = $this->table('CollectionItems')->newEmptyEntity();
        $collectionItem = $this->table('CollectionItems')->patchEntity($collectionItem, $this->request->getData());
        if ($this->table('CollectionItems')->save($collectionItem)) {
            $collection = $this->table('Collections')->find()->where(['id' => $collectionItem->collection_id])->first();
            $response['message'] = "The business has been added to " . $collection->name;
            $response['success'] = true;
        }
        $this->Custom->jsonResponse($response);
    }

    public function removeBusiness()
    {
        // debug($this->request->getData());
        // die();
        $this->request->allowMethod('ajax');
        $response = [
            "success" => false,
            "message" => "Oops! Something went wrong"
        ];
        if (!empty($this->request->getData()['business_id']) and !empty($this->request->getData()['collection_id'])) {
            $this->table('CollectionItems')->deleteAll(['business_id' => $this->request->getData()['business_id'], 'collection_id' => $this->request->getData()['collection_id']]);
            $collection = $this->table('Collections')->find()->where(['id' => $this->request->getData()['collection_id']])->first();
            $response['message'] = "The business has been removed from " . $collection->name;
            $response['success'] = true;
        }

        $this->Custom->jsonResponse($response);
    }

    //not sure still in use
    public function uploadReviewPhotos()
    {
        $this->request->allowMethod('ajax');
        $response = [
            "success" => false,
            "message" => "Oops! Something went wrong, please try again"
        ];

        $uploadCount = 0;
        if (!empty($this->request->getData()['business_id']) and !empty($this->request->getData()['photos'])) {
            $photos = json_decode($this->request->getData()['photos'], true);
            // $sentPhotos = count($photos);
            if (!empty($photos)) {
                foreach ($photos as $photo) {
                    $new_file = $this->Custom->uploadBase64File($photo['img'], "businesses");
                    if ($new_file) {
                        $businessPhoto = $this->table('BusinessReviewPhotos')->newEmptyEntity();
                        $businessPhoto->user_id = $this->Authentication->getIdentity()->getIdentifier();
                        $businessPhoto->business_review_id = $this->request->getData()['business_review_id'];
                        $businessPhoto->photo = $new_file;
                        $businessPhoto->caption = $photo['caption'];
                        if ($this->table('BusinessReviewPhotos')->save($businessPhoto)) {
                            $uploadCount++;
                        }
                    }
                }
            }
        }
        if ($uploadCount > 0) {
            $response['success'] = true;
            $response['message'] = "Uploaded " . $uploadCount . " photo" . ($uploadCount > 1 ? "s" : '');
        }

        $this->Custom->jsonResponse($response);
    }

    public function uploadPhotos()
    {
        $this->request->allowMethod('ajax');
        $response = [
            "success" => false,
            "message" => "Oops! Something went wrong, please try again"
        ];

        $uploadCount = 0;
        if (!empty($this->request->getData()['business_id']) and !empty($this->request->getData()['photos'])) {
            $photos = json_decode($this->request->getData()['photos'], true);
            // $sentPhotos = count($photos);
            if (!empty($photos)) {
                foreach ($photos as $photo) {
                    $new_file = $this->Custom->uploadBase64File($photo['img'], "businesses");
                    if ($new_file) {
                        $businessPhoto = $this->table('BusinessPhotos')->newEmptyEntity();
                        $businessPhoto->user_id = $this->Authentication->getIdentity()->getIdentifier();
                        $businessPhoto->business_id = $this->request->getData()['business_id'];
                        $businessPhoto->photo = $new_file;
                        $businessPhoto->caption = $photo['caption'];
                        if ($this->table('BusinessPhotos')->save($businessPhoto)) {
                            $this->Custom->addUserActivity([
                                'user_id' => $businessPhoto->user_id,
                                'business_photo_id' => $businessPhoto->id,
                            ]);
                            $uploadCount++;
                        }
                    }
                }
            }
        }
        if ($uploadCount > 0) {
            $response['success'] = true;
            $response['message'] = "Uploaded " . $uploadCount . " photo" . ($uploadCount > 1 ? "s" : '');
            $this->Notify->businessPhotoUpload($this->request->getData()['business_id'], $this->Authentication->getIdentity()->getIdentifier());
        }

        $this->Custom->jsonResponse($response);
    }

    public function reportPhoto()
    {
        $this->request->allowMethod('ajax');
        $response = [
            "success" => false,
            "message" => "Oops! Something went wrong, please try again"
        ];

        // debug($this->request->getData());

        if (!empty($this->request->getData()['photo_id'])) {

            // dd($this->request->getData()['is_review_photo']);
            $model = "PhotoReports";
            $column = "business_photo_id";
            if ($this->request->getData()['is_review_photo'] == "1") {
                $model = "ReviewPhotoReports";
                $column = "business_review_photo_id";
            }
            $photo = $this->table($model)->find()->where(['user_id' => $this->Authentication->getIdentity()->getIdentifier(), $column => $this->request->getData()['photo_id']])->first();
            if (empty($photo)) {
                $photo = $this->table($model)->newEmptyEntity();
            }
            $photo->user_id = $this->Authentication->getIdentity()->getIdentifier();
            $photo->$column = $this->request->getData()['photo_id'];
            $photo->why = $this->request->getData()['why'];
            $photo->specific_detail = $this->request->getData()['specific_detail'];
            if ($this->table($model)->save($photo)) {
                $response['success'] = true;
                $response['message'] = "done";
                // $response['count'] = $this->table($model)->find()->where([$column => $photo->$column])->count();
            }
            // dd($photo);
        }

        $this->Custom->jsonResponse($response);
    }


    public function reportReview()
    {
        $this->request->allowMethod('ajax');
        $response = [
            "success" => false,
            "message" => "Oops! Something went wrong, please try again"
        ];

        // dd($this->request->getData());

        if (!empty($this->request->getData()['review_id'])) {
            $report = $this->table('BusinessReviewReports')->newEmptyEntity();
            $report->user_id = $this->Authentication->getIdentity()->getIdentifier();
            $report->business_review_id = $this->request->getData()['review_id'];
            $report->why_do = $this->request->getData()['why'];
            $report->specific_detail = $this->request->getData()['specific_detail'];
            if ($this->table('BusinessReviewReports')->save($report)) {
                $response['success'] = true;
                $response['message'] = "success";
            }
            $this->Custom->updateReviewReplyCount($this->request->getData()['review_id']);
        }

        $this->Custom->jsonResponse($response);
    }


    public function reportProfile()
    {
        $this->request->allowMethod('ajax');
        $response = [
            "success" => false,
            "message" => "Oops! Something went wrong, please try again"
        ];

        if (!empty($this->request->getData()['profile_id'])) {
            $report = $this->table('ProfileReports')->newEmptyEntity();
            $report->user_id = $this->Authentication->getIdentity()->getIdentifier();
            $report->profile_id = $this->request->getData()['profile_id'];
            $report->description = $this->request->getData()['description'];
            if ($this->table('ProfileReports')->save($report)) {
                $response['success'] = true;
                $response['message'] = "success";
            }
        }

        $this->Custom->jsonResponse($response);
    }

    public function reportQuestion()
    {
        $this->request->allowMethod('ajax');
        $response = [
            "success" => false,
            "message" => "Oops! Something went wrong, please try again"
        ];

        if (!empty($this->request->getData()['question_id'])) {
            $report = $this->table('QuestionReports')->newEmptyEntity();
            $report->user_id = $this->Authentication->getIdentity()->getIdentifier();
            $report->question_id = $this->request->getData()['question_id'];
            $report->why = $this->request->getData()['why'];
            $report->specific_detail = $this->request->getData()['specific_detail'];
            if ($this->table('QuestionReports')->save($report)) {
                $response['success'] = true;
                $response['message'] = "success";
            }
        }

        $this->Custom->jsonResponse($response);
    }

    public function reportAnswer()
    {
        $this->request->allowMethod('ajax');
        $response = [
            "success" => false,
            "message" => "Oops! Something went wrong, please try again"
        ];

        if (!empty($this->request->getData()['answer_id'])) {
            $report = $this->table('AnswerReports')->newEmptyEntity();
            $report->user_id = $this->Authentication->getIdentity()->getIdentifier();
            $report->answer_id = $this->request->getData()['answer_id'];
            $report->why = $this->request->getData()['why'];
            $report->specific_detail = $this->request->getData()['specific_detail'];
            if ($this->table('AnswerReports')->save($report)) {
                $response['success'] = true;
                $response['message'] = "success";
            }
        }

        $this->Custom->jsonResponse($response);
    }

    public function submitAnswer()
    {
        $this->request->allowMethod('ajax');

        if (!empty($this->request->getData()['question_id'])) {
            $answer = $this->table('Answers')->newEmptyEntity();
            $answer->user_id = $this->Authentication->getIdentity()->getIdentifier();
            $answer->question_id = $this->request->getData()['question_id'];
            $answer->answer = $this->request->getData()['answer'];
            if ($this->table('Answers')->save($answer)) {

                // $this->Flash->success(__('Thank you for your answer.'));

                $top_answer = $this->Custom->answersQuery()->where(['Answers.id' => $answer->id])->first();
                $this->set('top_answer', $top_answer);

                $question = $this->Custom->getQuestions(null,  $answer->question_id)->first();
                $this->set('question', $question);

                $business = $this->Custom->getBusiness($question->business_id);
                $this->set('business', $business);

                $this->Custom->addUserActivity([
                    'user_id' => $answer->user_id,
                    'answer_id' => $answer->id,
                ]);

                $this->Notify->newAnswer($question, $answer);


                $userHasReviewedBusiness = false;
                if (!empty($this->Authentication->getIdentity())) {
                    $userHasReviewedBusiness = $this->Custom->userHasReviewedBusiness($this->Authentication->getIdentity()->getIdentifier(), $question->business_id);
                }
                $this->set('userHasReviewedBusiness', $userHasReviewedBusiness);
            }
        }
    }

    public function replyReview()
    {
        $this->request->allowMethod('ajax');
        if (!empty($this->request->getData()['review_id'])) {
            $reply = $this->table('BusinessReviewReplies')->newEmptyEntity();
            $reply->user_id = $this->Authentication->getIdentity()->getIdentifier();
            $reply->business_review_id = $this->request->getData()['review_id'];
            $reply->reply = $this->request->getData()['reply'];
            if ($this->table('BusinessReviewReplies')->save($reply)) {
                $this->Notify->replyReview($reply->business_review_id);
            }
            $review = $this->Custom->getBusinessReviews(null, $this->request->getData()['review_id'])->first();
            $this->set('review', $review);

            $business = $this->Custom->getBusiness($review->business_id);
            $this->set('business', $business);

            $this->Custom->updateReviewReplyCount($this->request->getData()['review_id']);
        }
    }
    public function cancelSubscription()
    {
        $this->request->allowMethod('ajax');
        $response = [
            "success" => false,
            "message" => "Oops! Something went wrong, please try again"
        ];
        // dd($this->request->getData());
        if (!empty($this->request->getData()['subscription_id'])) {
            $response['success'] = $this->Access->cancelSubscription($this->request->getData()['subscription_id']);
            if ($response['success']) {
                $this->Flash->default(__('Your subscription has been cancelled'));
            }
        }

        $this->Custom->jsonResponse($response);
    }

    public function reportOwnerReply()
    {
        $this->request->allowMethod('ajax');
        $response = [
            "success" => false,
            "message" => "Oops! Something went wrong, please try again"
        ];

        // dd($this->request->getData());

        if (!empty($this->request->getData()['review_id'])) {
            $report = $this->table('BusinessReviewOwnerReports')->newEmptyEntity();
            $report->user_id = $this->Authentication->getIdentity()->getIdentifier();
            $report->business_review_id = $this->request->getData()['review_id'];
            $report->description = $this->request->getData()['description'];
            if ($this->table('BusinessReviewOwnerReports')->save($report)) {
                $response['success'] = true;
                $response['message'] = "success";
            }

            $this->Custom->updateReviewReplyCount($this->request->getData()['review_id']);
        }

        $this->Custom->jsonResponse($response);
    }

    public function helpfulPhoto()
    {
        $this->request->allowMethod('ajax');
        $response = [
            "success" => false,
            "count" => 0,
            "message" => "Oops! Something went wrong, please try again"
        ];

        if (!empty($this->request->getData()['photo_id'])) {

            // dd($this->request->getData()['is_review_photo']);
            $model = "HelpfulPhotos";
            $column = "business_photo_id";
            if ($this->request->getData()['is_review_photo'] == "1") {
                $model = "HelpfulReviewPhotos";
                $column = "business_review_photo_id";
            }
            $helpfulPhoto = $this->table($model)->find()->where(['user_id' => $this->Authentication->getIdentity()->getIdentifier(), $column => $this->request->getData()['photo_id']])->first();
            if (empty($helpfulPhoto)) {
                $helpfulPhoto = $this->table($model)->newEmptyEntity();
            }
            $helpfulPhoto->user_id = $this->Authentication->getIdentity()->getIdentifier();
            $helpfulPhoto->$column = $this->request->getData()['photo_id'];
            if ($this->table($model)->save($helpfulPhoto)) {
                $response['success'] = true;
                $response['message'] = "done";
                $response['count'] = $this->table($model)->find()->where([$column => $helpfulPhoto->$column])->count();
            }
        }

        $this->Custom->jsonResponse($response);
    }

    public function helpfulReview()
    {
        $this->request->allowMethod('ajax');
        $response = [
            "success" => false,
            "count" => 0,
            "message" => "Oops! Something went wrong, please try again"
        ];

        if (!empty($this->request->getData()['review_id'])) {

            $give = $this->request->getData()['give'] == "false" || $this->request->getData()['give'] == false ? false : true;
            $helpful = $this->table('HelpfulReviews')->find()->where(['user_id' => $this->Authentication->getIdentity()->getIdentifier(), 'business_review_id' => $this->request->getData()['review_id']])->first();

            // dd($give);

            if (empty($helpful) and $give) {
                $helpful = $this->table('HelpfulReviews')->newEmptyEntity();
                $helpful->user_id = $this->Authentication->getIdentity()->getIdentifier();
                $helpful->business_review_id = $this->request->getData()['review_id'];
                if ($this->table('HelpfulReviews')->save($helpful)) {
                    $response['success'] = true;
                    $response['message'] = "done";
                    $response['count'] = $this->table('HelpfulReviews')->find()->where(['business_review_id' => $helpful->business_review_id])->count();
                }
            }

            if (!$give and !empty($helpful)) {
                if ($this->table('HelpfulReviews')->delete($helpful)) {
                    $response['success'] = true;
                    $response['message'] = "done";
                    $response['count'] = $this->table('HelpfulReviews')->find()->where(['business_review_id' => $helpful->business_review_id])->count();
                }
            }

            $this->Custom->updateHelpfulReviewCount($this->request->getData()['review_id']);
            $this->Custom->updateReviewReplyCount($this->request->getData()['review_id']);
        }

        $this->Custom->jsonResponse($response);
    }

    public function helpfulAnswer()
    {
        $this->request->allowMethod('ajax');
        $response = [
            "success" => false,
            "count" => 0,
            "message" => "Oops! Something went wrong, please try again"
        ];

        if (!empty($this->request->getData()['answer_id'])) {

            $give = $this->request->getData()['give'] == "false" || $this->request->getData()['give'] == false ? false : true;
            if ($give) {
                $helpful = $this->table('HelpfulAnswers')->find()->where(['user_id' => $this->Authentication->getIdentity()->getIdentifier(), 'answer_id' => $this->request->getData()['answer_id']])->first();

                if (empty($helpful)) {
                    $helpful = $this->table('HelpfulAnswers')->newEmptyEntity();
                    $helpful->user_id = $this->Authentication->getIdentity()->getIdentifier();
                    $helpful->answer_id = $this->request->getData()['answer_id'];
                    if ($this->table('HelpfulAnswers')->save($helpful)) {
                    }
                }
                $response['success'] = true;
                $response['message'] = "done";
                $response['count'] = $this->table('HelpfulAnswers')->find()->where(['answer_id' => $helpful->answer_id])->count();
            } else {
                $unhelpful = $this->table('UnhelpfulAnswers')->find()->where(['user_id' => $this->Authentication->getIdentity()->getIdentifier(), 'answer_id' => $this->request->getData()['answer_id']])->first();

                if (empty($unhelpful)) {
                    $unhelpful = $this->table('UnhelpfulAnswers')->newEmptyEntity();
                    $unhelpful->user_id = $this->Authentication->getIdentity()->getIdentifier();
                    $unhelpful->answer_id = $this->request->getData()['answer_id'];
                    if ($this->table('UnhelpfulAnswers')->save($unhelpful)) {
                    }
                }
                $response['success'] = true;
                $response['message'] = "done";
                $response['count'] = $this->table('UnhelpfulAnswers')->find()->where(['answer_id' => $unhelpful->answer_id])->count();
            }
        }

        $this->Custom->jsonResponse($response);
    }

    public function addReviews()
    {
        $this->request->allowMethod('ajax');
        $response = [
            "success" => false,
            "message" => "Oops! Something went wrong, please try again"
        ];
        if (!empty($this->request->getData()['business_id'])) {
            $user_id = !empty($this->request->getData()['user_id']) ? $this->request->getData()['user_id'] : $this->Authentication->getIdentity()->getIdentifier();

            $review = $this->table('BusinessReviews')->find()->where(['user_id' => $user_id, 'business_id' => $this->request->getData()['business_id']])->first();
            if (empty($review)) {
                $response = $this->saveReviewAndUploadPhotos(null, $this->request->getData(), $response);
            } else {
                if ($this->request->getData()['admin'] == "1") {
                    $response = $this->saveReviewAndUploadPhotos($review, $this->request->getData(), $response);
                } else {
                    if ($this->request->getData()['edit_review'] == "1") {
                        $history = $this->Custom->saveReviewHistory($review);
                        if ($history) {
                            $response = $this->saveReviewAndUploadPhotos($review, $this->request->getData(), $response);
                        }
                    } else {
                        $this->Flash->default(__('You already added a review for this business'));
                    }
                }
                $response['success'] = true;
                // $message = "You already added a review for this business";
            }
        }

        $this->Custom->jsonResponse($response);
    }


    public function saveReviewAndUploadPhotos($review = null, $data, $response)
    {
        $new_review = false;
        if (empty($review)) {
            $new_review = true;
            $review = $this->table('BusinessReviews')->newEmptyEntity();
            $review->user_id = $this->Authentication->getIdentity()->getIdentifier();
        }
        $review->business_id = $data['business_id'];
        $review->title = $data['title'];
        $review->comment = $data['comment'];
        $review->sort_of_visit = $data['sort_of_visit'];
        $review->visit_time = $data['visit_time'];
        $review->advice = $data['advice'];
        $review->recommend = $data['recommend'];
        // $review->star_rating = $this->Custom->calculateStarRating($data['ratings']);
        $review->star_rating = !empty($data['star_rating']) ? (float) $data['star_rating'] : ($review->recommend ? 5.00 : 1.00);

        // dd($review->user_id);
        if ($this->table('BusinessReviews')->save($review)) {

            if ($new_review) {
                $this->Notify->newReview($review->id);
            }


            $response['success'] = true;
            $response['business_review_id'] = $review->id;
            $message = "Review saved successfully.. ";

            $this->Custom->saveReviewValues($data['ratings'], $review);
            $this->Custom->calCulateBusinessAverageRating($review->business_id);
            //$response['count'] = $this->table('HelpfulPhotos')->find()->where(['business_photo_id' => $helpfulPhoto->business_photo_id])->count();

            $uploadCount = 0;
            if (!empty($data['photos'])) {
                $photos = json_decode($data['photos'], true);
                // $sentPhotos = count($photos);
                if (!empty($photos)) {
                    foreach ($photos as $photo) {
                        $new_file = $this->Custom->uploadBase64File($photo['img'], "reviews");
                        if ($new_file) {
                            $businessPhoto = $this->table('BusinessReviewPhotos')->newEmptyEntity();
                            $businessPhoto->user_id = $review->user_id;
                            $businessPhoto->business_review_id = $review->id;
                            $businessPhoto->photo = $new_file;
                            $businessPhoto->caption = $photo['caption'];
                            if ($this->table('BusinessReviewPhotos')->save($businessPhoto)) {
                                $uploadCount++;
                                $this->Custom->addUserActivity([
                                    'user_id' => $businessPhoto->user_id,
                                    'business_review_photo_id' => $businessPhoto->id,
                                ]);
                            }
                        }
                    }
                }
            }


            if ($data['edit_review'] != "1" and $data['admin'] != "1") {
                $this->Custom->addUserActivity([
                    'user_id' => $review->user_id,
                    'business_review_id' => $review->id,
                ]);
            }

            if ($uploadCount > 0) {
                $message .= "Uploaded " . $uploadCount . " photo" . ($uploadCount > 1 ? "s" : '');
            }
            $this->Flash->success(__($message));
        }
        return $response;
    }

    public function sendUserMessage()
    {
        $this->request->allowMethod('ajax');
        $response = [
            "success" => false,
            "message" => "Oops! Something went wrong, please try again"
        ];
        if (!empty($this->request->getData()['receiver_id'])) {

            if ((int) $this->request->getData()['receiver_id'] != (int) $this->Authentication->getIdentity()->getIdentifier()) {

                $userIsBlocked = $this->Custom->blockedUser($this->request->getData()['receiver_id'], $this->Authentication->getIdentity()->getIdentifier());
                if ($userIsBlocked) {
                    $response['message'] = "You can't send a message to this user at this time.";
                } else {

                    $conversation = $this->Chat->getActiveConversation($this->Authentication->getIdentity()->getIdentifier(), $this->request->getData()['receiver_id']);
                    $message_body = $this->request->getData()['body'];

                    $message = $this->Chat->submitChat($this->Authentication->getIdentity()->getIdentifier(), $conversation, $message_body);
                    if ($message) {
                        $response['success'] = true;
                        $response['message'] = "done";
                        $this->Notify->newMessage($message, $this->request->getData()['receiver_id']);
                    }
                }
            } else {
                $response['message'] = "You can't send a message to yourself";
            }
        }

        $this->Custom->jsonResponse($response);
    }


    public function logout()
    {
        // return $this->redirect($this->Auth->logout());
        // $this->Auth->logout();

        try {
            //code...
            $this->Authentication->logout();
        } catch (\RuntimeException $th) {
            //throw $th;
        }
        return $this->redirect($this->referer());
    }
}
