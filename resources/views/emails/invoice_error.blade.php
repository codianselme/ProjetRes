<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erreur de Facture</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        h1 {
            color: #d9534f;
        }
        h2 {
            color: #5bc0de;
        }
        .info {
            margin-bottom: 10px;
        }
        .info span {
            font-weight: bold;
        }
        .code {
            color: #d9534f;
            font-weight: bold;
        }
        .description {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Erreur Critique lors du Traitement de la Facture</h1>
        <p>Bonjour,</p>
        <p>Une erreur critique s'est produite lors du traitement de la facture. Voici les détails :</p>
        
        <h2>Détails de l'Erreur :</h2>
        <div class="info">
            <p><span>ID de la Facture :</span> {{ $errorDetails['invoice_id'] }}</p>
            <p><span>Numéro de Facture avant :</span> {{ $errorDetails['invoice_number_before'] }}</p>
            <p><span>Numéro de Facture après :</span> {{ $errorDetails['invoice_number_after'] }}</p>
            <p><span>Code d'Erreur :</span> <span class="code">{{ $errorDetails['errorCode'] }}</span></p>
            <p><span>Description de l'Erreur :</span> <span class="description">{{ $errorDetails['errorDesc'] }}</span></p>
        </div>
        
        <h2>Informations Complémentaires :</h2>
        <div class="info">
            <p><span>Utilisateur :</span> {{ $errorDetails['user_name'] }} (ID: {{ $errorDetails['user_id'] }})</p>
            <p><span>Timestamp :</span> {{ $errorDetails['timestamp'] }}</p>
        </div>
        
        <h2>Rapport de Log :</h2>
        <pre>{{ $errorDetails['log'] }}</pre>
        
        <p>Merci de bien vouloir vérifier les informations ci-dessus et prendre les mesures nécessaires.</p>
        
        <p>Cordialement,</p>
        <p>L'équipe de DA DIGIT ALL</p>
    </div>
</body>
</html>
