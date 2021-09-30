<?php

namespace App;

class Play
{
    public $board;
    public $play_lines;
    public $bet_count;
    public $total_win;

    public function setPlayLines($play_lines){
        $this->play_lines = $play_lines;
    }

    public function setBoard($board){
        $this->board = $board;
    }

    public function setBetAmount($bet_count){
        $this->bet_count = $bet_count;
    }

    public function setTotalWin($total_win){
        $this->total_win = $total_win;
    }
}
