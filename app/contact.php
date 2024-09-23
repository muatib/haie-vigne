<?php include "./includes/_header.php"  ?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8" />
    <link rel="icon" type="image" href="/img/enqueteur caen.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GeoCaen</title>

    <script type="module" src="http://localhost:5173/@vite/client"></script>
    <script type="module" src="http://localhost:5173/js/main.js"></script>

</head>

<body>


    <h1 class="contact-ttl">Formulaire de contact</h1>

    <form class="form-container" action="./_contact-traitment.php" method="post">
        <label class="contact-label" for="name">Nom</label>&ensp;&emsp;
        <input class="contact-input" type="text" name="name" id="name" placeholder="Votre nom" required>
        <label class="contact-label" for="email">Email</label>&ensp;&emsp;
        <input class="contact-input" type="email" name="email" id="email" placeholder="Votre adresse mail" required>
        <label class="message-label" for="message">Votre message</label>
        <textarea class="message-input" name="message" id="message" placeholder="Entrez votre message ici" required></textarea>
        <button class="contact-btn">Envoyer</button>

        <?php if (isset($_SESSION['message'])) {
            echo '<div class="message">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
        }
        ?>
    </form>
    <?php include './includes/_footer.php' ?>
    <script src="./js/burger.js"></script>
</body>

</html>