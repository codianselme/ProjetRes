<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Facture</title>
        <style>
            /* Configuration de base */
            @page {
                margin: 0;
                size: 100mm 297mm;
            }

            body {
                font-family: 'Segoe UI', Arial, sans-serif;
                width: 100mm;
                margin: 5mm;
                font-size: 8pt;
                line-height: 1.4;
                color: #333;
            }

            /* En-tête améliorée */
            .invoice-header {
                text-align: center;
                margin-bottom: 4mm;
                padding-bottom: 3mm;
                border-bottom: 2px solid #2c3e50;
            }

            .logo {
                width: 45mm;
                height: auto;
                margin: 0 auto 3mm;
                display: block;
            }

            .invoice-header h1 {
                font-size: 11pt;
                font-weight: 600;
                margin: 2mm 0;
                color: #2c3e50;
                text-transform: uppercase;
                letter-spacing: 0.5pt;
            }

            .invoice-header p {
                margin: 0.5mm 0;
                font-size: 7.5pt;
                color: #505050;
            }

            /* Table des détails */
            .invoice-details {
                width: 100%;
                margin: 3mm 0;
                border-collapse: collapse;
            }

            .invoice-details td {
                padding: 1.5mm 2mm;
                vertical-align: top;
                font-size: 8pt;
            }

            .invoice-details tr:first-child td {
                font-weight: bold;
                color: #2c3e50;
            }

            /* Table des articles */
            .invoice-items {
                width: 100%;
                border-collapse: collapse;
                margin: 3mm 0;
            }

            .invoice-items th {
                padding: 2mm 1mm;
                font-size: 8pt;
                text-transform: uppercase;
                background-color: #f8f9fa;
                border-top: 1px solid #dee2e6;
                border-bottom: 1px solid #dee2e6;
                color: #2c3e50;
            }

            .invoice-items td {
                padding: 1.5mm 1mm;
                font-size: 8pt;
                border-bottom: 1px dotted #eee;
            }

            .invoice-items tbody tr:hover {
                background-color: #f8f9fa;
            }

            /* Totaux */
            .totals-separator {
                border-top: 2px solid #2c3e50 !important;
            }

            .total {
                font-weight: 600;
                color: #2c3e50;
                text-transform: uppercase;
                font-size: 8.5pt;
            }

            tfoot td {
                padding: 2mm 1mm !important;
            }

            /* Pied de page */
            .invoice-footer {
                margin-top: 4mm;
                text-align: center;
                font-size: 8pt;
            }

            .invoice-footer p {
                margin: 1mm 0;
                color: #505050;
            }

            .cashier-info {
                margin: 3mm 0;
                padding: 2mm 0;
                border-top: 1px dashed #dee2e6;
                border-bottom: 1px dashed #dee2e6;
                text-align: left;
                background-color: #f8f9fa;
            }

            .cashier-info p {
                margin: 0.5mm 0;
                font-size: 8pt;
                color: #2c3e50;
            }

            /* QR Code */
            .qr-code {
                margin: 4mm auto;
                text-align: center;
            }

            .qr-code img {
                width: 25mm;
                height: 25mm;
                padding: 1mm;
                border: 1px solid #dee2e6;
                background-color: white;
            }

            /* Éléments supplémentaires */
            small {
                font-size: 7pt;
                color: #666;
            }

            em {
                font-style: italic;
                color: #666;
            }

            hr {
                border: none;
                border-top: 1px dashed #dee2e6;
                margin: 2mm 0;
            }

            /* Ajustements des colonnes */
            .invoice-items td:first-child { width: 45%; }
            .invoice-items td:nth-child(2) { width: 15%; text-align: center; }
            .invoice-items td:nth-child(3) { width: 20%; text-align: right; }
            .invoice-items td:nth-child(4) { width: 20%; text-align: right; }

            /* Styles pour l'impression */
            @media print {
                .invoice-wrapper {
                    padding: 0;
                    background-color: white;
                }

                .invoice-content {
                    box-shadow: none;
                    padding: 5mm;
                    width: 100mm;
                }

                .print-button {
                    display: none;
                }
            }

            /* Styles du bouton d'impression */
            .print-button {
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 1000;
            }

            .print-btn {
                background-color: #2c3e50;
                color: white;
                padding: 12px 24px;
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
                background-color: #34495e;
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            }

            .print-btn i {
                font-size: 16px;
            }

            /* Cacher le bouton lors de l'impression */
            @media print {
                .print-button {
                    display: none !important;
                }
            }
        </style>
        <!-- Ajoutez Font Awesome pour l'icône d'impression -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    </head>
    <body>

        @yield('content')

    </body>
</html>