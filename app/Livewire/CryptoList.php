<?php

namespace App\Livewire;

use App\CryptoApiRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CryptoList extends Component
{
    protected $cryptoRepository;
    public $cryptos = [];
    public $coins = [];

    public function mount(CryptoApiRepositoryInterface $cryptoRepository)
    {
        $this->cryptoRepository = $cryptoRepository;
        $responsedcoins = $this->cryptoRepository->listLatestCoins('market_cap', 'coins');
        $this->coins = collect($responsedcoins)->map(function ($coin) {
            return ['label' => $coin['name'] . ' (' . $coin['symbol'] . ')', 'value' => $coin['symbol']];
        });
    }

    public function render()
    {
        $this->cryptos = [];
        $coins = Auth::user()->cryptos;
        foreach ($coins as $coin) {
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
