<?php

namespace App\Commands;

use App\Services\BlockChain;
use App\Services\UTXOSet;
use Illuminate\Console\Command;

class InitBlockChain extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init-blockchain {address : 创世区块coinbase地址}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '初始化一个区块链，如果没有则创建';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $address = $this->argument('address');
        $this->task('init blockchain', function () use ($address) {
            $bc = BlockChain::NewBlockChain($address);
            (new UTXOSet($bc))->reindex();
            return true;
        });
    }
}
