<?php

namespace App\Http\Controllers;

use App\CryptoApiRepositoryInterface;
use Illuminate\Http\Request;

class CryptoController extends Controller
{
    protected $cryptoRepository; 
    
    public function __construct(CryptoApiRepositoryInterface $cryptoRepository) { 
        $this->cryptoRepository = $cryptoRepository; 
    } 

    public function index(?string $sort, ?string $currencyType) { 
        return $this->cryptoRepository->listLatestCoins($sort, $currencyType); 
    } 

    public function show(string $symbol, string $currency) { 
        return $this->cryptoRepository->getLatestCoinQuote($symbol, $currency);
    }
}
