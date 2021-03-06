<?php

namespace App\Resources;

class PayLines
{
    private $data_lines = [
        [0, 3, 6, 9, 12],
        [1, 4, 7, 10, 13],
        [2, 5, 8, 11, 14],
        [0, 4, 8, 10, 12],
        [2, 4, 6, 10, 14],
    ];

    private $data = [0, 3, 6, 9, 12, 1, 4, 7, 10, 13, 2, 5, 8, 11, 14];

    private $payLines;
    private $line;
    private $sequence;
    private $winningLines;

    public function __construct($sequence){
        $this->sequence = $sequence;
        $this->line = $this->order($this->sequence);
        $this->payLines = $this->getLines($this->data_lines, $this->line);
        $this->winningLines = $this->getWinningLines($this->payLines);
    }

    public function order($sequence){
        foreach ($this->data as $key => $value) {
            $line[$value] = $sequence[$key];
        }
        ksort($line);
        return $line;
    }

    public function getLines($payLines, $line){
        $output = [];
        foreach ($payLines as $payLineIndex => $payLineValue) {
            foreach ($payLineValue as $lineIndex => $value) {
                $output[$payLineIndex][$lineIndex] = $line[$value];
            }
        }
        return $output;
    }

    public function getWinningLines($lines){
        $possibleLines = $this->getPossibleLines($lines);
        $winners = $this->checkWinning($possibleLines);

        return $winners;
    }

    public function getPossibleLines($lines){
        $possibleLines = array_map(function ($line) {
            if (max(array_count_values($line)) < 3) {
                $line = null;
            }

            return $line;
        }, $lines);

        return array_values(array_filter($possibleLines));
    }

    public function checkWinning($lines){
        $winners = array_map(function ($line) {
            $counted = array_count_values($line);
            arsort($counted);
            $symbol = array_keys($counted)[0];
            $previousIndex = null;
            $count = 0;
            foreach ($line as $index => $value) {
                if ($value == $symbol) {
                    if ($previousIndex === null) {
                        $previousIndex = $index;
                        $count = 1;
                    } else {
                        if ($previousIndex + 1 == $index) {
                            $count++;
                        } else {
                            $count = 0;
                        }
                        $previousIndex = $index;
                    }
                }
            }
            if ($count >= 3) {
                return [implode(', ', $line) => $count];
            }
        }, $lines);
        return array_filter($winners);
    }

    public function getWinners(){
        return $this->winningLines;
    }
}
