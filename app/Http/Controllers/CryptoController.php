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

    public function index(string $sort, string $currencyType) { 
        $cryptos = $this->cryptoRepository->listLatestCoins($sort, $currencyType); 
        return view('cryptos.index', compact('cryptos')); 
    } 
    
    public function show(string $symbol, string $currency) { 
        $coin = $this->cryptoRepository->getLatestCoinQuote($symbol, $currency);
         return view('cryptos.show', compact('coin')); 
    }
}
