<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use App\Converter\JsonConverter;
use App\Hook\RealEstateHook;
use App\Validator\Api;

class RealEstateExecutor extends Command
{
    protected function configure()
    {
        $this->setName('real-estate-executor');
        $this->addArgument('filepath', InputArgument::REQUIRED, 'Json File path');
        $this->formatter = new RealEstateHook();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {   $filepath=$input->getArgument('filepath');
        if($this->formatter->checkFileExist($filepath)){
            $ads= JsonConverter::jsonToArray($filepath);
            $formatted_ads = [];
            foreach ($ads as $ad) {
                $formatted_ad=$this->formatter->formatAd($ad);
                Api::send($formatted_ad, 'real_estate');
                $formatted_ads[]=$formatted_ad;
            }
    
            print_r($formatted_ads);
        }
        return 0;
    }
}
