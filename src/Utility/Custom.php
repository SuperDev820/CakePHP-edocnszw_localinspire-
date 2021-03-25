<?php

namespace App\Utility;

use App\Controller\Component\CustomComponent; //we're just using this so we can load model
// use App\Controller\AppController; //we're just using this so we can load model
use Cake\Console\Shell;
use Cake\Controller\ComponentRegistry;

// <- resides in your app's src/Controller/Component folder

//use Goutte\Client;
//use Symfony\Component\DomCrawler\Crawler;
//use GuzzleHttp\Psr7;
//use GuzzleHttp\Exception\RequestException;

class Custom
// class Custom extends Component
// class Custom  extends AppController

{
    public $CustomComp;
    public $publishercode = "10000022318";

    public function initialize()
    {
        $controller = new \Cake\Controller\Controller();
        $this->CustomComp = new CustomComponent(new ComponentRegistry($controller));
    }

    public function getHostname()
    {
        $remote = env('SERVER_NAME') ? env('SERVER_NAME') : "edocadvisor.com";
        return env('SERVER_NAME') == "inspire4.local" ? "inspire4.local" : $remote;
    }


    public function getHost($chat = false)
    {
        $host = "";
        if (getEnv('SERVER_NAME') == "inspire4.local") {
            $host = "http://inspire4.local";
        } else {
            // $host = "https://" . getEnv('SERVER_NAME');
            $host = "https://" . $this->getHostname();
        }
        if ($chat) {
            return $host . "/api/chat";
        }
        return $host . ":2020";
    }


    public function makeLinks($str)
    {
        //$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
        $reg_exUrl = "/(((http|https|ftp|ftps)\:\/\/)|(www\.))[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\:[0-9]+)?(\/\S*)?/"; //also takes www.link into account

        $urls = array();
        $urlsToReplace = array();
        if (preg_match_all($reg_exUrl, $str, $urls)) {
            $numOfMatches = count($urls[0]);
            $numOfUrlsToReplace = 0;
            for ($i = 0; $i < $numOfMatches; $i++) {
                $alreadyAdded = false;
                $numOfUrlsToReplace = count($urlsToReplace);
                for ($j = 0; $j < $numOfUrlsToReplace; $j++) {
                    if ($urlsToReplace[$j] == $urls[0][$i]) {
                        $alreadyAdded = true;
                    }
                }
                if (!$alreadyAdded) {
                    array_push($urlsToReplace, $urls[0][$i]);
                }
            }
            $numOfUrlsToReplace = count($urlsToReplace);
            for ($i = 0; $i < $numOfUrlsToReplace; $i++) {

                //extra block I added to put http:// in front of links that don't have it
                $mystring = $urlsToReplace[$i];
                $findme = 'http://';
                $findme2 = 'https://';
                $pos = strpos($mystring, $findme);
                $pos2 = strpos($mystring, $findme2);
                if ($pos !== false || $pos2 !== false) { //if it has either http or https in string
                    //$mystring = $urlsToReplace[$i];
                } else {
                    $mystring = "http://" . $urlsToReplace[$i];
                }

                $str = str_replace($urlsToReplace[$i], "<a class=\"msglink\" href=\"" . $mystring . "\">" . $urlsToReplace[$i] . "</a> ", $str);
                // $str = str_replace($urlsToReplace[$i], "<a style=\"color:aqua\" href=\"" . $urlsToReplace[$i] . "\">" . $urlsToReplace[$i] . "</a> ", $str);
            }
            return $str;
        } else {
            return $str;
        }
    }



    public function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE)
    {
        $output = NULL;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
        $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
        $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
        $continents = array(
            "AF" => "Africa",
            "AN" => "Antarctica",
            "AS" => "Asia",
            "EU" => "Europe",
            "OC" => "Australia (Oceania)",
            "NA" => "North America",
            "SA" => "South America"
        );
        if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
            $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));

            if (!empty($ipdat) and $ipdat->geoplugin_status == 200  and @strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                switch ($purpose) {
                    case "location":
                        $output = array(
                            "city"           => @$ipdat->geoplugin_city,
                            "state"          => @$ipdat->geoplugin_regionName,
                            "country"        => @$ipdat->geoplugin_countryName,
                            "country_code"   => @$ipdat->geoplugin_countryCode,
                            "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                            "continent_code" => @$ipdat->geoplugin_continentCode
                        );
                        break;
                    case "address":
                        $address = array($ipdat->geoplugin_countryName);
                        if (@strlen($ipdat->geoplugin_regionName) >= 1)
                            $address[] = $ipdat->geoplugin_regionName;
                        if (@strlen($ipdat->geoplugin_city) >= 1)
                            $address[] = $ipdat->geoplugin_city;
                        $output = implode(", ", array_reverse($address));
                        break;
                    case "city":
                        $output = @$ipdat->geoplugin_city;
                        break;
                    case "state":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "region":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "country":
                        $output = @$ipdat->geoplugin_countryName;
                        break;
                    case "countrycode":
                        $output = @$ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }
        return $output;
    }

    public function searchPlaces($what = null, $type = null, $where = null, $page = 1, $rpp = 20, $sort = 'dist', $format = 'xml', $placement = null, $has_offers = null, $histograms = null, $i = null)
    {

        // die("got here 2");

        $qStr = "";
        $url = "http://api.citygridmedia.com/content/places/v2/search/where?";

        // 	$qStr .= "tag=" . urlencode(1722);
        // 	$qStr .= "type=" . urlencode("hotel");
        // 	if($what!=''){ $qStr .= "tag=" . urlencode("11279"); }
        // 	if($what!=''){ $qStr .= "&placement=" . urlencode("sec-5"); }

        if ($what != '') {
            $qStr .= "what=" . urlencode($what);
        }
        if ($type != '') {
            $qStr .= "&type=" . urlencode($type);
        }
        if ($where != '') {
            $qStr .= "&where=" . urlencode($where);
        }

        $qStr .= "&sort=" . urlencode($sort);
        $qStr .= "&page=" . urlencode($page);
        $qStr .= "&rpp=" . urlencode($rpp);

        if ($placement != '') {
            $qStr .= "&placement=" . urlencode($placement);
        }
        if ($has_offers != '') {
            $qStr .= "&has_offers=" . urlencode($has_offers);
        }
        if ($histograms != '') {
            $qStr .= "&histograms=" . urlencode($histograms);
        }
        if ($i != '') {
            $qStr .= "&i=" . urlencode($i);
        }

        $qStr .= "&format=" . $format;

        $qStr .= "&publisher=" . $this->publishercode;

        $url .= $qStr;

        //echo "pulling - " . $url . "<br /><br />";
        // 		print_r($url);exit;
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, 0);
        // curl_setopt($curl_handle,CURLOPT_CAINFO,'D:\wwwroot\hyp3rl0cal.laneworks.net\system\ca-bundle.crt');

        $searchResponse = curl_exec($curl_handle);
        curl_close($curl_handle);

        $search = json_decode($searchResponse);
        return $search;
    }

    public function places_detail(
        $id,
        $id_type = 'cg',
        $phone = null,
        $customer_only = null,
        $all_results = null,
        $review_count = null,
        $placement = null,
        $format = null,
        $callback = null,
        $i
    ) {

        //var_dump($_SERVER);	

        $client_ip = gethostbyname($_SERVER['HTTP_HOST']);
        //echo "IP: " . $client_ip . "<br />";

        $qStr = "";
        $url = "http://api.citygridmedia.com/content/places/v2/detail?";

        $qStr .= "id=" . $id;

        if ($id_type != '') {
            $qStr .= "&id_type=" . urlencode($id_type);
        }
        if ($phone != '') {
            $qStr .= "&phone=" . urlencode($phone);
        }
        if ($customer_only != '') {
            $qStr .= "&customer_only=" . urlencode($customer_only);
        }

        if ($all_results != '') {
            $qStr .= "&all_results=" . urlencode($all_results);
        }
        if ($review_count != '') {
            $qStr .= "&review_count=" . urlencode($review_count);
        }
        if ($placement != '') {
            $qStr .= "&placement=" . urlencode($placement);
        }
        if ($callback != '') {
            $qStr .= "&callback=" . urlencode($callback);
        }
        if ($i != '') {
            $qStr .= "&i=" . urlencode($i);
        }

        $qStr .= "&format=" . $format;

        $qStr .= "&client_ip=" . $client_ip;

        $qStr .= "&publisher=" . $this->publishercode;

        $url .= $qStr;

        //echo "pulling - " . $url . "<br /><br />";

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl_handle, CURLOPT_CAINFO, 'D:\wwwroot\hyp3rl0cal.laneworks.net\system\ca-bundle.crt');

        $searchResponse = curl_exec($curl_handle);
        curl_close($curl_handle);

        $search = json_decode($searchResponse);
        return $search;
    }

    public function display_web_ad_300_250($adid, $publisher, $what, $where)
    {

        $returnAd = '<div id="sidebar_ad_slot_' . $adid . '"></div>';
        $returnAd .= '<script type="text/javascript">';
        $returnAd .= "new CityGrid.Ads('sidebar_ad_slot_" . $adid . "', {";
        $returnAd .= "    collection_id: 'web-002-300x250',";
        $returnAd .= "    publisher: '" . $publisher . "',";
        $returnAd .= "    what:'" . $what . "',";
        $returnAd .= "    where: '" . $where . "',";
        $returnAd .= "    width: 300,";
        $returnAd .= "    height: 250";
        $returnAd .= "  });";
        $returnAd .= "</script>";

        return $returnAd;
    }

    public function display_web_ad_630_100($adid, $publisher, $what, $where)
    {

        $returnAd = '<script type="text/javascript">';
        $returnAd .= "new CityGrid.Ads('" . $adid . "', {";
        $returnAd .= "    collection_id: 'web-001-630x100',";
        $returnAd .= "    publisher: '" . $publisher . "',";
        $returnAd .= "    what:'" . $what . "',";
        $returnAd .= "    where: '" . $where . "',";
        $returnAd .= "    width: 630,";
        $returnAd .= "    height: 100";
        $returnAd .= "  });";
        $returnAd .= "</script>";

        return $returnAd;
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


    public function showArrayItemsAsString($array, $property = false)
    {
        $string = "";
        if (!empty($array)) {
            //var_dump($user->categories);
            foreach ($array as $array_item) {
                $string .= (!empty($property) ? $array_item->$property->name : $array_item->name) . ", ";
            }
            //echo $this->str_lreplace(",", "", $string);
        } else {
            return "N/A";
        }

        return $this->str_lreplace(",", "", $string);
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
    public function startsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }

    public function endsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return $length === 0 ||
            (substr($haystack, -$length) === $needle);
    }
    /*
     * Create a random string
     * @author    XEWeb <>
     * @param $length the length of the string to create
     * @return $str the string
     */
    public function randomString($length = 6, $upper = false)
    {
        $str = "";
        if ($upper) {
            $characters = array_merge(range('A', 'Z'));
        } else {
            $characters = array_merge(range('a', 'z'));
        }
        // $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }

    public function removeAllWhiteSpaces($string)
    {
        return strtolower(trim(preg_replace('/\s+/', '', $string)));
    }


    public function timestampIsToday($timestamp)
    {
        // dd($timestamp);
        if (is_object($timestamp)) {
            $time = new \Cake\I18n\Time($timestamp);
            if ($time->month == (int) date('n') and $time->day == (int) date('j')) {
                return true;
            }
        }

        // if (date('Ymd') == date('Ymd', strtotime($timestamp))) {
        if (date('md') == date('md', strtotime($timestamp))) {
            return true;
        }
        return false;
    }

    public function dateIsToday($date)
    {
        if (!empty($date)) {
            $month =  (int) date('n');
            $day = (int) date('j');
            if ($date->month == $month and $date->day == $day) {
                return true;
            }
        }
        return false;
    }

    public function convertToTimestamp($date = null)
    {
        if (is_object($date)) {
            return $date->toUnixString();
        }
        if (!empty($date)) {
            $ts_date = str_replace('/', '-', $date);
            return strtotime($ts_date);
        }
        return "";
    }

    public function getOfferIcon($offer, $mini = false)
    {
        $offer = $this->toArray($offer);
        // dd($offer);
        $str = '';
        $str .= $mini ? "" : '<div class="u-avatar mr-4">';
        if (isset($offer['birthday']) and ($offer['birthday'] == "true" or $offer['birthday'] == true or $offer['birthday'] == "1")) {
            $str .= '<i class="fas fa-birthday-cake ' . ($mini ? '' : ' fa-lg fa-3x') . '"></i>';
        } elseif (isset($offer['anniversary'])  and ($offer['anniversary'] == "true" or $offer['anniversary'] == true or $offer['anniversary'] == "1")) {
            $str .= '<i class="fas fa-heart' . ($mini ? '' : ' fa-lg fa-3x') . '"></i>';
        } else {
            $str .= '<i class="fas fa-gift' . ($mini ? '' : ' fa-lg fa-3x') . '"></i>';
        }
        $str .=  $mini ? "" : '</div>';
        return $str;
    }

    public function getBusinessPhotoUrl($business, $share = false, $photo = null)
    {
        if (strpos($photo, 'https://') !== false or strpos($photo, 'http://') !== false) {
            return $photo;
        }
        if (!empty($photo)) {
            if (!empty($photo->business_id)) {
                return $this->dpUrl($photo->photo, "businesses");
            } else {
                return $this->dpUrl($photo->photo, "reviews");
            }
        }
        if (!empty($business->primary_photo)) {
            return $this->dpUrl($business->primary_photo->photo, (!empty($business->primary_photo->business_id) ? "businesses" : "reviews"));
        }
        if (!empty($business->photo)) {
            return $this->dpUrl($business->photo->photo, "businesses");
        }
        if (!empty($business->review_photo)) {
            return $this->dpUrl($business->review_photo->photo, "reviews");
        }
        if ($share) {
            // return $this->Url->build('/assets/images/localinspire.png', true);
            return \Cake\Routing\Router::Url('/assets/images/localinspire.png', true);
        }
        return \Cake\Routing\Router::Url('/assets/img/defauls_buisness_image.png', true);
        // return $this->Url->build('/assets/img/defauls_buisness_image.png', true);
    }

    public function getSponsoredPhotoUrl($business)
    {
        // dd($business);
        if (!empty($business->ad)) {
            if (!empty($business->ad->business_photo)) {
                return $this->dpUrl($business->ad->business_photo->photo, "businesses");
            } else {
                return $this->dpUrl($business->ad->business_review_photo->photo, "reviews");
            }
        }
        return $this->getBusinessPhotoUrl($business);
    }

    public function remoteFileExists($url)
    {
        if (@get_headers($url)[0] == 'HTTP/1.1 404 Not Found') {
            // The image doesn't exist
            return false;
        } else {
            // The image exists
            return true;
        }
    }


    public function hoursandmins($time, $format = '%02d:%02d')
    {
        $format = '%02d hour(s) %02d minute(s)';
        if ($time < 1) {
            return;
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        return sprintf($format, $hours, $minutes);
    }

    /*
    Converts any variable to its best array representation
     */
    public function toArray($variable)
    {

        $snapshot = null;
        if (gettype($variable) == 'string') {
            $snapshot = json_decode($variable, true);
        } elseif (gettype($variable) == 'object') {
            try {
                $snapshot = $variable->toArray();
            } catch (\Error $e) {
                $snapshot = $variable;
            }
        } else {
            $snapshot = $variable;
        }

        //dd(gettype($order_snapshot));
        // if (gettype($order_snapshot) == 'object') {
        //     $snapshot = (array) $order_snapshot;
        // }

        return json_decode(json_encode($snapshot), true);
        //return (array) $snapshot;
    }

    public function secondsToDays($seconds)
    {
        $dtF = new \DateTime('@0');
        $dtT = new \DateTime("@$seconds");
        // return (int) $dtF->diff($dtT)->format('%a');
        // return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
        return $dtF->diff($dtT)->format('%a day(s), %h hour(s), %i minute(s)');
    }


    public function canShowLogLink($log)
    {
        $url = json_decode($log->url);
        $entity = json_decode($log->entity);

        if ($log->show_url == 0) {
            //dd("got here");
            return false;
        }

        // if (!empty($url) && $url->action != "add" && $url->isAjax == false) {
        //     return true;
        // }
        if (!empty($url)) {
            if (!($url->action == "add" && empty($entity))) {
                if ($url->isAjax == false) {
                    //dd("got here 2");
                    return true;
                }
            }
        }
        //debug($log);
        //debug($url);
        //debug($entity);
        //die();
        return false;
    }

    public function getLogLinkParams($log)
    {
        $url = json_decode($log->url);
        $entity = json_decode($log->entity);

        return [
            'prefix' => !empty($url->prefix) ? $url->prefix : null,
            'controller' => $url->controller,
            'action' => ($url->action == 'add' || $url->action == 'edit') && !empty($entity) ? 'view' : $url->action,
            (!empty($url->pass[0]) ? $url->pass[0] : ($url->action == 'add' && !empty($entity) ? $entity->id : '')),
        ];
    }

    public function getDay($index)
    {
        $day = null;
        if ($index == 1) {
            $day = "monday";
        } elseif ($index == 2) {
            $day = "tuesday";
        } elseif ($index == 3) {
            $day = "wednesday";
        } elseif ($index == 4) {
            $day = "thursday";
        } elseif ($index == 5) {
            $day = "friday";
        }
        return $day;
    }

    public function getMealType($index)
    {
        $meal = null;
        if ($index == 1) {
            $meal = "breakfast";
        } elseif ($index == 2) {
            $meal = "lunch";
        } elseif ($index == 3) {
            $meal = "dinner";
        }
        return $meal;
    }

    public function getDayReversed($day)
    {
        $index = null;
        if ($day == "monday") {
            $index = 1;
        } elseif ($day == "tuesday") {
            $index = 2;
        } elseif ($day == "wednesday") {
            $index = 3;
        } elseif ($day == "thursday") {
            $index = 4;
        } elseif ($day == "friday") {
            $index = 5;
        }
        return $index;
    }

    public function getMealTypeReversed($meal)
    {
        $index = null;
        if ($meal == "breakfast") {
            $index = 1;
        } elseif ($meal == "lunch") {
            $index = 2;
        } elseif ($meal == "dinner") {
            $index = 3;
        }
        return $index;
    }

    public function userHasRole($user_roles, $action_roles)
    {
        //get user with roles
        //check if any of the roles in roles_array is in array of user roles
        //if any exist at all, return true

        /*

        No need for this logic. If we add a new role, we'd go into all mentions of userHasRole function and add the new role
        Or better still we create an actions model and associate actions with allowed roles to perform them

        if($task == ">"){
        //check if max user role is grater than or equal to min allowed roles
        //find the maximum role in $action_roles and check if user's maximum role is greater than or equals to maximum access_roles

        }elseif($task == "<"){

        }else{

        }
         */
        //$result = !empty(array_intersect($user_roles, $action_roles));

        $bFound = (count(array_intersect($user_roles, $action_roles))) ? true : false;

        return $bFound;
    }

    public function dayUsage($instance)
    {
        // $instance = $this->toArray($instance);
        $response = ['used' => 0, 'left' => 0, 'active' => true];
        // return $response;
        $timer = \Cake\Datasource\FactoryLocator::get('Table')->get('Runnings')->find()
            ->where([
                'Runnings.day >=' => new \DateTime('today midnight'),
                'Runnings.day <' => new \DateTime('tomorrow midnight'),
                'instance_id' => (!empty($instance['id']) ? $instance['id'] : $instance->id)
            ])->first();
        if (!empty($timer)) {
            $response['active'] = $this->daily_limit > $timer->minutes ? true : false;
            $response['used'] = $this->hoursandmins($timer->minutes);
            $response['left'] = $this->hoursandmins($this->daily_limit - $timer->minutes);
        }
        return $response;
    }

    public function monthUsage($instance)
    {
        // $instance = $this->toArray($instance);
        $response = ['used' => 0, 'left' => 0, 'active' => true];
        $timers = \Cake\Datasource\FactoryLocator::get('Table')->get('Runnings')->find()
            ->where([
                'Runnings.day >=' => new \DateTime('first day of this month'),
                'Runnings.day <' => new \DateTime('first day of next month'),
                'instance_id' => (!empty($instance['id']) ? $instance['id'] : $instance->id)
            ])->toArray();
        // dd($timers);

        if (!empty($timers)) {
            $total_minutes = 0;
            foreach ($timers as $timer) {
                $total_minutes += $timer->minutes;
            }
            $response['active'] = $this->monthly_limit > $total_minutes ? true : false;
            $response['used'] = $this->hoursandmins($total_minutes);
            $response['left'] = $this->hoursandmins($this->monthly_limit - $total_minutes);
        }
        return $response;
    }

    public function getDirContents($dir, &$results = array())
    {

        // echo ($dir . PHP_EOL);
        $files = scandir($dir);

        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[] = $path;
            } else if ($value != "." && $value != "..") {
                $this->getDirContents($path, $results);
                $results[] = $path;
            }
        }

        return $results;
    }


    /**
     * @link http://gist.github.com/385876
     */
    public function csv_to_array($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header) {
                    $header = $row;
                } else {
                    if (count($header) == count($row)) {
                        $data[] = array_combine($header, $row);
                    }
                }
            }
            fclose($handle);
        }
        return $data;
    }
    public function make_csv_file($file_name, $file_counter, $split_dir, $file_header, $file_content)
    {
        // name file
        $name = $file_name . "_" . $file_counter . ".csv";

        // set path
        $path = $split_dir . $name;

        // set content
        $content = $file_header . $file_content;

        // save file
        if (($fp = fopen($path, "w+")) !== FALSE) {
            fwrite($fp, $content);
            fclose($fp);
        }
    } // make_csv_file()


    public function split_csv($file)
    {

        $split_dir = "";
        $ufile_target = "";


        $file_header = "";
        $file_content = "";
        $max_rows = 5000; // 1 header row + 4999 data rows

        $file_src = $file;
        $file_name = str_replace(".csv", "", $file);
        $file_counter = 1; // append to end of file name

        $i = 0; // source file row counter
        $col = 0; // source file row counter
        $row = 1; // destination file counter (keep under $max_rows)

        if (($handle = fopen($file_src, "r")) !== FALSE) {

            while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
                $col = count($data);
                //echo "<pre>".print_r($data,1)."</pre>";
                if ($i == 0) {

                    // store the file header
                    for ($n = 0; $n < $col; $n++) {
                        if ($n > 0) {
                            $file_header .= ",";
                        }

                        $file_header .= $data[$n];
                    }

                    $file_header .= "\n";
                } else {
                    if ($row < $max_rows) {
                        for ($n = 0; $n < $col; $n++) {
                            if ($n > 0) {
                                $file_content .= ",";
                            }

                            $file_content .= '"' . $data[$n] . '"';
                        }

                        $file_content .= "\n";
                    } else {
                        $this->make_csv_file($file_name, $file_counter, $split_dir, $file_header, $file_content);

                        // increment
                        $file_counter++;

                        // reset
                        $file_content = "";

                        // record this row
                        for ($n = 0; $n < $col; $n++) {
                            if ($n > 0) {
                                $file_content .= ",";
                            }

                            $file_content .= '"' . $data[$n] . '"';
                        }

                        $file_content .= "\n";


                        $row = 1;
                    }
                    $row++;
                }
                $i++;
            }

            $this->make_csv_file($file_name, $file_counter, $split_dir, $file_header, $file_content);

            fclose($handle);
        }
    }

    public function getSumOfProducts($products, $notes, $config_quantity = null)
    {
        $price = 0;
        $array_variable = json_decode($notes, true);

        //debug($notes);
        //debug($array_variable); die();

        if (!empty($products)) {
            foreach ($products as $value) {

                $value = (object) $value;

                $product_price = 0;

                //this is for the first people using this function
                if (!empty($array_variable) && array_key_exists('products_quantity', $array_variable)) {
                    if (array_key_exists($value->id, $array_variable['products_quantity'])) {
                        $product_price += ($value->price * $array_variable['products_quantity'][$value->id]);
                        //continue; //his should skip any more lines below and contnue the loop
                    } else {
                        $product_price += $value->price;
                    }
                } else {
                    $product_price += $value->price;
                }

                if (!empty($config_quantity['products']) && array_key_exists($value->id, $config_quantity['products'])) {
                    $product_price = $product_price * $config_quantity['products'][$value->id];
                }

                /*
                Duplicated for backwards compatibility reasons
                Had to change the config quantity key we store in db from products to product

                 */
                if (!empty($config_quantity['product']) && array_key_exists($value->id, $config_quantity['product'])) {
                    $product_price = $product_price * $config_quantity['product'][$value->id];
                }

                $price += $product_price;
                //this is subscription weekly price logic after delivery plan has been configured
                /*if(!empty($array_variable) && array_key_exists('config_quantity', $array_variable)){
                if(array_key_exists('products', $array_variable['config_quantity'])){
                if(array_key_exists($value->id, $array_variable['config_quantity']['product'])){
                $price += ($value->price * $array_variable['config_quantity']['product'][$value->id]);
                continue;
                }
                }
                }*/
                //$price += $value->price;
            }
        }
        return $price;
    }

    ///////////////////////////////////////////////////////////////////////////////////////////

    public function getRealIpAddr()
    {
        $ip = "";
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (!empty($_SERVER['REMOTE_ADDR'])) {   //to check ip is pass from proxy
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    public function dpUrl($image_url, $folder = null, $size = null, $host = null)
    {
        if (!empty($image_url)) {

            if (strpos($image_url, 'https://') !== false or strpos($image_url, 'http://') !== false) { //it's a social image
                return $image_url;
            }

            $path = explode("/", $folder);
            $real_folder = null;
            foreach ($path as $key => $value) {
                $real_folder .= $value . DS;
            }

            if (file_exists(WWW_ROOT . DS . 'uploads' . DS . $real_folder .  $image_url)) {
                if (env('SERVER_NAME') == "inspire4.local" || $host == "inspire4.local") {
                    $url = "http://" . $this->getHostname() . '/uploads/' . $folder . '/' . $image_url;
                } else {
                    // $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://';
                    $protocol = 'https://';
                    $url = $protocol . $this->getHostname() . '/uploads/' . $folder . '/' . $image_url;
                }
                return $url;

                //return $this->Url->build('/uploads/', true) . $folder . '/' . $image_url;
                //return \Cake\Routing\Router::url('/uploads/', true) . $folder . '/' . $image_url;
            }
            // if ($this->remoteFileExists($image_url)) {
            //     return $image_url;
            // }
        }
        // return $this->Url->build('/assets/', ['fullbase' => true]) ."images/services/s10.jpeg";
        if (env('SERVER_NAME') == "inspire4.local" || $host == "inspire4.local") {
            return "http://inspire4.local/img/no_img_available.jpg";
        }
        // return "https://" . $this->getHostname() . "/assets/images/noprofile.png";
        return 'https://www.placehold.it/' . (!empty($size) ? $size : '150x150') . '/EFEFEF/AAAAAA&amp;text=no+image';
    }


    public function getDp($image_url, $folder = null, $size = null)
    {
        return $this->dpUrl($image_url, $folder, $size);
        // if (!empty($image_url)) {

        //     if (file_exists(WWW_ROOT . 'uploads' . DS . $folder . DS . $image_url)) {
        //         if (env('SERVER_NAME') == "animecake4.local") {
        //             $url = "http://" . env('HTTP_HOST') . '/uploads/' . $folder . '/' . $image_url;
        //         } else {
        //             $url = "https://" . env('HTTP_HOST') . '/uploads/' . $folder . '/' . $image_url;
        //         }
        //         return $url;
        //         // return "http://jankara.local/uploads/".$folder."/".$image_url;
        //         //return "http://" . env('HTTP_HOST') . '/uploads/' . $folder . '/' . $image_url;
        //         //return Router::url('/uploads/'). $folder . '/' . $image_url;
        //         //return $this->Url->build('/uploads/', true) . $folder . '/' . $image_url;
        //     }
        //     // if ($this->remoteFileExists($image_url)) {
        //     //     return $image_url;
        //     // }
        // }
        // return 'https://www.placehold.it/' . (!empty($size) ? $size : '150x150') . '/EFEFEF/AAAAAA&amp;text=no+image';
    }

    //remove special characters from string
    public function clean($string)
    {
        // $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.     
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }
    public function cleanStr($json)
    {
        // This will remove unwanted characters.
        // Check http://www.php.net/chr for details
        for ($i = 0; $i <= 31; ++$i) {
            $json = str_replace(chr($i), "", $json);
        }
        $json = str_replace(chr(127), "", $json);

        // This is the most common part
        // Some file begins with 'efbbbf' to mark the beginning of the file. (binary level)
        // here we detect it and we remove it, basically it's the first 3 characters 
        if (0 === strpos(bin2hex($json), 'efbbbf')) {
            $json = substr($json, 3);
        }
        $json = mb_convert_encoding($json, "UTF-8", 'UTF-8');
        $json = preg_replace('/[^\x20-\x7E]/', '', $json);
        $json = html_entity_decode($json);
        $json = stripslashes($json);

        // $tab = array("UTF-8", "ASCII", "Windows-1252", "ISO-8859-15", "ISO-8859-1", "ISO-8859-6", "CP1256");
        // $chain = "";
        // foreach ($tab as $i) {
        //     foreach ($tab as $j) {
        //         $chain .= " $i$j " . iconv($i, $j, "$json");
        //     }
        // }


        return $json;
    }

    public function truncate($string, $length = 100, $ellipsis = false)
    {
        $options = [
            'ellipsis' => $ellipsis ? '...' : '',
            'exact' => true, //i.e the exact number of string to return shoud equal length
            'html' => false
        ];
        // try {
        // } catch (\Cake\Core\Exception\Exception $e) {
        //     return substr($string, 0, 40);
        // }
        return \Cake\Utility\Text::truncate($this->cleanStr($string), $length, $options);
    }


    public function getUserLocation($ip = null)
    {
        // dd($ip);
        if (env('SERVER_NAME') == "inspire4.local" || strpos($ip, '197.211') !== false || strpos($ip, '129.205') !== false) {
            return [
                "CountryCode" => "US",
                "CountryName" => "United States",
                "GeoID" => 6252001,
                "StateCode" => "TX",
                "State" => "Texas",
                "City" => "Terrell",
                "Postal" => "75270",
                "Latitude" => 32.714292,
                "Longitude" => -96.251342,
                "TimeZone" => "America/Chicago",
                "Continent" => [],
                "RequestTime" => 1574868110,
                "RequestedIP" => "129.205.113.200",
                "city" => "Terrell",
                "region" => "TX",
                "lat" => 32.714292,
                "long" => -96.251342,
            ];
        }

        // $json  = file_get_contents('https://api.snoopi.io/' . $ip . '?apikey=75c6c91b2f96504ead3cad90932b39bf'); 
        $json  = file_get_contents('https://api.snoopi.io/' . $ip . '?apikey=35cebbf2480e2a8b41bdd2327ef65fed');

        $location  =  json_decode($json, true);
        // $location['region'] = $location['State'];
        $location['city'] = !empty($location['City']) ? $location['City'] : "Terrell";
        $location['region'] = !empty($location['StateCode']) ? $location['StateCode'] : "TX";
        $location['lat'] = !empty($location['Latitude']) ? $location['Latitude'] : "32.7787";
        $location['long'] = !empty($location['Longitude']) ? $location['Longitude'] : "-96.8217";
        return $location;
    }

    public function makeUsername($firstname, $lastname, $random_username = false)
    {
        //ignored the random check for now
        // if($random_username){ //because we might decide to add the username field to the form
        // }
        return trim(strtolower(str_replace(" ", "", $firstname) . "_" . str_replace(" ", "", $lastname)
            . ($random_username ? '-' . $this->randomString(6) : '')));
    }
    public function getPromoText($string)
    {
        return strtolower($this->removeAllWhiteSpaces($string));
    }

    public  function get_lat_long($address)
    {

        return array('lat' => "32.914527", 'lng' => "-96.642094");
        $ip = $this->getRealIpAddr();
        $url = "http://ipinfo.io/" . $ip . "/json";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $head = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($head);
        $lat_val = current(explode(",", $output->loc));
        $lng_val = end(explode(",", $output->loc));
        $array = array('lat' => $lat_val, 'lng' => $lng_val);
        return $array;
    }
    public  function convert_state_to_abbrev($state)
    {
        switch ($state) {
            case "Alabama":
                return "AL";
                break;
            case "Alaska":
                return "AK";
                break;
            case "Arizona":
                return "AZ";
                break;
            case "Arkansas":
                return "AR";
                break;
            case "California":
                return "CA";
                break;
            case "Colorado":
                return "CO";
                break;
            case "Connecticut":
                return "CT";
                break;
            case "Delaware":
                return "DE";
                break;
            case "Florida":
                return "FL";
                break;
            case "Georgia":
                return "GA";
                break;
            case "Hawaii":
                return "HI";
                break;
            case "Idaho":
                return "ID";
                break;
            case "Illinois":
                return "IL";
                break;
            case "Indiana":
                return "IN";
                break;
            case "Iowa":
                return "IA";
                break;
            case "Kansas":
                return "KS";
                break;
            case "Kentucky":
                return "KY";
                break;
            case "Louisana":
                return "LA";
                break;
            case "Maine":
                return "ME";
                break;
            case "Maryland":
                return "MD";
                break;
            case "Massachusetts":
                return "MA";
                break;
            case "Michigan":
                return "MI";
                break;
            case "Minnesota":
                return "MN";
                break;
            case "Mississippi":
                return "MS";
                break;
            case "Missouri":
                return "MO";
                break;
            case "Montana":
                return "MT";
                break;
            case "Nebraska":
                return "NE";
                break;
            case "Nevada":
                return "NV";
                break;
            case "New Hampshire":
                return "NH";
                break;
            case "New Jersey":
                return "NJ";
                break;
            case "New Mexico":
                return "NM";
                break;
            case "New York":
                return "NY";
                break;
            case "North Carolina":
                return "NC";
                break;
            case "North Dakota":
                return "ND";
                break;
            case "Ohio":
                return "OH";
                break;
            case "Oklahoma":
                return "OK";
                break;
            case "Oregon":
                return "OR";
                break;
            case "Pennsylvania":
                return "PA";
                break;
            case "Rhode Island":
                return "RI";
                break;
            case "South Carolina":
                return "SC";
                break;
            case "South Dakota":
                return "SD";
                break;
            case "Tennessee":
                return "TN";
                break;
            case "Texas":
                return "TX";
                break;
            case "Utah":
                return "UT";
                break;
            case "Vermont":
                return "VT";
                break;
            case "Virginia":
                return "VA";
                break;
            case "Washington":
                return "WA";
                break;
            case "Washington D.C.":
                return "DC";
                break;
            case "West Virginia":
                return "WV";
                break;
            case "Wisconsin":
                return "WI";
                break;
            case "Wyoming":
                return "WY";
                break;
            case "Alberta":
                return "AB";
                break;
            case "British Columbia":
                return "BC";
                break;
            case "Manitoba":
                return "MB";
                break;
            case "New Brunswick":
                return "NB";
                break;
            case "Newfoundland & Labrador":
                return "NL";
                break;
            case "Northwest Territories":
                return "NT";
                break;
            case "Nova Scotia":
                return "NS";
                break;
            case "Nunavut":
                return "NU";
                break;
            case "Ontario":
                return "ON";
                break;
            case "Prince Edward Island":
                return "PE";
                break;
            case "Quebec":
                return "QC";
                break;
            case "Saskatchewan":
                return "SK";
                break;
            case "Yukon Territory":
                return "YT";
                break;
            default:
                return $state;
        }
    }
}
