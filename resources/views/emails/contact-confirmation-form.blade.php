<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Confirmation de votre message</title>
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
            <h2>Confirmation de réception</h2>
        </div>
        
        <div class="content">
            <p>Cher(e) {{ $contact->name }},</p>
            
            <p>Nous vous remercions d'avoir pris contact avec Les Saveurs du Corridor. Nous avons bien reçu votre message et nous nous efforcerons d'y répondre dans les plus brefs délais.</p>
            
            <p>Pour rappel, voici un résumé de votre message :</p>
            
            <div style="background-color: #fff; padding: 15px; margin: 15px 0; border-left: 4px solid #E45118;">
                {{ $contact->message }}
            </div>
            
            <p>Si vous avez des questions supplémentaires, n'hésitez pas à nous contacter.</p>
        </div>
        
        <div class="footer">
            <p>Les Saveurs du Corridor<br>
            Fidrossè, 100m à gauche de "Bénin Atlantic Beach Hotel" en allant vers le CEG Fiyegnon<br>
            Tél: +229 01 51 61 61 30</p>
        </div>
    </div>
</body>
</html>