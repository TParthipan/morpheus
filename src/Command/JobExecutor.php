<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use App\Converter\XMLConverter;
use App\Hook\JobHook;
use App\Validator\Api;


class JobExecutor extends Command
{
    protected function configure()
    {
        $this->setName('job-executor');
        $this->addArgument('filepath', InputArgument::REQUIRED, 'File path?');
        $this->formatter = new JobHook();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {   $filepath=$input->getArgument('filepath');
        if($this->formatter->checkFileExist($filepath)){
            $ads= XMLConverter::xmlToArray($filepath);
            $formatted_ads = [];
            foreach ($ads as $ad) {
                $formatted_ad=$this->formatter->formatAd($ad);
                Api::send($formatted_ad, 'job');
                $formatted_ads[]=$formatted_ad;

            }
            print_r($formatted_ads);
        }
        return 0;
    }
}
