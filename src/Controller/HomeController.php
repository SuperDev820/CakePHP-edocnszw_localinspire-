<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;

/**
 * Home Controller
 *
 *
 * @method \App\Model\Entity\Home[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HomeController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->Authentication->allowUnauthenticated(['index']);
        $this->set('page', "home");
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        // $page_url = $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        // $this->session->set_userdata('page_url', $page_url);
        // $FirstName = $this->session->userdata['FirstName'];
        // $LastName = $this->session->userdata['LastName'];
        // $Email = $this->session->userdata['Email'];
        // $Id = $this->session->userdata['Id'];


        // $data['currentLocation'] = $this->session->userdata('currentLocation');
        // print_r($data);exit;
        // $data['title'] = "Home Page";
        // $Site_Where = !empty($this->currentLocation['city']) ? $this->currentLocation['city'] : "Terrell, TX";
        // $placement = null;
        // $has_offers = false;
        // $histograms = false;
        // $i = null;
        // $type = null;
        // $format = 'json';
        // $what = 'Restaurants';
        // $where = $Site_Where;
        // $page = 1;
        // $rpp = 6;
        // $sort = 'dist';

        // $search_data = $this->Cu->searchPlaces($what, $type, $where, $page, $rpp, $sort, $format, $placement, $has_offers, $histograms, $i);
        // $search_data = $this->Cu->varToArray($search_data);
        // $this->set('search_data', $search_data);


        // dd($search_data['results']);


        $featuredCities = $this->table('Cities')->find()
            ->contain(['States'])
            ->where(['Cities.featured' => true])->toArray();
        $this->set('featuredCities', $featuredCities);

        $city = null;
        if (!empty($this->currentUser->city_id)) {
            $city = $this->Custom->getCity($this->currentUser->city_id);
        } else {
            $city_name = !empty($this->currentLocation['City']) ? $this->currentLocation['City'] : $this->currentLocation['city'];
            $state_name = !empty($this->currentLocation['StateCode']) ? $this->currentLocation['StateCode'] : $this->currentLocation['region'];

            $city =  $this->table('Cities')->find()
                ->where([
                    'OR' => [
                        ['LOWER(Cities.name) LIKE' => "%" . $city_name . "%"],
                        ["MATCH(Cities.name) AGAINST('{$city_name}' IN BOOLEAN MODE)"],
                    ],
                ])
                ->andWhere(['States.code' => $state_name])
                ->contain(['States'])->first();
        }

        if (!empty($city)) {

            $this->set('city', $city);
            $this->set('latest_posts', $this->Custom->getLatestPosts($city->id, 4));
            $sponsoredListings = $this->Custom->getSponsoredListings($city->id, true, 12);
            $this->set('sponsoredListings', $sponsoredListings);
        }
    }
}
