<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapport des Ventes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .total {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Rapport des Ventes</h1>
    <table>
        <thead>
            <tr>
                <th>Numéro de Facture</th>
                <th>Date</th>
                <th>Montant Total</th>
                <th>Montant Payé</th>
                <th>Méthode de Paiement</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sales as $sale)
            <tr>
                <td>{{ $sale->invoice_number }}</td>
                <td>{{ $sale->created_at->format('d/m/Y') }}</td>
                <td>{{ number_format($sale->total_amount, 0) }} FCFA</td>
                <td>{{ number_format($sale->paid_amount, 0) }} FCFA</td>
                <td>{{ ucfirst($sale->payment_method) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
