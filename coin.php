<?php
class coin
{
    private  $coin;
    private  $exchange_rate; //taxa de cambio
    // private string $standard;


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
    // public function get_standard()
    // {
    //     return $this->standard;
    // }
    public function standard_real($value, $coin)
    {
        $standard = numfmt_create("pt_BR", NumberFormatter::CURRENCY);
        $standard = numfmt_format_currency($standard, $value, $coin);
        return $standard;
    }
    public function seach_exchange_rate(string $coin)
    {
        $end_date = date("d-m-Y");
        $start_date = date("d-m-Y", strtotime("-7 days"));

        $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoMoedaPeriodo(moeda=@moeda,dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@moeda=\'' . $coin . '\'&@dataInicial=\'' . $start_date . '\'&@dataFinalCotacao=\'' . $end_date . '\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';

        $date_s = json_decode(file_get_contents($url), true);
        //     $dados = json_decode(file_get_contents($url), true);

        $exchange_rate = $date_s["value"][0]["cotacaoCompra"];
        $this->set_exchange_rate($exchange_rate);
    }
    public function print_exchange_rate($value)
    {
        $standard = $this->standard_real($this->get_exchange_rate(), $this->get_coin());
        echo "Moeda: " . $this->get_coin() . "<br>";
        echo "Taxa de câmbio: " . $this->get_exchange_rate() . "<br>";
        echo "Data de Verificação: " . date("d-n-Y") . "<br>";
        echo "Custo: $standard <br>";
        $real = $value / $this->get_exchange_rate();
        $standard_real =  $this->standard_real($real, $this->get_coin());
        echo "Real: $standard_real <br>";
    }
}
