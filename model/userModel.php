<?php
require_once ('./assets/php/fonctions.php');


function getConnexion($username,$password){
	$bdd = new DB();
	$date= getdate();
	$sql='SELECT * FROM utilisateur WHERE username="'.$username.'" AND etat="actif"';
	$reponse=SQLSelect($sql);

	if(count($reponse)==1){
	    foreach($reponse as $donnees):

	    	//cryptage AES
	    	$ciphering = "AES-128-CTR";
	        $options = 0;
	        $encryption_iv = '1234567891011121';
	        $encryption_key = "BCBFacturedsi@sesi!sei\$sm1";
        	$encryption = openssl_encrypt($password, $ciphering, $encryption_key, $options, $encryption_iv);

        	/*decryptage AES
        	$ciphering = "AES-128-CTR";
            $options = 0;

            $decryption_iv = '1234567891011121';
            $decryption_key = "BCBFacturedsi@sesi!sei\$sm1";
            $decryption=openssl_decrypt ($user->getSpecial(), $ciphering, $decryption_key, $options, $decryption_iv);*/


	        if($encryption==$donnees->password && $donnees->isBlocked==false && $donnees->isConnected==false){
	            $setTentativeZero=$bdd->db->PREPARE("UPDATE utilisateur SET tentative_echec=0, lastConnDate=CURRENT_TIMESTAMP, isConnected=true WHERE username='".$username."'");
	            $setTentativeZero->EXECUTE();
	            $accesSys=fopen('accesSys.txt','a');
	            fputs($accesSys, "accès accordé: ".$donnees->username." ".$date['mday']."/".$date['mon']."/".$date['year']."/".$date['hours'].":".$date['minutes'].":".$date['seconds']."\n");
	            fclose($accesSys);
	            return $donnees;
	        }
	        
	        else if($donnees->isBlocked==true){
	            return "blocked";
	        }

	        else if($donnees->isConnected==true){
	            return "User Already connected";
	        }
	        
	        else if($encryption!=$donnees->password){
	            $getTentative=$bdd->db->PREPARE("SELECT tentative_echec FROM utilisateur WHERE username='".$username."'");
	            $getTentative->EXECUTE();
	            $tentavtive=$getTentative->fetch();
	            if($tentavtive['tentative_echec']<=3){
	                $tentative=$tentavtive['tentative_echec']+1;
	                $setTentative=$bdd->db->PREPARE("UPDATE utilisateur SET tentative_echec=".$tentative." WHERE username='".$username."'");
	                $setTentative->EXECUTE();
	                $accesSys=fopen('accesSys.txt','a');
	                fputs($accesSys, "accès refusé, mot de passe incorrect: ".$username." ".$date['mday']."/".$date['mon']."/".$date['year']."/".$date['hours'].":".$date['minutes'].":".$date['seconds']."\n");
	                return "echec";
	                
	                fclose($accesSys);
	            }
	            else{
	                $setBlocked=$bdd->db->PREPARE("UPDATE utilisateur SET isBlocked=1 WHERE username='".$username."'");
	                $setBlocked->EXECUTE();
	                return "blocked";
	            }
	        }
	    endforeach;
	}


	elseif(count($reponse)==0){
	    return "notFound";
	}

	else if(count($reponse)>1)
		return "UNIQUE USERNAME CONSTRAINT VIOLATED";
}

function deconnect($id, $username){
	$bdd = new DB();
	$date= getdate();
	$userDec=$bdd->db->PREPARE("UPDATE utilisateur SET lastConnDate=CURRENT_TIMESTAMP, isConnected=default, isBlocked=default WHERE idUtilisateur=".$id);
	$userDec->EXECUTE();
	$accesSys=fopen('accesSys.txt','a');
	fputs($accesSys, "Deconnexion : ".$username." ".$date['mday']."/".$date['mon']."/".$date['year']."/".$date['hours'].":".$date['minutes'].":".$date['seconds']."\n");
	fclose($accesSys);
}

function addUser($nom, $prenom, $userName, $droit, $adder){
    $bdd = new DB();
    $epassword = "";

    $verifSql = 'SELECT * FROM utilisateur WHERE username="'.$userName.'"';
    $verifResult = SQLSelect($verifSql);


    $passwords = SQLSelect('SELECT * FROM password');
    foreach ($passwords as $password) {
        $epassword = $password->password;
        //echo $epassword;
    }

    if(empty($verifResult)){
        $sql =$bdd->db->PREPARE('INSERT INTO `utilisateur`(`idUtilisateur`, `nom`, `prenom`, `droit`, `username`, `password`, `etat`, `tentative_echec`, `lastConnDate`, `isConnected`, `isBlocked`) VALUES (DEFAULT , :nom, :prenom, :droit, :username, :password, DEFAULT, DEFAULT, DEFAULT, default, default)');
        $sql->EXECUTE(array(
            "nom" => $nom ,
            "prenom" => $prenom ,
            "username" => $userName ,
            "password" => $epassword ,
            "droit" => $droit
        ));

        $date= getdate();
        $accesSys=fopen('accesSys.txt','a');
        fputs($accesSys, "Ajout de l'utilisateur: ".$userName." le ".$date['mday']."/".$date['mon']."/".$date['year']."/".$date['hours'].":".$date['minutes'].":".$date['seconds']." par ".$adder."\n");
        fclose($accesSys);

        return true;
    }
    else
        return false;
}


function getUsersBdd(){
    $bdd = new DB();
    $sql='SELECT * FROM utilisateur';
    $reponse=SQLSelect($sql);

    return $reponse;
}

function getInfoUser($id){
    $bdd = new DB();
    $sql='SELECT * FROM utilisateur WHERE `idUtilisateur`='.$id;
    $reponses=SQLSelect($sql);

    foreach($reponses as $reponse):
        return $reponse;
    endforeach;
}

function modifyUser($nom, $prenom, $username, $droit, $id, $modifier){
    $bdd = new DB();

    $sql =$bdd->db->PREPARE("UPDATE `utilisateur` SET `nom`=:nom, `prenom`=:prenom, `username`=:username, `droit`=:droit WHERE `idUtilisateur`=:id");
    $sql->EXECUTE(array(
        'nom' => $nom,
        'prenom' => $prenom,
        'username' => $username,
        'droit' => $droit,
        'id' => $id
    ));

    if($sql) {
        $date= getdate();
        $accesSys=fopen('accesSys.txt','a');
        fputs($accesSys, "Modification de l'utilisateur: ".$username." le ".$date['mday']."/".$date['mon']."/".$date['year']."/".$date['hours'].":".$date['minutes'].":".$date['seconds']." par ".$modifier."\n");
        fclose($accesSys);
        return true;
    }
    else
        return false;
}

function deleteOldUser($id, $deleter){

    $nom = "";
    $verifSql = 'SELECT * FROM utilisateur WHERE idUtilisateur="'.$id.'"';
    $verifResults = SQLSelect($verifSql);
    foreach ($verifResults as $verifResult){
        $nom = $verifResult->nom;
    }


    $bdd = new DB();
    $sql=$bdd->db->PREPARE('DELETE FROM `utilisateur` WHERE `idUtilisateur`=:id');
    $sql->EXECUTE(array(
        'id'=> $id
    ));

    $date= getdate();
    $accesSys=fopen('accesSys.txt','a');
    fputs($accesSys, "Suppresion de l'utilisateur: ".$nom." le ".$date['mday']."/".$date['mon']."/".$date['year']."/".$date['hours'].":".$date['minutes'].":".$date['seconds']." par ".$deleter."\n");
    fclose($accesSys);

    return true;
}

function initUser($id){
    $bdd = new DB();
    $userState = null;

    $verifUsers = SQLSelect('SELECT * FROM utilisateur WHERE idUtilisateur='.$id);
    foreach ($verifUsers as $verifUser){
        $userState = $verifUser->isBlocked;
    }

    if($userState==1){
        $epassword = "";
        $passwords = SQLSelect('SELECT * FROM password');
        foreach ($passwords as $password) {
            $epassword = $password->password;
            //echo $epassword;
        }

        $sql =$bdd->db->PREPARE("UPDATE `utilisateur` SET `isBlocked`= false, `tentative_echec`=0, `password`=:password, isConnected=false  WHERE `idUtilisateur`=:id");
        $sql->EXECUTE(array(
            'id' => $id,
            'password' => $epassword,
        ));

        if($sql)
            return true;
        else
            return false;
    }

    else{
        $sql =$bdd->db->PREPARE("UPDATE `utilisateur` SET `isBlocked`= 1 WHERE `idUtilisateur`=:id");
        $sql->EXECUTE(array(
            'id' => $id
        ));

        if($sql)
            return true;
        else
            return false;
    }
}

function modifyMe($username, $password, $id){
    $bdd = new DB();

    $verifUsers = SQLSelect('SELECT * FROM utilisateur WHERE idUtilisateur='.$id);
    foreach ($verifUsers as $verifUser){
        if($username==$verifUser->username){
            //echo $id;
            //cryptage AES
            $ciphering = "AES-128-CTR";
            $options = 0;
            $encryption_iv = '1234567891011121';
            $encryption_key = "BCBFacturedsi@sesi!sei\$sm1";
            $encryption = openssl_encrypt($password, $ciphering, $encryption_key, $options, $encryption_iv);
            $sql = $bdd->db->PREPARE('UPDATE `utilisateur` SET `password`=:password WHERE `idUtilisateur`=:id');
            $sql->EXECUTE(array(
                'password'=>$encryption,
                'id'=>$id,
            ));

            if($sql)
                return true;
            else
                return false;
        }
    }

    /*cryptage AES
    $ciphering = "AES-128-CTR";
    $options = 0;
    $encryption_iv = '1234567891011121';
    $encryption_key = "BCBFacturedsi@sesi!sei\$sm1";
    //$encryption = openssl_encrypt($password, $ciphering, $encryption_key, $options, $encryption_iv);

    //decryptage AES
    $ciphering = "AES-128-CTR";
    $options = 0;

    $decryption_iv = '1234567891011121';
    $decryption_key = "BCBFacturedsi@sesi!sei\$sm1";
    $decryption=openssl_decrypt ($user->getSpecial(), $ciphering, $decryption_key, $options, $decryption_iv);*/


}