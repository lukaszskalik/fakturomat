<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Faktura</title>
</head>
<body>
    <h1>
        Nr faktury: {{$invoice->number}}
    </h1>
    <h2>
        Kwota: {{$invoice->total}} PLN
    </h2>
    <h3>
        Data wystawienia: {{$invoice->date}}
    </h3>
    <br/>
    <h3>
        Dane klienta:
    </h3>
    <p>{{$invoice->customer->name}}</p>
    <p>{{$invoice->customer->address}}</p>
    <p>{{$invoice->customer->nip}}</p>

</body>
</html>
