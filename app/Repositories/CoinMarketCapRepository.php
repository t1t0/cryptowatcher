<?php

namespace App\Repositories;

use App\CryptoApiRepositoryInterface;
use Illuminate\Support\Facades\Http;

class CoinMarketCapRepository implements CryptoApiRepositoryInterface
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct() { 
        $this->baseUrl = config('services.coinmarketcap.base_url');
        $this->apiKey = config('services.coinmarketcap.api_key');
    } 
    
    public function listLatestCoins(string $sort = 'market_cap', string $currencyType = 'coins') { 
        $endpoint = 'cryptocurrency/listings/latest';
        $url = $this->baseUrl.$endpoint;

        $response = Http::withHeaders([ 
                'X-CMC_PRO_API_KEY' => $this->apiKey, 
            ])->withQueryParameters([ 
                'sort' => $sort, 
                'cryptocurrency_type' => $currencyType 
            ])->get($url);
            

        return json_decode($response->getBody(), true)['data']; 
    } 
    
    public function getLatestCoinQuote(string $symbol, string $currency = 'EUR') { 
        $endpoint = 'cryptocurrency/quotes/latest';
        $url = $this->baseUrl.$endpoint;

        $response = Http::withHeaders([ 
                'X-CMC_PRO_API_KEY' => $this->apiKey, 
            ])->withQueryParameters([ 
                'symbol' => $symbol, 
                'convert' => $currency 
            ])->get($url);
            

        return json_decode($response->getBody(), true)['data'];  
    }


}