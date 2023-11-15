<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title><?=  $title?></title>
        <link rel="stylesheet" type="text/css" href="styles/style.css"/>
    </head>
    <body>
        <header>
            <img src='src/assets/img/logo.png' alt="logo"/>
            <ul>
                <?php
                    foreach($this->getNav() as $label => $link)
                    {
                        echo "<li><a href=\"$link\">$label</a></li>";
                    }
                ?>
            </ul>
        </header>
        <?= $content ?>
    </body>
</html>