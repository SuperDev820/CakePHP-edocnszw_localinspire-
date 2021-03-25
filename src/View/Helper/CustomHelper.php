<?php

declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use App\Utility\Custom;
use Cake\I18n\Time;
use DateTime;
use App\Utility\TinyMinify;


/**
 * Custom helper
 */
class CustomHelper extends Helper
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    public $helpers = ['Html', 'Url', 'Text'];
    public $Cu; //for use with custom utility

    // Execute any other additional setup for your helper.
    public function initialize(array $config): void
    {
        $this->Cu = new Custom();
    }
    public function htmlMinify($html)
    {
        return TinyMinify::html($html);
    }

    public function splitString($string = null, $number = 2, $beginning = true)
    {
        // return $string;
        if ($beginning) {
            // $message = explode(' ', $string, $number);
            $message = preg_split('/[\s,]+/', $string, $number)[0];
        } else {
            // $message = preg_replace('/^R \\d+ /', '', $string,$number);
            $message = explode(' ', $string, $number)[1];
            // dd($message);
        }
        return $message;
    }
    public function getYears($min = 1960)
    {
        $arr = range(date('Y') - 5, $min);
        $years = ["" => "Year"];
        foreach ($arr as $key => $value) {
            $years[$value] = $value;
        }
        return  $years;
    }

    public function getMonths()
    {
        return [
            "" => 'Month',
            "01" => 'January',
            "02" => 'February',
            "03" => 'March',
            "04" => 'April',
            "05" => 'May',
            "06" => 'June',
            "07" => 'July',
            "08" => 'August',
            "09" => 'September',
            "10" => 'October',
            "11" => 'November',
            "12" => 'December',
        ];
    }
    public function getDays()
    {

        $arr = range(01, 31);
        $days = ["" => "Day"];
        foreach ($arr as $key => $value) {
            $days[(strlen((string) $value) == 1 ? "0" . $value : $value)] = $value;
        }
        return  $days;
    }
    // public function jsMinify($js)
    // {
    //     return \JShrink\Minifier::minify($js);
    // }

    public function getHost()
    {
        return $this->Cu->getHost();
    }
    public function getQuestionsSortText()
    {
        if ($this->queryHasKey('sort', 'recently-answered')) {
            return "Recently Answered";
        }
        if ($this->queryHasKey('sort', 'recent')) {
            return "Recent";
        }
        if ($this->queryHasKey('sort', 'oldest')) {
            return "Oldest";
        }
        if ($this->queryHasKey('sort', 'top')) {
            return "Most answers";
        }
        return "Newest";
    }


    public function getReviewsSortText()
    {
        if ($this->queryHasKey('sort', 'replies')) {
            return "Owner Replies";
        }
        if ($this->queryHasKey('sort', 'recent')) {
            return "Recent";
        }
        if ($this->queryHasKey('sort', 'waiting')) {
            return "Awaiting Replies";
        }
        if ($this->queryHasKey('sort', 'recommend')) {
            return "Recommends";
        }
        if ($this->queryHasKey('sort', 'oldest')) {
            return "Oldest";
        }
        if ($this->queryHasKey('sort', 'helpful')) {
            return "Most helpful";
        }
        if ($this->queryHasKey('sort', 'anniversary')) {
            return "Anniversary Specials";
        }
        if ($this->queryHasKey('sort', 'birthday')) {
            return "Birthday Specials";
        }
        if ($this->queryHasKey('sort', 'collection')) {
            return "Saved Business Specials";
        }

        if (!empty($this->_View->get('keywords'))) {
            foreach ($this->_View->get('keywords') as $key => $keyword) {
                if ($this->queryHasKey('sort',  $keyword->name)) {
                    return  $keyword->name;
                }
            }
        }
        return "Newest";
    }


    public function getLastElementKey($array)
    {
        end($array);
        return key($array);
    }
    public function getLocationText()
    {
        $location = $this->_View->get('currentLocation');
        return $location['city'] . ", " . $location['region'];
    }

    public function cleanArticle($body, $page = 1)
    {
        // return $body;
        // $text = $article['Article']['body'];
        $text = $body;
        $text = str_replace("<br>", "<br/>", $text);
        $text = str_replace('<p>&nbsp;</p>', '<br/>', $text);
        $bl = explode('</p>', $text);

        $p = 15;
        $p_nr = count($bl);

        $start = ($page - 1) * $p;

        $pagesNo = ceil($p_nr / $p);

        $n = $page + 1;

        $article['Article']['pages'] = $pagesNo;
        //		$bl = array_slice($bl, $start, $p);

        $article['Article']['body'] = implode("</p>", $bl);

        $new = $article['Article']['body'];
        if (preg_match_all('/<img[^>]+>/i', $new, $result)) {
            foreach ($result[0] as $img) {
                preg_match("/<img .*?(?=src)src=\"([^\"]+)\"/si", $img, $href);
                $href = $href[1];
                $newText = "<a href='$href' class='lightbox rev_pic'><img style='max-width: 500px;'src='$href'/></a>";
                $new = str_replace($img, $newText, $new);
            }
        }

        $new = preg_replace("/line-height:.+?;/i", "", $new);
        // $article['Article']['body'] = $new;
        return $new;
    }
    
    public function paginatorTemplatesFrontend($customlinkclass = null)
    {
        return [
            // 'number' => '<em><a href="{{url}}">{{text}}</a></em>',
            'number' => '<li class="page-item"><a class="page-link ' . $customlinkclass . '" href="{{url}}">{{text}}</a></li>',
            'current' => '<li class="page-item active"><a class="page-link ' . $customlinkclass . '" href="{{url}}">{{text}}</a></li>',

            //'nextActive' => '<li><a rel="next" href="{{url}}">{{text}}</a></li>',
            'nextActive' => '<li class="page-item"><a class="page-link next_page ' . $customlinkclass . '" aria-label="Next" href="{{url}}"><i class="fa fa-angle-right"></i></a></li>',
            'nextDisabled' => '<li class="page-item disabled"><a class="page-link ' . $customlinkclass . '" href="" onclick="return false;"><i class="fa fa-angle-right"></i></a></li>',
            // 'prevActive' => '<li class="prev page-item"><a class="" rel="prev" href="{{url}}">{{text}}</a></li>',
            'prevActive' => '<li class="page-item"><a class="page-link ' . $customlinkclass . '" aria-label="Previous" href="{{url}}"><i class="fa fa-angle-left"></i></a></li>',
            'prevDisabled' => '<li class="page-item disabled"><a class="page-link ' . $customlinkclass . '" href="" onclick="return false;"><i class="fa fa-angle-left"></i></a></li>',
            'counterRange' => '{{start}} - {{end}} of {{count}}',
            'counterPages' => '{{page}} of {{pages}}',
            'color' => '{{page}} of {{pages}}',
            //'first' => '<li><a href="{{url}}">{{text}}</a></li>',
            'first' => '<li class="page-item"><a class="page-link" href="{{url}}"><i class="fa fa-angle-left"></i><i class="fa fa-angle-left"></i></a></li>',
            //'last' => '<li class="last page-item"><a class="" href="{{url}}">{{text}}</a></li>',
            'last' => '<li class="page-item"><a class="page-link" href="{{url}}"><i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i></a></li>',

            'ellipsis' => '<li class="ellipsis">...</li>',
            'sort' => '<a href="{{url}}">{{text}}</a>',
            'sortAsc' => '<a class="asc" href="{{url}}">{{text}}</a>',
            'sortDesc' => '<a class="desc" href="{{url}}">{{text}}</a>',
            'sortAscLocked' => '<a class="asc locked" href="{{url}}">{{text}}</a>',
            'sortDescLocked' => '<a class="desc locked" href="{{url}}">{{text}}</a>',
        ];
    }

    public function getFilterDropdownOptions($filter)
    {
        $foptions = json_decode($filter->options, true);
        $options = [];
        if (!empty($foptions)) {
            foreach ($foptions as $key => $value) {
                $options[$value] = $value;
            }
        }
        return $options;
    }
    public function businessPhotoUser($business)
    {
        if (!empty($business->primary_photo)) {
            return $business->primary_photo->user;
        }
        if (!empty($business->photo)) {
            return $business->photo->user;
        }
        if (!empty($business->review_photo)) {
            return $business->review_photo->user;
        }
        return null;
    }
    public function canShow($entity, $business)
    {
        // return true;
        // dd($entity);
        $data = $this->varToArray($entity);
        $active =  $data['active'];
        $start_date = true;
        $stop_date = true;
        $birthday = true;
        $anniversary = true;
        $all_members = true;
        $collection_members = true;
        $now = time();
        if (isset($data['all_members']) and $data['all_members'] == true) {
            $user = $this->_View->get('currentUser');
            if (empty($user)) {
                $all_members = false;
            }
        }
        if (isset($data['collection_members']) and $data['collection_members'] == true) {
            $userCollections = $this->_View->get('loggedInUserCollections');
            $collection_members = $this->userHasSavedBusiness($business, $userCollections);
        }
        // if (isset($data['birthday']) and $data['birthday'] == true) {
        //     $user = $this->_View->get('currentUser');
        //     if (!empty($user) and !empty($user->dob)) {
        //         if (!$this->Cu->timestampIsToday($this->Cu->convertToTimestamp($user->dob))) {
        //             $birthday = false;
        //         }
        //     }
        // }
        // if (isset($data['anniversary']) and $data['anniversary'] == true) {
        //     $user = $this->_View->get('currentUser');
        //     if (!empty($user) and !empty($user->anniversary)) {
        //         if (!$this->Cu->timestampIsToday($this->Cu->convertToTimestamp($user->anniversary))) {
        //             $anniversary = false;
        //         }
        //     }
        // }
        if (!empty($data['start_date'])) {
            if ($data['start_date'] > $now) {
                $start_date = false;
            }
        }
        if (!empty($data['stop_date'])) {
            if ($now > $data['stop_date']) {
                $stop_date = false;
            }
        }
        return ($active and $all_members and $collection_members and $birthday and $start_date and $stop_date and $anniversary) ? true : false;
    }
    public function convertToTimestamp($date)
    {
        return $this->Cu->convertToTimestamp($date);
    }
    public function getOfferTypeDisplay($offer)
    {
        $str = "";
        if ($offer->birthday) {
            $str .= "birthdays, ";
        }
        if ($offer->anniversary) {
            $str .= "anniversaries, ";
        }
        if ($offer->collection_members) {
            $str .= "collectors, ";
        }
        return empty($str) ? 'Everyone' : $this->str_lreplace(",", "", $str);
    }
    public function getOfferAudience($offer)
    {
        $str = "";
        if ($offer->anniversary) {
            $str .= ' <span class="fas fa-heart mr-2"></span>Anniversary special, <br>';
        }
        if ($offer->birthday) {
            $str .= '<span class="fas fa-birthday-cake mr-2"></span>Birthday special, <br>';
        }
        if ($offer->collection_members) {
            $str .=  '<span class="fas fa-gift mr-2"></span>Members who saved business, <br>';
        }
        if ($offer->all_members) {
            $str .= '<span class="fas fa-chair mr-2"></span>All Members';
        }
        return empty($str) ? 'Everyone' : $this->str_lreplace(",", "", $str);
    }
    public function getOfferIcon($offer)
    {
        return $this->Cu->getOfferIcon($offer, true);
    }
    public function getBusinessAdPhoto($featured_ad)
    {
        if (!empty($featured_ad)) {
            if (!empty($featured_ad->business_photo)) {
                return $featured_ad->business_photo;
            }
            if (!empty($featured_ad->business_review_photo)) {
                return $featured_ad->business_review_photo;
            }
        }
        return null;
    }
    public function getBusinessPhotoUrl($business, $share = false, $photo = null)
    {
        return $this->Cu->getBusinessPhotoUrl($business, $share, $photo);
    }
    public function getSponsoredPhotoUrl($business)
    {
        return $this->Cu->getSponsoredPhotoUrl($business);
    }
    public function emptyBusinessImage()
    {
        // return \Cake\Routing\Router::url('/assets/img/defauls_buisness_image.png', true);
        return $this->Url->build('/assets/img/defauls_buisness_image.png', ['fullBase' => true]);
    }
    public function emptyProfileImage()
    {
        // return \Cake\Routing\Router::url('/assets/images/noprofile.png', true);
        return $this->Url->build('/assets/images/noprofile.png', ['fullBase' => true]);
    }

    public function checkChecked($queryKey)
    {
        $query = $this->getView()->getRequest()->getQuery();
        if (isset($query[$queryKey])) {
            return 'checked="checked"';
        }
        return '';
    }
    public function showData($data)
    {
        $str = "";
        foreach ($data as $key => $value) {
            // debug($key);
            // dd($value);
            $str .= '<strong>' . $key . ':</strong> ' . (is_array($value) ? json_encode($value) : $value);
            $str .= "<br>";
        }
        return $str;
    }

    public function getSliderValue($business = null, $filter, $second = false, $dollarSign = false)
    {

        if (!empty($business) and !empty($business->business_additionals)) {
            foreach ($business->business_additionals as $value) {
                if ($value->filter_id == $filter->id) {
                    $dollar  = "";
                    if ($filter->id == 57 and $dollarSign) {
                        $dollar  = "$";
                    }
                    return $dollar . ($second ? $value->value2 : $value->value);
                }
            }
        }
        return "";
    }

    public function getSelectedSubcats($business = null, $subcategory, $returnName = false)
    {
        if (!empty($business) and !empty($business->subcategories)) {
            foreach ($business->subcategories as $value) {
                if ($value->id == $subcategory->id) {
                    if ($returnName) {
                        return $subcategory->name . ", ";
                    }
                    return 'checked="checked"';
                }
            }
        }
        return "";
    }

    public function getAdditionalValue($business = null, $filter)
    {
        if (!empty($business) and !empty($business->business_additionals)) {
            foreach ($business->business_additionals as $value) {
                if ($value->filter_id == $filter->id) {
                    return $value->value;
                }
            }
        }
        return "";
    }
    public function getPromoText($string)
    {
        return $this->Cu->getPromoText($string);
    }

    public function userHasSavedBusiness($business, $loggedInUserCollections = true)
    {
        if (!empty($loggedInUserCollections)) {
            foreach ($loggedInUserCollections as $key => $value) {
                if (!empty($value->collection_items)) {
                    foreach ($value->collection_items as $key2 => $item) {
                        if ($item->business_id == $business->id) {
                            return true;
                        }
                    }
                }
            }
        }

        return false;
    }
    public function displayCategoriesAndSubcategories($business, $replace = true)
    {
        $str = "";
        // $str = "Category 1 &bull; Subcat 1, subcat 2 ";
        if (!empty($business->categories)) {
            $str .= $business->categories[0]->name . " &bull; ";
        }
        if (!empty($business->sic2category)) {
            $str .= $business->sic2category->name . ", ";
        }
        if (!empty($business->sic4category)) {
            $str .= $business->sic4category->name . ", ";
        }
        if (!empty($business->sic8category)) {
            $str .= $business->sic8category->name . ", ";
        }
        if (!empty($business->subcategories)) {
            $count = 0;
            foreach ($business->subcategories as $key => $subcategory) {
                if ($count < 4) {
                    $str .= $subcategory->name . ", ";
                }
                $count++;
            }
        }
        return $replace ? $this->str_lreplace(",", "", $str) : $str;
    }



    public function slug($string)
    {
        try {
            return \Cake\Utility\Text::slug(strtolower($string));
        } catch (\Cake\Core\Exception\Exception $e) {
            // } catch (\Error $e) {
            return substr($this->findAndReplace(" ", "-", $string), 0, 40);
        }
    }
    public function truncate($string, $length = 100, $ellipsis = false)
    {
        return $this->Cu->truncate($string, (!empty($length) ? $length : 100), $ellipsis);
    }

    public function answerHelpful($answer)
    {
        $user = $this->_View->get('currentUser');
        if (!empty($answer) and !empty($user) and !empty($answer->helpful_answers)) {
            foreach ($answer->helpful_answers as $key => $value) {
                if ($value->user_id == $user->id) {
                    return true;
                }
            }
        }
        return false;
    }

    public function answerNotHelpful($answer)
    {
        $user = $this->_View->get('currentUser');
        if (!empty($answer) and !empty($user) and !empty($answer->unhelpful_answers)) {
            foreach ($answer->unhelpful_answers as $key => $value) {
                if ($value->user_id == $user->id) {
                    return true;
                }
            }
        }
        return false;
    }

    public function isHelpful($review)
    {
        $user = $this->_View->get('currentUser');
        if (!empty($review) and !empty($user) and !empty($review->helpful_reviews)) {
            foreach ($review->helpful_reviews as $key => $value) {
                if ($value->user_id == $user->id) {
                    return true;
                }
            }
        }
        return false;
    }

    public function isHelpfulPhoto($photo)
    {
        $user = $this->_View->get('currentUser');
        if (!empty($photo) and !empty($user) and !empty($photo->helpful_photos)) {
            foreach ($photo->helpful_photos as $key => $value) {
                if ($value->user_id == $user->id) {
                    return true;
                }
            }
        }
        if (!empty($photo) and !empty($user) and !empty($photo->helpful_review_photos)) {
            foreach ($photo->helpful_review_photos as $key => $value) {
                if ($value->user_id == $user->id) {
                    return true;
                }
            }
        }
        return false;
    }

    public function canReply($review, $business)
    {
        $user = $this->_View->get('currentUser');
        if (!empty($review) and !empty($user)) {
            if ($business->user_id == $user->id) {
                return true;
            }
        }
        return false;
    }

    public function userContributions($user)
    {
        return $user->business_review_photos_count + $user->business_reviews_count + $user->business_photos_count;
    }

    public function removeAllWhiteSpaces($string)
    {
        return $this->Cu->removeAllWhiteSpaces($string);
    }

    public function getNotificationBackground($notification_type_id)
    {
        if ($notification_type_id == 1) { //info
            return 'bg-info';
        }
        if ($notification_type_id == 2) { //success
            return 'bg-green';
        }
        if ($notification_type_id == 3) { //warning
            return 'bg-orange';
        }
        if ($notification_type_id == 4) { //error
            return 'bg-red';
        }

        return 'bg-info';
    }
    public function getNotificationIcon($notification_type_id)
    {
        if ($notification_type_id == 1) { //info
            return '<i class="fa fa-info-circle"></i>';
        }
        if ($notification_type_id == 2) { //success
            return '<i class="fa fa-check"></i>';
        }
        if ($notification_type_id == 3) { //warning
            return '<i class="fa fa-exclamation-triangle"></i>';
        }
        if ($notification_type_id == 4) { //error
            return '<i class="fa fa-exclamation-triangle"></i>';
        }

        return '<i class="fa fa-info-circle"></i>';
    }
    public function getFilterUrl($key, $value = null, $action, $catslug = null)
    {

        $request = $this->getView()->getRequest();
        return $this->Url->build([
            'controller' => $request->getParam('controller'), 'action' => $request->getParam('action'),
            !empty($request->getParam('pass')[0]) ? $request->getParam('pass')[0] : "",
            !empty($request->getParam('pass')[1]) ? $request->getParam('pass')[1] : '',
            !empty($request->getParam('pass')[2]) ? $request->getParam('pass')[2] : '',
            !empty($request->getParam('pass')[3]) ? $request->getParam('pass')[3] : '',
            '?' => $this->$action($key, $value),
        ]);
    }

    public function queryHasKey($key = null, $value = null)
    {
        $query = $this->getView()->getRequest()->getQuery();
        if (isset($query[$key])) {
            if (!empty($value)) {
                if ($query[$key] == $value) {
                    return true;
                }
            } else {
                return true;
            }
        }
        return false;
    }
    public function addQueryKey($key = null, $value = null)
    {
        $query = $this->getView()->getRequest()->getQuery();
        if (!empty($key) && !empty($value)) {
            $query[$key] = $value;
        }

        return $query;
    }
    public function removeQueryKey($key = null)
    {
        $query = $this->getView()->getRequest()->getQuery();
        unset($query[$key]);
        return $query;
    }

    public function getBusinessReviewAverage($reviews)
    {
        return $this->Cu->getBusinessReviewAverage($reviews);
    }

    public function getVarJson($variable)
    {

        $data = $this->toArray($variable);
        foreach ($data as $key => $value) {
            mb_convert_encoding($value, "UTF-8");
        }
        return json_encode($data,  JSON_HEX_QUOT | JSON_HEX_APOS);
        // return str_replace("'", "\'", json_encode($data, JSON_HEX_APOS));
    }
    public function varToArray($variable)
    {
        return $this->toArray($variable);
    }
    public function toArray($variable)
    {
        return $this->Cu->toArray($variable);
    }

    ////$this->_View->get('doctor_role')

    public function userHasRole($role, $roles)
    {
        if (!empty($roles)) {
            foreach ($roles as $value) {
                if ($value->id == $role) {
                    return true;
                }
            }
        }
        return false;
    }

    public function paginatorTemplates()
    {

        /*

        <li class="disabled">
        <a href="#!!">
        <i class="material-icons">chevron_left</i>
        </a>
        </li>
        <li class="active">
        <a href="javascript:void(0);">1</a>
        </li>
        <li class="waves-effect">
        <a href="javascript:void(0);">2</a>
        </li>
        <li class="waves-effect">
        <a href="javascript:void(0);">3</a>
        </li>
        <li class="waves-effect">
        <a href="javascript:void(0);">4</a>
        </li>
        <li class="waves-effect">
        <a href="javascript:void(0);">5</a>
        </li>
        <li class="waves-effect">
        <a href="javascript:void(0);">6</a>
        </li>
        <li class="waves-effect">
        <a href="javascript:void(0);">7</a>
        </li>
        <li class="waves-effect">
        <a href="javascript:void(0);">8</a>
        </li>
        <li class="waves-effect">
        <a href="javascript:void(0);">
        <i class="material-icons">chevron_right</i>
        </a>
        </li>

         */
        return [
            // 'number' => '<em><a href="{{url}}">{{text}}</a></em>',
            'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
            'current' => '<li class="page-item active"><a class="page-link" href="">{{text}}</a></li>',

            'nextActive' => '<li class="next page-item"><a class="page-link" rel="next" href="{{url}}">{{text}}<i class="material-icons">chevron_right</i></a></li>',
            'nextDisabled' => '<li class="next page-item disabled"><a class="page-link" href="" onclick="return false;">{{text}}<i class="material-icons">chevron_right</i></a></li>',
            'prevActive' => '<li class=""><a class="page-link" rel="prev" href="{{url}}"><i class="material-icons">chevron_left</i>{{text}}</a></li>',
            'prevDisabled' => '<li class="prev page-item disabled"><a class="page-link" href="" onclick="return false;"><i class="material-icons">chevron_left</i>{{text}}</a></li>',
            'counterRange' => '{{start}} - {{end}} of {{count}}',
            'counterPages' => '{{page}} of {{pages}}',
            'first' => '<li class="first page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
            'last' => '<li class="last page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',

            'ellipsis' => '<li class="ellipsis">...</li>',
            'sort' => '<a href="{{url}}">{{text}}</a>',
            'sortAsc' => '<a class="asc" href="{{url}}">{{text}}</a>',
            'sortDesc' => '<a class="desc" href="{{url}}">{{text}}</a>',
            'sortAscLocked' => '<a class="asc locked" href="{{url}}">{{text}}</a>',
            'sortDescLocked' => '<a class="desc locked" href="{{url}}">{{text}}</a>',
        ];
    }

    public function getDiscountOfBills($bills)
    {
        $discount = 0;
        if (!empty($bills)) {
            foreach ($bills as $bill) {
                $discount += $bill->discount;
            }
        }

        return $discount;
    }
    public function getSumOfBills($bills)
    {
        $sum = 0;
        if (!empty($bills)) {
            foreach ($bills as $bill) {
                $sum += $bill->amount;
            }
        }

        return $sum;
    }

    public function getInvoiceBalance($bills)
    {
        $balance = 0;
        if (!empty($bills)) {
            foreach ($bills as $bill) {
                $balance = $balance + $this->getBillBalance($bill);
            }
        }
        return $balance > 0 ? $balance : 0;
    }

    public function getBillBalance($bill)
    {
        $balance = $bill->amount - ($bill->deposit + $bill->discount);
        if ($balance < 0) {
            return 0;
        }
        return $balance;
    }

    public function checkCompleteInvoice($bills)
    {
        if (!empty($bills)) {
            foreach ($bills as $bill) {

                if ($bill->completed == 0) {
                    return "No";
                }
            }
        }
        return "Yes";
    }

    public function getUserDoctorSpecialization($user)
    {
        if (!empty($user->doctors[0]->specializations)) {
            $word = $this->getTitleFromSpecialty($user->doctors[0]->specializations[0]->name);
            return ucfirst($word);
        }
        return '';
    }
    public function getAllUserDoctorSpecialization($user)
    {
        $word = '';
        if (!empty($user->doctors[0]->specializations)) {

            foreach ($user->doctors[0]->specializations as $specialization) {
                $word2 = $this->getTitleFromSpecialty($specialization->name);
                $word .= ucfirst($word2) . ", ";
            }

            return '<br> <strong>' . $this->str_lreplace(",", ".", $word) . '</strong>';
            //return '<div class="d-flex p-2">' . $this->str_lreplace(",", ".", $word) . '</div>';

        }
        return '';
    }
    public function getTitleFromSpecialty($specialty)
    {
        if ($this->endsWith($specialty, "gy")) {
            $specialty = $this->str_lreplace("gy", "gist", $specialty);
        }
        if ($this->endsWith($specialty, "ery")) {
            $specialty = $this->str_lreplace("ery", "eon", $specialty);
        }

        return $specialty;
    }
    public function getRandomDoctorColor()
    {
        $color_class = [
            '',
            'xl-pink',
            'xl-seagreen',
            'xl-blue',
            'xl-khaki',
            'xl-coral',
            'xl-amber',
            'xl-slategray',
            'xl-turquoise',
            'xl-parpl',
        ];
        return $color_class[array_rand($color_class)];
    }
    public function getRandomTimeLineColor()
    {
        $color_class = [
            '',
            'border-warning border-l',
            'border-info',
            'border-danger',
        ];
        return $color_class[array_rand($color_class)];
    }
    public function getScaleColour($scale)
    {
        if ($scale >= 0 && $scale <= 24) {
            return "progress-bar-danger";
        }
        if ($scale >= 25 && $scale <= 39) {
            return "progress-bar-warning";
        }

        if ($scale >= 40 && $scale <= 59) {
            return "progress-bar-success";
        }

        if ($scale >= 60 && $scale <= 70) {
            return "progress-bar-warning";
        }

        if ($scale >= 71 && $scale <= 100) {
            return "progress-bar-danger";
        }

        return "progress-bar-info";
    }
    public function readableTimestamp($timestamp)
    {
        //$timestamp = 1333699439;
        return !empty($timestamp) ? gmdate("l, jS \of F Y h:i A", (int) $timestamp) : "Not Available.";
    }
    public function readableTimestamp2($timestamp)
    {
        //$timestamp = 1333699439;
        // return !empty($timestamp) ? gmdate("l, jS \of F Y h:i A", $timestamp) : "Not Available.";
        return !empty($timestamp) ? gmdate("l, M d, Y", (int) $timestamp) : "Not Available.";
    }

    public function getFacebookUrl($username)
    {
        return "http://fb.com/" . $username;
    }

    public function getTwitterUrl($username)
    {
        return "http://twitter.com/" . $username;
    }

    public function getInstagramUrl($username)
    {
        return "http://instagram.com/" . $username;
    }

    public function getAgeFromDate($date)
    {

        //dd(date("D M Y", strtotime($date)));
        //dd(strtotime($date));
        //return date("D M Y") - date("D M Y", strtotime($date));

        //$dateOfBirth = "17-10-1985";

        if (!empty($date)) {
            $today = date("D M Y");
            $diff = date_diff(date_create($date), date_create($today));
            return $diff->format('%y') + 1;
        }
        return "N/A";
    }

    //Not really in use but another variation of the above function
    public function getAge($year, $month, $day)
    {
        $date = "$year-$month-$day";
        if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
            $dob = new DateTime($date);
            $now = new DateTime();
            return $now->diff($dob)->y;
        }
        $difference = time() - strtotime($date);
        return floor($difference / 31556926);
    }

    //works with bootstrap file input plugin - http: //plugins.krajee.com/file-input
    public function checkImagePreview($image, $folder = null)
    {
        if (empty($image)) {
            return '';
        }

        return "data-initial-preview=\"<img src='" . $this->getDp($image, $folder) . "' class='file-preview-image' title='Image' width='300' height='150' >\"";
    }

    public function checkRatingRadio($review, $value)
    {
        if (!empty($review) and round($review->star_rating) == round((float) $value)) {
            return 'checked="checked"';
        }
        return '';
    }
    public function checkReviewOptionRatingRadio($review, $review_option, $value)
    {
        if (!empty($review->review_values)) {
            foreach ($review->review_values as $key => $review_value) {
                if ($review_value->review_option_id  == $review_option->id and (int) $review_value->value == $value) {
                    return 'checked="checked"';
                }
            }
        }
        return '';
    }
    public function checkVisitRadio($review, $value)
    {
        // return '';
        if (!empty($review) and $review->sort_of_visit  == $value) {
            return 'active';
            // return 'checked="checked"';
        }
        if (empty($review) and $value == "Couples") {
            return 'active';
        }
        return '';
    }
    public function getUserDisplayName($user)
    {
        return $user->name_desc;
    }

    public function getNotificationIcon2($notification_type_id)
    {

        // return '<i class="ft-bell info float-left d-block font-large-1 mt-1 mr-2"></i>';
        if ($notification_type_id == 1 || $notification_type_id == 5) { //info
            return '<i class="fa fa-info-circle info float-left d-block font-large-1 mt-1 mr-2"></i>';
        }
        if ($notification_type_id == 2) { //success
            return '<i class="fa fa-check success float-left d-block font-large-1 mt-1 mr-2"></i>';
        }
        if ($notification_type_id == 3) { //warning
            return '<i class="fa fa-exclamation-triangle warning float-left d-block font-large-1 mt-1 mr-2"></i>';
        }
        if ($notification_type_id == 4) { //error
            return '<i class="fa fa-exclamation-triangle danger float-left d-block font-large-1 mt-1 mr-2"></i>';
        }

        return '<i class="fa fa-info-circle"></i>';
    }

    public function getBusinessIcon($business)
    {
        if (!empty($business->api_response_details)) {
            $response = \json_decode($business->api_response_details, true);
            return $response['icon'];
        }

        return $this->Url->build('/assets/images/users/8.png', true);
    }

    public function getLinkData($business, $service = null)
    {
        $str = 'data-business_id="' . $business->id . '"' . " ";
        $str .= 'data-business_name="' . $business->name . '"' . " ";
        if (!empty($service)) {
            $str .= 'data-service_id="' . $service->id . '"' . " ";
            $str .= 'data-service_name="' . $service->name . '"' . " ";
        } else {
            $str .= 'data-service_id=""' . " ";
            $str .= 'data-service_name=""' . " ";
        }
        return $str;
    }
    public function dpUrl($image_url, $folder = null, $size = null)
    {
        return $this->Cu->dpUrl($image_url, $folder, $size);
    }

    public function getDp($image_url, $folder = null, $size = null)
    {
        return $this->Cu->dpUrl($image_url, $folder, $size);
    }
    public function lastSeen($user)
    {

        if (!empty($user->last_active_time)) {
            $time = Time::createFromTimestamp($user->last_active_time);
            if ($time->wasWithinLast('3 minutes')) {
                return "Online";
            } else {
                return "Last seen " . $time->timeAgoInWords();
            }
        }
        return "Offline";
    }

    public function userIsOnline($user)
    {

        if (!empty($user->last_active_time)) {
            $time = Time::createFromTimestamp($user->last_active_time);
            return $time->wasWithinLast('5 minutes');
        }
        return false;
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

    public function businessInCollection($collection, $business)
    {
        if (!empty($collection->collection_items)) {
            foreach ($collection->collection_items as $collection_item) {
                if ($collection_item->business_id == $business->id) {
                    return true;
                }
            }
        }
        return false;
    }
    public function checkDepartmentsDrop($all_departments, $page)
    {
        if (!empty($all_departments)) {
            foreach ($all_departments as $department) {
                if ($page == preg_replace('/\s+/', '', $department->name)) {
                    return true;
                }
            }
        }
        return false;
    }

    public function startsWith($haystack, $needle)
    {
        return $this->Cu->startsWith($haystack, $needle);
    }

    public function endsWith($haystack, $needle)
    {
        return $this->Cu->endsWith($haystack, $needle);
    }
    public function niceShorterDate($dob)
    {
        if (!empty($dob)) {
            $test = new DateTime($dob);
            return date_format($test, 'l jS, M Y');
        }
        return "N/A";
    }

    public function savePercentage($package)
    {
        $normal_yearly = $package->price_per_month * 12;
        $diff = $normal_yearly - $package->price_per_year;
        return round($diff / ($normal_yearly / 100));
    }
    public function dateFromTimestamp($timestamp = "", $format = null)
    {
        if (!empty($timestamp)) {
            return date((!empty($format) ? $format : "D, jS F Y"), $timestamp);
        }
        // return date("M jS h:i:s A", $timestamp);
        return "";
    }
    public function singularise($word, $count)
    {
        if ($count < 2) {
            if ($this->endsWith($word, "diagnoses")) { //special case
                $word = "diagnosis";
                return $word;
            }

            if ($this->endsWith($word, "ies")) {
                $word = $this->str_lreplace("ies", "y", $word);
            } elseif ($this->endsWith($word, "s")) {
                $word = $this->str_lreplace("s", "", $word);
            }
        }
        return $word;
    }
    public function showArrayItemsAsString($array)
    {
        return $this->Cu->showArrayItemsAsString($array);
    }
    public function findAndReplace($find, $replace, $string)
    {
        return str_replace($find, $replace, $string);
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

    // public function userHasRole($user_roles, $action_roles)
    // {
    //     return $this->Cu->userHasRole($user_roles, $action_roles);
    // }

    public function niceDateMonthYear($dob)
    {
        return $this->niceDateMonthDayYear($dob, 'M Y');
        // $test = new DateTime($dob);
        // return date_format($test, 'M Y');
        // return date_format($test, 'F Y');
    }
    public function niceDateMonthDayYear($dob, $format = 'M d, Y')
    {
        if (!empty($dob)) {
            return $dob->format($format);
            // return $dob->i18nFormat('M d, Y');

        }
        return '';
    }
    public function niceDate($dob)
    {
        $test = new DateTime($dob);
        return date_format($test, 'l, jS \of F Y');
    }

    public function niceDateNoYear($dob)
    {
        $test = new DateTime($dob);
        return date_format($test, 'l, jS \of F');
    }
}
