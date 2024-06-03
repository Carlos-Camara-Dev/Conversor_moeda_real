<?php
// require_once("coin.php");
if (isset($_POST['coin'])) {

    $padrao = numfmt_create("pt_BR", NumberFormatter::CURRENCY);
    $coin = $_POST['coin'];

    $value = $_POST['value'];
    $end_date = date('m-d-Y');
    $start_date = date('m-d-Y', strtotime("-7 days"));

    $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoMoedaPeriodo(moeda=@moeda,dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@moeda=\'' . $coin . '\'&@dataInicial=\'' . $start_date . '\'&@dataFinalCotacao=\'' . $end_date . '\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';

    $dados = json_decode(file_get_contents($url), true);

    $exchange_rate = $dados["value"][0]["cotacaoCompra"];

    echo "O $coin esté custando " . numfmt_format_currency($padrao, $exchange_rate, $coin);
    $real = $value / $exchange_rate;
    echo ", o que vale " . numfmt_format_currency($padrao, $real, "BRL");
} else {
    echo "Esperando o formulário...";
}
