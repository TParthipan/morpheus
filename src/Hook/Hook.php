<?php
namespace App\Hook;
use Symfony\Component\HttpClient\HttpClient;

class Hook
{
    private $client;
    public function __construct()
    {
        $this->client =   HttpClient::create();
    }

    public function checkFileExist($filepath) :bool
    {
        if(!file_exists($filepath)){
            print_r("Le fichier {$filepath} n'existe pas \n");
            return false;  
        }
        return true;  
    }
    public function getCodePostale(array $search) :string
    {   
        $response = $this->client->request('GET','https://api-adresse.data.gouv.fr/search', [
            'query' => [
                'q' => implode(" ", $search),
                'limit' => 1,
            ],
        ]);
        $content = ($response->getStatusCode()==200)? $response->toArray() : [];
        $cp= (isset($content['features'][0]['properties']['postcode']))? $content['features'][0]['properties']['postcode'] : '';
        return $cp;  
    }

}
