<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Facture</title>
        <style>
            @page {
                margin: 0;
                size: 100mm 297mm;
            }
            body {
                font-family: 'Arial', sans-serif;
                width: 100mm;
                margin: 5mm;
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
                width: 50mm;
                height: auto;
                margin: 0 auto 2mm;
                display: block;
            }
            /* Styles pour le bouton d'impression */
            .print-button {
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 999;
            }

            .print-btn {
                background-color: #4CAF50;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 14px;
                display: flex;
                align-items: center;
                gap: 8px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.2);
                transition: all 0.3s ease;
            }

            .print-btn:hover {
                background-color: #45a049;
                transform: translateY(-2px);
            }

            /* Cacher le bouton lors de l'impression */
            @media print {
                .print-button {
                    display: none;
                }

                /* Forcer le format A6 en mode portrait lors de l'impression */
                @page {
                    size: 100mm 297mm;
                    margin: 0;
                }

                body {
                    width: 100mm;
                    margin: 5mm;
                }

                /* Éviter les sauts de page indésirables */
                .invoice-content {
                    page-break-inside: avoid;
                }
            }

            /* Styles pour le conteneur principal */
            .invoice-wrapper {
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 20px;
                background-color: #f5f5f5; /* Fond gris clair pour distinguer la facture */
            }

            /* Styles pour la facture elle-même */
            .invoice-content {
                background: white;
                padding: 5mm;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                width: 100mm;
            }

            /* Ajustement pour l'impression */
            @media print {
                .invoice-wrapper {
                    padding: 0;
                    display: block;
                    background-color: white;
                    min-height: auto;
                }

                .invoice-content {
                    box-shadow: none;
                    padding: 5mm;
                    width: 100mm;
                }
            }

            /* Ajustement des colonnes du tableau */
            .invoice-items td:first-child {
                width: 45%;
            }
            .invoice-items td:nth-child(2) {
                width: 15%;
            }
            .invoice-items td:nth-child(3) {
                width: 20%;
            }
            .invoice-items td:nth-child(4) {
                width: 20%;
            }
        </style>
        <!-- Ajoutez Font Awesome pour l'icône d'impression -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    </head>
    <body>

        @yield('content')

    </body>
</html>