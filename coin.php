<?php
class coin
{
    private $coin;
    private $exchange_rate; //taxa de cambio

    public function __construct($coin)
    {
        $this->set_coin($coin);
    }
    public function get_coin()
    {
        return $this->coin;
    }
    public function set_coin($coin)
    {
        $this->coin = $coin;
    }
    public function exchange_rate()
    {
    }
}
