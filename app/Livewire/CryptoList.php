<?php

namespace App\Livewire;

use App\CryptoApiRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CryptoList extends Component
{
    protected $cryptoRepository; 
    public $cryptos = [];

    public function render(CryptoApiRepositoryInterface $cryptoRepository)
    {
        $this->cryptos = [];
        $this->cryptoRepository = $cryptoRepository; 
        $coins = Auth::user()->cryptos;
        foreach($coins as $coin){
            $response = $this->cryptoRepository->getLatestCoinQuote($coin->symbol, 'EUR');
            $this->cryptos[] = [
                'name' => $response[$coin->symbol]['name'],
                'symbol' => $response[$coin->symbol]['symbol'],
                'price' => round($response[$coin->symbol]['quote']['EUR']['price'], 2)
            ];
        }
        return view('livewire.crypto-list');
    }
}
