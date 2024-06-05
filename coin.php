<?php
class coin
{
    private string $coin;
    private int $exchange_rate; //taxa de cambio


    public function __construct($coin)
    {
        $this->set_coin($coin);
        $this->seach_exchange_rate($coin);
    }
    public function get_coin()
    {
        return $this->coin;
    }
    public function set_coin($coin)
    {
        $this->coin = $coin;
    }
    public function get_exchange_rate()
    {
        return $this->exchange_rate;
    }
    public function set_exchange_rate($exchange_rate)
    {
        $this->exchange_rate = $exchange_rate;
    }
    public function seach_exchange_rate(string $coin)
    {
        $start_date = date("d-m-Y");
        $end_date = date("d-m-Y", strtotime("-7 days"));

        $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoMoedaPeriodo(moeda=@moeda,dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@moeda=\'' . $coin . '\'&@dataInicial=\'' . $start_date . '\'&@dataFinalCotacao=\'' . $end_date . '\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';

        $date_s = json_decode(file_get_contents($url), true);

        $this->set_exchange_rate($date_s["value"][0]["cotacaoCompra"]);
    }
    public function print_exchange_rate()
    {
        // echo "O $coin esté custando " . numfmt_format_currency($padrao, $exchange_rate, $coin);
        // $real = $value / $exchange_rate;
        // echo ", o que vale " . numfmt_format_currency($padrao, $real, "BRL");
    }
}