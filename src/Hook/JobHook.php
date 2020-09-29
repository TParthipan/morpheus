<?php
// src/Hook/JobHook.php
namespace App\Hook;

class JobHook extends Hook
{
    public function formatAd(array $ad): array
    {   
        // if(!isset($ad['contract'])){
        //     print_r("Le champs contract est introuvable pour le client ".$ad['client_reference']."!!!! \r\n");
        // }
        $contrat = $this->getContrat('interim');
        if($contrat === 0){
            print_r("Le type de contrat est nouveau \n");
            return[];
        }
        $body=$this->buildDescription($ad);
        $cp=$this->getCodePostale([$ad['location_city'], $ad['location_state'], $ad['location_country']]);
        $formatted_ad=array(
            'id'        => isset($ad['client_reference']) ? (int)explode('-',$ad['client_reference'])[1] : '', 
            'title'     => isset($ad['title']) ? $ad['title'] : '', 
            'body'      => $body, 
            'vertical'  =>'job', 
            'city'      => isset( $ad['location_city']) ? $ad['location_city'] :'',
            'zip_code'  => $cp, 
            'pro_ad'    => true, 
            'images'    => (isset($ad['pictures'])) ? [$ad['pictures']] : [], 
            'contract'  => (int)$contrat,
        );
        if(isset($ad['salary'])){
            $formatted_ad['salary']=(int)$ad['salary'];
        }

        return $formatted_ad;
    }
    /**
     * Fonction qui détermine le contrat
     */
    public function getContrat($contrat)
    {  
        $contrat= mb_strtolower($contrat);
        switch (mb_strtolower($contrat)){
            case 'cdi':
                return 1;
                break;
            case 'cdd':
                return 2;
                break;
            case 'interim':
                return 3;
                break;
            case 'stage/alternance':
                return 4;
                break;
            default:
                return 0;
                break;
        }
    }
    public function buildDescription($ad){
        $data1= (isset($ad['description_entreprise']))? $ad['description_entreprise'] : '';
        $data2= (isset($ad['description_poste']))? $ad['description_poste'] : '';

        return substr($data1."\r\n".$data2, 0, 500);
    }
}
