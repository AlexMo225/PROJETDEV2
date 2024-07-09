<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding: 10px 0;
            background: linear-gradient(135deg, #c5ccc9, #15854b);
            color: white;
            border-radius: 10px 10px 0 0;
        }
        .header img {
            max-width: 100%;
            height: auto;
            border-radius: 10px 10px 0 0;
        }
        .content {
            padding: 20px;
        }
        .content h1, .content h2, .content p {
            margin: 0 0 15px 0;
        }
        .content a {
            display: inline-block;
            margin-top: 10px;
            margin:10px 0px 10px 0px;
            padding: 10px 20px;
            background-color: #15854b;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .footer {
            text-align: center;
            padding: 10px 0;
            background: linear-gradient(135deg, #c5ccc9, #15854b);
            color: white;
            border-radius: 0 0 10px 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Votre Abonnement a été Mis à Jour</h1>
        </div>
        <div class="content">
            <h2>Bonjour {{ $user->name }} ,</h2>
            <p>Nous vous confirmons que votre abonnement a été mis à jour avec succès. Vous pouvez désormais profiter de nos nouveaux services et avantages exclusifs.</p>
            <p>Pour voir les détails de votre abonnement mis à jour, veuillez vous connecter à votre compte en utilisant le lien ci-dessous :</p>
            <a href="http://localhost:5173/account">Voir Mon Abonnement</a>
            <p>Si vous avez des questions ou avez besoin d'assistance, n'hésitez pas à nous contacter via le formulaire de contact.</p>
            <p>Sportivement,<br>L'équipe <strong>MARACANA</strong></p>
        </div>
        <div class="footer">
            <p>&copy;2024 MARACANA. Tous droits réservés.</p>
        </div>
    </div>
</body>
</html>
