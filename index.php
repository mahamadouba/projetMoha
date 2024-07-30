<style>
a
{
    text-decoration: none;
    border-radius: 5px;
}

</style>
<form method="POST" action="">
    <table>
        <tr>
            <td>
                <input type="text" name="login" placeholder="Votre login" required />
            </td>
        </tr>
        <tr>
            <td>
                <input type="password" name="motPasse" placeholder="Votre mot de passe" required />
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="connecter" value="Connecter" />
                <a href="inscription.php">S'inscrire</a>
            </td>
        </tr>  
    </table>
</form>
<?php 
    if(isset($_POST["connecter"]))
    {
        extract($_POST);
        require "fonction.php";
        authentification($login, $motPasse);
    }
?>