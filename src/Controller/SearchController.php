<?php
// /declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;

/**
 * Search Controller
 *
 */
class SearchController extends AppController
{
    public $limit = 24;
    public function initialize(): void
    {
        parent::initialize();
        $this->Authentication->allowUnauthenticated(['index']);
        $this->set('page', "search");
        $this->set('limit', $this->limit);
        // if ($this->shouldBeSecure()) {
        //     $this->Security->setConfig('unlockedActions', [
        //         'index'
        //     ]);
        // }
    }

    public function index()
    {

        $requestQuery = $this->Custom->cleanQuery($this->request->getQuery());
        $search_term = isset($requestQuery['find']) ? $requestQuery['find'] : "";
        $loc = isset($requestQuery['location']) ? $requestQuery['location'] : "";
        $subcat_filters = isset($requestQuery['filters']) ? explode(',', $requestQuery['filters']) : [];
        $radius = isset($requestQuery['radius']) ? $requestQuery['radius'] : 20;
        $mergeQuery = [];
        $cityQuery = [];
        $catsQuery = [];
        $distanceQuery = [];

        // dd($this->currentLocation);
        $query = $this->table('Businesses')->find()
            ->select($this->table('Businesses'))
            ->contain($this->Custom->businessContains())
            ->leftJoinWith('Sic8categories')
            ->leftJoinWith('Categories')
            ->leftJoinWith('Subcategories')
            // ->leftJoinWith('BusinessPhotos')
            ->leftJoinWith('Cities')
            ->distinct('Businesses.id');

        // debug($subcat_filters);
        $city = null;

        $keyword = $this->table('SearchKeywords')->find()
            ->where(['SearchKeywords.name' => $search_term])
            ->contain(['Filters' => function ($q) {
                return $q
                    ->where(['Filters.show_filter' => true])
                    ->order(['Filters.key_order' => 'ASC'])
                    // ->limit(15)
                    ->contain(['Subcategories', 'FormTypes']);
            }])->first();

        // $filters = $this->table('Filters')->find()
        //     ->where(['Filters.show_filter' => true])
        //     ->contain($this->Custom->filterContains())
        //     ->order(['Filters.key_order' => 'ASC'])->toArray();
        // $chunksize = round(count($filters) / 3);
        $filters = null;
        $chunksize = null;


        $sicQuery = [
            ["MATCH(Sic8categories.name) AGAINST('{$search_term}' IN BOOLEAN MODE)"],
            ['LOWER(Sic8categories.name) LIKE' => "%" . strtolower($search_term) . "%"],
        ];
        $subcatQuery = [
            ["MATCH(Subcategories.name) AGAINST('{$search_term}' IN BOOLEAN MODE)"],
            ['LOWER(Subcategories.name) LIKE' => "%" . strtolower($search_term) . "%"],
        ];
        // }
        // dd($keyword->filters);

        if (!empty($keyword->filters)) {
            $filters = $keyword->filters;
            $chunksize = round(count($filters) / 3);
        } else {
            $query2 = $this->table('Businesses')->find()
                ->select($this->table('Businesses'))
                ->contain($this->Custom->businessContains())
                ->leftJoinWith('Sic8categories');
            $searched_businesses_sic4 = $query2->where([
                'OR' => $sicQuery,
            ])->toArray();
            // dd($searched_businesses_sic4);
            $businesses_sic4 = [];
            if (!empty($searched_businesses_sic4)) {
                foreach ($searched_businesses_sic4 as $key => $business) {
                    if (!in_array($business->sic4category_id, $businesses_sic4)) {
                        $businesses_sic4[] = $business->sic4category_id;
                    }
                }
                // dd($businesses_sic4);
                $keywords = $this->table('SearchKeywords')->find()
                    ->where(['sic4category_id IN ' => $businesses_sic4])->contain(['Filters' => function ($q) {
                        return $q
                            ->where(['Filters.show_filter' => true])
                            ->order(['Filters.key_order' => 'ASC'])
                            // ->limit(15)
                            ->contain(['Subcategories', 'FormTypes']);
                    }])->toArray();

                $keywords_ids = [];
                if (!empty($keywords)) {
                    foreach ($keywords as $key => $keyword) {
                        if (!in_array($keyword->id, $keywords_ids)) {
                            $keywords_ids[] = $keyword->id;
                        }
                    }
                    $filters = $this->table('Filters')->find()
                        ->where(['Filters.show_filter' => true, 'Filters.search_keyword_id IN ' => $keywords_ids])
                        ->contain($this->Custom->filterContains())
                        ->distinct('Filters.id')
                        ->order(['Filters.key_order' => 'ASC'])->toArray();

                    // dd($filters);
                    $chunksize = round(count($filters) / 3);
                }
            }
        }


        if (!empty($loc)) {

            $cityDb = $this->Custom->getCityByQueryString($this->request->getQuery());
            // $this->Custom->doLog('city2.txt', $cityDb);

            if (!empty($cityDb)) {

                $this->set('city', $cityDb);

                $citySearch = $this->table('CitySearches')->find()->where(['city_id' => $cityDb->id])->first();
                if (!empty($citySearch)) {
                    $citySearch->count = $citySearch->count + 1;
                    $this->table('CitySearches')->save($citySearch);
                } else {
                    if (!empty($this->Authentication->getIdentity())) {
                        $citySearch = $this->table('CitySearches')->newEmptyEntity();
                        $citySearch->user_id = $this->Authentication->getIdentity()->getIdentifier();
                        $citySearch->city_id = $city->id;
                        $citySearch->count = 1;
                        $this->table('CitySearches')->save($citySearch);
                    }
                }

                $cities_ids = $this->Custom->getNearbyCities($cityDb, $radius);

                $query->where(['Businesses.city_id IN' => $cities_ids]);
            }
        }



        // dd($query->where([
        //     'OR' => $sicQuery,
        // ])->toArray());

        $filtered_cat_ids = [];
        if (!empty($filters)) {
            foreach ($filters as $key => $filter) {
                if (!in_array($filter->category_id, $filtered_cat_ids)) {
                    $filtered_cat_ids[] = $filter->category_id;
                }
            }
            // $query->innerJoinWith('Categories', function ($q) use ($filtered_cat_ids) {
            //     return $q->where(['Categories.id IN' => $filtered_cat_ids]);
            // });

        }

        if (!empty($filtered_cat_ids)) {
            $catsQuery = [
                ['Categories.id IN' => $filtered_cat_ids],
            ];
        }


        $filter_sci2ids = $this->Custom->getFilterCats($filters, "sic2categories");
        $filter_sci4ids = $this->Custom->getFilterCats($filters, "sic4categories");
        $filter_sci8ids = $this->Custom->getFilterCats($filters, "sic8categories");

        $sci2Query = [];
        if (!empty($filter_sci2ids)) {
            $sci2Query = [
                ['Businesses.sic2category_id IN' => $filter_sci2ids],
            ];
        }

        $sci4Query = [];
        if (!empty($filter_sci4ids)) {
            $sci4Query = [
                ['Businesses.sic4category_id IN' => $filter_sci4ids],
            ];
        }

        $sci8Query = [];
        if (!empty($filter_sci8ids)) {
            $sci8Query = [
                ['Businesses.sic8category_id IN' => $filter_sci8ids],
            ];
        }



        // $mergeQuery = array_merge($cityQuery, $catsQuery);
        // $mergeQuery = array_merge($sicQuery, $cityQuery, $sci2Query, $sci4Query, $sci8Query, $distanceQuery);
        $mergeQuery = array_merge($catsQuery, $subcatQuery, $sicQuery, $sci2Query, $sci4Query, $sci8Query);
        // $mergeQuery = array_merge($sicQuery);

        if (!empty($mergeQuery)) {
            $query->where([
                'OR' => $mergeQuery,
            ]);
        }

        $filtered_subcategories = [];
        if (!empty($subcat_filters)) {
            foreach ($subcat_filters as $key => $value) {
                $sc = $this->table('Subcategories')->find()->where(['name' => $value])->toArray();
                if (!empty($sc)) {
                    foreach ($sc as $key => $value) {
                        $filtered_subcategories[] = $value;
                    }
                }
            }
        }
        $this->set('filtered_subcategories', $filtered_subcategories);

        $filtered_subcat_ids = [];
        if (!empty($filtered_subcategories)) {
            foreach ($filtered_subcategories as $key => $value) {
                if (!in_array($value->id, $filtered_subcat_ids)) {
                    $filtered_subcat_ids[] = $value->id;
                }
            }

            //belongsToMany, can also use innerJoinWith if you don't intend to load associated data, matching loads associated data
            $query->innerJoinWith('Subcategories', function ($q) use ($filtered_subcat_ids) {
                return $q->where(['Subcategories.id IN' => $filtered_subcat_ids]);
            });
        }

        $filtered_additionals = [];
        $ranges_additionals = [];

        if (!empty($requestQuery)) {
            foreach ($requestQuery as $key => $value) {
                $filters_search1 = $this->table('Filters')->find()->where(['name' => $key])->toArray();
                if (!empty($filters_search1)) {
                    foreach ($filters_search1 as $key2 => $value2) {
                        $value2->value = $value;
                        $filtered_additionals[] = $value2;
                    }
                }

                if (strpos($key, "range-")  !== false) {
                    // debug($key);
                    $name = trim(str_replace("_", " ", $key));
                    $name = trim(str_replace("range-", "", $name));
                    $exploded = explode("-", $value);

                    $filters_search2 = $this->table('Filters')->find()->where(['name' => $name])->toArray();
                    if (!empty($filters_search2)) {
                        foreach ($filters_search2 as $key3 => $value3) {
                            $value3->value = !empty($exploded[0]) ? $exploded[0] : "";
                            $value3->value2 = !empty($exploded[1]) ? $exploded[1] : "";
                            $ranges_additionals[] = $value3;
                        }
                    }
                }
            }
            // dd($filtered_additionals);
        }


        if (!empty($filtered_additionals)) {

            // $filtered_addtionals_ids = [];
            $filtered_addtionals_values = [];
            foreach ($filtered_additionals as $key => $value) {
                if (!in_array($value->id, $filtered_subcat_ids)) {
                    $search_value = $this->Custom->escapeString($value->value);
                    // $filtered_addtionals_ids[] = $value->id;
                    $filtered_addtionals_values[] = ['LOWER(BusinessAdditionals.value) LIKE' => "%" . $search_value . "%"];
                    $filtered_addtionals_values[] = ["MATCH(BusinessAdditionals.value) AGAINST('{$search_value}' IN BOOLEAN MODE)"];
                }
            }
            if (!empty($filtered_subcat_ids)) {
                $filtered_addtionals_values[] = ['BusinessAdditionals.filter_id IN' => $filtered_subcat_ids];
            }

            // dd($filtered_addtionals_values);

            //belongsToMany, can also use innerJoinWith if you don't intend to load associated data, matching loads associated data
            $query->innerJoinWith('BusinessAdditionals', function ($q) use ($filtered_addtionals_values) {
                return $q->where([
                    'OR' => $filtered_addtionals_values
                ]);
            });
        }


        $filtered_range_values = [];
        if (!empty($ranges_additionals)) {
            foreach ($ranges_additionals as $key => $value) {
                $fid = $value->id;
                $v1 = $this->Custom->escapeString($value->value);
                $v2 = $this->Custom->escapeString($value->value2);
                // $filtered_addtionals_ids[] = $value->id;

                $filtered_range_values[] = ['BusinessAdditionals.filter_id' => $fid, 'BusinessAdditionals.value >=' => $v1, 'BusinessAdditionals.value2 <=' => $v2];
            }
            $query->innerJoinWith('BusinessAdditionals', function ($q) use ($filtered_range_values) {
                return $q->where([
                    'OR' => $filtered_range_values
                ]);
            });
        }


        $this->set('filtered_additionals', $filtered_additionals);


        // debug($filtered_additionals);
        // debug($ranges_additionals);

        // $user_filters = array_merge($filtered_additionals, $ranges_additionals);
        // $this->set('user_filters', $user_filters);
        // debug($user_filters);

        // dd($requestQuery);


        // if (!empty($city)) {
        //     $query->order(['average_rating' => "DESC", 'distance' => 'DESC']);
        // } else {
        //     $query->order(['average_rating' => "DESC"]);
        // }
        $query->order(['average_rating' => "DESC"]);

        // dd($query->toArray());

        $empty_result = false;
        $total_count = $query->count();

        try {
            $businesses = $this->paginate($query, ['limit' => $this->limit]);
            // debug($businesses->toArray());
            // die();
            if (empty($total_count)) {
                $empty_result = true;
            }
            // dd(json_encode($businesses));
            // die(str_replace('\'', '\\\'', json_encode($businesses)));
        } catch (\Cake\Http\Exception\NotFoundException $e) {

            $empty_result = true;
            // $requestQuery = $this->request->getQuery();
            // $requestQuery['page'] = $this->request->getParam('paging')['Businesses']['pageCount'];

            // return $this->redirect([
            //     'controller' => 'search', 'action' => 'index',
            //     !empty($this->request->getParam('pass')[0]) ? $this->request->getParam('pass')[0] : '',
            //     !empty($this->request->getParam('pass')[1]) ? $this->request->getParam('pass')[1] : '',
            //     '?' => $requestQuery,
            // ]);
        }

        // dd($businesses->toArray());



        // $filterChunks = array_chunk($filters, 16, true);
        //dd($filterChunks);

        // foreach ($filterChunks[0] as $key => $filter) {
        //     foreach ($filter->subcategories as $key2 => $subcat) {
        //         // dd($subcat);
        //     }
        // }

        $this->set(compact('filters', 'businesses', 'radius', 'businesses', 'empty_result', 'search_term', 'total_count', 'chunksize'));

        $cityIdToUse = !empty($cityDb) ? $cityDb->id : ($this->currentUser ? $this->currentUser->city_id : null);

        $sponsoredListings = $this->Custom->getSponsoredListings($cityIdToUse, true, 3);
        $this->set('sponsoredListings', $sponsoredListings);
    }
}
