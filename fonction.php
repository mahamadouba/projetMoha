<?php 
    function database()
    {
        $host = "localhost";
        $user = "root";
        $pass = "";
        $base = "gestion_produit";
        $con = new mysqli($host, $user, $pass, $base);
        if($con->connect_errno)
            $db = $con->connect_error;
        else
            $db = new mysqli($host, $user, $pass, $base);
        return $db; 
    }
    // fin fonction database()
    function creerCompte($pre, $nm, $adr, $tel, $em, $pro, $log, $mot)
    {
        $connexion = database();
        // vérifier si le login n'est pas déjà utilisé
        $ver = "select login from compte where login='".$log."'";
        $res = $connexion->query($ver);
        $nb = $res->num_rows;
        if($nb == 1)
            echo "Ce login $log est déjà utilisé";
        else
        {
            //insertion dans la table personne
            $ins_pers = "insert into personne(prenom, nom, adresse, telephone, email, profil)
            values('".$pre."','".$nm."','".$adr."','".$tel."','".$em."','".$pro."')";
            $res = $connexion->query($ins_pers);
            if($res)
            {
                $id = $connexion->insert_id;
                $motCrypte = sha1($mot);
                $ins_comp = "insert into compte(login, motPasse, idPersonne) 
                values('".$log."','".$motCrypte."','".$id."')";
                $res_comp = $connexion->query($ins_comp);
                if($res_comp)
                {
                    echo "Compte bien crée";
                }
                else
                {
                    echo "Echec d'enregitrement du compte";
                }
            }
        }
    }
    // fin fonction creerCompte()

    function authentification($log, $mot)
    {
        $db = database();
        $mc = sha1($mot);
        $req = "select p.idPersonne, prenom, nom, profil,login from compte c, personne p 
        where p.idPersonne = c.idPersonne and login ='".$log."' and motPasse ='".$mc."'";
        $res = $db->query($req);
        $nb = $res->num_rows;
        if($nb == 0)
            echo "Ce compte n'existe pas";
        else
        {
            session_start();
            while($inf = $res->fetch_row())
            {
                $_SESSION["prenom"] = $inf[1];
                $_SESSION["nom"] = $inf[2];
                $_SESSION["profil"] = $inf[3];
                $_SESSION["login"] = $inf[4];
                if($inf[3] == "Administrateur")
                    header("location:espace_admin.php");
                else if($inf[3] == "Utilisateur")
                        header("location:espace_user.php");
            }
        }

    }
?>