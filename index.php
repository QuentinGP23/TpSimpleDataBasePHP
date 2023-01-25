<!DOCTYPE html>
<html lang="fr">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Author" content="GEOFFROY PITAILLER Quentin">
    <meta name="description" content="index">
    <link rel="icon" href="php_PNG12.png">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Ubuntu" />
    <title>TP dev web</title>
</head>

<body>
    
    <section class="sheee">
    <h1>PHP dev web TP1</h1>
    </section>
    
    <!--------------------------formulaire de base----------------------->
    <form action="index.php" method="post" class="formulaire">
        <fieldset>
            <legend>Formulaire 1</legend>
        <label for="Afficher">Afficher</label>
        <input type="radio" name="choix1" class="radio">
        <label for="Inserer">Insérer</label>
        <input type="radio" name="choix2" class="radio">
        <label for="Supprimer">Supprimer</label>
        <input type="radio" name="choix3" class="radio">
        <input type="submit" class="bouton" name="valider" value='Valider'>
        </fieldset>
    </form>
    <!---------------------------------------------------------------------->
    
    <?php
    
    //////////////////////fonction d'insertion/////////////////////////////////
    function insert(){
        $sql = mysqli_connect("localhost","qgeoffroyp_php","Onepiece54.","qgeoffroyp_tpphp");
        $img = $_FILES['img']['name'];
        $imgtmp = $_FILES['img']['tmp_name'];
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        move_uploaded_file($imgtmp, 'img/'.$img);
        $requette = mysqli_query($sql, "INSERT INTO Insertion (fichier,Titre,description) VALUES('$img', '$titre', '$description')");
    };
    ///////////////////////////////////////////////////////////////////////////
    
    ////////////////////////fonction d'affichage////////////////////////////////
    function show(){
        $sql = mysqli_connect("localhost","qgeoffroyp_php","Onepiece54.","qgeoffroyp_tpphp");
        $requette1 = mysqli_query($sql, "SELECT * FROM Insertion ORDER BY Titre");
        while ($var = mysqli_fetch_assoc($requette1)){
            echo "<section class='image'>";
            foreach($var as $indice => $var1){
                if ($indice == "fichier" ){
                     $fichier=$var['fichier'];
                    echo "<img src='img/$fichier' alt='Image'/>";
                  }
                elseif ($indice == 'Titre'){
                    echo "<h2>$var1</h2>";
                }
                else{
                    echo "<p class='description>$var1</p>";
                }
              }
            echo "</section>";
        }
    };
    /////////////////////////////////////////////////////////////////////////////
    
    ////////////////fonction de suppression//////////////////////////////////////
    function delete(){
        $sql = mysqli_connect("localhost","qgeoffroyp_php","Onepiece54.","qgeoffroyp_tpphp");
        $titre = $_POST['Titreimage'];
        if ($requette2=mysqli_query($sql, "DELETE FROM Insertion WHERE Titre = '$titre'")){
            echo"L'image ".$titre." a été supprimée.";
        }
        else{
            echo'Echec de la supression';
        }
    }
    ///////////////////////////////////////////////////////////////////////////////////////////
/////////////formulaire d'insertion///////////////////////////////////////////////////////////////
    if (isset($_POST['valider'])){
        if (isset($_POST['choix2'])){
            ?>
        <br><br>
        <form action='index.php' method='post' class='formulaire' enctype="multipart/form-data">
        <fieldset>
        <legend>Formulaire d'insertion</legend>
        <input type='file' name='img' accept='image/png, image/jpeg' class='bouton2' required>
        <label for='txt'>Mettre un titre</label>
        <input type='text' id='titre' name='titre' class='zonetxt' required>
        <label for='txt'>Mettre une description</label>
        <input type='text' id='description' name='description' class='zonetxt'>
        <input type='submit' class='bouton' name='valider1' value='Envoyer'>
        </fieldset>
    </form>
    
    <?php
        };
    };
    ///////////////////////////////////////////////////////////////////////////////////////
    
    /////////formulaire supression/////////////////////////////////////////////////////////
    if (isset($_POST['valider'])){
        if (isset($_POST['choix3'])){
            ?>
            <form action="index.php" method="post" class='formulaire'>
                <fieldset>
                    <legend>Formulaire de suppression</legend>
                <label for='txt' required>Saisissez le titre  de l'image à supprimer :</label>
                <input type="text" name="Titreimage" class='zonetxt' required/>
                <input type='submit' class='bouton' name="valider2" value="Envoyer">
                </fieldset>
            </form>
  <?php
        };
    };
    /////////////////////////////////////////////////////////////////////////////////////
    
    /////lancement de la fonction insert///////////////////////
    if (isset($_POST['valider1'])){
        insert();
    }

    ///////lancement de la fonction show/////////////////////
    if (isset($_POST['valider'])){
        if (isset($_POST['choix1'])){
            show();
        };
    };
    //////////////////////////////////////////////////////////
    /////////lancement de la fonction delete////////////////////
    if (isset($_POST['valider2'])){
        delete();
    }
    ?>
    <section class='sheee'>
        <a href='index.php' class='bouton'>Retour</a>
    </section>
</body>
</html>