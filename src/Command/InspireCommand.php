<?php

declare(strict_types=1);

namespace App\Command;

use Cake\Console\Arguments;
use Cake\Command\Command;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use App\Utility\Custom;
use App\Controller\Component\CustomComponent;
use Cake\Controller\ComponentRegistry;

/**
 * Inspire command.
 */
class InspireCommand extends Command
{
    /**
     * Hook method for defining this command's option parser.
     *
     * @see https://book.cakephp.org/3.0/en/console-and-shells/commands.html#defining-arguments-and-options
     *
     * @param \Cake\Console\ConsoleOptionParser $parser The parser to be defined
     * @return \Cake\Console\ConsoleOptionParser The built parser.
     */
    public function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser = parent::buildOptionParser($parser);
        $parser->addArgument('action', [
            'help' => 'split or save'
        ]);
        return $parser;
    }

    public function initialize(): void
    {
        $controller = new \Cake\Controller\Controller();
        $this->Custom = new CustomComponent(new ComponentRegistry($controller));
        $this->Cu = new Custom();
    }


    public function table($model)
    {
        return  \Cake\Datasource\FactoryLocator::get('Table')->get($model);
    }

    /**
     * Implement this method with your command's logic.
     *
     * @param \Cake\Console\Arguments $args The command arguments.
     * @param \Cake\Console\ConsoleIo $io The console io
     * @return null|void|int The exit code or null for success
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $this->io = $io;
        $action = $args->getArgument('action');
        $this->$action($io);
    }

    public function biz($io)
    {
        // $this->bizCsvAction($io, true);
        $this->bizCsvAction($io);
    }

    private function bizCsvAction($io, $split = false)
    {
        $folder = LOGS . 'biz';
        $folder_files = $this->Cu->getDirContents($folder);
        $count = 0;
        foreach ($folder_files as $key => $value) {
            if (strpos($value, '.csv') !== false) {
                if ($split) {
                    $this->Cu->split_csv($value);
                    $this->io->out("Splitted " . $value);
                    unlink($value);
                } else {
                    $data = $this->Cu->csv_to_array($value);
                    if ($data != false) {
                        $this->io->out("Working on " . $value);
                        foreach ($data as $key2 => $d) {

                            $d2 = array_change_key_case($d, CASE_LOWER);
                            // debug($d2);
                            $city = $this->table('Cities')->find()->contain(['States'])
                                ->where([
                                    'OR' => [
                                        // ["MATCH(" . $model . ".name) AGAINST('{$search_term}'IN BOOLEAN MODE)"],
                                        ['LOWER(Cities.name) LIKE' => "%" . trim(strtolower($d2['city'])) . "%"],
                                        // ['LOWER(Cities.county) LIKE' => "%" . trim(strtolower($d2['city'])) . "%"],
                                        // ["MATCH(" . $model . ".county) AGAINST('{$search_term}'IN BOOLEAN MODE)"],
                                    ],
                                ])->andWhere(['LOWER(States.code)' => trim(strtolower($d2['state code']))])->first();


                            if (empty($city)) {
                                $city = $this->table('Cities')->find()->contain(['States'])
                                    ->where([
                                        'OR' => [
                                            ["MATCH(Cities.name) AGAINST('" . $d2['city'] . "'IN BOOLEAN MODE)"],
                                            ['LOWER(Cities.name) LIKE' => "%" . trim(strtolower($d2['city'])) . "%"],
                                            // ['LOWER(Cities.county) LIKE' => "%" . trim(strtolower($d2['city'])) . "%"],
                                            // ["MATCH(" . $model . ".county) AGAINST('{$search_term}'IN BOOLEAN MODE)"],
                                        ],
                                    ])->andWhere(['LOWER(States.code)' => trim(strtolower($d2['state code']))])->first();
                            }

                            if (!empty($city)) {
                                // $this->io->out("Working on City " . $city->name);
                                $sic2 = $this->table('Sic2categories')->find()->where(['name' => $d2['sic2 category']])->first();
                                if (empty($sic2) and !empty($d2['sic2 category'])) {
                                    $sic2 = $this->table('Sic2categories')->newEmptyEntity();
                                    $sic2->name = $d2['sic2 category'];
                                    if ($this->table('Sic2categories')->save($sic2)) {
                                    }
                                } else {
                                    if (!empty($sic2)) {
                                        $this->table('Sic2categories')->deleteAll(['id <>' => $sic2->id, 'name' => $d2['sic2 category']]);
                                    }
                                }
                                $sic4 = $this->table('Sic4categories')->find()->where(['name' => $d2['sic4 category']])->first();
                                if (empty($sic4) and !empty($d2['sic4 category'])) {
                                    $sic4 = $this->table('Sic4categories')->newEmptyEntity();
                                    $sic4->name = $d2['sic4 category'];
                                    if ($this->table('Sic4categories')->save($sic4)) {
                                    }
                                } else {
                                    if (!empty($sic4)) {
                                        $this->table('Sic4categories')->deleteAll(['id <>' => $sic4->id, 'name' => $d2['sic4 category']]);
                                    }
                                }
                                $sic8 = $this->table('Sic8categories')->find()->where(['name' => $d2['sic8 category']])->first();
                                if (empty($sic8) and !empty($d2['sic8 category'])) {
                                    $sic8 = $this->table('Sic8categories')->newEmptyEntity();
                                    $sic8->name = $d2['sic8 category'];
                                    if ($this->table('Sic8categories')->save($sic8)) {
                                    }
                                } else {
                                    if (!empty($sic8)) {
                                        $this->table('Sic8categories')->deleteAll(['id <>' => $sic8->id, 'name' => $d2['sic8 category']]);
                                    }
                                }

                                $industry = $this->table('Industries')->find()
                                    ->where(['name' => $d2['industry']])->first();
                                if (empty($industry) and !empty($d2['industry'])) {
                                    $industry = $this->table('Industries')->newEmptyEntity();
                                    $industry->name = $d2['industry'];
                                    if ($this->table('Industries')->save($industry)) {
                                    }
                                }
                                $business = $this->table('Businesses')->find()
                                    ->where(['name' => $d2['business name'], 'city_id' => $city->id])->first();
                                $message = "Updated ";
                                if (empty($business)) {
                                    $message = "Saved new ";
                                    $business = $this->table('Businesses')->newEmptyEntity();
                                }
                                $business->name = !empty($business->name) ? $business->name : $d2['business name'];
                                $business->about = !empty($business->name) ? $business->name : $d2['business name'];
                                $business->sic2category_id =  !empty($sic2) ? $sic2->id : null;
                                $business->sic4category_id =  !empty($sic4) ? $sic4->id : null;
                                $business->sic8category_id =  !empty($sic8) ? $sic8->id : null;
                                $business->industry_id =  !empty($industry) ? $industry->id : null;
                                $business->contact_name = !empty($business->contact_name) ? $business->contact_name : $d2['contact name'];
                                $business->city_id =  $city->id;
                                $business->zip = !empty($business->zip) ? $business->zip : $d2['zip code'];
                                $business->address = !empty($business->address) ? $business->address : $d2['address'];
                                $business->phone = !empty($business->phone) ? $business->phone : $d2['phone'];
                                $business->website = !empty($business->website) ? $business->website : $d2['web'];

                                $cordinates = explode(',', $d2['coordinates']);
                                $business->latitude = !empty($business->latitude) ? $business->latitude : (!empty($cordinates[0]) ? $cordinates[0] : 0);
                                $business->longitude = !empty($business->longitude) ? $business->longitude : (!empty($cordinates[1]) ? $cordinates[1] : 0);
                                $business->location_type = !empty($business->location_type) ? $business->location_type : $d2['location type'];
                                $business->market_variable = !empty($business->market_variable) ? $business->market_variable : $d2['market variable'];
                                $business->annual_revenue = !empty($business->annual_revenue) ? $business->annual_revenue : $d2['annual revenue'];
                                if ($this->table('Businesses')->save($business)) {
                                    // $this->io->out($message . $business->name);
                                } else {
                                    // dd($business);
                                }

                                $count++;
                            }
                        }
                        if (file_exists($value)) {
                            unlink($value);
                        }
                        if ($count > 50000) {
                            exit();
                        }
                        // $io->out("updated " . $updates . " cities");
                    } else {
                        // dd($file);
                    }
                }
            }
        }
    }


    public function sics()
    {
        //so we'd say, for each sic2, find sic4 that is related to each word in sic2, then patch entityy the association
        $sic2s = $this->table('Sic2categories')->find()->toArray();
        $this->sicLogic($sic2s, 'Sic4categories', 'Sic2categoriesSic4categories', 'sic2category_id', 'sic4category_id');

        $sic4s = $this->table('Sic4categories')->find()->toArray();
        $this->sicLogic($sic4s, 'Sic8categories', 'Sic4categoriesSic8categories', 'sic4category_id', 'sic8category_id');
    }

    private function sicLogic($data, $model1, $model2, $column1, $column2)
    {
        foreach ($data as $key => $sic2) {
            $names_exploded = explode(" ", $sic2->name);
            foreach ($names_exploded as $key => $name) {
                $name = trim(str_replace(" ", "", $name));
                $name =  $this->Cu->clean($name);
                if (!empty($name)) {
                    $name = strtolower($name);
                    if ($name == "and" or $name == "or" or $name == "other" or $name == "an" or $name == "of") {
                        continue;
                    }
                    $sic4s = $this->table($model1)->find()
                        ->where(['LOWER(' . $model1 . '.name) LIKE' => "%" . strtolower($name) . "%"])->toArray();
                    if (!empty($sic4s)) {
                        foreach ($sic4s as $key => $sic4) {
                            $sic2sic4 = $this->table($model2)->find()
                                ->where([$column1 => $sic2->id, $column2 => $sic4->id])->first();
                            if (empty($sic2sic4)) {
                                $sic2sic4 = $this->table($model2)->newEmptyEntity();
                            }
                            $sic2sic4->$column1 = $sic2->id;
                            $sic2sic4->$column2 = $sic4->id;
                            if ($this->table($model2)->save($sic2sic4)) {
                                $this->io->out("saved relation for " . $name);
                            }
                        }
                    }
                }
            }
        }
    }

    public function city()
    {
        $file = LOGS . DS . 'city' . DS . 'uscities.csv';

        //$data = $this->getFile($file);
        $data = $this->Cu->csv_to_array($file);

        $updates = 0;

        if ($data != false) {
            foreach ($data as $data) {
                if (strpos($data['city'], "'") !== false) {
                    continue;
                }
                $data = array_change_key_case($data, CASE_LOWER);
                // debug($data);
                $city = $this->table('Cities')->find()->contain(['States'])
                    ->where([
                        'OR' => [
                            // ["MATCH(Cities.name) AGAINST('" . $data['city'] . "'IN BOOLEAN MODE)"],
                            ['LOWER(Cities.name) LIKE' => "%" . trim(strtolower($data['city'])) . "%"],
                            // ['LOWER(Cities.county) LIKE' => "%" . trim(strtolower($d2['city'])) . "%"],
                            // ["MATCH(" . $model . ".county) AGAINST('{$search_term}'IN BOOLEAN MODE)"],
                        ],
                    ])->andWhere(['States.code' => $data['state_id']])->first();
                if (empty($city)) {
                    $city = $this->table('Cities')->find()->contain(['States'])
                        ->where([
                            'OR' => [
                                ["MATCH(Cities.name) AGAINST('" . $data['city'] . "'IN BOOLEAN MODE)"],
                                ['LOWER(Cities.name) LIKE' => "%" . trim(strtolower($data['city'])) . "%"],
                                // ['LOWER(Cities.county) LIKE' => "%" . trim(strtolower($d2['city'])) . "%"],
                                // ["MATCH(" . $model . ".county) AGAINST('{$search_term}'IN BOOLEAN MODE)"],
                            ],
                        ])->andWhere(['States.code' => $data['state_id']])->first();
                }
                // dd($city);


                if (!empty($city) and empty($city->population)) {
                    $data['population'] = mb_convert_encoding($data['population'], "UTF-8");
                    $city->population = $data['population'];
                    if ($this->table("Cities")->save($city)) {
                        $this->io->out("updated " . $city->name);
                        $updates++;
                    } else {
                        dd($city);
                    }
                }
            }

            $this->io->out("updated " . $updates . " cities");
        } else {
            dd($file);
        }
    }
}
