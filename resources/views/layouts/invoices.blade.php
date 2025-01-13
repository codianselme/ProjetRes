<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Facture</title>
        <style>
            @page {
                margin: 0;
                size: 80mm 297mm;
            }
            body {
                font-family: 'Arial', sans-serif;
                margin: 4mm;
                font-size: 8pt;
                line-height: 1.3;
            }
            .invoice-header {
                text-align: center;
                margin-bottom: 3mm;
                padding-bottom: 2mm;
                border-bottom: 1px solid #000;
            }
            .invoice-header h1 {
                font-size: 10pt;
                font-weight: bold;
                margin: 1mm 0;
                text-transform: uppercase;
                letter-spacing: 0.5pt;
            }
            .invoice-header p {
                margin: 0.3mm 0;
                font-size: 7pt;
                color: #333;
            }
            .invoice-details {
                width: 100%;
                margin: 2mm 0;
                font-size: 7.5pt;
            }
            .invoice-details td {
                padding: 1mm 2mm;
                vertical-align: top;
            }
            .invoice-items {
                width: 100%;
                border-collapse: collapse;
                margin: 2mm 0;
            }
            .invoice-items th {
                padding: 1.5mm 1mm;
                font-size: 7.5pt;
                text-transform: uppercase;
                border-top: 1px dashed #000;
                border-bottom: 1px dashed #000;
                background-color: #f8f8f8;
            }
            .invoice-items td {
                padding: 1mm;
                font-size: 7.5pt;
                border-bottom: 0.5px dotted #ddd;
            }
            .invoice-items tbody tr:last-child td {
                border-bottom: none;
            }
            .invoice-items td:nth-child(2),
            .invoice-items td:nth-child(3),
            .invoice-items td:nth-child(4) {
                text-align: right;
            }
            .totals-separator {
                border-top: 1.5px dashed #000 !important;
                font-weight: bold;
            }
            .total {
                font-weight: bold;
                text-transform: uppercase;
                font-size: 8pt;
            }
            .invoice-footer {
                margin-top: 3mm;
                text-align: center;
                font-size: 7pt;
            }
            .cashier-info {
                margin: 3mm 0;
                padding: 2mm 0;
                border-top: 1px dashed #000;
                border-bottom: 1px dashed #000;
                text-align: left;
            }
            .cashier-info p {
                margin: 0.5mm 0;
                font-size: 7.5pt;
            }
            .qr-code {
                margin: 3mm auto;
                text-align: center;
            }
            .qr-code img {
                width: 25mm;
                height: 25mm;
                margin: 0 auto;
            }
            small {
                font-size: 6.5pt;
                color: #666;
            }
            em {
                font-style: italic;
                color: #555;
            }
            hr {
                border: none;
                border-top: 1px dashed #000;
                margin: 2mm 0;
            }
            .logo {
                width: 35mm;
                height: auto;
                margin: 0 auto 2mm;
                display: block;
            }
        </style>
    </head>
    <body>

        @yield('content')

    </body>
</html>