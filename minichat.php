<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Minichat</title>
    </head>
    
    <body>
    
        <form style = "text-align : center" action="minichatPost.php" method="post">
            
                <label for="pseudo">Pseudo</label> 
                <input type="text" name="pseudo" id="pseudo" value="<?php if(isset($_COOKIE['pseudo'])) echo htmlspecialchars($_COOKIE['pseudo']); ?>"/>
                
                <label for="message">Message</label>
                <input type="text" name="message" id="message" />
                
                <input type="submit" value="Envoyer" />
            
        </form>

        

        <?php

        // Connexion à la base de données "test"
        try
        {
            $PDO = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8', 'root', '');
        }
        catch(Exception $e)
        {
                die('Erreur : '.$e->getMessage());
        }

        // Récupération des 5 derniers messages de la table "minichat"
        $messages = $PDO->query('SELECT pseudo, message, date_creation FROM minichat ORDER BY ID DESC LIMIT 0, 5');

        // Affichage de chaque message 
        while ($message = $messages->fetch())
        {
            // Conversion de la date US en date FR
            echo  '<p>' . htmlspecialchars(strftime('%d-%m-%Y - %H:%M:%S',strtotime($message['date_creation']))) . '<strong>' . ' - ' . htmlspecialchars($message['pseudo']) . '</strong> : ' . htmlspecialchars($message['message']) . '</p>';
        }

        $messages->closeCursor();

        ?>
    </body>
</html>