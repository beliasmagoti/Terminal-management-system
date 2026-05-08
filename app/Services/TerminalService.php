<?php 
namespace App\Services;

use App\Interfaces\TerminalRepositoryInterface;
use App\Repositories\TermanalRepository;

class TerminalService {

    public function __construct(
        protected TerminalRepositoryInterface $terminalRepository
    )
    {
        throw new \Exception('Not implemented');
    }




}