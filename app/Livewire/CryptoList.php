<?php

namespace App\Livewire;

use App\CryptoApiRepositoryInterface;
use App\Models\Crypto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class CryptoList extends Component
{
    protected $cryptoRepository;
    public $cryptos = [];
    public $coins = [];
    public $newCoin;

    public function render(CryptoApiRepositoryInterface $cryptoRepository)
    {
        $this->cryptoRepository = $cryptoRepository;
        $responsedcoins = $this->cryptoRepository->listLatestCoins('market_cap', 'coins');
        $userCoins = Auth::user()->cryptos->pluck('symbol')->toArray();

        // Filter out coins that are already in the user's list
        $this->coins = collect($responsedcoins)->filter(function ($coin) use ($userCoins) {
            return !in_array($coin['symbol'], $userCoins);
        })->map(function ($coin) {
            return ['label' => $coin['name'], 'value' => $coin['symbol']];
        });

        $this->cryptos = [];
        foreach (Auth::user()->cryptos as $coin) {
            $response = $this->cryptoRepository->getLatestCoinQuote($coin->symbol, 'EUR');
            $this->cryptos[] = [
                'name' => $response[$coin->symbol]['name'],
                'symbol' => $response[$coin->symbol]['symbol'],
                'price' => round($response[$coin->symbol]['quote']['EUR']['price'], 2)
            ];
        }
        return view('livewire.crypto-list');
    }


    public function addCoinToList()
    {
        $coin = collect($this->coins)->firstWhere('value', $this->newCoin);
        $coinToAdd = new Crypto();
        $coinToAdd->symbol = $coin['value'];
        $coinToAdd->name = $coin['label'];
        $coinToAdd->user_id = Auth::user()->id;
        $coinToAdd->save();
    }
}
