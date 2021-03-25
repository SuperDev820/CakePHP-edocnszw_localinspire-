<?php

declare(strict_types=1);

namespace App\Command;

use Cake\Console\Arguments;
use Cake\Command\Command;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use App\Controller\Component\CustomComponent;
use Cake\Controller\ComponentRegistry;
use App\Utility\Custom;

/**
 * Sics command.
 */
class SicsCommand extends Command
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

        return $parser;
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
        $sic2s = $this->table('Sic2categories')->find()->toArray();
        $this->sicLogic($sic2s, 'Sic4categories', 'Sic2categoriesSic4categories', 'sic2category_id', 'sic4category_id', $io);

        $sic4s = $this->table('Sic4categories')->find()->toArray();
        $this->sicLogic($sic4s, 'Sic8categories', 'Sic4categoriesSic8categories', 'sic4category_id', 'sic8category_id', $io);
    }


    public function table($model)
    {
        return  \Cake\Datasource\FactoryLocator::get('Table')->get($model);
    }
    private function sicLogic($data, $model1, $model2, $column1, $column2, $io)
    {
        $this->Custom = new CustomComponent(new ComponentRegistry(new \Cake\Controller\Controller()));
        $this->Cu = new Custom();

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
                                $io->out("saved relation for " . $name);
                            }
                        }
                    }
                }
            }
        }
    }
}
