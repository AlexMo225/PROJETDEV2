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
            <h1>Bienvenue chez MARACANA</h1>
        </div>
        <div class="content">
            <h2>Bonjour {{ $user->name }} !</h2>
            <p>Nous sommes ravis de vous accueillir parmi nous !</p>
            <p><strong>Maracana</strong> est conçu pour vous offrir une expérience de réservation de terrains de sport rapide, simple et efficace. Que vous soyez un passionné de football, de basketball ou d'autres sports, nous avons ce qu'il vous faut.</p>
            <h2>1. Réservation Facile et Rapide</h2>
            <p>Réservez vos terrains de sport préférés en quelques clics. Plus besoin de passer des heures à chercher et à réserver – tout est à portée de main.</p>
            <h2>2. Offres d'Abonnement Exclusives</h2>
            <p>Profitez de nos offres d'abonnement exclusives qui vous permettent d'accéder à des tarifs préférentiels et à des avantages supplémentaires.</p>
            <h2>3. Actualités Sportives</h2>
            <p>Restez informé des dernières actualités et événements sportifs grâce à notre page dédiée. Vous y trouverez des résultats de matchs, des analyses, des interviews et bien plus encore.</p>
            <h2>4. Témoignages et Expériences</h2>
            <p>Découvrez les témoignages de nos utilisateurs satisfaits et partagez vos propres expériences. Votre avis compte beaucoup pour nous.</p>
            <a href="http://localhost:5173/login">Connectez-vous à votre compte</a>
            <p>Si vous avez des questions ou avez besoin d'assistance, n'hésitez pas à nous contacter Via le formulaire </p>
            <p>Encore une fois, bienvenue chez <strong>Maracana</strong> ! Nous sommes impatients de vous aider à organiser vos activités sportives et à vivre des moments inoubliables.</p>

        </div>
        <div class="footer">
            <p>&copy; 2024 MARACANA. Tous droits réservés.</p>
        </div>
    </div>
</body>
</html>