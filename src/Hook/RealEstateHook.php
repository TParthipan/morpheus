<?php
// src/Hook/RealEstateHook.php
namespace App\Hook;

class RealEstateHook extends Hook
{
    public function formatAd(array $ad): array
    {
        $extraField = $this->getCategory($ad['categorie'], $ad['type']);
        if(empty($extraField)){
            return [];
        }
        $formatted_ad=array(
            'id'        => isset($ad['id']) ? $ad['id'] : '', 
            'title'     => isset($ad['titre']) ? $ad['titre'] : '', 
            'body'      => isset($ad['description']) ? $ad['description'] : '', 
            'vertical'  =>'real_estate', 
            'price'     => isset($ad['prix']) ? (int)$ad['prix'] : null, 
            'city'      => isset( $ad['ville']) ? $ad['ville'] :'',
            'zip_code'  => isset($ad['code_postal']) ? $ad['code_postal'] :'', 
            'pro_ad'    => true, 
            'images'    => (isset($ad['photos']) && is_array($ad['photos'])) ? array_slice($ad['photos'], 0, 10) : [], 
            'category'  => $extraField['categorie']
        );
        if($extraField['type'] !== ''){
            $formatted_ad['type']=$extraField['type'];
        }

        return $formatted_ad;
    }
    /**
     * Fonction qui détermine la categorie et le type si requis à renvoyer
     */
    public function getCategory($categorie, $type)
    {
        switch (mb_strtolower($categorie)){
            case 'vente':
                return array('categorie' => 1, 'type' => '');
                break;
            case 'location':
                return array('categorie' => 2, 'type' => '');
                break;
            case 'colocation':
                return array('categorie' => 3, 'type' => '');
                break;
            case 'bureaux et commerces':
                return array('categorie' => 4, 'type' => $type);
            default:
                return [];
                break;
        }
    }
}
