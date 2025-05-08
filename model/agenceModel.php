<?php
require_once ('./assets/php/fonctions.php');

function getAgencesBdd(){
    //$bdd = new DB();
    $sql='SELECT * FROM agence WHERE CodeAgence!=99000';
    $reponse=SQLSelect($sql);

    return $reponse;
}

function addAgence($nom, $code, $adder){
    $bdd = new DB();

    $verifSql = 'SELECT * FROM agence WHERE nom="'.$nom.'" or codeAgence="'.$code.'"';
    $verifResult = SQLSelect($verifSql);


    if(empty($verifResult)){
        $sql =$bdd->db->PREPARE('INSERT INTO `agence`(`idAgence`, `nom`, `CodeAgence`) VALUES (DEFAULT , :nom, :code)');
        $sql->EXECUTE(array(
            "nom" => $nom ,
            "code" => $code ,
        ));

        $date= getdate();
        $accesSys=fopen('accesSys.txt','a');
        fputs($accesSys, "Ajout de l'agence: ".$nom." le ".$date['mday']."/".$date['mon']."/".$date['year']."/".$date['hours'].":".$date['minutes'].":".$date['seconds']." par ".$adder." Code Agence : ".$code."\n");
        fclose($accesSys);

        return true;
    }
    else
        return false;
}

function deleteOldAgence($id, $deleter){
    $nom = "";
    $verifSql = 'SELECT * FROM agence WHERE idAgence="'.$id.'"';
    $verifResults = SQLSelect($verifSql);
    foreach ($verifResults as $verifResult){
        $nom = $verifResult->nom;
    }


    $bdd = new DB();
    $sql=$bdd->db->PREPARE('DELETE FROM `agence` WHERE `idAgence`=:id');
    $sql->EXECUTE(array(
        'id'=> $id
    ));

    $date= getdate();
    $accesSys=fopen('accesSys.txt','a');
    fputs($accesSys, "Suppression de l'agence: ".$nom." le ".$date['mday']."/".$date['mon']."/".$date['year']."/".$date['hours'].":".$date['minutes'].":".$date['seconds']." par ".$deleter."\n");
    fclose($accesSys);

    return true;
}

function getInfoAgence($id){
    $bdd = new DB();
    $sql='SELECT * FROM agence WHERE `idAgence`='.$id;
    $reponses=SQLSelect($sql);

    foreach($reponses as $reponse):
        return $reponse;
    endforeach;
}

function modifyAgence($nom, $code, $id, $modifAgence){
    $bdd = new DB();

    $sql =$bdd->db->PREPARE("UPDATE `agence` SET `nom`=:nom, `codeAgence`=:code WHERE `idAgence`=:id");
    $sql->EXECUTE(array(
        'nom' => $nom,
        'code' => $code,
        'id' => $id
    ));

    if($sql) {
        $date= getdate();
        $accesSys=fopen('accesSys.txt','a');
        fputs($accesSys, "Modification de l'organisme: ".$nom." numero de compte : ".$code." le ".$date['mday']."/".$date['mon']."/".$date['year']."/".$date['hours'].":".$date['minutes'].":".$date['seconds']." par ".$modifAgence."\n");
        fclose($accesSys);
        return true;
    }
    else
        return false;
}

