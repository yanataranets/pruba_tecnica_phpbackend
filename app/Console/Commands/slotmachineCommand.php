<?php

namespace App\Console\Commands;

use App\Play;
use App\Resources\Board;
use App\Resources\PayLines;
use App\Resources\Winning;
use Illuminate\Console\Command;

class slotmachineCommand extends Command
{
    protected $signature = 'slot:play';

    public function handle()
    {
        $play = new Play();
        $board = new Board();
        $bet = 1;
        $bet_count = $bet * 100;

        $play->setBoard($board->get_board());
        $pay_lines = new PayLines($board->get_board());
        $play->setPlayLines($pay_lines->getWinners());
        $play->setBetAmount($bet_count);
        $total_win = new Winning($pay_lines->getWinners(), $bet_count);
        $play->setTotalWin($total_win->getTotal());
        $this->info(json_encode($play, JSON_PRETTY_PRINT));
    }
}
