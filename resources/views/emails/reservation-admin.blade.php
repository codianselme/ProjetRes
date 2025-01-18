<!DOCTYPE html>
<html>
<head>
    <title>Nouvelle Réservation</title>
    <style>
        body {
            font-family: 'Helvetica', Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f6f9fc;
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
            color: #1a1a1a;
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .details {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .detail-row {
            display: flex;
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
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
            color: #333;
            flex-grow: 1;
        }
        .special-requests {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin-top: 20px;
            border-radius: 4px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #f0f0f0;
            color: #666;
            font-size: 0.9em;
        }
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 0.9em;
            font-weight: 500;
            background: #e3f2fd;
            color: #1976d2;
            margin-top: 10px;
        }
        .restaurant-info {
            margin-top: 20px;
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Nouvelle Réservation</h2>
            <div class="status-badge">Nouvelle</div>
        </div>
        
        <div class="details">
            <div class="detail-row">
                <div class="detail-label">Nom du client</div>
                <div class="detail-value">{{ $reservation->customer_name }}</div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Téléphone</div>
                <div class="detail-value">{{ $reservation->phone }}</div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Email</div>
                <div class="detail-value">{{ $reservation->email ?? 'Non renseigné' }}</div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Nombre de personnes</div>
                <div class="detail-value">{{ $reservation->persons }} {{ $reservation->persons > 1 ? 'personnes' : 'personne' }}</div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Date</div>
                <div class="detail-value">{{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}</div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Heure</div>
                <div class="detail-value">{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</div>
            </div>
            
            @if($reservation->special_requests)
                <div class="special-requests">
                    <div class="detail-label">Demandes spéciales</div>
                    <div class="detail-value">{{ $reservation->special_requests }}</div>
                </div>
            @endif
        </div>
        
        <div class="footer">
            <p>Cette réservation a été effectuée via le site Les Saveurs du Corridor</p>
            <div class="restaurant-info">
                <p>Les Saveurs du Corridor<br>
                Fidrossè, 100m à gauche de "Bénin Atlantic Beach Hotel"<br>
                Tél: +229 01 51 61 61 30</p>
            </div>
        </div>
    </div>
</body>
</html>