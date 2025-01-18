<!DOCTYPE html>
<html>
<head>
    <title>Confirmation de réservation</title>
    <style>
        body {
            font-family: 'Helvetica', Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f6f9fc;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }
        .header h2 {
            color: #2c3e50;
            margin: 0;
            font-size: 26px;
            font-weight: 600;
        }
        .welcome-text {
            color: #2c3e50;
            font-size: 18px;
            line-height: 1.6;
            margin: 20px 0;
        }
        .details {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 8px;
            margin: 20px 0;
            border: 1px solid #e9ecef;
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
            color: #666;
            width: 180px;
            flex-shrink: 0;
        }
        .detail-value {
            color: #2c3e50;
            flex-grow: 1;
        }
        .special-requests {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin-top: 20px;
            border-radius: 4px;
        }
        .contact-info {
            background: #e3f2fd;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
        }
        .contact-info p {
            margin: 10px 0;
            color: #1976d2;
        }
        .contact-info strong {
            color: #1565c0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #f0f0f0;
        }
        .restaurant-info {
            background: #2c3e50;
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            text-align: center;
        }
        .restaurant-info p {
            margin: 5px 0;
            font-size: 0.9em;
        }
        .thank-you {
            text-align: center;
            color: #2c3e50;
            font-size: 1.1em;
            margin: 20px 0;
            font-style: italic;
        }
        .confirmation-number {
            text-align: center;
            background: #e8f5e9;
            padding: 10px;
            border-radius: 5px;
            color: #2e7d32;
            margin: 20px 0;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Confirmation de votre réservation</h2>
        </div>
        
        <div class="welcome-text">
            Cher(e) {{ $reservation->customer_name }},
            <br>
            Nous vous remercions d'avoir choisi Les Saveurs du Corridor. Votre réservation a été confirmée avec succès.
        </div>

        <div class="confirmation-number">
            N° de réservation: #{{ str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}
        </div>
        
        <div class="details">
            <div class="detail-row">
                <div class="detail-label">Date</div>
                <div class="detail-value">{{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}</div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Heure</div>
                <div class="detail-value">{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Nombre de personnes</div>
                <div class="detail-value">{{ $reservation->persons }} {{ $reservation->persons > 1 ? 'personnes' : 'personne' }}</div>
            </div>
            
            @if($reservation->special_requests)
                <div class="special-requests">
                    <div class="detail-label">Vos demandes spéciales</div>
                    <div class="detail-value">{{ $reservation->special_requests }}</div>
                </div>
            @endif
        </div>
        
        <div class="contact-info">
            <p><strong>Besoin de modifier ou d'annuler votre réservation ?</strong></p>
            <p>Contactez-nous au <strong>+229 01 51 61 61 30</strong></p>
        </div>

        <div class="thank-you">
            Nous sommes impatients de vous accueillir !
        </div>
        
        <div class="footer">
            <div class="restaurant-info">
                <p><strong>Les Saveurs du Corridor</strong></p>
                <p>Fidrossè, 100m à gauche de "Bénin Atlantic Beach Hotel"</p>
                <p>Tél: +229 01 51 61 61 30</p>
            </div>
        </div>
    </div>
</body>
</html>