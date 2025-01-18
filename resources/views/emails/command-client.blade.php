<!DOCTYPE html>
<html>
<head>
    <title>Confirmation de votre commande</title>
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
            background: linear-gradient(135deg, #2c3e50, #3498db);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        .header h2 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }
        .welcome-text {
            padding: 30px;
            text-align: center;
            font-size: 18px;
            color: #2c3e50;
            background: #f8f9fa;
            border-bottom: 1px solid #eee;
        }
        .order-number {
            background: #e3f2fd;
            color: #1976d2;
            padding: 10px 20px;
            border-radius: 20px;
            display: inline-block;
            margin-top: 15px;
            font-size: 16px;
        }
        .content-section {
            padding: 30px;
            border-bottom: 1px solid #eee;
        }
        .section-title {
            color: #2c3e50;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #3498db;
        }
        .order-items {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
        }
        .order-item {
            background: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .item-name {
            font-weight: 600;
            color: #2c3e50;
            font-size: 16px;
            margin-bottom: 10px;
        }
        .item-details {
            display: flex;
            justify-content: space-between;
            color: #7f8c8d;
            font-size: 14px;
            flex-wrap: wrap;
            gap: 10px;
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
        .delivery-info {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .delivery-detail {
            display: flex;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        .delivery-label {
            font-weight: 600;
            color: #7f8c8d;
            width: 140px;
            flex-shrink: 0;
        }
        .delivery-value {
            color: #2c3e50;
            flex-grow: 1;
        }
        .notes {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin-top: 20px;
            border-radius: 4px;
        }
        .contact-info {
            text-align: center;
            padding: 30px;
            background: #f8f9fa;
        }
        .contact-info .phone {
            font-size: 24px;
            color: #2c3e50;
            font-weight: 600;
            margin: 10px 0;
        }
        .footer {
            text-align: center;
            padding: 30px;
            background: #2c3e50;
            color: white;
        }
        .restaurant-info {
            margin-top: 20px;
            font-size: 14px;
            line-height: 1.8;
        }
        .thank-you {
            font-size: 20px;
            color: #27ae60;
            text-align: center;
            margin: 30px 0;
            font-weight: 600;
        }
        .social-links {
            margin-top: 20px;
        }
        .social-links a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Confirmation de votre commande</h2>
            <div class="order-number">
                Commande #{{ str_pad($command->id, 6, '0', STR_PAD_LEFT) }}
            </div>
        </div>
        
        <div class="welcome-text">
            Cher(e) {{ $command->customer_name }},
            <br>
            Nous vous remercions pour votre commande. Voici le récapitulatif :
        </div>

        <div class="content-section">
            <div class="section-title">Votre Commande</div>
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
                    Total à payer: {{ number_format($command->total_amount) }} FCFA
                </div>
            </div>
        </div>

        <div class="content-section">
            <div class="section-title">Informations de Livraison</div>
            <div class="delivery-info">
                <div class="delivery-detail">
                    <div class="delivery-label">Adresse</div>
                    <div class="delivery-value">{{ $command->delivery_address }}</div>
                </div>
                @if($command->notes)
                <div class="notes">
                    <div class="delivery-label">Notes spéciales</div>
                    <div class="delivery-value">{{ $command->notes }}</div>
                </div>
                @endif
            </div>
        </div>

        <div class="thank-you">
            Merci de votre confiance !
        </div>

        <div class="contact-info">
            <p>Pour toute question concernant votre commande :</p>
            <div class="phone">+229 01 51 61 61 30</div>
        </div>
        
        <div class="footer">
            <div class="restaurant-info">
                <p><strong>Les Saveurs du Corridor</strong></p>
                <p>Fidrossè, 100m à gauche de "Bénin Atlantic Beach Hotel"</p>
                <p>Tél: +229 01 51 61 61 30</p>
            </div>
            <div class="social-links">
                <a href="#">Facebook</a>
                <a href="#">Instagram</a>
                <a href="#">WhatsApp</a>
            </div>
        </div>
    </div>
</body>
</html>