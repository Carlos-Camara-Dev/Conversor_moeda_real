<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de Moeda - Real</title>
    <link rel="stylesheet" href="overall_style.css">
</head>

<body>
    <main class="main">
        <section>
            <form action="requeri.php" method="post" id="form_conversor">
                <h2>Convertor de Moedas - Real</h2>
                <label for="coin">
                    Moeda
                </label><br>
                <input type="text" name="coin" id="coin" placeholder="Digite a moeda" required>
                <br>
                <label for="value">
                    Valor
                </label><br>
                <input type="text" name="value" id="value" placeholder="Digite o valor" required>
                <!-- step="0.001" -->
                <br>
                <input id="buttom" type="submit" value="converter">
            </form>
        </section>
    </main>
</body>

</html>