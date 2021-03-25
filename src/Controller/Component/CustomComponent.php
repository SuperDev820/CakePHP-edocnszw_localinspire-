<?php

declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use App\Utility\Custom;
use Cake\I18n\Time;
use Cake\Filesystem\File;

/**
 * Custom component
 */
class CustomComponent extends Component
{
    // The other component your component uses
    public $components = ['Flash', 'Auth', 'Access', 'Authentication'];
    public $Cu; //for use with custom utility
    public $limit = 10;
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    // Execute any other additional setup for your component.
    public function initialize(array $config): void
    {
        // try {

        //     $this->loadModels($this, $this->getController());
        // } catch (\Cake\Core\Exception\Exception $th) {
        //     $this->loadModels($this, null);
        // }
        $this->controller = $this->getController();
        $this->Cu = new Custom();
    }

    public function goToSuspendAction()
    {
        return $this->getController()->redirect(['prefix' => false, 'controller' => 'account', 'action' => 'suspended']);
    }
    public function goToHome()
    {
        return $this->getController()->redirect('/');
    }
    public function goToAccount()
    {
        return $this->getController()->redirect(['controller' => 'account', 'action' => 'index']);
    }
    public function goToUpgrade()
    {
        return $this->getController()->redirect(['controller' => 'biz', 'action' => 'upgrade']);
    }
    public function removeDuplicateFilters()
    {
        return;
        $filterSubs = $this->table('FiltersSubcategories')->find()->toArray();
        foreach ($filterSubs as $fs) {
            $filterSubs2 = $this->table('FiltersSubcategories')->find()->where(['filter_id' => $fs->filter_id, 'subcategory_id' => $fs->subcategory_id])->toArray();
            if (!empty($filterSubs2)) {
                foreach ($filterSubs2 as $dup) {
                    if ($this->table('FiltersSubcategories')->find()->where(['filter_id' => $fs->filter_id, 'subcategory_id' => $fs->subcategory_id])->count() > 1) {
                        $this->table('FiltersSubcategories')->delete($dup);
                    }
                }
            }
        }
    }
    public function fixTags()
    {
        return;
        $subcategories = $this->table('Subcategories')->find()->toArray();
        foreach ($subcategories as $subcat) {
            if (!empty($subcat->separate_title)) {
                $title_name = trim($subcat->separate_title);
                // dd($tag_name);
                $title = $this->Titles->find()->where(['name' => $title_name])->first();
                if (empty($title)) {
                    $title = $this->Titles->newEmptyEntity();
                    $title->name = $title_name;
                    $this->Titles->save($title);
                }
                $tagsSubcategory = $this->table('SubcategoriesTitles')->newEmptyEntity();
                $tagsSubcategory->subcategory_id = $subcat->id;
                $tagsSubcategory->title_id = $title->id;
                $this->table('SubcategoriesTitles')->save($tagsSubcategory);
            }
        }
    }

    public function fixFilters()
    {
        return;
        $filters = $this->table('Filters')->find()->toArray();
        foreach ($filters as $filter) {
            if ($filter['child_tags'] != "") {
                $tags = explode(",", $filter['child_tags']);
                foreach ($tags as $tag_text) {

                    $temp = [];
                    $type = explode("-", $tag_text)[0];
                    $childs = explode("-", $tag_text)[1];
                    if ($type == "checkbox") {

                        $children = explode("+", $childs);
                        if (!empty($children)) {
                            $subcats = $this->table('Subcategories')->find()->where(['id IN' => $children])->toArray();
                            foreach ($subcats as $subcat) {
                                $filtersSubcategory = $this->table('FiltersSubcategories')->newEmptyEntity();
                                $filtersSubcategory->filter_id = $filter->id;
                                $filtersSubcategory->subcategory_id = $subcat->id;
                                $this->table('FiltersSubcategories')->save($filtersSubcategory);
                            }
                        }
                        $filter->form_type_id = 2;
                        $temp['type'] = "checkbox";
                        $temp['fields'] = $tag_text;
                        $temp['subcats'] = $subcats;
                        $temp['childs'] = $childs;
                    } else if ($type == "textbox") {
                        $temp['type'] = "textbox";
                        $temp['text'] = $childs;
                        $temp['fields'] = $tag_text;

                        $filter->form_type_id = 1;
                    } elseif ($type == "dropdown") {
                        $temp['type'] = "dropdown";
                        $temp['text'] = $childs;
                        $temp['fields'] = $tag_text;
                        $temp['childs'] = explode("+", explode("-", $tag_text)[2]);
                        // $filter->form_type_id = 3;

                        $filter->form_type_id = 1; //change dropdown to normal input
                        $filter->placeholder = $childs;
                    } elseif ($type == "slider") {
                        // print_r($type);exit;
                        $temp['type'] = "slider";
                        // $temp['text'] = $childs;
                        $childs_arr = explode("_", $childs);
                        $temp['text'] = $childs_arr[0];
                        $temp['min'] = $childs_arr[1];
                        $temp['max'] = $childs_arr[2];
                        $temp['step'] = $childs_arr[3];
                        $temp['fields'] = $tag_text;

                        $filter->form_type_id = 3;
                        $filter->placeholder = $temp['text'];
                    } else {
                        // dd($temp);
                    }
                    // dd($temp);
                    $this->table('Filters')->save($filter);
                    $filter['child_tag_name'][]  = $temp;
                }
            }
        }
    }

    public function getChunkSize($business, $filters)
    {
        // dd($business->business_additionals);
        // $count = 0;
        $filtersArr = [];
        foreach ($filters as $key => $filter) {
            if (!empty($business->business_additionals)) {
                foreach ($business->business_additionals as $value) {
                    if ($value->filter_id == $filter->id) {
                        if (!in_array($filter->id, $filtersArr)) {
                            $filtersArr[]  = $filter->id;
                        }
                    }
                }
            }
            if (!empty($business->subcategories)) {
                foreach ($business->subcategories as $subcat) {
                    if (!empty($subcat->filters)) {
                        foreach ($subcat->filters as $filter2) {
                            if ($filter2->id == $filter->id) {
                                if (!in_array($filter2->id, $filtersArr)) {
                                    $filtersArr[]  = $filter2->id;
                                }
                            }
                        }
                    }
                }
            }
        }
        // $chunksize = round(count($filtersArr) / 3);
        // debug(count($business->business_additionals));
        // debug(count($business->subcategories));
        // dd($filtersArr);
        // return round(count($filtersArr) / 3);
        $returnValue = round(count($filtersArr) / 2) - 1;
        return $returnValue > 1 ? $returnValue : 2;
    }

    public function calCulateBusinessAverageRating($id)
    {
        $sum = $this->table('BusinessReviews')->find()->where(['BusinessReviews.business_id' => $id])->sumOf('star_rating');
        $count = $this->table('BusinessReviews')->find()->where(['BusinessReviews.business_id' => $id])->count();
        $business = $this->getBusiness($id);
        if ($business) {
            if (!empty($count)) {
                $average =  round($sum / $count, 2);
                $business->average_rating = $average;
            } else {
                $business->average_rating = 0.00;
            }
            $this->table('Businesses')->save($business);
        }
    }
    public function calculateStarRating($ratings)
    {
        //Our array, which contains a set of numbers.
        // $array = [$ratings->quality, $ratings->price, $ratings->value];
        //Calculate the average.
        return round(array_sum($ratings) / count($ratings), 2);
    }

    public function saveReviewHistory($review)
    {
        $data = $this->Cu->varToArray($review);
        $data['created'] = null;
        $data['modified'] = null;
        $history = $this->table('ReviewHistories')->newEmptyEntity();
        $history = $this->table('ReviewHistories')->patchEntity($history, $data);
        $history->business_review_id = $review->id;
        $history->review_values_json = json_encode($this->getBusinessReviews(null, $review->id)->first()->review_values);
        if ($this->table('ReviewHistories')->save($history)) {
            return true;
        }
        return false;
    }
    public function saveReviewValues($ratings, $review)
    {
        if (!empty($ratings)) {
            foreach ($ratings as $key => $value) {
                $rating_value = $this->table('ReviewValues')->find()->where(['business_review_id' => $review->id, 'review_option_id' => $key])->first();
                if (empty($rating_value)) {
                    $rating_value = $this->table('ReviewValues')->newEmptyEntity();
                }
                $rating_value->business_review_id = $review->id;
                $rating_value->review_option_id = $key;
                $rating_value->value = $value;
                if ($this->table('ReviewValues')->save($rating_value)) {
                }
            }
        }
    }

    public function getUserLogin($id)
    {
        $user = $this->table('Users')->find()->where(['Users.id' => $id])->first();
        return $user;
    }
    public function getUser($id, $username = null)
    {
        if (!empty($username)) {
            $user = $this->table('Users')->find()->where(['Users.username' => $username])->contain($this->userContains())->first();
            // $user = $this->table('Users')->find()->where(['Users.username' => $username])->contain($this->userContains())->first();
        } else {
            $user = $this->table('Users')->find()->where(['Users.id' => $id])->contain($this->userContains())->first();
            // $user = $this->table('Users')->get($id, [
            //     'contain' => $this->userContains(),
            // ]);
        }
        return $user;
    }

    public function getUserCollections($user_id = null, $collection_id = null, $no_private = false)
    {
        $conditions = ['Collections.user_id' => $user_id];
        $query =  $this->table('Collections')->find();
        if (!empty($collection_id)) {
            $conditions['Collections.id'] = $collection_id;
        }
        if ($no_private) {
            $conditions['Collections.private'] = false;
        }
        $query->where($conditions);
        $query
            ->contain([
                'CollectionItems' => [
                    'Businesses' => function ($q) {
                        return $q->contain([
                            'Cities' => function ($q2) {
                                return $q2->contain(['States'])->leftJoinWith('States');
                            },
                            'Users' => function ($q) {
                                return $q->contain(['Cities' => function ($q2) {
                                    return $q2->contain(['States'])->leftJoinWith('States');
                                }])->leftJoinWith('Cities');
                            }
                        ])->leftJoinWith('Cities');
                    }
                ],
            ])
            ->order(['Collections.created' => 'DESC'])
            ->distinct(['Collections.id'])
            ->enableAutoFields(true);

        return $query;
    }



    public function getUserCollectionsLogic($user_id, $no_private = false)
    {
        $query = $this->getUserCollections($user_id, null, $no_private);
        $empty_result = false;
        $showCollectionsPagination = true;
        $collections_total_count = null;
        try {
            $collections_total_count = $query->count();
            $collections = $this->getController()->paginate($query, ['limit' => $this->limit]);
            // $activities = $this->getController()->paginate($query, ['limit' => 3]);


            if ($collections_total_count <= $this->limit) {
                $showCollectionsPagination = false;
            }

            if (empty($collections_total_count)) {
                $empty_result = true;
            }
        } catch (\Cake\Http\Exception\NotFoundException $e) {
            $this->paginateExceptionHandler('Collections');
        }
        $this->getController()->set(compact('empty_result', 'collections', 'collections_total_count', 'showCollectionsPagination'));
    }



    public function getUserActivitiesLogic($user_id, $reviews = false, $photos = false)
    {

        $query = $this->getUserActivities($user_id, $reviews, $photos);
        $empty_result = false;
        $showActivitiesPagination = true;
        $activities_total_count = null;
        try {
            $activities_total_count = $query->count();
            $activities = $this->getController()->paginate($query, ['limit' => $this->limit]);
            // $activities = $this->getController()->paginate($query, ['limit' => 3]);

            // if ($activities_total_count <= 20) {
            if ($activities_total_count <= $this->limit) {
                $showActivitiesPagination = false;
            }

            if (empty($activities_total_count)) {
                $empty_result = true;
            }

            $activitiesArray = [];

            foreach ($activities->toArray() as $key => $activity) {

                if (!empty($activity->business_review->helpful_reviews)) {
                    $helpful_reviews = [];
                    foreach ($activity->business_review->helpful_reviews as $key => $value) {

                        $value->is_follow = !empty($this->getController()->Authentication->getIdentity()) ? $this->followsUser($this->getController()->Authentication->getIdentity()->getIdentifier(), $value->user_id) : false;
                        $helpful_reviews[] = $value;
                    }
                    $activity->business_review->helpful_reviews = $helpful_reviews;
                }
                if (!empty($activity->business_photo->helpful_photos)) {
                    $helpful_photos = [];
                    foreach ($activity->business_photo->helpful_photos as $key => $value) {
                        $value->is_follow = !empty($this->getController()->Authentication->getIdentity()) ? $this->followsUser($this->getController()->Authentication->getIdentity()->getIdentifier(), $value->user_id) : false;
                        $helpful_photos[] = $value;
                    }
                    $activity->business_photo->helpful_photos = $helpful_photos;
                }
                $activitiesArray[] = $activity;
            }

            $this->getController()->set('activitiesArray', $activitiesArray);
        } catch (\Cake\Http\Exception\NotFoundException $e) {
            $this->paginateExceptionHandler('UserActivities');
        }
        $this->getController()->set(compact('empty_result', 'activities_total_count', 'showActivitiesPagination'));
    }

    public function getUserActivities($id, $reviews = false, $photos = false)
    {

        // $conditions = ['UserActivities.user_id' => $id];
        $conditions = [];
        $query =   $this->table('UserActivities')->find();
        if ($reviews) {
            $conditions['UserActivities.business_review_id IS NOT'] = null;
        }

        if ($photos) {
            $conditions = [
                'OR' => [
                    ['UserActivities.business_photo_id IS NOT NULL'],
                    ['UserActivities.business_review_photo_id IS NOT NULL'],
                ],
            ];
        }

        $query->where($conditions)->andWhere(['UserActivities.user_id' => $id]);

        // dd($conditions);

        $query->contain([
            'Users',
            'BusinessReviews' => function ($q) {
                return $this->reviewsQuery($q);
            },
            'Questions' => function ($q) {
                return $this->questionQuery($q);
            },
            'BusinessPhotos' => function ($q) {
                return $this->businessPhotosQuery($q);
            },
            'BusinessReviewPhotos' => function ($q) {
                $contains = $this->reviewPhotoContains();
                $contains['BusinessReviews'] = ['Businesses' => function ($q) {
                    return $q->contain([
                        'Cities' => function ($q2) {
                            return $q2->contain(['States'])->leftJoinWith('States');
                        }
                    ])->leftJoinWith('Cities');
                }];
                return $q->contain($contains);
            },
            'Answers' => function ($q) {
                return $this->answersQuery($q);
            }
        ])
            ->order(['UserActivities.created' => 'DESC'])
            ->distinct(['UserActivities.id'])
            ->enableAutoFields(true);

        return $query;
    }


    public function businessPhotosQuery($q)
    {
        $query = $this->table('BusinessPhotos')->find();
        if (!empty($q)) {
            $query = $q;
        }
        $query
            ->contain([
                'HelpfulPhotos' => [
                    'Users' => function ($q) {
                        return $q->contain(['Cities' => function ($q2) {
                            return $q2->contain(['States'])->leftJoinWith('States');
                        }])->leftJoinWith('Cities');
                    }
                ],
                'Businesses' => function ($q) {
                    return $q->contain([
                        'Cities' => function ($q2) {
                            return $q2->contain(['States'])->leftJoinWith('States');
                        }
                    ])->leftJoinWith('Cities');
                },
                'Users' => function ($q) {
                    return $q->contain(['Cities' => function ($q2) {
                        return $q2->contain(['States'])->leftJoinWith('States');
                    }])->leftJoinWith('Cities');
                }
            ]);
        return $query;
    }

    public function viewerIsBlocked($viewer_id, $viewed_id)
    {
        if (!empty($viewed_id) and !empty($viewer_id)) {
            $blocked = $this->table('BlockLists')->find()->where(['user_id' => $viewed_id, 'blocked_user_id' => $viewer_id])->first();
            if (!empty($blocked)) {
                return true;
            }
        }
        return false;
    }
    public function dateFromTimestamp($timestamp)
    {
        return date("D, jS F Y", $timestamp);
        // return date("M jS h:i:s A", $timestamp);
    }
    public function getCollectionSaves($id)
    {
        return $this->table('CollectionItems')->find()->where(['CollectionItems.business_id' => $id]);
    }
    public function setActiveCity($id, $user_id = null)
    {
        $user = $this->getUser((!empty($user_id) ? $user_id : $this->getController()->Authentication->getIdentity()->getIdentifier()));
        $user->active_city = $id;

        // debug($id);
        // dd($user);
        if ($this->table('Users')->save($user)) {
            return true;
        }
        // dd($user);
        return false;
    }
    public function setActiveBusiness($id)
    {
        $user = $this->getUser($this->getController()->Authentication->getIdentity()->getIdentifier());
        $user->active_business = $id;
        $this->table('Users')->save($user);
    }
    public function bizContains()
    {
        return [
            "Cities" => function ($q2) {
                return $q2->contain(['States'])->leftJoinWith('States');
            },
            "BusinessRoles",
            "Sic2categories",
            "Sic4categories",
            "Sic8categories",
            "BusinessAdditionals.Filters",
            "Subcategories.Filters",
            "Categories",
            "BusinessHours.Days",
            "Users",
            // "Users" => function ($q) {
            //     return $q->contain(['Cities' => function ($q2) {
            //         return $q2->contain(['States'])->leftJoinWith('States');
            //     }])->leftJoinWith('Cities');
            // },
            'BusinessPhotos' => function ($q) {
                return $q->limit(5);
            }
        ];
    }
    public function getCity($id)
    {
        return $this->table('Cities')->get($id, [
            'contain' => ['States'],
        ]);
    }


    public function getCityTags($city_id, $type = "list")
    {
        return $this->table('Tags')->find($type, ['limit' => 2000])->where(['city_id' => $city_id]);
    }

    public function getBusiness($id = null)
    {
        return $id ? $this->table('Businesses')->find()
            ->where(['Businesses.id' => $id])
            ->contain($this->bizContains())
            ->leftJoinWith('Cities')
            ->leftJoinWith('Users')
            ->first() : null;
    }

    public function getBusinessPhotos($business_id =  null, $user_id = null, $photo_id = null)
    {
        $query = $this->table('BusinessPhotos')->find()->contain(['HelpfulPhotos', 'PhotoReports', 'Users', 'Businesses' => function ($q) {
            return $q->contain([
                'Cities' => function ($q2) {
                    return $q2->contain(['States'])->leftJoinWith('States');
                },
                'Users' => function ($q) {
                    return $q->contain(['Cities' => function ($q2) {
                        return $q2->contain(['States'])->leftJoinWith('States');
                    }])->leftJoinWith('Cities');
                }
            ])->leftJoinWith('Cities');
        }]);
        if (!empty($user_id)) {
            $query->where(['BusinessPhotos.user_id' => $user_id]);
        }
        if (!empty($business_id)) {
            $query->where(['BusinessPhotos.business_id' => $business_id]);
        }
        if (!empty($photo_id)) {
            $query->where(['BusinessPhotos.id' => $photo_id]);
        }
        return $query;
    }

    public function getFeaturedAd($id = null, $cityid = null, $random = false, $limit = false, $containBusiness = true)
    {

        $contains = [
            'BusinessPhotos', 'BusinessReviewPhotos',
            'BusinessReviews' => ['Users' => function ($q) {
                return $q->contain(['Cities' => function ($q2) {
                    return $q2->contain(['States'])->leftJoinWith('States');
                }])->leftJoinWith('Cities');
            }]
        ];
        if ($containBusiness) {
            $contains['Businesses'] = $this->bizContains();
        }
        $query = $this->table('FeaturedAds')->find()
            ->contain($contains)
            ->distinct('FeaturedAds.id');
        if (!empty($id)) {
            $query->where(['FeaturedAds.business_id' => $id]);
        }
        if (!empty($cityid)) {
            $query->leftJoinWith('Businesses');
            $query->where(['Businesses.city_id' => $cityid]);
        }
        if ($random) {
            $query->order(['rand()']);
        }
        if ($limit) {
            $query->limit($limit);
        }
        return $query;
    }
    public function getBusinessReviewPhotos($id = null, $sendArray = true, $photo_id = null)
    {
        $contains = $this->reviewPhotoContains();
        $contains[] = 'BusinessReviews';
        $query = $this->table('BusinessReviewPhotos')->find()->contain($contains);
        if (!empty($id)) {
            $query->where(['BusinessReviews.business_id' => $id]);
        }
        if (!empty($photo_id)) {
            $query->where(['BusinessReviewPhotos.id' => $photo_id]);
        }

        if ($sendArray) {
            return $query->toArray();
        }
        return $query;
    }

    public function citiesQuery($onlyunclaimed = false)
    {
        $query = $this->table('Cities')->find()
            ->contain($this->cityContains())
            ->select($this->table('Cities'))
            ->enableAutoFields(true)
            ->distinct('Cities.id');

        if ($onlyunclaimed) {
            $query->where(['Cities.user_id IS NULL']);
        }
        return $query;
    }
    public function getNearbyCities($city = null, $radius = 20, $as_array = true, $onlyunclaimed = false)
    {
        // $cityQuery = [
        //     ['Businesses.city_id' => $city->id],
        // ];


        // $distanceField = "( 3959 * acos( cos( radians(".$latlng['lat'].") ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(".$latlng['lng'].") ) + sin( radians(".$latlng['lat'].") ) * sin( radians( lat ) ) ) ) AS distance FROM l_cities_list HAVING distance < ".$radius." ORDER BY distance";
        //  $distanceField = "( 3959 * acos( cos( radians(" . $this->currentLocation['lat'] . ") ) * cos( radians( Businesses.latitude ) ) * cos( radians( Businesses.longitude ) - radians(" . $this->currentLocation['long'] . ") ) + sin( radians(" . $this->currentLocation['lat'] . ") ) * sin( radians( Businesses.latitude ) ) ) )";

        // $this->currentLocation = $this->Cu->getUserLocation("192.227.139.106");
        // $this->currentLocation = $this->Cu->getUserLocation("75.175.204.60");

        // $query
        //     ->select(['distance' => $businessDistanceField])
        //     ->having(['distance < ' => $radius]);

        // ->bind(':latitude', $this->currentLocation['lat'], 'float')
        // ->bind(':longitude', $this->currentLocation['long'], 'float')

        // $distanceQuery = [
        //     ['distance <' => $radius],
        // ];

        // $distanceField = "*, ( 3959 * acos( cos( radians(" . $this->currentLocation['lat'] . ") ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(" . $this->currentLocation['long'] . ") ) + sin( radians(" . $this->currentLocation['lat'] . ") ) * sin( radians( lat ) ) ) ) AS distance";

        // $distanceField = "( 3959 * acos( cos( radians(" . $city->latitude . ") ) * cos( radians( Businesses.latitude ) ) * cos( radians( Businesses.longitude ) - radians(" . $city->longitude . ") ) + sin( radians(" . $city->latitude . ") ) * sin( radians( Businesses.latitude ) ) ) )";


        $businessDistanceField =  "( 3959 * acos( cos( radians(" . $city->latitude . ") ) * cos( radians( Businesses.latitude ) ) * cos( radians( Businesses.longitude  ) - radians(" . $city->longitude . ") ) + sin( radians(" . $city->latitude . ") ) * sin( radians( Businesses.latitude ) ) ) )";

        $distanceField = "( 3959 * acos( cos( radians(" . $city->latitude . ") ) * cos( radians( Cities.latitude ) ) * cos( radians( Cities.longitude ) - radians(" . $city->longitude . ") ) + sin( radians(" . $city->latitude . ") ) * sin( radians( Cities.latitude ) ) ) )";

        $query = $this->citiesQuery($onlyunclaimed)->select(['distance' => $distanceField])
            ->having(['distance <' => $radius])
            ->order(['distance' => 'DESC']);
        if ($as_array) {
            $nearby_cities = $query->toArray();
            $cities_ids = [$city->id]; //this is not necessary, because the query also includes the current city
            foreach ($nearby_cities as $key => $city) {
                if (!in_array($city->id, $cities_ids)) {
                    $cities_ids[] = $city->id;
                }
            }
            return $cities_ids;
        }
        return $query;
    }

    public function getPercentage($total, $number)
    {
        if ($total > 0) {
            return $total - (($total / 100) * $number);
        }
        return 0;
    }
    public function getOptions()
    {
        return $this->table('Options')->find()->where(['id' => 1])->first();;
    }
    public function getSponsoredListings($city_id = null,  $random = true, $limit = 5)
    {
        $sponsoredListings = [];
        $query = $this->table('Cities')->find()->contain(['States']);
        if (!empty($city_id)) {
            $query->where(['Cities.id' =>  $city_id]);
        } else {
            $locationCity = $this->getController()->currentLocation['City'];
            $StateName = $this->getController()->currentLocation['State'];
            $query->where(['Cities.name' =>  $locationCity])
                ->andWhere(['States.name LIKE' => "%" . $StateName . "%"]);
        }
        $city = $query->first();
        if (!empty($city)) {
            $cities_ids = $this->getNearbyCities($city, 20);
            $activeSubscriptionsInCity = $this->Access->activeSubscriptions(null, false, $this->Access->sponsored_plan)
                ->innerJoinWith('Businesses', function ($q) use ($cities_ids) {
                    return $q->where(['Businesses.city_id IN' => $cities_ids]);
                })
                // ->distinct(['Subscriptions.business_id'])
                ->toArray();
            $business_ids = [];
            if (!empty($activeSubscriptionsInCity)) {
                foreach ($activeSubscriptionsInCity as $key => $subscription) {
                    if (!in_array($subscription->business_id, $business_ids)) {
                        $business_ids[] = $subscription->business_id;
                    }
                }
                if (!empty($business_ids)) {
                    $query = $this->table('Businesses')->find()
                        ->select($this->table('Businesses'))
                        ->contain($this->businessContains())
                        ->where(['Businesses.id IN' => $business_ids]);
                    if ($random) {
                        $query->order(['rand()']);
                    }
                    if ($limit) {
                        $query->limit($limit);
                    }
                    $sponsoredListings = $query->toArray();
                }
            }
        }
        return $sponsoredListings;
    }

    public function getBusinessReviewsLogic($business_id, $showTips = null, $user_id = null,  $requestQuery = null)
    {
        $query = $this->getBusinessReviews($business_id, null, $user_id,  $requestQuery);
        // dd($query);
        $reviews = false;
        $empty_result = false;
        $showPagination = true;
        $tips = $showTips == "true" or $showTips == true ? true : false;

        try {
            $review_total_count = $query->count();
            $reviews = $this->getController()->paginate($query, ['limit' => $this->limit]);
            $reviewsArray = [];

            if ($review_total_count <= $this->limit) {
                $showPagination = false;
            }

            foreach ($reviews->toArray() as $key => $review) {

                if (!empty($review->helpful_reviews)) {
                    $helpful_reviews = [];
                    foreach ($review->helpful_reviews as $key => $value) {
                        $value->is_follow = !empty($this->getController()->Authentication->getIdentity()) ? $this->followsUser($this->getController()->Authentication->getIdentity()->getIdentifier(), $value->user_id) : false;
                        $helpful_reviews[] = $value;
                    }
                    $review->helpful_reviews = $helpful_reviews;
                }
                // dd($review->business);
                // dd($review->business_id);
                // $review->business = $this->table('Businesses')->find()
                // ->where(['Businesses.id' => $review->business_id])
                // // ->contain($this->bizContains())
                // // ->leftJoinWith('Cities')
                // // ->leftJoinWith('Users')
                // ->first();
                // $review->business = $this->getBusiness($review->business_id);
                $reviewsArray[] = $review;
            }
            // dd($reviewsArray);
            $this->getController()->set('reviewsArray', $reviewsArray);

            if (empty($review_total_count)) {
                $empty_result = true;
            }

            // dd($this->getController()->getRequest()->getParam('paging')['BusinessReviews']['start']);

            // $startCount = $this->request->getParam('paging')['BusinessReviews']['start'];
            $startCount = $this->getController()->getRequest()->getParam('paging')['BusinessReviews']['start'];

            // dd($this->getController()->getRequest()->getParam('paging'));
        } catch (\Cake\Http\Exception\NotFoundException $e) {
            $this->paginateExceptionHandler('BusinessReviews');
        }
        $this->getController()->set(compact('reviews', 'empty_result', 'review_total_count', 'showPagination', 'tips', 'startCount'));
    }

    public function getBusinessAnnouncementsLogic($business_id, $requestQuery = null)
    {
        $query = $this->getBusinessAnnouncements($business_id, $requestQuery);
        // dd($query);
        $announcements = false;
        $empty_result = false;
        $showAnnouncementsPagination = true;

        try {
            $announcements_total_count = $query->count();
            $announcements = $this->getController()->paginate($query, ['limit' => $this->limit]);

            if ($announcements_total_count <= $this->limit) {
                $showAnnouncementsPagination = false;
            }


            if (empty($announcements_total_count)) {
                $empty_result = true;
            }

            // dd($this->getController()->getRequest()->getParam('paging')['BusinessReviews']['start']);

            // $startCount = $this->request->getParam('paging')['BusinessReviews']['start'];
            $startCount = $this->getController()->getRequest()->getParam('paging')['Announcements']['start'];

            // dd($this->getController()->getRequest()->getParam('paging'));
        } catch (\Cake\Http\Exception\NotFoundException $e) {
            $this->paginateExceptionHandler('Announcements');
        }
        $this->getController()->set(compact('announcements', 'empty_result', 'announcements_total_count', 'showAnnouncementsPagination', 'startCount'));
    }
    public function getBusinessOffersLogic($business_id = null, $requestQuery = null, $city_id = null)
    {
        // $this->limit = 5;
        $query = $this->getBusinessOffers($business_id, $requestQuery, true, $city_id);
        // dd($query);
        $offers = false;
        $empty_result = false;
        $showOffersPagination = true;

        try {
            $offers_total_count = $query->count();
            $offers = $this->getController()->paginate($query, ['limit' => $this->limit]);

            if ($offers_total_count <= $this->limit) {
                $showOffersPagination = false;
            }
            if (empty($offers_total_count)) {
                $empty_result = true;
            }
            $startCount = $this->getController()->getRequest()->getParam('paging')['Offers']['start'];
        } catch (\Cake\Http\Exception\NotFoundException $e) {
            $this->paginateExceptionHandler('Offers');
        }
        $this->getController()->set(compact('offers', 'empty_result', 'offers_total_count', 'showOffersPagination', 'startCount'));
    }

    private function paginateExceptionHandler($model)
    {
        $empty_result = true;
        $requestQuery = $this->getController()->getRequest()->getQuery();
        $requestQuery['page'] = $this->getController()->getRequest()->getAttribute('paging')[$model]['pageCount'];

        return $this->getController()->redirect([
            'controller' => $this->getController()->getRequest()->getParam('controller'), 'action' => $this->getController()->getRequest()->getParam('action'),
            !empty($this->getController()->getRequest()->getParam('pass')[0]) ? $this->getController()->getRequest()->getParam('pass')[0] : '',
            !empty($this->getController()->getRequest()->getParam('pass')[1]) ? $this->getController()->getRequest()->getParam('pass')[1] : '',
            !empty($this->getController()->getRequest()->getParam('pass')[2]) ? $this->getController()->getRequest()->getParam('pass')[2] : '',
            !empty($this->getController()->getRequest()->getParam('pass')[3]) ? $this->getController()->getRequest()->getParam('pass')[3] : '',
            '?' => $requestQuery,
        ]);
    }

    public function jsonResponse($response)
    {
        $response = $this->Cu->toArray($response);
        $this->getController()->set(compact('response'));
        $this->getController()->viewBuilder()
            ->setOption('serialize', 'response');
        // ->setOption('jsonOptions', JSON_FORCE_OBJECT);
        $this->getController()->RequestHandler->renderAs($this->getController(), 'json');
    }
    public function unreadUserNotifications($user_id)
    {
        return $this->notificationsQuery($user_id)->where(['viewed' => 0, 'notification_type_id !=' => 6])->limit(7)->toArray();
    }
    public function unreadUserMessages($user_id)
    {
        return $this->notificationsQuery($user_id)->where(['viewed' => 0,  'notification_type_id' => 6])->limit(7)->toArray();
    }
    public function notificationsQuery($user_id)
    {
        $query = $this->table('Notifications')->find()->contain(['NotificationTypes', 'Users', 'MessageUsers'])
            ->where(['user_id' => $user_id])
            ->order(['Notifications.created' => 'DESC']);
        return $query;
    }
    public function getNotificationsLogic($requestQuery = null)
    {

        $unread_count = $this->table('Notifications')->find()->where(['user_id' => $this->getController()->Authentication->getIdentity()->getIdentifier(), 'viewed' => 0])->count();
        $limit = 20;
        $showNotificationPagination = true;

        try {

            $query = $this->notificationsQuery($this->getController()->Authentication->getIdentity()->getIdentifier());

            $notifications_total_count = $query->count();
            $notifications = $this->getController()->paginate($query, ['limit' => $limit]);

            if ($notifications_total_count <= $limit) {
                $showNotificationPagination = false;
            }
            if (empty($review_total_count)) {
                $empty_result = true;
            }
            $startCount = $this->getController()->getRequest()->getParam('paging')['Notifications']['start'];

            // dd($this->getRequest()->getParam('paging'));
        } catch (\Cake\Http\Exception\NotFoundException $e) {
            $this->paginateExceptionHandler('Notifications');
        }

        $this->getController()->set(compact('notifications', 'unread_count', 'empty_result', 'notifications_total_count', 'showNotificationPagination', 'startCount'));
    }

    public function blockedUser($user_id, $blocked_user_id)
    {
        if (!empty($blocked_user_id) and !empty($user_id) and $user_id != $blocked_user_id) {
            $check = $this->table('BlockLists')->find()->where(['user_id' => $user_id, 'blocked_user_id' => $blocked_user_id])->first();
            if (!empty($check)) {
                return true;
            }
        }
        return false;
    }

    public function userBlockedMe($user_id, $blocked_user_id)
    {
        if (!empty($blocked_user_id) and !empty($user_id) and $user_id != $blocked_user_id) {
            $check = $this->table('BlockLists')->find()->where(['user_id' => $blocked_user_id, 'blocked_user_id' => $user_id])->first();
            if (!empty($check)) {
                return true;
            }
        }
        return false;
    }

    public function followersLogic($user_id, $following = false)
    {
        $query = $this->getFollowers($user_id, $following);
        $empty_result = false;
        $showFPagination = true;
        $user_followers_following = null;
        try {
            $total_f_count = $query->count();
            // $user_followers_following = $this->getController()->paginate($query, ['limit' => $this->limit]);
            $user_followers_following = $this->getController()->paginate($query, ['limit' => 9]);

            if ($total_f_count <= $this->limit) {
                $showFPagination = false;
            }

            if (empty($total_f_count)) {
                $empty_result = true;
            }

            $user_followers_followingArray = [];

            foreach ($user_followers_following->toArray() as $key => $value) {

                if ($following) {
                    $value->followsUser = $this->followsUser($this->getController()->Authentication->getIdentity()->getIdentifier(), $value->user_id);
                    $value->followedByUser = $this->followedByUser($this->getController()->Authentication->getIdentity()->getIdentifier(), $value->user_id);
                    $value->blockedUser = $this->blockedUser($this->getController()->Authentication->getIdentity()->getIdentifier(), $value->user_id);
                    $value->userBlockedMe = $this->userBlockedMe($this->getController()->Authentication->getIdentity()->getIdentifier(), $value->user_id);
                } else {
                    $value->followsUser = $this->followsUser($this->getController()->Authentication->getIdentity()->getIdentifier(), $value->follow_id);
                    $value->followedByUser = $this->followedByUser($this->getController()->Authentication->getIdentity()->getIdentifier(), $value->follow_id);
                    $value->blockedUser = $this->blockedUser($this->getController()->Authentication->getIdentity()->getIdentifier(), $value->follow_id);
                    $value->userBlockedMe = $this->userBlockedMe($this->getController()->Authentication->getIdentity()->getIdentifier(), $value->follow_id);
                }
                $user_followers_followingArray[] = $value;
            }


            // dd($user_followers_following);
        } catch (\Cake\Http\Exception\NotFoundException $e) {
            $this->paginateExceptionHandler('Followers');
        }
        $this->getController()->set(compact('user_followers_following', 'empty_result', 'total_f_count', 'showFPagination', 'user_followers_followingArray'));
    }

    public function getFollowers($user_id, $following = false)
    {
        $query =  $this->table('Followers')->find();

        if ($following) {
            $query->where(['follow_id' => $user_id]);
        } else {
            $query->where(['Followers.user_id' => $user_id]);
        }

        $query->contain([
            'Follows' => function ($q) {
                return $q->contain(['Cities' => function ($q2) {
                    return $q2->contain(['States'])->leftJoinWith('States');
                }])->leftJoinWith('Cities');
            },
            'Users' => function ($q) {
                return $q->contain(['Cities' => function ($q2) {
                    return $q2->contain(['States'])->leftJoinWith('States');
                }])->leftJoinWith('Cities');
            },
        ])
            //->leftJoinWith('ReviewValues')
            // ->order(['Followers.created' => "DESC"])
            ->distinct(['Followers.id'])
            ->enableAutoFields(true);

        $requestQuery = $this->cleanQuery($this->getController()->getRequest()->getQuery());
        $sort = !empty($requestQuery['sort']) ? $requestQuery['sort'] : null;


        if ($following) {
            $sortArray = ['LOWER(Users.firstname)' => 'ASC'];
            if (!empty($sort)) {
                if ($sort == "active") {
                    $sortArray = ['Users.last_active_time' => 'DESC'];
                }
                if ($sort == "a-z") {
                    $sortArray = ['LOWER(Users.firstname)' => 'ASC'];
                }
                if ($sort == "z-a") {
                    $sortArray = ['LOWER(Users.firstname)' => 'DESC'];
                }
                if ($sort == "recent") {
                    $sortArray = ['Followers.created' => 'DESC'];
                }
            }
        } else {
            $sortArray = ['LOWER(Follows.firstname)' => 'ASC'];
            if (!empty($sort)) {
                if ($sort == "active") {
                    $sortArray = ['Follows.last_active_time' => 'DESC'];
                }
                if ($sort == "a-z") {
                    $sortArray = ['LOWER(Follows.firstname)' => 'ASC'];
                }
                if ($sort == "z-a") {
                    $sortArray = ['LOWER(Follows.firstname)' => 'DESC'];
                }
                if ($sort == "recent") {
                    $sortArray = ['Followers.created' => 'DESC'];
                }
            }
        }


        $query->order($sortArray);
        return $query;
    }


    public function followsUser($user_id, $user_am_following_id)
    {
        if (!empty($user_am_following_id) and !empty($user_id)) {
            if ($user_id == $user_am_following_id) {
                return true;
            }
            $check = $this->table('Followers')->find()->where(['follow_id' => $user_id, 'user_id' => $user_am_following_id])->first();
            if (!empty($check)) {
                return true;
            }
        }
        return false;
    }

    public function followedByUser($user_id, $user_who_follows_id)
    {
        if (!empty($user_who_follows_id) and !empty($user_id)) {
            if ($user_id == $user_who_follows_id) {
                return true;
            }
            $check = $this->table('Followers')->find()->where(['follow_id' => $user_who_follows_id, 'user_id' => $user_id])->first();
            if (!empty($check)) {
                return true;
            }
        }
        return false;
    }


    public function getQuestionsLogic($business_id = null, $user_id = null, $requestQuery = null)
    {
        $query = $this->getQuestions($business_id, null, false, $user_id, true, $requestQuery);
        // dd($query);
        $business_questions = false;
        $empty_result = false;
        $showQuestionPagination = true;
        try {
            $total_questions_count = $query->count();
            $business_questions = $this->getController()->paginate($query, ['limit' => $this->limit]);

            if ($total_questions_count <= $this->limit) {
                $showQuestionPagination = false;
            }

            if (empty($total_questions_count)) {
                $empty_result = true;
            }
        } catch (\Cake\Http\Exception\NotFoundException $e) {
            $this->paginateExceptionHandler('Questions');
        }
        $this->getController()->set(compact('business_questions', 'empty_result', 'total_questions_count', 'showQuestionPagination'));

        $userHasReviewedBusiness = false;
        if (!empty($this->getController()->Authentication->getIdentity())) {
            $userHasReviewedBusiness = $this->userHasReviewedBusiness($this->getController()->Authentication->getIdentity()->getIdentifier(), $business_id);
        }
        $this->getController()->set('userHasReviewedBusiness', $userHasReviewedBusiness);
    }


    public function reviewPhotoContains()
    {
        return ['HelpfulReviewPhotos' => ['Users' => function ($q) {
            return $q->contain(['Cities' => function ($q2) {
                return $q2->contain(['States'])->leftJoinWith('States');
            }])->leftJoinWith('Cities');
        }], 'ReviewPhotoReports', 'Users' => function ($q) {
            return $q->contain(['Cities' => function ($q2) {
                return $q2->contain(['States'])->leftJoinWith('States');
            }])->leftJoinWith('Cities');
        }];
    }

    public function getOverallReviews($id)
    {
        $options =  $this->table('ReviewOptions')->find()->toArray();
        $overall = [];
        foreach ($options as $key => $option) {
            $sum = $this->table('ReviewValues')->find()->where(['BusinessReviews.business_id' => $id, 'review_option_id' => $option->id])->contain(['BusinessReviews'])->sumOf('value');
            $count = $this->table('ReviewValues')->find()->where(['BusinessReviews.business_id' => $id, 'review_option_id' => $option->id])->contain(['BusinessReviews'])->count();

            if (!empty($sum)) {
                $overall[] = [
                    "option" => $option,
                    "average" => round($sum / $count, 2),
                ];
            }
        }
        return $overall;
    }

    public function updateHelpfulReviewCount($review_id)
    {
        $businessReview = $this->getBusinessReviews(null, $review_id)->first();
        $businessReview->helpful_count = $this->table('HelpfulReviews')->find()->where(['business_review_id' => $review_id])->count();
        $this->table('BusinessReviews')->save($businessReview);
    }

    public function updateReviewReplyCount($review_id)
    {
        $businessReview = $this->getBusinessReviews(null, $review_id)->first();
        $businessReview->reply_count = $this->table('BusinessReviewReplies')->find()->where(['business_review_id' => $review_id])->count();
        $this->table('BusinessReviews')->save($businessReview);
    }


    public function getfeaturedReview($id)
    {
        return $this->getBusinessReviews($id)->andWhere(['BusinessReviews.featured' => true])->first();
    }

    public function getBusinessReviews($business_id = null, $business_review_id = null, $user_id = null,  $requestQuery = null, $order = true)
    {

        $query =  $this->table('BusinessReviews')->find();
        if (!empty($business_review_id)) {
            $query->where(['BusinessReviews.id' => $business_review_id]);
        } elseif (!empty($user_id)) {
            $query->where(['BusinessReviews.user_id' => $user_id]);
        } elseif (!empty($business_id)) {
            $query->where(['BusinessReviews.business_id' => $business_id]);
        } else {
            //$query->where(['BusinessReviews.approved' => 1]);
        }
        return $this->reviewsQuery($query, $requestQuery, $order);
    }

    public function reviewsQuery($query = null,  $requestQuery = null, $order = true)
    {
        if (empty($query)) {
            $query =  $this->table('BusinessReviews')->find();
        }
        $query
            ->select(['replies' => $query->func()->count('BusinessReviewReplies.id')])
            // ->select(['helpful_count' => $query->func()->count('HelpfulReviews.id')])
            ->select($this->table('BusinessReviews'))
            ->group(['BusinessReviews.id'])
            ->contain($this->businessReviewContains())
            ->leftJoinWith('ReviewValues')
            ->leftJoinWith('BusinessReviewReplies')
            ->leftJoinWith('Businesses')
            // ->leftJoinWith('HelpfulReviews')
            // ->order(['BusinessReviews.created' => "DESC"])
            ->distinct(['BusinessReviews.id'])
            ->enableAutoFields(true);

        // dd($requestQuery);

        $filters = null;
        if (!empty($this->getController()) and isset($this->getController()->getRequest()->getQuery()['filters'])) {
            $filters = $this->getController()->getRequest()->getQuery()['filters'];
        } elseif (!empty($requestQuery)) {
            $filters =  isset($requestQuery['filters']) ? $requestQuery['filters'] : null;
        }


        $helpfulSet = false;
        if (!empty($filters)) {
            $filtersArray = explode("-", $filters);

            $orArray = [];
            if (in_array("5", $filtersArray)) {
                $orArray[] = ['BusinessReviews.star_rating >=' => 4.5];
            }
            if (in_array("4", $filtersArray)) {
                $orArray[] = ['BusinessReviews.star_rating >=' => 4, 'BusinessReviews.star_rating <=' => 4.4];
            }
            if (in_array("3", $filtersArray)) {
                $orArray[] = ['BusinessReviews.star_rating >=' => 3, 'BusinessReviews.star_rating <=' => 3.9];
            }
            if (in_array("2", $filtersArray)) {
                $orArray[] = ['BusinessReviews.star_rating >=' => 2, 'BusinessReviews.star_rating <=' => 2.9];
            }
            if (in_array("1", $filtersArray)) {
                $orArray[] = ['BusinessReviews.star_rating >=' => 1, 'BusinessReviews.star_rating <=' => 1.9];
            }
            $query->where(['OR' => $orArray]);

            if (in_array("h", $filtersArray)) {
                $query->andWhere(['BusinessReviews.helpful_count >=' => 1]);
            }

            if (in_array("r", $filtersArray)) {
                $query->andWhere(['BusinessReviews.recommend' => true]);
            }
        }
        // dd("stop");

        if ($order) {
            $sort = !empty($requestQuery['sort']) ? $requestQuery['sort'] : null;
            $sortArray = ['BusinessReviews.created' => 'DESC'];
            if (!empty($sort)) {
                if ($sort == "replies") {
                    $sortArray = ['replies' => 'DESC'];
                } elseif ($sort == "recent") {
                    $sortArray = ['BusinessReviews.created' => 'DESC'];
                } elseif ($sort == "oldest") {
                    $sortArray = ['BusinessReviews.created' => 'ASC'];
                } elseif ($sort == "helpful") {
                    $sortArray = ['BusinessReviews.helpful_count' => 'DESC'];
                } elseif ($sort == "recommend") {
                    // $sortArray = ['BusinessReviews.recommend' => 'DESC'];
                    $query->andWhere(['BusinessReviews.recommend' => true]);
                } elseif ($sort == "waiting") {
                    // $sortArray = ['BusinessReviews.helpful_count' => 'DESC'];
                    $query->andWhere(['BusinessReviews.reply_count' => 0]);
                }
            }

            $query->order($sortArray);
        }
        return $query;
    }

    public function getBusinessOffers($business_id = null,  $requestQuery = null, $order = true, $city_id = null)
    {
        $query =  $this->table('Offers')->find();
        if (!empty($business_id)) {
            $query->where(['Offers.business_id' => $business_id]);
        } else {
            //$query->where(['Announcements.approved' => 1]);
        }
        return $this->offersQuery($query, $requestQuery, $order, $city_id);
    }
    public function table($model)
    {
        return  \Cake\Datasource\FactoryLocator::get('Table')->get($model);
    }
    public function offersQuery($query = null,  $requestQuery = null, $order = true, $city_id = null)
    {
        if (empty($query)) {
            $query =  $this->table('Offers')->find();
        }
        $query
            ->select($this->table('Offers'))
            ->group(['Offers.id'])
            ->distinct(['Offers.id'])
            ->contain(["Businesses" => $this->businessContains()])
            // ->order(['Offers.created' => "DESC"])
            ->enableAutoFields(true);

        $showBirthday = false;
        $showAnniversary = false;
        // $query->where(['Businesses.city_id' => $city_id]);
        $cityOnly = true;

        if ($order) {

            // $requestQuery = $this->cleanQuery($this->getController()->getRequest()->getQuery());
            $sort = !empty($requestQuery['sort']) ? $requestQuery['sort'] : null;

            // $categories;
            // $sic2categories;
            // $sic4categories;
            // $sic8categories;

            $sortArray = ['Offers.created' => 'DESC'];
            if (!empty($sort)) {
                if ($sort == "recent") {
                    $sortArray = ['Offers.created' => 'DESC'];
                } elseif ($sort == "anniversary") {
                    $showAnniversary = true;
                    $sortArray = ['Offers.anniversary' => 'DESC'];
                } elseif ($sort == "birthday") {
                    $showBirthday = true;
                    $sortArray = ['Offers.birthday' => 'DESC'];
                } elseif ($sort == "collection") {
                    $cityOnly = false;
                    $bizIdsinCollection = $this->getUserCollectionBusinessesIds($this->getController()->Authentication->getIdentity()->getIdentifier());
                    if (!empty($bizIdsinCollection)) {
                        $query->andWhere(['Offers.business_id IN' => $bizIdsinCollection]);
                    } else {
                        $query->andWhere(['Offers.business_id' => 0]);
                    }
                } else {

                    $keyword = $this->table('SearchKeywords')->find()
                        ->where(['SearchKeywords.name' => $sort])
                        ->contain(['Filters' => function ($q) {
                            return $q
                                // ->where(['Filters.show_filter' => true])
                                // ->order(['Filters.key_order' => 'ASC'])
                                // ->limit(15)
                                ->contain(['Subcategories', 'FormTypes']);
                        }])->first();
                    // dd($keyword);
                    if (!empty($keyword)) {
                        $sic4category_ids = [];
                        if (!empty($keyword->sic4category_id)) {
                            if (!in_array($keyword->sic4category_id, $sic4category_ids)) {
                                $sic4category_ids[] = $keyword->sic4category_id;
                            }
                        }

                        if (!empty($sic4category_ids)) {
                            $sci4Query = [
                                ['Businesses.sic4category_id IN' => $sic4category_ids],
                            ];
                        }

                        $categories_ids = $this->getKeyWordCategories($keyword);
                        if (!empty($categories_ids)) {
                            $query->innerJoinWith('Businesses.Categories', function ($q) use ($categories_ids) {
                                return $q->where(['Categories.id IN' => $categories_ids]);
                            });
                        }
                    }
                }
            }



            $query->order($sortArray);
        }


        if ($cityOnly and !empty($city_id)) {
            $query->andWhere(['Businesses.city_id' => $city_id]);
        }

        if (!empty($this->getController()->Authentication->getIdentity())) {

            if ($this->Cu->dateIsToday($this->getController()->currentUser->anniversary)) {
                $query->andWhere(['Offers.anniversary' => true]);
            } else {
                $query->andWhere(['Offers.anniversary' => false]);
            }
            if ($this->Cu->dateIsToday($this->getController()->currentUser->dob)) {
                $query->andWhere(['Offers.birthday' => true]);
            } else {
                $query->andWhere(['Offers.birthday' => false]);
            }
        }

        return $query;
    }


    public function getKeyWordCategories($keyword)
    {
        $cat_ids = [];
        if (!empty($keyword->filters)) {
            foreach ($keyword->filters as $key => $filter) {
                if (!in_array($filter->category_id, $cat_ids)) {
                    $cat_ids[] = $filter->category_id;
                }
            }
        }
        return $cat_ids;
    }
    public function getUserCollectionBusinessesIds($user_id = null)
    {
        $collections =  $this->getUserCollections($user_id)->toArray();
        $business_ids = [];
        foreach ($collections as $key => $collection) {
            foreach ($collection->collection_items as $item) {
                if (!in_array($item->business_id, $business_ids)) {
                    $business_ids[] = $item->business_id;
                }
            }
        }
        return $business_ids;
    }
    public function getBusinessAnnouncements($business_id = null,  $requestQuery = null, $order = true)
    {

        $query =  $this->table('Announcements')->find();
        if (!empty($business_id)) {
            $query->where(['Announcements.business_id' => $business_id]);
        } else {
            //$query->where(['Announcements.approved' => 1]);
        }
        return $this->announcementsQuery($query, $requestQuery, $order);
    }


    public function announcementsQuery($query = null,  $requestQuery = null, $order = true)
    {
        if (empty($query)) {
            $query =  $this->table('Announcements')->find();
        }
        $query
            ->select($this->table('Announcements'))
            ->contain(["Businesses" => $this->businessContains()])
            ->group(['Announcements.id'])
            ->distinct(['Announcements.id'])
            // ->order(['Announcements.created' => "DESC"])
            ->enableAutoFields(true);


        return $query;
    }

    public function convertToTimestamp($date = null)
    {
        return $this->Cu->convertToTimestamp($date);
    }
    public function businessSharesAndClicks($business_id)
    {
        $business_shares_all = $this->bizSharesCount($business_id, ['all' => true]);
        $business_shares_all_this_week = $this->bizSharesCount($business_id, ['all' => true], (new \DateTime('first day of this week'))->format("Y-m-d H:i:s"), (new \DateTime())->format("Y-m-d H:i:s"));
        $business_shares_all_this_month = $this->bizSharesCount($business_id, ['all' => true], (new \DateTime('first day of this month'))->format("Y-m-d H:i:s"), (new \DateTime())->format("Y-m-d H:i:s"));
        $business_shares_all_last_month = $this->bizSharesCount($business_id, ['all' => true], (new \DateTime('first day of last month'))->format("Y-m-d H:i:s"), (new \DateTime('last day of last month'))->format("Y-m-d H:i:s"));
        $business_shares = $this->bizSharesCount($business_id, ['business_id' => true]);
        $business_shares_facebook = $this->bizSharesCount($business_id, ['business_id' => true, 'facebook' => true]);
        $business_shares_twitter = $this->bizSharesCount($business_id, ['business_id' => true, 'twitter' => true]);
        $this->getController()->set(compact('business_shares_all', 'business_shares_all_this_week', 'business_shares', 'business_shares_facebook', 'business_shares_twitter', 'business_shares_all_this_month', 'business_shares_all_last_month'));


        $business_facebook_clicks = $this->bizClicksCount($business_id, ['facebook' => true, 'business_id' => true]);
        $business_twitter_clicks = $this->bizClicksCount($business_id, ['twitter' => true, 'business_id' => true]);
        $review_facebook_clicks = $this->bizClicksCount($business_id, ['facebook' => true, 'business_review_id' => true]);
        $review_twitter_clicks = $this->bizClicksCount($business_id, ['twitter' => true, 'business_review_id' => true]);

        $this->getController()->set(compact('business_facebook_clicks', 'business_twitter_clicks', 'review_facebook_clicks', 'review_twitter_clicks'));
    }
    public function saveAdditionals($business, $additionals = null)
    {
        if (!empty($additionals)) {
            $this->table('BusinessAdditionals')->deleteAll(['business_id' => $business->id]);
            foreach ($additionals as $filter_id => $value) {
                $businessAdditional = $this->table('BusinessAdditionals')->newEmptyEntity();
                $businessAdditional->filter_id = $filter_id;
                $businessAdditional->business_id = $business->id;
                $businessAdditional->value = !empty($value['value']) ? $value['value'] : "";
                $businessAdditional->value2 = !empty($value['value2']) ? $value['value2'] : "";
                $this->table('BusinessAdditionals')->save($businessAdditional);
            }
        }
    }
    public function saveHours($business, $hours = null)
    {
        if (!empty($hours)) {
            $this->table('BusinessHours')->deleteAll(['business_id' => $business->id]);
            foreach ($hours as $day_id => $value) {
                $businessHours = $this->table('BusinessHours')->newEmptyEntity();
                $businessHours->day_id = $day_id;
                $businessHours->business_id = $business->id;
                $businessHours->opening_time = !empty($value['opening_time']) ? $value['opening_time'] : "";
                $businessHours->closing_time = !empty($value['closing_time']) ? $value['closing_time'] : "";
                $this->table('BusinessHours')->save($businessHours);
            }
        }
    }
    public function getBusinessEdits($id = null)
    {
        $query = $this->table('BusinessEdits')->find('all')
            ->contain(["Users" => $this->userContains(), "Businesses" => $this->businessContains()]);
        if (!empty($id)) {
            // dd($id);
            $query
                ->where(['BusinessEdits.id' => $id]);
        } else {
            $query->where(['approved' => false, 'declined' => false]);
        }
        return $query;
    }
    public function addShareClick($data, $visitor_info)
    {
        $click = $this->table('ShareClicks')->newEmptyEntity();
        $share = $this->table('ShareClicks')->patchEntity($click, $data);
        $click->user_id = !empty($this->getController()->Authentication->getIdentity()) ? $this->getController()->Authentication->getIdentity()->getIdentifier() : null;
        $click->referrer = $visitor_info['referer'];
        if ($this->table('ShareClicks')->save($click)) {
        }
    }
    public function addBizPageView($business_id)
    {
        $view = $this->table('PageViews')->newEmptyEntity();
        $view->business_id = $business_id;
        $view->user_id = !empty($this->getController()->Authentication->getIdentity()) ? $this->getController()->Authentication->getIdentity()->getIdentifier() : null;
        if ($this->table('PageViews')->save($view)) {
        }
    }
    public function bizViewsCount($business_id, $startDate = null, $endDate = null)
    {
        $query = $this->table('PageViews')->find()
            ->where(['business_id' => $business_id]);
        if (!empty($startDate) and !empty($endDate)) {
            $query->andWhere([function ($exp, $q) use ($startDate, $endDate) {
                return $exp->between('PageViews.created', $startDate, $endDate);
            }]);
        }
        return $query->count();
    }
    public function bizReviewsCount($business_id, $startDate = null, $endDate = null, $male = false, $female = false, $recommend = false)
    {
        $query = $this->table('BusinessReviews')->find()
            ->where(['business_id' => $business_id]);
        if (!empty($startDate) and !empty($endDate)) {
            $query->andWhere([function ($exp, $q) use ($startDate, $endDate) {
                return $exp->between('BusinessReviews.created', $startDate, $endDate);
            }]);
        }

        if ($male) {
            $query->leftJoinWith('Users')->where(['Users.gender' => 'Male']);
        }
        if ($female) {
            $query->leftJoinWith('Users')->where(['Users.gender' => 'Female']);
        }
        if ($recommend) {
            $query->andWhere(['BusinessReviews.recommend' => true]);
        }
        return $query->count();
    }
    public function bizSavesCount($business_id, $startDate = null, $endDate = null, $male = false, $female = false)
    {
        $query = $this->table('CollectionItems')->find()
            ->where(['business_id' => $business_id]);
        if (!empty($startDate) and !empty($endDate)) {
            $query->andWhere([function ($exp, $q) use ($startDate, $endDate) {
                return $exp->between('CollectionItems.created', $startDate, $endDate);
            }]);
        }
        if ($male) {
            $query->leftJoinWith('Collections.Users')->where(['Users.gender' => 'Male']);
        }
        if ($female) {
            $query->leftJoinWith('Collections.Users')->where(['Users.gender' => 'Female']);
        }
        return $query->count();
    }


    public function bizSharesCount($business_id, $data = null, $startDate = null, $endDate = null)
    {
        $query = $this->table('Shares')->find();
        $conditions = [];

        if ((isset($data['all']) and !empty($data['all'])) or (isset($data['business_id']) and !empty($data['business_id']))) {
            if (isset($data['facebook']) and !empty($data['facebook'])) {
                $conditions[] = ['Shares.facebook' => $data['facebook'], 'Shares.business_id' => $business_id];
            } elseif (isset($data['twitter']) and !empty($data['twitter'])) {
                $conditions[] = ['Shares.twitter' => $data['twitter'], 'Shares.business_id' => $business_id];
            } else {
                $conditions[] = ['Shares.business_id' => $business_id];
            }
        }
        if ((isset($data['all']) and !empty($data['all'])) or (isset($data['business_review_id']) and !empty($data['business_review_id']))) {
            $query->leftJoinWith('BusinessReviews');
            if (isset($data['facebook']) and !empty($data['facebook'])) {
                $conditions[] = ['Shares.facebook' => $data['facebook'], 'BusinessReviews.business_id' => $business_id];
            } elseif (isset($data['twitter']) and !empty($data['twitter'])) {
                $conditions[] = ['Shares.twitter' => $data['twitter'], 'BusinessReviews.business_id' => $business_id];
            } else {
                $conditions[] = ['BusinessReviews.business_id' => $business_id];
            }
        }
        // if ((isset($data['all']) and !empty($data['all'])) or (isset($data['business_photo_id']) and !empty($data['business_photo_id']))) {
        //     $query->leftJoinWith('BusinessPhotos');
        //     $conditions[] = ['BusinessPhotos.business_id' => $business_id];
        // }
        // if ((isset($data['all']) and !empty($data['all'])) or (isset($data['question_id']) and !empty($data['question_id']))) {
        //     $query->leftJoinWith('Questions');
        //     $conditions[] = ['Questions.business_id' => $business_id];
        // }
        // if ((isset($data['all']) and !empty($data['all'])) or (isset($data['business_review_photo_id']) and !empty($data['business_review_photo_id']))) {
        //     $query->leftJoinWith('BusinessReviewPhotos.BusinessReviews');
        //     $conditions[] = ['BusinessReviews.business_id' => $business_id];
        // }

        if (!empty($conditions)) {

            $query->where(['OR' => $conditions]);
            // $query->andWhere(['OR' => ['Shares.twitter IS NOT NULL', 'Shares.facebook IS NOT NULL']]);
        }


        if (!empty($startDate) and !empty($endDate)) {
            $query->andWhere([function ($exp, $q) use ($startDate, $endDate) {
                return $exp->between('Shares.created', $startDate, $endDate);
            }]);
        }
        return $query->group('Shares.id')->count();
    }
    public function bizClicksCount($business_id, $data = null, $startDate = null, $endDate = null)
    {
        $query = $this->table('ShareClicks')->find();
        $conditions = [];

        if ((isset($data['all']) and !empty($data['all'])) or (isset($data['business_id']) and !empty($data['business_id']))) {
            if (isset($data['facebook']) and !empty($data['facebook'])) {
                $conditions[] = ['LOWER(ShareClicks.referrer) LIKE' => "%fb.com%", 'ShareClicks.business_id' => $business_id];
                $conditions[] = ['LOWER(ShareClicks.referrer) LIKE' => "%facebook%", 'ShareClicks.business_id' => $business_id];
            } elseif (isset($data['twitter']) and !empty($data['twitter'])) {
                $conditions[] = ['LOWER(ShareClicks.referrer) LIKE' => "%twitter%", 'ShareClicks.business_id' => $business_id];
            } else {
                $conditions[] = ['ShareClicks.business_id' => $business_id];
            }
        }
        if ((isset($data['all']) and !empty($data['all'])) or (isset($data['business_review_id']) and !empty($data['business_review_id']))) {
            $query->leftJoinWith('BusinessReviews');
            if (isset($data['facebook']) and !empty($data['facebook'])) {
                $conditions[] = ['LOWER(ShareClicks.referrer) LIKE' => "%fb.com%", 'BusinessReviews.business_id' => $business_id];
                $conditions[] = ['LOWER(ShareClicks.referrer) LIKE' => "%facebook%", 'BusinessReviews.business_id' => $business_id];
            } elseif (isset($data['twitter']) and !empty($data['twitter'])) {
                $conditions[] = ['LOWER(ShareClicks.referrer) LIKE' => "%twitter%", 'BusinessReviews.business_id' => $business_id];
            } else {
                $conditions[] = ['BusinessReviews.business_id' => $business_id];
            }
        }

        if (!empty($conditions)) {
            $query->where(['OR' => $conditions]);
        }


        if (!empty($startDate) and !empty($endDate)) {
            $query->andWhere([function ($exp, $q) use ($startDate, $endDate) {
                return $exp->between('ShareClicks.created', $startDate, $endDate);
            }]);
        }
        return $query->group('ShareClicks.id')->count();
    }
    public function getUserReferralCount($user_id, $startDate = null, $endDate = null)
    {
        $query = $this->table('Users')->find()
            ->where(['Users.ref_id' => $user_id]);
        if (!empty($startDate) and !empty($endDate)) {
            $query->andWhere([function ($exp, $q) use ($startDate, $endDate) {
                return $exp->between('Users.created', $startDate, $endDate);
            }]);
        }
        return $query->count();
    }
    public function getRelatedBusiness($business)
    {
        $query = $this->table('Businesses')->find()
            ->select($this->table('Businesses'))
            ->contain($this->businessContains())
            ->leftJoinWith('Categories');

        $query->where(['Businesses.city_id' => $business->city_id])
            ->andWhere(['Businesses.id !=' => $business->id]);

        if (!empty($business->categories) and $query->count() > 10) {
            $filtered_cat_ids = [$business->categories[0]->id];
            $query->where(['Categories.id IN' =>  $filtered_cat_ids]);
        }

        $query->limit(5);
        return $query;
    }
    public function userHasReviewedBusiness($user_id,  $business_id)
    {
        if ($user_id) {
            $query =  $this->table('BusinessReviews')->find()->where(['user_id' => $user_id, 'business_id' => $business_id])->first();
            if (!empty($query)) {
                return true;
            }
        }
        return false;
    }

    public function popularQuestions($business_id = null)
    {
        return $this->getQuestions($business_id, null, true);
    }
    public function businessReviewContains()
    {
        return [
            // 'ReviewValues' => ['ReviewOptions'],
            'ReviewValues' => function ($q) {
                return $q->contain(['ReviewOptions'])->leftJoinWith('ReviewOptions');
            },
            // 'Users',
            'Users' => function ($q) {
                return $q->contain(['Cities' => function ($q2) {
                    return $q2->contain(['States'])->leftJoinWith('States');
                }])->leftJoinWith('Cities');
            },
            // 'Users.Cities.States', 
            'BusinessReviewOwnerReports',
            'BusinessReviewReplies',
            'BusinessReviewReports',
            'ReviewHistories',
            'BusinessReviewPhotos' => function ($q) {
                return $q->contain($this->reviewPhotoContains());
            },
            'HelpfulReviews' => ['Users' => function ($q) {
                return $q->contain([
                    'Cities' => function ($q2) {
                        return $q2->contain(['States'])->leftJoinWith('States');
                    }
                    //, 'BusinessReviewPhotos', 'BusinessPhotos', 'BusinessReviews'
                ])->leftJoinWith('Cities');
            }],
            'Businesses' => function ($q) {
                return $q->contain([
                    'Cities' => function ($q2) {
                        return $q2->contain(['States'])->leftJoinWith('States');
                    },
                    'Users' => function ($q) {
                        return $q->contain(['Cities' => function ($q2) {
                            return $q2->contain(['States'])->leftJoinWith('States');
                        }])->leftJoinWith('Cities');
                    }
                ])->leftJoinWith('Cities');
            }
        ];
    }

    public function questionQuery($q = null, $popular = false, $order = true, $requestQuery = null)
    {
        $query = $this->table('Questions')->find();
        if (!empty($q)) {
            $query = $q;
        }
        $query
            ->select(['total_answers' => $query->func()->count('Answers.id')])
            ->select($this->table('Questions'))
            ->group(['Questions.id'])
            ->contain([
                'Answers' => function ($q) {
                    return $this->answersQuery($q);
                },
                // 'Users',
                'Users' => function ($q) {
                    return $q->contain(['Cities' => function ($q2) {
                        return $q2->contain(['States'])->leftJoinWith('States');
                    }])->leftJoinWith('Cities');
                },
                'Businesses' => function ($q) {
                    return $q->contain([
                        'Cities' => function ($q2) {
                            return $q2->contain(['States'])->leftJoinWith('States');
                        },
                        'Users' => function ($q) {
                            return $q->contain(['Cities' => function ($q2) {
                                return $q2->contain(['States'])->leftJoinWith('States');
                            }])->leftJoinWith('Cities');
                        }
                    ])->leftJoinWith('Cities');
                }
            ])
            ->leftJoinWith('Answers')
            //->order(['Questions.created' => "DESC"])
            ->distinct(['Questions.id'])
            ->enableAutoFields(true);
        if ($order) {

            // $requestQuery = $this->cleanQuery($this->getController()->getRequest()->getQuery());
            $sort = !empty($requestQuery['sort']) ? $requestQuery['sort'] : null;

            $sortArray = ['Questions.created' => 'DESC'];
            if ($popular) {
                $sortArray = ['total_answers' => 'DESC'];
            } else {
                if (!empty($sort)) {
                    if ($sort == "top") {
                        $sortArray = ['total_answers' => 'DESC'];
                    } elseif ($sort == "recent") {
                        $sortArray = ['Questions.created' => 'DESC'];
                    } elseif ($sort == "oldest") {
                        $sortArray = ['Questions.created' => 'ASC'];
                    } elseif ($sort == "recently-answered") {
                        $sortArray = ['Answers.created' => 'DESC'];
                    }
                }
            }

            $query->order($sortArray);
        }
        return $query;
    }


    public function getQuestions($business_id = null, $question_id = null, $popular = false, $user_id = null, $order = true, $requestQuery = null)
    {
        $query = $this->table('Questions')->find();
        if (!empty($question_id)) {
            $query->where(['Questions.id' => $question_id]);
        } elseif (!empty($user_id)) {
            $query->where(['Questions.user_id' => $user_id]);
        } elseif (!empty($business_id)) {
            $query->where(['Questions.business_id' => $business_id]);
        } else {
            // $query->where(['Questions.business_id' => $business_id]);
        }
        return $this->questionQuery($query, $popular, $order, $requestQuery);
    }

    public function setMostHelpfulAnswer($question_id)
    {
        $this->table('Answers')->updateAll(
            ['mosthelpful' => 0], // fields
            ['question_id' => $question_id]
        );
        $most_helpful_answer = $this->answersQuery(null, $question_id)->order(['total_helpful_answers' => "DESC"])->first();
        // dd( $most_helpful_answer);
        if (!empty($most_helpful_answer)) {
            $most_helpful_answer->mosthelpful = true;
            $this->table('Answers')->save($most_helpful_answer);
        }
    }
    public function answersQuery($q =  null, $question_id = null, $user_id = null, $answer_id = null)
    {
        $query = $this->table('Answers')->find();
        if (!empty($q)) {
            $query = $q;
        }
        $query
            ->select(['total_helpful_answers' => $query->func()->count('HelpfulAnswers.id')])
            ->select($this->table('Answers'))
            ->enableAutoFields(true)
            ->group(['Answers.id'])
            ->order(['total_helpful_answers' => 'DESC'])
            ->contain([
                'HelpfulAnswers', "Questions" => ['Businesses' => function ($q) {
                    return $q->contain([
                        'Cities' => function ($q2) {
                            return $q2->contain(['States'])->leftJoinWith('States');
                        },
                        'Users' => function ($q) {
                            return $q->contain(['Cities' => function ($q2) {
                                return $q2->contain(['States'])->leftJoinWith('States');
                            }])->leftJoinWith('Cities');
                        }
                    ])->leftJoinWith('Cities');
                }],
                'UnhelpfulAnswers', 'Users' => function ($q) {
                    return $q->contain(['Cities' => function ($q2) {
                        return $q2->contain(['States'])->leftJoinWith('States');
                    }])->leftJoinWith('Cities');
                }
            ])
            ->leftJoinWith('HelpfulAnswers');

        if (!empty($question_id)) {
            $query->where(['Answers.question_id' => $question_id]);
        }
        if (!empty($user_id)) {
            $query->where(['Answers.user_id' => $user_id]);
        }

        return $query;
    }

    public function cityContains()
    {
        return [
            // 'Users' => function ($q) {
            //     return $q->contain(['Cities' => function ($q2) {
            //         return $q2->contain(['States'])->leftJoinWith('States');
            //     }])->leftJoinWith('Cities');
            // },
            'CitySearches',
            'States'
        ];
    }

    public function reportedPhotosQuery($user_id = null)
    {
        $query = $this->table('PhotoReports')->find();
        $query
            ->contain([
                'BusinessPhotos' => function ($q) {
                    return $this->businessPhotosQuery($q);
                },
                'Users' => function ($q) {
                    return $q->contain(['Cities' => function ($q2) {
                        return $q2->contain(['States'])->leftJoinWith('States');
                    }])->leftJoinWith('Cities');
                }
            ])
            ->leftJoinWith('BusinessPhotos');

        if (!empty($user_id)) {
            $query->where(['PhotoReports.user_id' => $user_id]);
        }

        return $query;
    }

    public function reportedBusinessReviewOwnerReportsQuery($user_id = null)
    {
        $query = $this->table('BusinessReviewOwnerReports')->find();
        $query
            ->contain([
                'BusinessReviews' => function ($q) {
                    return $this->reviewsQuery($q);
                },
                'Users' => function ($q) {
                    return $q->contain(['Cities' => function ($q2) {
                        return $q2->contain(['States'])->leftJoinWith('States');
                    }])->leftJoinWith('Cities');
                }
            ])
            ->innerJoinWith('BusinessReviews');

        if (!empty($user_id)) {
            $query->where(['BusinessReviewOwnerReports.user_id' => $user_id]);
        }

        return $query;
    }

    public function reportedReviewPhotosQuery($user_id = null)
    {
        $query = $this->table('ReviewPhotoReports')->find();
        $query
            ->contain([
                'BusinessReviewPhotos' => [
                    'Users' => function ($q) {
                        return $q->contain(['Cities' => function ($q2) {
                            return $q2->contain(['States'])->leftJoinWith('States');
                        }])->leftJoinWith('Cities');
                    }
                ],
                'Users' => function ($q) {
                    return $q->contain(['Cities' => function ($q2) {
                        return $q2->contain(['States'])->leftJoinWith('States');
                    }])->leftJoinWith('Cities');
                }
            ]);
        // ->leftJoinWith('BusinessPhotos');

        if (!empty($user_id)) {
            $query->where(['ReviewPhotoReports.user_id' => $user_id]);
        }

        return $query;
    }

    public function reportedProfilesQuery($user_id = null)
    {
        $query = $this->table('ProfileReports')->find();
        $query
            ->contain([
                'Users' => function ($q) {
                    return $q->contain(['Cities' => function ($q2) {
                        return $q2->contain(['States'])->leftJoinWith('States');
                    }])->leftJoinWith('Cities');
                },
                'Profiles' => function ($q) {
                    return $q->contain(['Cities' => function ($q2) {
                        return $q2->contain(['States'])->leftJoinWith('States');
                    }])->leftJoinWith('Cities');
                }
            ]);

        if (!empty($user_id)) {
            $query->where(['ProfileReports.user_id' => $user_id]);
        }

        return $query;
    }

    public function reportedQuestionsQuery($user_id = null, $question_id = null)
    {
        $query = $this->table('QuestionReports')->find();
        $query
            ->contain([
                'Questions' => function ($q) {
                    return $this->questionQuery($q);
                },
                'Users' => function ($q) {
                    return $q->contain(['Cities' => function ($q2) {
                        return $q2->contain(['States'])->leftJoinWith('States');
                    }])->leftJoinWith('Cities');
                }
            ])
            ->innerJoinWith('Questions');

        if (!empty($question_id)) {
            $query->where(['QuestionReports.question_id' => $question_id]);
        }
        if (!empty($user_id)) {
            $query->where(['QuestionReports.user_id' => $user_id]);
        }

        return $query;
    }


    public function reportedReviewsQuery($user_id = null, $business_review_id = null)
    {
        $query = $this->table('BusinessReviewReports')->find();
        $query
            ->contain([
                'BusinessReviews' => function ($q) {
                    return $this->reviewsQuery($q);
                },
                'Users' => function ($q) {
                    return $q->contain(['Cities' => function ($q2) {
                        return $q2->contain(['States'])->leftJoinWith('States');
                    }])->leftJoinWith('Cities');
                }
            ])
            ->innerJoinWith('BusinessReviews');

        if (!empty($question_id)) {
            $query->where(['BusinessReviewReports.business_review_id' => $business_review_id]);
        }
        if (!empty($user_id)) {
            $query->where(['BusinessReviewReports.user_id' => $user_id]);
        }

        return $query;
    }

    public function reportedAnswersQuery($user_id = null, $question_id = null)
    {
        $query = $this->table('AnswerReports')->find();
        $query
            ->contain([
                'Answers' => function ($q) {
                    return $this->answersQuery($q);
                },
                'Users' => function ($q) {
                    return $q->contain(['Cities' => function ($q2) {
                        return $q2->contain(['States'])->leftJoinWith('States');
                    }])->leftJoinWith('Cities');
                }
            ])
            ->leftJoinWith('Answers');

        if (!empty($question_id)) {
            $query->where(['AnswerReports.question_id' => $question_id]);
        }
        if (!empty($user_id)) {
            $query->where(['AnswerReports.user_id' => $user_id]);
        }

        return $query;
    }


    public function getAnswersLogic($question_id)
    {

        $query = $this->answersQuery(null, $question_id);

        $empty_result = false;
        $showAnswersPagination = true;
        try {
            $answers_total_count = $query->count();
            $answers = $this->getController()->paginate($query, ['limit' => $this->limit]);

            if ($answers_total_count <= $this->limit) {
                $showAnswersPagination = false;
            }

            if (empty($review_total_count)) {
                $empty_result = true;
            }

            // dd($question_id);
            // dd($query->toArray());
        } catch (\Cake\Http\Exception\NotFoundException $e) {

            $this->paginateExceptionHandler('Answers');
        }
        $this->getController()->set(compact('answers', 'empty_result', 'answers_total_count', 'showAnswersPagination', 'tips'));
    }



    public function truncate($string, $length = 100, $ellipsis = false)
    {
        return $this->Cu->truncate($string, $length, $ellipsis);
    }


    public function getReviewOptions($category =  null)
    {
        $ids = [];
        if (!empty($category) and $category->id == 97) { //restaurant
            //$result = ['Food', 'Value', 'Location', 'Service', 'Atmosphere'];
            $ids = [1, 2, 3, 4, 5];
        }
        if (!empty($category) and $category->id == 112) { //vacation rentals
            // $result = [' Value', 'Location', 'Service', 'Sleep Quality', 'Atmosphere'];
            $ids = [2, 3, 4, 5, 7];
        }
        if (!empty($category) and $category->id == 63) { //hotels and motels
            // $result = ['Value', 'Location', 'Service', 'Sleep Quality', 'Atmosphere'];
            $ids = [1, 2, 3, 4, 5, 7];
        }
        if (empty($ids)) {
            // $result = ['Fun', 'Value', 'Location', 'Service', 'Atmosphere'];
            $ids = [6, 2, 3, 4, 5];
        }
        return $this->table('ReviewOptions')->find()->where(['id IN' => $ids])->toArray();
    }


    public function uploadFileLaminas($file, $folder, $folder2 = null)
    {
        //https://github.com/php-fig/http-message/blob/master/src/UploadedFileInterface.php
        //https://docs.laminas.dev/laminas-diactoros/v2/api/#uploadedfile
        $response = ["success" => false, "message" => "", "filename" => "", 'size' => $file->getSize()];

        if (empty($file->getSize())) {
            return $response;
        }

        $fileName = $file->getClientFilename();
        // $type = $file->getClientMediaType(); 
        // $stream = $file->getStream(); 
        // $size = $file->getSize(); 
        $ext = substr(strtolower(strrchr($fileName, '.')), 1); //get the extension
        $arr_ext = array('jpg', 'jpeg', 'gif', 'png', 'pdf'); //set allowed extensions
        $setNewFileName = date("YFj") . "_" . rand(000000, 999999);
        if (in_array($ext, $arr_ext)) {
            if (!file_exists(WWW_ROOT  . "uploads" . DS . $folder)) {
                mkdir(WWW_ROOT .  "uploads" . DS . $folder, 0777, true);
            }
            $save_dir =  WWW_ROOT .  "uploads" . DS . $folder;
            $full_path = $save_dir . DS . $setNewFileName . '.' . $ext;
            $file->moveTo($full_path);
            $imageFileName = $setNewFileName . '.' . $ext;
            $response['success'] = true;
            $response['filename'] = $imageFileName;
            $response['full_path'] = $full_path;
            $response['save_dir'] = $save_dir;

            if (!empty($folder2)) {
                if (!file_exists(WWW_ROOT  . "uploads" . DS . $folder2)) {
                    mkdir(WWW_ROOT .  "uploads" . DS . $folder2, 0777, true);
                }
                $save_dir2 =  WWW_ROOT .  "uploads" . DS . $folder2;
                $full_path2 = $save_dir2 . DS . $setNewFileName . '.' . $ext;
                if (copy($full_path, $full_path2)) {
                    $response['copied'] = true;
                }
                $response['full_path2'] = $full_path2;
                $response['save_dir2'] = $save_dir2;
            }
        } else {
            $response['message'] = "File Extension not supported";
        }
        return $response;
    }
    public function userContains()
    {
        return [
            // "Cities" => function ($q) {
            //     return $q->contain(['States'])->leftJoinWith('States');
            // },
            'Collections', 'BusinessPhotos', 'BusinessReviews' => function ($q) {
                return $this->reviewsQuery($q);
            }, 'Collections', 'Questions' => function ($q) {
                return $this->questionQuery($q);
            }
        ];
    }


    public function businessContains()
    {
        return ["Cities" => function ($q) {
            return $q->contain(['States'])->leftJoinWith('States');
        }, "Categories", "Users", "Sic2categories", "Sic4categories", "Sic8categories", 'BusinessRoles'];
    }

    public function uploadBase64File($file, $folder)
    {
        list($type, $uploaded_file) = explode(';', $file);
        list(, $uploaded_file) = explode(',', $uploaded_file);
        $file_data = base64_decode($uploaded_file);

        // Get file mime type
        $finfo = finfo_open();
        $file_mime_type = finfo_buffer($finfo, $file_data, FILEINFO_MIME_TYPE);

        // File extension from mime type
        if ($file_mime_type == 'image/jpeg' || $file_mime_type == 'image/jpg') {
            $file_type = 'jpeg';
        } else if ($file_mime_type == 'image/png') {
            $file_type = 'png';
        } else if ($file_mime_type == 'image/gif') {
            $file_type = 'gif';
        } else if ($file_mime_type == 'application/pdf') {
            $file_type = 'pdf';
        } else {
            $file_type = 'other';
        }

        $setNewFileName = date("YFj") . "_" . rand(000000, 999999);
        // // Validate type of file
        if (in_array($file_type, ['jpeg', 'png', 'gif'])) {
            // Set a unique name to the file and save
            // $file_name = uniqid() . '.' . $file_type;
            $file_name = $setNewFileName . '.' . $file_type;

            if (!file_exists(WWW_ROOT . DS . "uploads" . DS . $folder)) {
                mkdir(WWW_ROOT . DS . "uploads" . DS . $folder, 0777, true);
            }

            if (file_put_contents(WWW_ROOT . "uploads" . DS . $folder . DS . $file_name, $file_data)) {
                return $file_name;
            }
        }
        return false;
    }

    public function uploadFile($file, $folder)
    {
        // $file = $this->getController()->getRequest()->data['image']; //put the data into a var for easy use

        //debug($file); die();
        $response = [
            "success" => false,
            "message" => "",
            "filename" => ""
        ];

        if (!empty($file['name'])) {

            $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
            $arr_ext = array('jpg', 'jpeg', 'gif', 'png', 'pdf'); //set allowed extensions
            $setNewFileName = date("YFj") . "_" . rand(000000, 999999);

            //only process if the extension is valid
            if (in_array($ext, $arr_ext)) {

                if (!file_exists(WWW_ROOT . DS . "uploads" . DS . $folder)) {
                    mkdir(WWW_ROOT . DS . "uploads" . DS . $folder, 0777, true);
                }

                //do the actual uploading of the file. First arg is the tmp name, second arg is

                //where we are putting it, //move_uploaded_file returns true on success
                if (move_uploaded_file($file['tmp_name'], WWW_ROOT . DS . "uploads" . DS . $folder . DS . $setNewFileName . '.' . $ext)) {

                    //then we can prepare the filename for database entry
                    $imageFileName = $setNewFileName . '.' . $ext;
                    $response['success'] = true;
                    $response['filename'] = $imageFileName;
                } else {
                    $response['message'] = "Could not upload file";
                }
            } else {
                $response['message'] = "File Extension not supported";
            }
        } else {
            // $this->Flash->error('No file uploaded');
            $response['message'] = "No file selected";
        }
        return $response;
    }

    public function getDp($image_url, $folder = null, $size = null)
    {
        return $this->Cu->dpUrl($image_url, $folder, $size);
    }

    public function addUserActivity($data)
    {
        $activity = $this->table('UserActivities')->newEmptyEntity();
        $activity = $this->table('UserActivities')->patchEntity($activity, $data);
        if ($this->table('UserActivities')->save($activity)) {
            return true;
        }
        //debug($notification);die();
        return false;
    }

    public function doLog($filename, $data = [])
    {
        $file = new File(LOGS . DS . $filename, true, 0644);
        if (!empty($data)) {
            if (is_array($data)) {
                $data = json_encode($data);
            }
            $file->append($data);
        } else {
            $file->append(json_encode($this->getController()->getRequest()->getQuery()));
        }
        $file->append("-----------------------------------------------------------/r/n");
    }


    public function escapeString($str)
    {
        $conn = \Cake\Datasource\ConnectionManager::get('default')->config();
        $mysqli = new \mysqli($conn['host'], $conn['username'], $conn['password'], $conn['database']);
        $search_term = mysqli_real_escape_string($mysqli, $str);

        return $search_term;
    }


    public function cleanQuery($data)
    {
        $arr = [];
        foreach ($data as $key => $value) {
            $newKey = str_replace("amp;", "", $key);
            $newKey = str_replace("__", "", $newKey);
            $arr[$newKey] = $value;
        }
        return $arr;
    }

    public function getTags($city_id = null)
    {
        return $this->table('Tags')->find()->leftJoinWith('Cities')
            ->where(['Cities.id' => $city_id])->toArray();
    }
    public function getLatestPosts($city_id = null, $limit = 5)
    {
        return $this->getPost(null, null, $city_id)->limit($limit);
    }
    public function getPost($tagslug = null, $id = null, $city_id = null)
    {

        $conditions = [];
        $query =  $this->table('Posts')->find();
        if (!empty($city_id)) {
            $query->where(['Posts.city_id' => $city_id]);
        }
        if (!empty($id)) {
            $query->andWhere(['Posts.id' => $id]);
        }
        if (!empty($tagslug)) {
            $tag = $this->table('Tags')->find()
                ->where(['slug' => $tagslug, 'city_id' => $city_id])->first();
            if (!empty($tag)) {
                $query->innerJoinWith('Tags', function ($q) use ($tag) {
                    return $q->where(['Tags.id' => $tag->id]);
                });
            }
        }

        $query->contain(['Tags', 'Users'])
            ->order(['Posts.created' => 'DESC'])
            ->distinct(['Posts.id'])
            ->enableAutoFields(true);

        return $query;
    }


    public function getPostsLogic($tagslug = null, $city_id = null)
    {

        $query = $this->getPost($tagslug, null, $city_id);
        // dd($query->toArray());
        $empty_result = false;
        $showPostsPagination = true;
        $posts_total_count = null;
        try {
            $posts_total_count = $query->count();
            $posts = $this->getController()->paginate($query, ['limit' => $this->limit]);
            if ($posts_total_count <= $this->limit) {
                $showPostsPagination = false;
            }

            if (empty($posts_total_count)) {
                $empty_result = true;
            }
        } catch (\Cake\Http\Exception\NotFoundException $e) {
            $this->paginateExceptionHandler('Posts');
        }
        $this->getController()->set(compact('empty_result', 'posts_total_count', 'showPostsPagination', 'posts'));
    }

    public function getCityByQueryString($requestQuery, $city_name = null, $state_name = null)
    {
        if (empty($city_name) and empty($state_name)) {

            $requestQuery = $this->cleanQuery($requestQuery);
            $loc = isset($requestQuery['location']) ? $requestQuery['location'] : (isset($requestQuery['loc']) ? $requestQuery['loc'] : "");
            $city_name = "";
            if (strpos($loc, ",") !== false) {
                $city_name = explode(",", $loc)[0];
                $state_name = explode(",", $loc)[1];
            } elseif (strpos($loc, "-")  !== false) {
                $city_name = explode("-", $loc)[0];
                $state_name = explode("-", $loc)[1];
            } else {
                $city_name = explode(", ", $loc)[0];
                $state_name = explode(", ", $loc)[1];
            }
            $state_name = trim(strtoupper($state_name));
        }
        // $this->doLog('city_name', $city_name);
        // $this->doLog('state_name', $state_name);
        // $this->doLog('request', $requestQuery);

        $cityQuery = $this->table('Cities')->find()
            // ->where(['LOWER(Cities.name) LIKE' => "%" . $city_name . "%"])
            ->where([
                'OR' => [
                    ['LOWER(Cities.name) LIKE' => "%" . strtolower($city_name) . "%"],
                    ["MATCH(Cities.name) AGAINST('{$city_name}' IN BOOLEAN MODE)"],
                ],
            ])
            ->andWhere(['States.code' => $state_name])
            ->contain(['States'])->first();
        // dd($cityQuery);
        // $this->doLog('city1.txt', $cityQuery);
        return $cityQuery;
    }
    public function postsFullTextQuery($search_term)
    {
        return [
            ["MATCH(Posts.title) AGAINST('{$search_term}'IN BOOLEAN MODE)"],
            ['LOWER(Posts.title) LIKE' => "%" . $search_term . "%"],
        ];
    }

    public function recommendLogic($review = null, $requestQuery = null)
    {

        // $recommend = !empty($review) ? $review->recommend : false;
        // $positive_recommendation =  $recommend ? $recommend : false;

        $recommend = false;
        $positive_recommendation =  false;
        if (isset($requestQuery['recommend'])) {
            $recommend = true;
            if ($requestQuery['recommend'] == "no") {
                $positive_recommendation =  false;
            }
            if ($requestQuery['recommend'] == "yes") {
                $positive_recommendation =  true;
            }
        }
        // dd($recommend);
        $this->getController()->set('recommend', $recommend);
        $this->getController()->set('positive_recommendation', $positive_recommendation);
    }


    public function citesFullTextQuery($search_term, $model = "Cities")
    {
        return [
            // ["MATCH(" . $model . ".name) AGAINST('{$search_term}'IN BOOLEAN MODE)"],
            ['LOWER(' . $model . '.name) LIKE' => "%" . strtolower($search_term) . "%"],
            // ["MATCH(" . $model . ".county) AGAINST('{$search_term}'IN BOOLEAN MODE)"],
            ['LOWER(' . $model . '.county) LIKE' => "%" . strtolower($search_term) . "%"],
        ];
    }
    public function catFullTextQuery($search_term, $model = "Categories")
    {
        return [
            ["MATCH(" . $model . ".name) AGAINST('{$search_term}'IN BOOLEAN MODE)"],
            ['LOWER(' . $model . '.name) LIKE' => "%" . $search_term . "%"],
        ];
    }
    public function filtersFullTextQuery($search_term, $model = "Filters")
    {
        return [
            ["MATCH(" . $model . ".name) AGAINST('{$search_term}'IN BOOLEAN MODE)"],
            ['LOWER(' . $model . '.name) LIKE' => "%" . $search_term . "%"],
        ];
    }
    public function subcatFullTextQuery($search_term, $model = "Subcategories")
    {
        return [
            ["MATCH(" . $model . ".name) AGAINST('{$search_term}'IN BOOLEAN MODE)"],
            ['LOWER(' . $model . '.name) LIKE' => "%" . $search_term . "%"],
        ];
    }
    public function statesFullTextQuery($search_term, $model = "States")
    {
        return [
            // ["MATCH(" . $model . ".name) AGAINST('{$search_term}'IN BOOLEAN MODE)"],
            ['LOWER(' . $model . '.name) LIKE' => "%" . $search_term . "%"],
        ];
    }
    public function filterContains()
    {
        return ['SearchKeywords', 'Categories', 'FormTypes', 'Sic2categories', 'Sic4categories', 'Sic8categories', 'Subcategories', 'BusinessAdditionals'];
    }

    public function getFilterCats($filters, $catproperty)
    {
        $property_ids = [];
        if (!empty($filters)) {
            foreach ($filters as $key => $filter) {

                if (!empty($filter->$catproperty)) {
                    foreach ($filter->$catproperty as $key => $value) {
                        if (!in_array($value->id, $property_ids)) {
                            $property_ids[] = $value->id;
                        }
                    }
                }
            }
        }

        return $property_ids;
    }
    public function businessFullTextQuery($search_term, $model = "Businesses")
    {
        return [
            ["MATCH(" . $model . ".name) AGAINST('{$search_term}'IN BOOLEAN MODE)"],
            ['LOWER(' . $model . '.name) LIKE' => "%" . $search_term . "%"],
        ];
    }
    public function couponFullTextQuery($search_term, $model = "Coupons")
    {
        return [
            ["MATCH(" . $model . ".code) AGAINST('{$search_term}'IN BOOLEAN MODE)"],
            ['LOWER(' . $model . '.code) LIKE' => "%" . $search_term . "%"],
        ];
    }
    public function subscriptionsQuery()
    {
        return $this->table('Subscriptions')->find('all')
            ->contain(['Businesses' => $this->bizContains(), 'Coupons', 'Packages']);
    }
    public function citySubscriptionsQuery()
    {
        return $this->table('CitySubscriptions')->find('all')
            ->contain(['Users' => $this->userContains(), 'CitySubscriptionCities.Cities']);
    }

    public function addReminder($business_id, $status_id, $reminder_schedule_id = 3)
    {
        $reminder = $this->table('Reminders')->find()->where(['active' => false])->first();
        if (empty($reminder)) {
            $reminder = $this->table('Reminders')->newEmptyEntity();
        }
        $reminder->business_id = $business_id;
        $reminder->active = true;
        // $reminder->number_of_times = 10;
        $reminder->reminder_status_id = $status_id;
        $reminder->reminder_schedule_id = $reminder_schedule_id;
        if ($this->table('Reminders')->save($reminder)) {
            return true;
        }
        return false;
    }

    public function remindersQuery()
    {
        return $this->table('Reminders')->find('all')
            ->contain(['Businesses' => $this->bizContains(), 'ReminderStatuses', 'ReminderSchedules']);
    }

    public function packagesFullTextQuery($search_term, $model = "Packages")
    {
        return [
            ["MATCH(" . $model . ".name) AGAINST('{$search_term}'IN BOOLEAN MODE)"],
            ['LOWER(' . $model . '.name) LIKE' => "%" . $search_term . "%"],
        ];
    }

    public function businessReviewsFullTextQuery($search_term, $model = "BusinessReviews")
    {
        return [
            ["MATCH(" . $model . ".title) AGAINST('{$search_term}'IN BOOLEAN MODE)"],
            ['LOWER(' . $model . '.title) LIKE' => "%" . $search_term . "%"],
            ["MATCH(" . $model . ".advice) AGAINST('{$search_term}'IN BOOLEAN MODE)"],
            ['LOWER(' . $model . '.advice) LIKE' => "%" . $search_term . "%"],
        ];
    }

    public function userFullTextQuery($search_term, $model = "Users")
    {
        return [
            ["MATCH(" . $model . ".username) AGAINST('{$search_term}'IN BOOLEAN MODE)"],
            ["MATCH(" . $model . ".email) AGAINST('{$search_term}'IN BOOLEAN MODE)"],
            ["MATCH(" . $model . ".firstname) AGAINST('{$search_term}'IN BOOLEAN MODE)"],
            ["MATCH(" . $model . ".lastname) AGAINST('{$search_term}'IN BOOLEAN MODE)"],
            ['LOWER(' . $model . '.username) LIKE' => "%" . $search_term . "%"],
            ['LOWER(' . $model . '.email) LIKE' => "%" . $search_term . "%"],
            ['LOWER(' . $model . '.firstname) LIKE' => "%" . $search_term . "%"],
            ['LOWER(' . $model . '.lastname) LIKE' => "%" . $search_term . "%"],
            ['LOWER(' . $model . '.othername) LIKE' => "%" . $search_term . "%"],
            ['LOWER(' . $model . '.phone) LIKE' => "%" . $search_term . "%"],
            ['LOWER(' . $model . '.uniqueid) LIKE' => "%" . $search_term . "%"],
        ];
    }

    public function makeUsername($firstname, $lastname)
    {
        $userName =  $this->Cu->makeUsername($firstname, $lastname);
        // dd($userName);
        $check = $this->table('Users')->find()->where(['username' => $userName])->first();
        if (empty($check)) {
            return $userName;
        }
        return $this->Cu->makeUsername($firstname, $lastname, true);
    }

    public function getCityByOptions($user = null, $queryStr = null)
    {
        $location = $this->getController()->currentLocation;
        if (!empty($this->getController()->Authentication->getIdentity()) and !empty($user->city_id)) {
            $city = $this->getCity($user->city_id);
        } else {
            // dd($this->currentLocation['region']);
            $city = $this->getCityByQueryString($queryStr, $location['city'], $location['region']);
        }
        return $city;
    }
    public function newUser($data)
    {
        $response = [
            "success" => false,
            "user" => ""
        ];
        $user = $this->table('Users')->newEmptyEntity();
        $user = $this->table('Users')->patchEntity($user, $data);
        // $user->username = trim(strtolower(str_replace(" ", "", $user->firstname) . "." . str_replace(" ", "", $user->lastname)));
        $user->username = $this->makeUsername($user->firstname, $user->lastname);
        $user->uniqueid = date("ymd") . $this->randomString(6);
        // $user->registration_snapshot = json_encode($user->toArray());

        $city = $this->getCityByQueryString(null, $this->getController()->currentLocation['city'], $this->getController()->currentLocation['region']);

        $user->city_id = $city ? $city->id : null;

        $uniquecode = substr(md5(microtime()), 0, 10); //generate random string
        $user->email_verification_token = $uniquecode;

        if ($this->table('Users')->save($user)) {
            $response['message'] = 'Registration was successful.';
            $this->Flash->success(__('Welcome to Local Inspire. We\'re glad to have you..'));
            $response['success'] = true;
            $user->image = $this->getDp($user->image, 'users', '350x250');
            $response['user'] = $user;
            // $this->Auth->setUser($user);
            // $this->Notify->newUser($user);

            // $uniquecode = substr(md5(microtime()), 0, 10); //generate random string
            // $aLink = $this->Cu->getActivationLink() . $uniquecode . "/" . $user->uniqueid;
            // $this->Cu->SendActivationAndWelcomeMail($user->toArray(), $aLink);
        } else {
            $response['message'] = 'Something went wrong. Please, try again.';
            $errors = $user->getErrors();
            if (!empty($errors)) {
                $message = "";
                foreach ($errors as $key2 => $value2) {
                    $message = reset($value2);
                }
                $response['message'] = $message;
            }
        }

        // $response['user'] = $user;

        return $response;
    }

    public function saveUserEmail($data, $verified = false)
    {
        $timeout = time() + DAY;
        $user_email = $this->table('UserEmails')->find()->where(['email' => $data['email']])->first();
        if (empty($user_email)) {
            $user_email = $this->table('UserEmails')->newEmptyEntity();
        }
        $user_email->user_id = $this->getController()->Authentication->getIdentity()->getIdentifier();
        $user_email->email = $data['email'];
        $user_email->token = $verified ? "" : date("ymd") . $this->randomString(6);
        $user_email->timeout =  $verified ? "" : $timeout;
        $user_email->passkey =  $verified ? "" : uniqid();
        $user_email->verified =  $verified;
        if ($this->table('UserEmails')->save($user_email)) {
            return $user_email;
        }
        return false;
    }

    public function sendConfirmationEmail($user, $user_email = false)
    {
        // $url = \Cake\Routing\Router::Url(['prefix'=>false,'controller' => 'account', 'action' => 'confirmEmail'], true) . '/' . $passkey;
        // $email = $this->Cu->sendResetEmail($url, $user_email->toArray());
        return true;
    }
    public function sendUserEmail($user, $data)
    {
        // $url = \Cake\Routing\Router::Url(['prefix'=>false,'controller' => 'account', 'action' => 'confirmEmail'], true) . '/' . $passkey;
        // $email = $this->Cu->sendResetEmail($url, $user_email->toArray());
        return true;
    }

    public function getBusinessPhotoUrl($business, $share = false)
    {
        return $this->Cu->getBusinessPhotoUrl($business, $share);
    }
    public function saveMergeRequest($data)
    {
        $merge = $this->table('Merges')->find()->where(['user_id' => $data['user_id'], 'merge_user_id' => $data['merge_user_id']])->first();
        if (empty($merge)) {
            $merge = $this->table('Merges')->newEmptyEntity();
        }
        $merge->user_id = $data['user_id'];
        $merge->merge_user_id = $data['merge_user_id'];
        $merge->token = date("ymd") . strtolower($this->randomString(50));
        $merge->passkey = uniqid();
        $merge->link =  \Cake\Routing\Router::Url(['prefix' => false, 'controller' => 'account', 'action' => 'merge',  $merge->passkey,  $merge->token], true);
        if ($this->table('Merges')->save($merge)) {
            return $merge;
        }
        return false;
    }

    public function sendMergeEmail($user, $merge_email = false)
    {
        // $url = \Cake\Routing\Router::Url(['prefix'=>false,'controller' => 'account', 'action' => 'confirmEmail'], true) . '/' . $passkey;
        // $email = $this->Cu->sendResetEmail($url, $user_email->toArray());
        return true;
    }

    public function mergeAccount($mergeRequest)
    {
        //models to merge
        $models = $this->table('Users')->associations()->keys();
        if (!empty($models)) {
            foreach ($models as $key => $model) {
                $checkEntity = $this->table($model)->newEmptyEntity();
                if ($checkEntity->accessible("user_id")) {
                    $entities = $this->table($model)->find()->where(['user_id' => $mergeRequest->merge_user_id])->toArray();
                    if (!empty($entities)) {
                        foreach ($entities as $entity) {
                            // if (property_exists($entity, "user_id")) {
                            $entity->user_id = $mergeRequest->user_id;
                            $this->table($model)->save($entity);
                            // }
                        }
                    }
                }
            }
        }

        $merge_user = $this->getUser($mergeRequest->merge_user_id);
        $mergeRequest->merged = true;
        $mergeRequest->deleted_user = json_encode($merge_user);
        $this->table('Merges')->save($mergeRequest);
        $this->table('Users')->delete($merge_user);
        return true;
    }



    public function cakeTime($time)
    {
        $time = new Time($time);
        return $time->timeAgoInwords();
    }

    public function cakeTime2($time)
    {
        $time = new Time($time);
        return $time->i18nFormat('yyyy-MM-dd HH:mm');
        // return $time->i18nFormat('yyyy-MM-dd HH:mm:ss');
    }

    //find and replace last occurence in string
    public function str_lreplace($search, $replace, $subject)
    {
        $pos = strrpos($subject, $search);
        if ($pos !== false) {
            $subject = substr_replace($subject, $replace, $pos, strlen($search));
        }
        return $subject;
    }
    /*
     * Create a random string
     * @author    XEWeb <>
     * @param $length the length of the string to create
     * @return $str the string
     */
    public function randomString($length = 6)
    {
        $str = "";
        $characters = array_merge(range('A', 'Z'));
        // $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }

    public function generateRandomAlphanumeric($size)
    {
        $alpha_key = '';
        $keys = range('A', 'Z');

        for ($i = 0; $i < 2; $i++) {
            $alpha_key .= $keys[array_rand($keys)];
        }

        $length = $size - 2;

        $key = '';
        $keys = range(0, 9);

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $alpha_key . $key;
    }
}
