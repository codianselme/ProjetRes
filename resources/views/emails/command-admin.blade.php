<!DOCTYPE html>
<html>
<head>
    <title>Nouvelle Commande</title>
    <style>
        body {
            font-family: 'Helvetica', Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f6f9fc;
            color: #2c3e50;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: #2c3e50;
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }
        .header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .status-badge {
            display: inline-block;
            background: #e74c3c;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 14px;
            margin-top: 10px;
        }
        .content-section {
            padding: 30px;
            border-bottom: 1px solid #eee;
        }
        .section-title {
            color: #2c3e50;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #3498db;
        }
        .detail-row {
            display: flex;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        .detail-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .detail-label {
            font-weight: 600;
            color: #7f8c8d;
            width: 180px;
            flex-shrink: 0;
        }
        .detail-value {
            color: #2c3e50;
            flex-grow: 1;
        }
        .order-items {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .order-item {
            background: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .item-name {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .item-details {
            display: flex;
            justify-content: space-between;
            color: #7f8c8d;
            font-size: 14px;
        }
        .order-total {
            margin-top: 20px;
            padding: 15px;
            background: #2c3e50;
            color: white;
            border-radius: 8px;
            text-align: right;
            font-size: 18px;
        }
        .notes {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin-top: 20px;
            border-radius: 4px;
        }
        .footer {
            text-align: center;
            padding: 30px;
            background: #f8f9fa;
            color: #7f8c8d;
            font-size: 14px;
        }
        .restaurant-info {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        .restaurant-info p {
            margin: 5px 0;
        }
        .highlight {
            color: #e74c3c;
            font-weight: 600;
        }
        .contact-info {
            display: inline-block;
            background: #e3f2fd;
            padding: 10px 20px;
            border-radius: 20px;
            color: #1976d2;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Nouvelle Commande</h2>
            <div class="status-badge">À traiter</div>
        </div>
        
        <div class="content-section">
            <div class="section-title">Informations Client</div>
            <div class="detail-row">
                <div class="detail-label">Client</div>
                <div class="detail-value">{{ $command->customer_name }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Téléphone</div>
                <div class="detail-value highlight">{{ $command->phone }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Email</div>
                <div class="detail-value">{{ $command->email ?? 'Non renseigné' }}</div>
            </div>
            @if($command->needs_delivery)
                <div class="detail-row">
                    <div class="detail-label">Mode de livraison</div>
                    <div class="detail-value highlight">Livraison à domicile</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Adresse de livraison</div>
                    <div class="detail-value">{{ $command->delivery_address }}</div>
                </div>
            @else
                <div class="detail-row">
                    <div class="detail-label">Mode de livraison</div>
                    <div class="detail-value">À emporter</div>
                </div>
            @endif
        </div>

        <div class="content-section">
            <div class="section-title">Détails de la Commande</div>
            <div class="order-items">
                @foreach($cart as $item)
                <div class="order-item">
                    <div class="item-name">{{ $item['dish_name'] }}</div>
                    <div class="item-details">
                        <span>Quantité: {{ $item['quantity'] }}</span>
                        <span>Prix unitaire: {{ number_format($item['price']) }} FCFA</span>
                        <span>Total: {{ number_format($item['price'] * $item['quantity']) }} FCFA</span>
                    </div>
                </div>
                @endforeach
                
                <div class="order-total">
                    <div class="total-row">
                        <span>Sous-total:</span>
                        <span>{{ number_format($command->total_amount) }} FCFA</span>
                    </div>
                    @if($command->needs_delivery)
                        <div class="total-row">
                            <span>Frais de livraison:</span>
                            <span>{{ number_format($command->delivery_fee) }} FCFA</span>
                        </div>
                    @endif
                    <div class="total-row grand-total">
                        <span>Total à payer:</span>
                        <span>{{ number_format($command->final_amount) }} FCFA</span>
                    </div>
                </div>
            </div>

            @if($command->notes)
            <div class="notes">
                <div class="detail-label">Notes spéciales</div>
                <div class="detail-value">{{ $command->notes }}</div>
            </div>
            @endif
        </div>

        <div class="footer">
            <div class="contact-info">
                Commande #{{ str_pad($command->id, 6, '0', STR_PAD_LEFT) }}
            </div>
            <div class="restaurant-info">
                <p><strong>Les Saveurs du Corridor</strong></p>
                <p>Fidrossè, 100m à gauche de "Bénin Atlantic Beach Hotel"</p>
                <p>Tél: +229 01 51 61 61 30</p>
            </div>
        </div>
    </div>
</body>
</html>