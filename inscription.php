<form method="POST" action="">
    <table>
        <tr>
            <td>
                <input type="text" name="prenom" placeholder="Votre prénom" required/>
            </td>
            <td>
                <input type="text" name="nom" placeholder="Votre nom" required/>
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="adresse" placeholder="Votre adresse" required/>
            </td>
            <td>
                <input type="number" name="telephone" placeholder="Votre téléphone" required/>
            </td>
        </tr>
        <tr>
            <td>
                <input type="email" name="email" placeholder="Votre email" required/>
            </td>
            <td>
                <select name="profil" style="width: 175px;">
                    <option>Administrateur</option>
                    <option>Utilisateur</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="login" placeholder="Votre login" required/>
            </td>
            <td>
                <input type="password" name="motPasse" placeholder="Votre mot de passe" required/>
            </td>
        </tr>
        <tr>
            <td>
                <input type="password" name="confPasse" placeholder="Confirmer le mot de passe" required/>
            </td>
            <td>
                <input type="submit" name="creer" value="Créer un compte" />
            </td>
        </tr>
    </table>
</form>
<?php 
    if(isset($_POST["creer"]))
    {
        extract($_POST);
        require "fonction.php";
        if($motPasse != $confPasse)
        {
            echo "Ces deux mots de passe ne sont pas identiques";
        }
        else if(strlen($motPasse)<8 || strlen($motPasse)>14)
        {
            echo "Veuillez revoir la longueur du mot de passe [8 à 14] caractères";
        }
        else
        {
            creerCompte($prenom, $nom, $adresse, $telephone, $email, $profil, $login, $motPasse);
        }
    }
?>