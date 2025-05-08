<?php
require_once ('./assets/php/fonctions.php');

function getOrganismesBdd(){
    //$bdd = new DB();
    $sql='SELECT * FROM organisme';
    $reponse=SQLSelect($sql);

    return $reponse;
}

function addOrganisme($nom, $compte, $agence, $cle, $adder){
    $bdd = new DB();

    $verifSql = 'SELECT * FROM organisme WHERE nom="'.$nom.'"';
    $verifResult = SQLSelect($verifSql);


    if(empty($verifResult)){
        $sql =$bdd->db->PREPARE('INSERT INTO `organisme`(`idOrganisme`, `nom`, `agence`, `noCompte`, `cle`) VALUES (DEFAULT , :nom, :agence, :compte, :cle)');
        $sql->EXECUTE(array(
            "nom" => $nom ,
            "agence" => $agence ,
            "compte" => $compte ,
            "cle" => $cle ,
        ));

        $date= getdate();
        $numero = "".$agence."-".$compte."-".$cle;
        $accesSys=fopen('accesSys.txt','a');
        fputs($accesSys, "Ajout de l'organisme: ".$nom." le ".$date['mday']."/".$date['mon']."/".$date['year']."/".$date['hours'].":".$date['minutes'].":".$date['seconds']." par ".$adder." Numero de compte : ".$numero."\n");
        fclose($accesSys);

        return true;
    }
    else
        return false;
}

function deleteOldOrganisme($id, $deleter){
    $nom = "";
    $verifSql = 'SELECT * FROM organisme WHERE idOrganisme="'.$id.'"';
    $verifResults = SQLSelect($verifSql);
    foreach ($verifResults as $verifResult){
        $nom = $verifResult->nom;
    }


    $bdd = new DB();
    $sql=$bdd->db->PREPARE('DELETE FROM `organisme` WHERE `idOrganisme`=:id');
    $sql->EXECUTE(array(
        'id'=> $id
    ));

    $date= getdate();
    $accesSys=fopen('accesSys.txt','a');
    fputs($accesSys, "Suppression de l'organisme: ".$nom." le ".$date['mday']."/".$date['mon']."/".$date['year']."/".$date['hours'].":".$date['minutes'].":".$date['seconds']." par ".$deleter."\n");
    fclose($accesSys);

    return true;
}

function getOrganismeUser($id){
    $bdd = new DB();
    $sql='SELECT * FROM organisme WHERE `idOrganisme`='.$id;
    $reponses=SQLSelect($sql);

    foreach($reponses as $reponse):
        return $reponse;
    endforeach;
}

function modifyOrganisme($nom, $compte, $agence, $cle, $id, $modifOrganisme){
    $bdd = new DB();

    $sql =$bdd->db->PREPARE("UPDATE `organisme` SET `nom`=:nom, `noCompte`=:compte, `agence`=:agence, `cle`=:cle WHERE `idOrganisme`=:id");
    $sql->EXECUTE(array(
        'nom' => $nom,
        'compte' => $compte,
        'agence' => $agence,
        'cle' => $cle,
        'id' => $id
    ));

    if($sql) {
        $date= getdate();
        $numero = "".$agence."-".$compte."-".$cle;
        $accesSys=fopen('accesSys.txt','a');
        fputs($accesSys, "Modification de l'organisme: ".$nom." numero de compte : ".$numero." le ".$date['mday']."/".$date['mon']."/".$date['year']."/".$date['hours'].":".$date['minutes'].":".$date['seconds']." par ".$modifOrganisme."\n");
        fclose($accesSys);
        return true;
    }
    else
        return false;
}

