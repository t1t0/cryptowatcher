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
}
