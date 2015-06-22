<?php


class QuickFind
{
    protected $id = [];

    public function __construct($n)
    {
        $this->id = range(0, $n - 1);
    }

    public function union($p, $q)
    {
        $pid = $this->id[$p];
        $qid = $this->id[$q];
        foreach ($this->id as $key => &$value) {
            if ($value === $pid) {
                $value = $qid;
            }
        }

    }

    public function println()
    {
        echo implode(" ", $this->id);
        echo "\n";
    }
}

class WeightedQuickUnion extends QuickFind
{
    protected $weight = [];

    public function __construct($n)
    {
        $this->weight = array_fill(0, 10, 1);
        parent::__construct($n);
    }

    public function union($p, $q)
    {
        $rootP = self::find($p);
        $rootQ = self::find($q);
        if ($rootP != $rootQ) {

            if ($this->weight[$rootP] < $this->weight[$rootQ]) {
                $this->id[$rootP] = $rootQ;
                $this->weight[$rootQ] += $this->weight[$rootP];
            } else {
                $this->id[$rootQ] = $rootP;
                $this->weight[$rootP] += $this->weight[$rootQ];
            }
        }

    }

    public function find($n)
    {
        while ($n != $this->id[$n]) {
            $n = $this->id[$n];
        }
        return $n;
    }

}

$qf = new QuickFind(10);
$qf->union(3, 5);
$qf->union(1, 8);
$qf->union(1, 9);
$qf->union(1, 5);
$qf->union(9, 0);
$qf->union(7, 2);
$qf->println();
//3-5 1-8 1-9 1-5 9-0 7-2

$qf = new WeightedQuickUnion(10);
$qf->union(4, 6);
$qf->union(3, 6);
$qf->union(8, 9);
$qf->union(7, 0);
$qf->union(1, 2);
$qf->union(8, 4);
$qf->union(6, 5);
$qf->union(1, 7);
$qf->union(6, 0);
//4-6 3-6 8-9 7-0 1-2 8-4 6-5 1-7 6-0
$qf->println();
