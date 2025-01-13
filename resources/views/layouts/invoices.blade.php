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
                font-family: 'Courier New', monospace;
                margin: 4mm;
                font-size: 8pt;
                line-height: 1.2;
            }
            .invoice-header {
                text-align: center;
                margin-bottom: 2mm;
            }
            .invoice-header h1 {
                font-size: 9pt;
                font-weight: bold;
                margin: 1mm 0;
                line-height: 1.1;
            }
            .invoice-header p {
                margin: 0.3mm 0;
                font-size: 7pt;
            }
            .invoice-details, .invoice-items {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 1mm;
            }
            .invoice-details td {
                padding: 1mm;
                font-size: 8pt;
            }
            .invoice-items td, .invoice-items th {
                padding: 0.5mm 1mm;
                font-size: 7pt;
                white-space: nowrap;
            }
            .invoice-items td:nth-child(2),
            .invoice-items td:nth-child(3),
            .invoice-items td:nth-child(4) {
                text-align: right;
            }
            .invoice-items th {
                border-top: 1px dashed #000;
                border-bottom: 1px dashed #000;
            }
            .total {
                font-weight: bold;
            }
            .invoice-footer {
                font-size: 7pt;
                margin-top: 2mm;
                line-height: 1.1;
            }
            hr {
                margin: 1mm 0;
            }
            .logo {
                width: 40mm;
                height: auto;
                margin: 0 auto 1mm;
                display: block;
            }
            .qr-code {
                text-align: center;
                margin: 2mm 0;
            }
            .qr-code img {
                width: 20mm;
                height: 20mm;
            }
            .cashier-info {
                margin-top: 2mm;
                border-top: 1px dashed #000;
                padding-top: 2mm;
            }
            .cashier-info p {
                margin: 0;
                font-size: 7pt;
            }
            .totals-separator {
                border-top: 1px dashed #000;
                margin-top: 1mm;
            }
        </style>
    </head>
    <body>

        @yield('content')

    </body>
</html>