<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nouveau message de contact</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 30px;
            margin: 20px 0;
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 2px solid #E45118;
            margin-bottom: 30px;
        }
        h2 {
            color: #E45118;
            font-size: 24px;
            margin: 0;
            padding: 0;
        }
        .content {
            background-color: #f9f9f9;
            border-radius: 6px;
            padding: 20px;
            margin: 20px 0;
        }
        .field {
            margin-bottom: 15px;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .label {
            font-weight: bold;
            color: #666;
            min-width: 100px;
            display: inline-block;
        }
        .value {
            color: #333;
        }
        .message-content {
            background-color: #fff;
            border-left: 4px solid #E45118;
            padding: 15px;
            margin-top: 10px;
            font-style: italic;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #888;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h2>Nouveau Message de Contact</h2>
        </div>
        
        <div class="content">
            <div class="field">
                <span class="label">Nom :</span>
                <span class="value">{{ $contact->name }}</span>
            </div>
            
            <div class="field">
                <span class="label">Email :</span>
                <span class="value">{{ $contact->email }}</span>
            </div>
            
            <div class="field">
                <span class="label">Téléphone :</span>
                <span class="value">{{ $contact->phone ?? 'Non renseigné' }}</span>
            </div>
            
            {{-- <div class="field">
                <span class="label">Site web :</span>
                <span class="value">{{ $contact->website ?? 'Non renseigné' }}</span>
            </div> --}}
            
            <div class="field">
                <span class="label">Message :</span>
                <div class="message-content">
                    {{ $contact->message }}
                </div>
            </div>
        </div>
        
        <div class="footer">
            <p>Ce message a été envoyé via le formulaire de contact du site Les Saveurs du Corridor</p>
        </div>
    </div>
</body>
</html>