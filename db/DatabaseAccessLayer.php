<?php
    require_once "adndprojectDbManager.php"; //includes Database Class
 	
	function getMenu(){  
		global $ADnD_Db;
		$queryText = "CALL adndproject.GetMenu(".(isset($_SESSION['user']) ? "'".$_SESSION['user']."'" : 'NULL').")";
		$result = $ADnD_Db->performQuery($queryText);
		$ADnD_Db->closeConnection();
		return $result; 
	}

	//al momento della registrazione, controlla se l'user e gia presente nel db, e se non lo e lo inserisce
	function insertUser($username, $email, $password){
		global $ADnD_Db;
		$queryText = 'SELECT Username, Email '
					.  'FROM utenti '
					. 'WHERE Username = ? OR Email = ?';

		if (!($stmt = $ADnD_Db->getPreparedStmt($queryText))) {
			header("Location: ../Registrati.php?regerror=sqlerror");
			exit();
		}
		else {
			$stmt->bind_param('ss', $username, $email);
			$stmt->execute();
			$resultCheck = $stmt->get_result();
		//	$resultCheck = $stmt->num_rows;
			if ($resultCheck->num_rows > 0) {
				$result = $resultCheck->fetch_assoc();
				if ($result['Username'] == $username && $result['Email'] == $email) {
					header("Location: ../Registrati.php?regerror=userandemailtaken");
					exit();
				}
				else if ($result['Username'] == $username) {
					header("Location: ../Registrati.php?regerror=usertaken&email=".$email);
					exit();
				}
				else if ($result['Email'] == $email) {
					header("Location: ../Registrati.php?regerror=emailtaken&username=".$username);
					exit();
				}
					
			}
			else {

				$queryText = 'INSERT INTO utenti (Username, Email, Password) '
							.     'VALUES (?, ?, ?)'; 
				if (!($stmt = $ADnD_Db->getPreparedStmt($queryText))) {
					header("Location: ../Registrati.php?regerror=sqlerror");
					exit();
				}
				else {
					$hashedPwd = password_hash($password, PASSWORD_DEFAULT);

					$stmt->bind_param('sss', $username, $email, $hashedPwd);
					$stmt->execute();
					header("Location: ../Registrati.php?registrazione=success");
					exit();
				}	
			}			
		}
		$stmt->close();
		$ADnD_Db->closeConnection();
		return;
	}

	function getNextId(){
		global $ADnD_Db;
		//cerco il piu grande id per poter inserire il nuovo personaggio con l'id successivo
		$queryText = 'SELECT max(idPersonaggio) as id '
					.  'FROM personaggi';
		$tempresult = $ADnD_Db->performQuery($queryText);
		$result = $tempresult->fetch_assoc();
		if ($result['id'] == null) {
			$id = 1;
		} else {
			$id = $result['id'] + 1;
		};
		return $id;
	}

	function getCurrentId(){
		global $ADnD_Db;
		//cerco il piu grande id per poter inserire le informazioni dell'ultimo personaggio
		$queryText = 'SELECT max(idPersonaggio) as id '
					.  'FROM personaggi';
		$tempresult = $ADnD_Db->performQuery($queryText);
		$result = $tempresult->fetch_assoc();
		return $result['id'];
	}

	//funzione di inserimento di un nuovo personaggio nel database
	function EseguiQuery($queryText){
		global $ADnD_Db;
		$ADnD_Db->performQuery($queryText);
		$ADnD_Db->closeConnection();
		return; 
	}

	//controlla se nel db sono presenti i dati inseriti dall'utente, e se lo sono esegue il login
	function login($user_email, $password){
		global $ADnD_Db;
		$queryText = 'SELECT * '
					.  'FROM utenti '
					. 'WHERE Username = ? OR Email = ?;'; 
		if (!($stmt = $ADnD_Db->getPreparedStmt($queryText))) {
			header("Location: ../index.php?error=sqlerror");
			exit();
		}
		else {
			$stmt->bind_param('ss', $user_email, $user_email);
			$stmt->execute();
			$result = $stmt->get_result();
			if ($row = $result->fetch_assoc()) {
				$pwdCheck = password_verify($password, $row['Password']);
				if ($pwdCheck == false) {
					header("Location: ../index.php?error=wrongpwd");
					exit();
				}
				else if ($pwdCheck == true) {
					session_start();
					$_SESSION['user'] = $row['Username'];
					$_SESSION['email'] = $row['Email'];

					header("Location: ../index.php?login=logsuccess");
					exit();
				}
				else {
					//questo else serve nel caso che $pwdCheck per qualche errore nascosto non ritorni un boolean ma qualcos altro
					header("Location: ../index.php?error=wrongpwd");
					exit();
				}
			}
			else {
				header("Location: ../index.php?error=nouser");
				exit();
			}
		}
	}

	//controlla se nel db sono presenti i dati inseriti dall'utente, e se lo sono aggiorna il profilo
	function UpdProfilo($pArr){
		global $ADnD_Db;
		$queryText = 'SELECT * '
					.  'FROM utenti '
					. 'WHERE Username = ?;'; 
		if (!($stmt = $ADnD_Db->getPreparedStmt($queryText))) {
			header("Location: ../index.php?error=sqlerror");
			exit();
		}
		else {
			$stmt->bind_param('s', $pArr['pUser']);
			$stmt->execute();		
			$result = $stmt->get_result();
			if ($row = $result->fetch_assoc()) {
				$pwdCheck1 = password_verify($pArr['pNewPwd'], $row['Password']);
				if($pwdCheck1 == true){
					return 'samepwd';
				}
				$pwdCheck = password_verify($pArr['pCurPwd'], $row['Password']);
				if ($pwdCheck == false) {
					return 'wrongpwd';
				}
				if (!filter_var($pArr['pNewEmail'], FILTER_VALIDATE_EMAIL)){
					return 'badmail';
				}
				if($pArr['pNewPwd'] !== 'null') $pwd = password_hash($pArr['pNewPwd'], PASSWORD_DEFAULT);
				$queryText = 'CALL UpdProfilo(';
				$queryText .= "'{$pArr['pUser']}',";
				$queryText .= "'{$pArr['pNewEmail']}',";
				$queryText .= ($pArr['pNewPwd'] == 'null' ? "NULL" : "'{$pwd}'");
				$queryText .= ')';
				//writeLog('UpdProfilo', $queryText);
		
				try{			
					$ADnD_Db->performQuery($queryText);
					$ADnD_Db->closeConnection();
					session_start();
					$_SESSION['email'] = $pArr['pNewEmail'];
					return "true";
				} catch(Exception $e) {
					return $e->getMessage();
				}	
			}
			else {
				//in questo caso qui non dovrebbe entrare mai dal momento che lo user dovrebbe sempre essere corretto...
				header("Location: ../index.php?error=nouser");
				exit();
			}
		}
	}

	function DelProfilo($pArr){
		global $ADnD_Db;
		$queryText = 'CALL DelProfilo(';
		$queryText .= "'{$pArr['pUser']}'";
		$queryText .= ')';
		//writeLog('DelProfilo', $queryText);

		try{			
			$ADnD_Db->performQuery($queryText);
			$ADnD_Db->closeConnection();
			session_start();
			session_unset();
			session_destroy();
			return "true";
		} catch(Exception $e) {
			return $e->getMessage();
		}	
	}

	//cerca nel database l'abilita col codice dato 
	function selAbilita($idAbilita){
		global $ADnD_Db;
		$queryText = 'SELECT * '
					.'  FROM abilita '
					.' WHERE idAbilita = '.$idAbilita;
		$result = $ADnD_Db->performQuery($queryText)->fetch_assoc();
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	//cerca nel database l'abilita di classe col codice dato 
	function selAbilitaDiClasse($idAbilitadiclasse){
		global $ADnD_Db;
		$queryText = 'SELECT * '
					.'  FROM abilitadiclasse '
					.' WHERE idAbilitadiclasse = '.$idAbilitadiclasse;
		$result = $ADnD_Db->performQuery($queryText)->fetch_assoc();
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	//cerca nel database l'abilita di razza col codice dato 
	function selAbilitaDiRazza($idAbilitadirazza){
		global $ADnD_Db;
		$queryText = 'SELECT * '
					.'  FROM abilitadirazza '
					.' WHERE idAbilitadirazza = '.$idAbilitadirazza;
		$result = $ADnD_Db->performQuery($queryText)->fetch_assoc();
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	//cerca nel database l'abilita ladri col codice dato 
	function selAbilitaLadri($idAbilitaladri){
		global $ADnD_Db;
		$queryText = 'SELECT * '
					.'  FROM abilitadiladri '
					.' WHERE idAbilitaladri = '.$idAbilitaladri;
		$result = $ADnD_Db->performQuery($queryText)->fetch_assoc();
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	//cerca nel database l'allineamento col codice dato 
	function selAllineamento($idAllineamento){
		global $ADnD_Db;
		$queryText = 'SELECT * '
					.'  FROM allineamento '
					.' WHERE idAllineamento = '.$idAllineamento;
		$result = $ADnD_Db->performQuery($queryText)->fetch_assoc();
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	//cerca nel database l'arma col codice dato 
	function selArma($idArma){
		global $ADnD_Db;
		$queryText = 'SELECT * '
					.'  FROM arma '
					.' WHERE idArma = '.$idArma;
		$result = $ADnD_Db->performQuery($queryText)->fetch_assoc();
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	//cerca nel database la classe col codice dato 
	function selClasse($idClasse){
		global $ADnD_Db;
		$queryText = 'SELECT * '
					.'  FROM classe '
					.' WHERE idClasse = '.$idClasse;
		$result = $ADnD_Db->performQuery($queryText)->fetch_assoc();
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	//cerca nel database l'incantesimo col nome dato 
	function selIncantesimo($NomeIncantesimo){
		global $ADnD_Db;
		$queryText = 'SELECT * '
					.'  FROM incantesimi '
					." WHERE NomeIncantesimo = '{$NomeIncantesimo}'";
		writeLog('selIncantesimo', $queryText);
		$result = $ADnD_Db->performQuery($queryText)->fetch_assoc();
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	//cerca nel database il personaggio col codice dato 
	function selPersonaggio($idPersonaggio){
		global $ADnD_Db;
		$queryText = 'SELECT * '
					.'  FROM personaggi '
					.' WHERE idPersonaggio = '.$idPersonaggio;
		$result = $ADnD_Db->performQuery($queryText)->fetch_assoc();
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	//cerca nel database le abilita del personaggio col codice dato 
	function selPgAbilita($idPersonaggio){
		global $ADnD_Db;
		$queryText = 'SELECT * '
					.'  FROM pg_abilita '
					.' WHERE idPersonaggio = '.$idPersonaggio;
		$result = $ADnD_Db->performQuery($queryText);
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	//cerca nel database le abilita di classe del personaggio col codice dato 
	function selPgAbilitaDiClasse($idPersonaggio){
		global $ADnD_Db;
		$queryText = 'SELECT *'
					.'  FROM pg_abilitadiclasse'
					.' WHERE idPersonaggio = '.$idPersonaggio;
		$result = $ADnD_Db->performQuery($queryText);
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	//cerca nel database le abilita di razza del personaggio col codice dato 
	function selPgAbilitaDiRazza($idPersonaggio){
		global $ADnD_Db;
		$queryText = 'SELECT *'
					.'  FROM pg_abilitadirazza'
					.' WHERE idPersonaggio = '.$idPersonaggio;
		$result = $ADnD_Db->performQuery($queryText);
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	//cerca nel database le abilita da ladro del personaggio col codice dato 
	function selPgAbilitaLadri($idPersonaggio){
		global $ADnD_Db;
		$queryText = 'SELECT *'
					.'  FROM pg_abilitaladri'
					.' WHERE idPersonaggio = '.$idPersonaggio;
		$result = $ADnD_Db->performQuery($queryText);
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	//cerca nel database le armi del personaggio col codice dato 
	function selPgArma($idPersonaggio){
		global $ADnD_Db;
		$queryText = 'SELECT *'
					.'  FROM pg_arma'
					.' WHERE idPersonaggio = '.$idPersonaggio;
		$result = $ADnD_Db->performQuery($queryText);
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	//cerca nel database le armature del personaggio col codice dato 
	function selPgArmatura($idPersonaggio){
		global $ADnD_Db;
		$queryText = 'SELECT *'
					.'  FROM pg_armatura'
					.' WHERE idPersonaggio = '.$idPersonaggio;
		$result = $ADnD_Db->performQuery($queryText);
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	//cerca nel database i personaggi che usano l'incantesimo col nome dato 
	function selIncPersonaggi($NomeIncantesimo){
		global $ADnD_Db;
		$queryText = 'SELECT *'
					.'  FROM pg_incantesimi'
					.' WHERE Nome = '.$NomeIncantesimo;
		$result = $ADnD_Db->performQuery($queryText);
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	//cerca nel database gli incantesimi del personaggio col codice dato 
	function selPgIncantesimi($idPersonaggio){
		global $ADnD_Db;
		$queryText = 'SELECT *'
					.'  FROM pg_incantesimi'
					.' WHERE idPersonaggio = '.$idPersonaggio;
		$result = $ADnD_Db->performQuery($queryText);
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	//cerca nel database le monete del personaggio col codice dato 
	function selPgMoneta($idPersonaggio){
		global $ADnD_Db;
		$queryText = 'SELECT *'
					.'  FROM pg_moneta'
					.' WHERE idPersonaggio = '.$idPersonaggio;
		$result = $ADnD_Db->performQuery($queryText);
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	//cerca nel database le proficienze del personaggio col codice dato 
	function selPgProficienze($idPersonaggio){
		global $ADnD_Db;
		$queryText = 'SELECT *'
					.'  FROM pg_proficienze'
					.' WHERE idPersonaggio = '.$idPersonaggio;
		$result = $ADnD_Db->performQuery($queryText);
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	//cerca nel database le proficienze con le armi del personaggio col codice dato 
	function selPgProficienzeArmi($idPersonaggio){
		global $ADnD_Db;
		$queryText = 'SELECT *'
					.'  FROM pg_proficienzearmi'
					.' WHERE idPersonaggio = '.$idPersonaggio;
		$result = $ADnD_Db->performQuery($queryText);
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	//cerca nel database gli stili di combattimento del personaggio col codice dato 
	function selPgStiliCombattimento($idPersonaggio){
		global $ADnD_Db;
		$queryText = 'SELECT *'
					.'  FROM pg_stilicombattimento'
					.' WHERE idPersonaggio = '.$idPersonaggio;
		$result = $ADnD_Db->performQuery($queryText);
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	//cerca nel database gli svantaggi del personaggio col codice dato 
	function selPgSvantaggi($idPersonaggio){
		global $ADnD_Db;
		$queryText = 'SELECT *'
					.'  FROM pg_svantaggi'
					.' WHERE idPersonaggio = '.$idPersonaggio;
		$result = $ADnD_Db->performQuery($queryText);
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	//cerca nel database i modificatori dei tiri salvezza del personaggio col codice dato 
	function selPgTiroSalvezzaModificatore($idPersonaggio){
		global $ADnD_Db;
		$queryText = 'SELECT *'
					.'  FROM pg_tirosalv_mod'
					.' WHERE idPersonaggio = '.$idPersonaggio;
		$result = $ADnD_Db->performQuery($queryText);
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	//cerca nel database i tratti del personaggio col codice dato 
	function selPgTratti($idPersonaggio){
		global $ADnD_Db;
		$queryText = 'SELECT *'
					.'  FROM pg_tratti'
					.' WHERE idPersonaggio = '.$idPersonaggio;
		$result = $ADnD_Db->performQuery($queryText);
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	//cerca nel database la proficienza col codice dato 
	function selProficienza($idProficienza){
		global $ADnD_Db;
		$queryText = 'SELECT * '
					.'  FROM proficienze '
					.' WHERE idProficienza = '.$idProficienza;
		$result = $ADnD_Db->performQuery($queryText)->fetch_assoc();
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	//cerca nel database la razza col codice dato 
	function selRazza($idRazza){
		global $ADnD_Db;
		$queryText = 'SELECT * '
					.'  FROM razza '
					.' WHERE idRazza = '.$idRazza;
		$result = $ADnD_Db->performQuery($queryText)->fetch_assoc();
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	//cerca nel database lo svantaggio col codice dato 
	function selSvantaggio($idSvantaggio){
		global $ADnD_Db;
		$queryText = 'SELECT *'
					.'  FROM svantaggi'
					.' WHERE idSvantaggio = '.$idSvantaggio;
		$result = $ADnD_Db->performQuery($queryText)->fetch_assoc();
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	//cerca nel database il tratto col codice dato 
	function selTratto($idTratto){
		global $ADnD_Db;
		$queryText = 'SELECT *'
					.'  FROM tratti'
					.' WHERE idTratto = '.$idTratto;
		$result = $ADnD_Db->performQuery($queryText)->fetch_assoc();
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	//cerca nel database lo stile di combattimento col codice dato 
	function selStile($idStile){
		global $ADnD_Db;
		$queryText = 'SELECT *'
					.'  FROM stilicombattimento'
					.' WHERE idStile = '.$idStile;
		$result = $ADnD_Db->performQuery($queryText)->fetch_assoc();
		$ADnD_Db->closeConnection(); 
		return $result;
	}











	//cerca nel database quali sono i possibili allineamenti 
	function selectAllineamento(){
		global $ADnD_Db;
		$queryText = 'SELECT * '
					.'  FROM allineamento';
		$result = $ADnD_Db->performQuery($queryText);
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	//cerca nel database quali sono le possibili razze 
	function selectRazza(){
		global $ADnD_Db;
		$queryText = 'SELECT * '
					.'  FROM razza';
		$result = $ADnD_Db->performQuery($queryText);
		$ADnD_Db->closeConnection(); 
		return $result;
	}	

	//cerca nel database quali sono le possibili classi 
	function selectClasse(){
		global $ADnD_Db;
		$queryText = 'SELECT * '
					.'  FROM classe';
		$result = $ADnD_Db->performQuery($queryText);
		$ADnD_Db->closeConnection(); 
		return $result;
	}	

	function selectCategoriaArma(){
		global $ADnD_Db;
		$queryText = 'SELECT distinct Categoria '
					.'  FROM arma';
		$result = $ADnD_Db->performQuery($queryText);
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	function selectCategoriaProficienze(){
		global $ADnD_Db;
		$queryText = 'SELECT distinct Categoria '
					.'  FROM proficienze';
		$result = $ADnD_Db->performQuery($queryText);
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	function selectArmatura(){
		global $ADnD_Db;
		$queryText = 'SELECT * '
		            .'FROM armatura '
		            .'WHERE idArmatura != 12';
		$result = $ADnD_Db->performQuery($queryText);
		$ADnD_Db->closeConnection();
		return $result;
	}

	function selectArmi($pCategoria, $pFixValue){

		if($pCategoria == null) return null;

		global $ADnD_Db;
		$queryText = 'SELECT 0 as idArma, \''.$pFixValue.'\' as Nome';
		$queryText .= ' UNION SELECT idArma, Nome FROM arma WHERE Categoria = \''. $pCategoria . '\'';
		//writeLog('selectArmi', $queryText);
		$result = $ADnD_Db->performQuery($queryText);
		$ADnD_Db->closeConnection(); 
		return $result;
	}	

	function selectProficienze($pCategoria, $pFixValue){

		if($pCategoria == null) return null;

		global $ADnD_Db;
		$queryText = 'SELECT 0 as idProficienza, \''.$pFixValue.'\' as Nome';
		$queryText .= ' UNION SELECT idProficienza, Nome FROM proficienze WHERE Categoria = \''. $pCategoria . '\'';
		//writeLog('selectProficienze', $queryText);
		$result = $ADnD_Db->performQuery($queryText);
		$ADnD_Db->closeConnection(); 
		return $result;
	}	

	function selectAbilitaDiRazza($pRazza, $pFixValue){

		if($pRazza == null) return null;

		global $ADnD_Db;
		$queryText = 'SELECT 0 as idAbilitadirazza, \''.$pFixValue.'\' as Nome';
		$queryText .= ' UNION SELECT idAbilitadirazza, Nome FROM abilitadirazza WHERE Razza = \''. $pRazza . '\'';
		//writeLog('selectAbilitaDiRazza', $queryText);
		$result = $ADnD_Db->performQuery($queryText);
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	function selectAbilitaDiClasse($pClasse, $pFixValue){

		if($pClasse == null) return null;

		global $ADnD_Db;
		$queryText = 'SELECT 0 as idAbilitadiclasse, \''.$pFixValue.'\' as Nome';
		$queryText .= ' UNION SELECT idAbilitadiclasse, Nome FROM abilitadiclasse WHERE Classe = \''. $pClasse . '\'';
		//writeLog('selectAbilitaDiClasse', $queryText);
		$result = $ADnD_Db->performQuery($queryText);
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	function selectTratti(){

		global $ADnD_Db;
		$queryText = 'SELECT idTratto, Nome FROM tratti';
		//writeLog('selectTratti', $queryText);
		$result = $ADnD_Db->performQuery($queryText);
		$ADnD_Db->closeConnection(); 
		return $result;
	}	

	function selectSvantaggi(){

		global $ADnD_Db;
		$queryText = 'SELECT idSvantaggio, Nome FROM svantaggi';
		//writeLog('selectTratti', $queryText);
		$result = $ADnD_Db->performQuery($queryText);
		$ADnD_Db->closeConnection(); 
		return $result;
	}	

	function selectStiliComb(){

		global $ADnD_Db;
		$queryText = 'SELECT idStile, Nome FROM stilicombattimento';
		//writeLog('selectStiliComb', $queryText);
		$result = $ADnD_Db->performQuery($queryText);
		$ADnD_Db->closeConnection(); 
		return $result;
	}	

	function getArma($pId){

		if($pId == null) return null;

		global $ADnD_Db;
		$queryText = 'SELECT idArma, Nome, DannoPM, DannoG, Peso, Taglia, Tipo, FattoreVelocita '
					 .' FROM arma '
					 .'WHERE idArma = \''. $pId . '\'';
		//writeLog('getArma', $queryText);
		$result = $ADnD_Db->performQuery($queryText)->fetch_assoc();
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	function aggiungiProficienza($pId){

		if($pId == null) return null;

		global $ADnD_Db;
		$queryText = 'SELECT idProficienza, Nome, Categoria, CostoPP, ValoreBase, Abilita '
					 .' FROM proficienze '
					 .'WHERE idProficienza = \''. $pId . '\'';
		writeLog('aggiungiProficienza', $queryText);
		$result = $ADnD_Db->performQuery($queryText)->fetch_assoc();
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	function aggiungiTratto($pId){

		if($pId == null) return null;

		global $ADnD_Db;
		$queryText = 'SELECT idTratto, Nome, CostoPP '
					 .' FROM tratti '
					 .'WHERE idTratto = \''. $pId . '\'';
		//writeLog('aggiungiTratto', $queryText);
		$result = $ADnD_Db->performQuery($queryText)->fetch_assoc();
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	function aggiungiSvantaggio($pId){

		if($pId == null) return null;

		global $ADnD_Db;
		$queryText = 'SELECT idSvantaggio, Nome, PPModerato, PPGrave '
					 .' FROM svantaggi '
					 .'WHERE idSvantaggio = \''. $pId . '\'';
		//writeLog('aggiungiTratto', $queryText);
		$result = $ADnD_Db->performQuery($queryText)->fetch_assoc();
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	function aggiungiAbRazza($pId){

		if($pId == null) return null;

		global $ADnD_Db;
		$queryText = 'SELECT idAbilitadirazza, Nome, CostoPP, Razza '
					 .' FROM abilitadirazza '
					 .'WHERE idAbilitadirazza = \''. $pId . '\'';
		//writeLog('aggiungiTratto', $queryText);
		$result = $ADnD_Db->performQuery($queryText)->fetch_assoc();
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	function aggiungiAbClasse($pId){

		if($pId == null) return null;

		global $ADnD_Db;
		$queryText = 'SELECT idAbilitadiclasse, Nome, CostoPP, Classe '
					 .' FROM abilitadiclasse '
					 .'WHERE idAbilitadiclasse = \''. $pId . '\'';
		//writeLog('aggiungiTratto', $queryText);
		$result = $ADnD_Db->performQuery($queryText)->fetch_assoc();
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	function aggiungiStileComb($pId){

		if($pId == null) return null;

		global $ADnD_Db;
		//$queryText = "SELECT idStile, Nome, Effetto FROM stilicombattimento  WHERE idStile = '{$pId}'";
		$queryText = 'SELECT idStile, Nome, Effetto '
					 .' FROM stilicombattimento '
					 .'WHERE idStile = \''. $pId . '\'';
		writeLog('aggiungiStileComb', $queryText);
		$result = $ADnD_Db->performQuery($queryText)->fetch_assoc();
		$ADnD_Db->closeConnection(); 
		return $result;
	}

	function InsUpdPersonaggio($pArr){
		global $ADnD_Db;
		$separatore = '';
		$lvIdPersonaggio = $pArr['idPersonaggio'];
		if ($lvIdPersonaggio == 'null') {
			$lvIdPersonaggio = getNextId();
		}
		$queryText = 'CALL InsUpdPersonaggio(';
		$queryText .= $lvIdPersonaggio . ',';
		$queryText .= "'{$pArr['pCreatore']}',";
		$queryText .= "'{$pArr['pNome']}',";
		$queryText .= "{$pArr['pRazza']},";
		$queryText .= "{$pArr['pClasse']},";
		$queryText .= $pArr['pClassi_Secondarie'] == 'null' ? 'NULL,' : "'{$pArr['pClassi_Secondarie']}',";
		$queryText .= "'{$pArr['pAllineamento']}',";
		$queryText .= "{$pArr['pLivello']},";
		$queryText .= $pArr['pLivelli_Secondari'] == 'null' ? 'NULL,' : "'{$pArr['pLivelli_Secondari']}',";
		$queryText .= "{$pArr['pEsperienza']},";
		$queryText .= $pArr['pOrigine'] == 'null' ? 'NULL,' : "'{$pArr['pOrigine']}',";
		$queryText .= $pArr['pFamiglia'] == 'null' ? 'NULL,' : "'{$pArr['pFamiglia']}',";
		$queryText .= $pArr['pStirpe_Clan'] == 'null' ? 'NULL,' : "'{$pArr['pStirpe_Clan']}',";
		$queryText .= $pArr['pReligione'] == 'null' ? 'NULL,' : "'{$pArr['pReligione']}',";
		$queryText .= $pArr['pClasse_Sociale'] == 'null' ? 'NULL,' : "'{$pArr['pClasse_Sociale']}',";
		$queryText .= $pArr['pFratelli_Sorelle'] == 'null' ? 'NULL,' : "'{$pArr['pFratelli_Sorelle']}',";
		$queryText .= "'{$pArr['pSesso']}',";
		$queryText .= "{$pArr['pAnni']},";
		$queryText .= $pArr['pAltezza'] == 'null' ? 'NULL,' : "{$pArr['pAltezza']},";
		$queryText .= $pArr['pPeso'] == 'null' ? 'NULL,' : "{$pArr['pPeso']},";
		$queryText .= $pArr['pCapelli'] == 'null' ? 'NULL,' : "'{$pArr['pCapelli']}',";
		$queryText .= $pArr['pOcchi'] == 'null' ? 'NULL,' : "'{$pArr['pOcchi']}',";
		$queryText .= $pArr['pAspetto'] == 'null' ? 'NULL' : "'{$pArr['pAspetto']}'";
		$queryText .= ')';
		//return $queryText;
		try{			
			$ADnD_Db->performQuery($queryText);
			$ADnD_Db->closeConnection();
			return $lvIdPersonaggio;
		} catch(Exception $e) {
			return $e->getMessage();
		}
	}

	function writeLog($pNomeFunzione, $pMessaggio){
		global $ADnD_Db;
		//$queryText = "CALL writeLog ('{$pNomeFunzione}', '{$pMessaggio}')";
		$queryText = "CALL writeLog ('".$pNomeFunzione."', '".str_replace("'", "''", $pMessaggio)."')";
		$ADnD_Db->performQuery($queryText);
		$ADnD_Db->closeConnection();
	}

	function InsUpdCaratteristica($pArr){
		global $ADnD_Db;
		$queryText = 'CALL InsUpdCaratteristica(';
		$queryText .= "{$pArr['idPersonaggio']},";
		$queryText .= "{$pArr['idAbilita']},";
		$queryText .= "'{$pArr['Val_Abilita']}',";
		$queryText .= "{$pArr['Val_Skill1']},";
		$queryText .= "{$pArr['Val_Skill2']}";
		$queryText .= ')';
		
		//writeLog('InsUpdCaratteristica', $queryText);
		try{			
			$ADnD_Db->performQuery($queryText);
			$ADnD_Db->closeConnection();
			return 'true';
		} catch(Exception $e) {
			return $e->getMessage();
		}
	}

	function InsUpdTiroSalvezza($pArr){
		global $ADnD_Db;
		try{
			for($i = 0; $i < 5; $i++){
				$queryText = 'CALL InsUpdTiroSalvezza(';
				$queryText .= "{$pArr['idPersonaggio']},";
				$queryText .= $pArr['pIdTiroSalvezza'.$i] . ',';
				$tmp = trim($pArr['pModificatore'.$i]);
				$tmp = ($tmp > 0 ? '+' : '').$tmp;
				$queryText .= '\''.$tmp.'\'';
				$queryText .= ')';
				//writeLog('InsUpdTiroSalvezza', $queryText);	
				$ADnD_Db->performQuery($queryText);						
			}
			$ADnD_Db->closeConnection();	
			return 'true';
		} catch(Exception $e) {
			return $e->getMessage();
		}
	}

	function InsUpdArmatura($pArr){
		global $ADnD_Db;
		$queryText = 'CALL InsUpdArmatura(';
		$queryText .= "{$pArr['idPersonaggio']},";
		$queryText .= "{$pArr['pIdArmatura']},";
		$queryText .= "{$pArr['pCA']},";
		$queryText .= "{$pArr['pSorpreso']},";
		$queryText .= "{$pArr['pSenzaScudo']},";
		$queryText .= "{$pArr['pAlleSpalle']},";
		$queryText .= "{$pArr['pIncantesimi']},";
		$queryText .= ($pArr['pDifese'] != '' ? "'{$pArr['pDifese']}'" : 'null');
		$queryText .= ')';
		writeLog('InsUpdArmatura', $queryText);

		try{			
			$ADnD_Db->performQuery($queryText);
			$ADnD_Db->closeConnection();
			return 'true';
		} catch(Exception $e) {
			return $e->getMessage();
		}	
	}

	function UpdPuntiFerita($pArr){
		global $ADnD_Db;
		$queryText = 'CALL UpdPuntiFerita(';
		$queryText .= "{$pArr['idPersonaggio']},";
		$queryText .= "{$pArr['pPuntiFerita']},";
		$queryText .= "{$pArr['pFerite']}";
		$queryText .= ')';
		//writeLog('UpdPuntiFerita', $queryText);

		try{			
			$ADnD_Db->performQuery($queryText);
			$ADnD_Db->closeConnection();
			return 'true';
		} catch(Exception $e) {
			return $e->getMessage();
		}	
	}

	function ChkInsArma($pArr){
		global $ADnD_Db;
		$queryText = 'SELECT ChkInsArma(';
		$queryText .= "{$pArr['idPersonaggio']},";
		$queryText .= "{$pArr['pIdArma']}";
		$queryText .= ') as result';
		//writeLog('ChkInsArma', $queryText);

		try{			
			$temp = $ADnD_Db->performQuery($queryText)->fetch_assoc();
			$result = $temp['result'];
			//writeLog('check', $result);
			$ADnD_Db->closeConnection();
			return $result;
		} catch(Exception $e) {
			return $e->getMessage();
		}	
	}

	function UpdPgArma($pArr){
		global $ADnD_Db;
		$queryText = 'CALL UpdPgArma(';
		$queryText .= "{$pArr['idPersonaggio']},";
		$queryText .= "{$pArr['pIdArma']},";
		$queryText .= "{$pArr['pAtkRound']},";
		//$queryText .= "'{$pArr['pModAtkDanno']}',";

		if($pArr['pModAtkDanno'] !== 'null'){
			$tmp = trim($pArr['pModAtkDanno']);
			$tmp2 = explode("/", $tmp);
			$tmp2[0] = ($tmp2[0] > 0 ? '+' : '').trim($tmp2[0]);
			$tmp2[1] = ($tmp2[1] > 0 ? '+' : '').trim($tmp2[1]);
			$queryText .= "'".$tmp2[0].'/'.$tmp2[1]."',";
		} else {
			$queryText .= 'null,';
		}

		$queryText .= "{$pArr['pThaco']},";
		$queryText .= "{$pArr['pRaggio']}";
		$queryText .= ')';
		//writeLog('UpdPgArma', $queryText);

		try{			
			$ADnD_Db->performQuery($queryText);
			//writeLog('pNum', $pArr['pNum']);
			$ADnD_Db->closeConnection();
			return "{$pArr['pNum']}";
		} catch(Exception $e) {
			return $e->getMessage();
		}	
	}

	function DelArma($pArr){
		global $ADnD_Db;
		$queryText = 'CALL DelArma(';
		$queryText .= "{$pArr['idPersonaggio']},";
		$queryText .= "{$pArr['pIdArma']}";
		$queryText .= ')';
		//writeLog('DelArma', $queryText);

		try{			
			$ADnD_Db->performQuery($queryText);
			$ADnD_Db->closeConnection();
			return "true";
		} catch(Exception $e) {
			return $e->getMessage();
		}	
	}

	function ChkInsArmaProf($pArr){
		global $ADnD_Db;
		$queryText = 'SELECT ChkInsArmaProf(';
		$queryText .= "{$pArr['idPersonaggio']},";
		$queryText .= "{$pArr['pIdArma']}";
		$queryText .= ') as result';
		//writeLog('ChkInsArma', $queryText);

		try{			
			$temp = $ADnD_Db->performQuery($queryText)->fetch_assoc();
			$result = $temp['result'];
			//writeLog('check', $result);
			$ADnD_Db->closeConnection();
			return $result;
		} catch(Exception $e) {
			return $e->getMessage();
		}	
	}

	function UpdPgArmaProf($pArr){
		global $ADnD_Db;
		$queryText = 'CALL UpdPgArmaProf(';
		$queryText .= "{$pArr['idPersonaggio']},";
		$queryText .= "{$pArr['pIdArma']},";
		$queryText .= "{$pArr['pPP']},";
		$queryText .= "{$pArr['pScelta']},";
		$queryText .= "{$pArr['pEsperto']},";
		$queryText .= "{$pArr['pSpec']},";
		$queryText .= "{$pArr['pMaestro']},";
		$queryText .= "{$pArr['pAlto']},";
		$queryText .= "{$pArr['pGrande']}";	
		$queryText .= ')';
		//writeLog('UpdPgArmaProf', $queryText);

		try{			
			$ADnD_Db->performQuery($queryText);
			//writeLog('pNum', $pArr['pNum']);
			$ADnD_Db->closeConnection();
			return "{$pArr['pNum']}";
		} catch(Exception $e) {
			return $e->getMessage();
		}	
	}

	function DelArmaProf($pArr){
		global $ADnD_Db;
		$queryText = 'CALL DelArmaProf(';
		$queryText .= "{$pArr['idPersonaggio']},";
		$queryText .= "{$pArr['pIdArma']}";
		$queryText .= ')';
		//writeLog('DelArmaProf', $queryText);

		try{			
			$ADnD_Db->performQuery($queryText);
			$ADnD_Db->closeConnection();
			return "true";
		} catch(Exception $e) {
			return $e->getMessage();
		}	
	}

	function ChkInsProficienza($pArr){
		global $ADnD_Db;
		$queryText = 'SELECT ChkInsProficienza(';
		$queryText .= "{$pArr['idPersonaggio']},";
		$queryText .= "{$pArr['pIdProficienza']},";
		$queryText .= "{$pArr['pValore']}";
		$queryText .= ') as result';
		//writeLog('ChkInsProficienza', $queryText);

		try{			
			$temp = $ADnD_Db->performQuery($queryText)->fetch_assoc();
			$result = $temp['result'];
			//writeLog('check', $result);
			$ADnD_Db->closeConnection();
			return $result;
		} catch(Exception $e) {
			return $e->getMessage();
		}	
	}

	function UpdPgProficienza($pArr){
		global $ADnD_Db;
		$queryText = 'CALL UpdPgProficienza(';
		$queryText .= "{$pArr['idPersonaggio']},";
		$queryText .= "{$pArr['pIdProficienza']},";
		$queryText .= "{$pArr['pValore']}";
		$queryText .= ')';
		//writeLog('UpdPgProficienza', $queryText);

		try{			
			$ADnD_Db->performQuery($queryText);
			//writeLog('pNum', $pArr['pNum']);
			$ADnD_Db->closeConnection();
			return "{$pArr['pNum']}";
		} catch(Exception $e) {
			return $e->getMessage();
		}	
	}

	function DelPgProficienza($pArr){
		global $ADnD_Db;
		$queryText = 'CALL DelPgProficienza(';
		$queryText .= "{$pArr['idPersonaggio']},";
		$queryText .= "{$pArr['pIdProficienza']}";
		$queryText .= ')';
		//writeLog('DelPgProficienza', $queryText);

		try{			
			$ADnD_Db->performQuery($queryText);
			$ADnD_Db->closeConnection();
			return "true";
		} catch(Exception $e) {
			return $e->getMessage();
		}	
	}

	function ChkInsTratto($pArr){
		global $ADnD_Db;
		$queryText = 'SELECT ChkInsTratto(';
		$queryText .= "{$pArr['idPersonaggio']},";
		$queryText .= "{$pArr['pIdTratto']}";
		$queryText .= ') as result';
		//writeLog('ChkInsTratto', $queryText);

		try{			
			$temp = $ADnD_Db->performQuery($queryText)->fetch_assoc();
			$result = $temp['result'];
			//writeLog('check', $result);
			$ADnD_Db->closeConnection();
			return $result;
		} catch(Exception $e) {
			return $e->getMessage();
		}	
	}

	function DelPgTratto($pArr){
		global $ADnD_Db;
		$queryText = 'CALL DelPgTratto(';
		$queryText .= "{$pArr['idPersonaggio']},";
		$queryText .= "{$pArr['pIdTratto']}";
		$queryText .= ')';
		//writeLog('DelPgTratto', $queryText);

		try{			
			$ADnD_Db->performQuery($queryText);
			$ADnD_Db->closeConnection();
			return "true";
		} catch(Exception $e) {
			return $e->getMessage();
		}	
	}

	function ChkInsSvantaggio($pArr){
		global $ADnD_Db;
		$queryText = 'SELECT ChkInsSvantaggio(';
		$queryText .= "{$pArr['idPersonaggio']},";
		$queryText .= "{$pArr['pIdSvantaggio']}";
		$queryText .= ') as result';
		//writeLog('ChkInsSvantaggio', $queryText);

		try{			
			$temp = $ADnD_Db->performQuery($queryText)->fetch_assoc();
			$result = $temp['result'];
			//writeLog('check', $result);
			$ADnD_Db->closeConnection();
			return $result;
		} catch(Exception $e) {
			return $e->getMessage();
		}	
	}

	function ChkInsStileComb($pArr){
		global $ADnD_Db;
		$queryText = 'SELECT ChkInsStileComb(';
		$queryText .= "{$pArr['idPersonaggio']},";
		$queryText .= "{$pArr['pIdStile']}";
		$queryText .= ') as result';
		writeLog('ChkInsStileComb', $queryText);

		try{			
			$temp = $ADnD_Db->performQuery($queryText)->fetch_assoc();
			$result = $temp['result'];
			writeLog('check', $result);
			$ADnD_Db->closeConnection();
			return $result;
		} catch(Exception $e) {
			return $e->getMessage();
		}	
	}

	function UpdPgStileComb($pArr){
		global $ADnD_Db;
		$queryText = 'CALL UpdPgStileComb(';
		$queryText .= "{$pArr['idPersonaggio']},";
		$queryText .= "{$pArr['pIdStile']},";
		$queryText .= "{$pArr['pPP']},";
		$queryText .= "{$pArr['pSpec']}";
		$queryText .= ')';
		writeLog('UpdPgStileComb', $queryText);

		try{			
			$ADnD_Db->performQuery($queryText);
			//writeLog('pNum', $pArr['pNum']);
			$ADnD_Db->closeConnection();
			return "{$pArr['pNum']}";
		} catch(Exception $e) {
			return $e->getMessage();
		}	
	}

	function DelPgStileComb($pArr){
		global $ADnD_Db;
		$queryText = 'CALL DelPgStileComb(';
		$queryText .= "{$pArr['idPersonaggio']},";
		$queryText .= "{$pArr['pIdStile']}";
		$queryText .= ')';
		//writeLog('DelPgStileComb', $queryText);

		try{			
			$ADnD_Db->performQuery($queryText);
			$ADnD_Db->closeConnection();
			return "true";
		} catch(Exception $e) {
			return $e->getMessage();
		}	
	}

	function UpdPgSvantaggio($pArr){
		global $ADnD_Db;
		$queryText = 'CALL UpdPgSvantaggio(';
		$queryText .= "{$pArr['idPersonaggio']},";
		$queryText .= "{$pArr['pIdSvantaggio']},";
		$queryText .= "{$pArr['pGrave']}";
		$queryText .= ')';
		//writeLog('UpdPgSvantaggio', $queryText);

		try{			
			$ADnD_Db->performQuery($queryText);
			//writeLog('pNum', $pArr['pNum']);
			$ADnD_Db->closeConnection();
			return "{$pArr['pNum']}";
		} catch(Exception $e) {
			return $e->getMessage();
		}	
	}

	function DelPgSvantaggio($pArr){
		global $ADnD_Db;
		$queryText = 'CALL DelPgSvantaggio(';
		$queryText .= "{$pArr['idPersonaggio']},";
		$queryText .= "{$pArr['pIdSvantaggio']}";
		$queryText .= ')';
		//writeLog('DelPgSvantaggio', $queryText);

		try{			
			$ADnD_Db->performQuery($queryText);
			$ADnD_Db->closeConnection();
			return "true";
		} catch(Exception $e) {
			return $e->getMessage();
		}	
	}

	function ChkInsAbRazza($pArr){
		global $ADnD_Db;
		$queryText = 'SELECT ChkInsAbRazza(';
		$queryText .= "{$pArr['idPersonaggio']},";
		$queryText .= "{$pArr['pIdAbRazza']}";
		$queryText .= ') as result';
		//writeLog('ChkInsAbRazza', $queryText);

		try{			
			$temp = $ADnD_Db->performQuery($queryText)->fetch_assoc();
			$result = $temp['result'];
			//writeLog('check', $result);
			$ADnD_Db->closeConnection();
			return $result;
		} catch(Exception $e) {
			return $e->getMessage();
		}	
	}

	function DelPgAbRazza($pArr){
		global $ADnD_Db;
		$queryText = 'CALL DelPgAbRazza(';
		$queryText .= "{$pArr['idPersonaggio']},";
		$queryText .= "{$pArr['pIdAbRazza']}";
		$queryText .= ')';
		//writeLog('DelPgAbRazza', $queryText);

		try{			
			$ADnD_Db->performQuery($queryText);
			$ADnD_Db->closeConnection();
			return "true";
		} catch(Exception $e) {
			return $e->getMessage();
		}	
	}

	function ChkInsAbClasse($pArr){
		global $ADnD_Db;
		$queryText = 'SELECT ChkInsAbClasse(';
		$queryText .= "{$pArr['idPersonaggio']},";
		$queryText .= "{$pArr['pIdAbClasse']}";
		$queryText .= ') as result';
		//writeLog('ChkInsAbClasse', $queryText);

		try{			
			$temp = $ADnD_Db->performQuery($queryText)->fetch_assoc();
			$result = $temp['result'];
			//writeLog('check', $result);
			$ADnD_Db->closeConnection();
			return $result;
		} catch(Exception $e) {
			return $e->getMessage();
		}	
	}

	function DelPgAbClasse($pArr){
		global $ADnD_Db;
		$queryText = 'CALL DelPgAbClasse(';
		$queryText .= "{$pArr['idPersonaggio']},";
		$queryText .= "{$pArr['pIdAbClasse']}";
		$queryText .= ')';
		//writeLog('DelPgAbClasse', $queryText);

		try{			
			$ADnD_Db->performQuery($queryText);
			$ADnD_Db->closeConnection();
			return "true";
		} catch(Exception $e) {
			return $e->getMessage();
		}	
	}

	function UpdInfoGeneriche($pArr){
		global $ADnD_Db;
		$queryText = 'CALL UpdInfoGeneriche(';
		$queryText .= "{$pArr['idPersonaggio']},";
		$queryText .= "{$pArr['pPPRimanenti']},";
		$queryText .= "{$pArr['pPuntiMagiaRimanenti']},";
		$queryText .= "{$pArr['pPuntiMagiaTotali']},";
		$queryText .= "{$pArr['pVelMovimento']}";
		$queryText .= ')';
		//writeLog('UpdInfoGeneriche', $queryText);

		try{			
			$ADnD_Db->performQuery($queryText);
			$ADnD_Db->closeConnection();
			return 'true';
		} catch(Exception $e) {
			return $e->getMessage();
		}	
	}

	function InsUpdRicchezze($pArr){
		global $ADnD_Db;
		$queryText = 'CALL InsUpdRicchezze(';
		$queryText .= "{$pArr['idPersonaggio']},";
		$queryText .= "{$pArr['pIdMoneta']},";
		$queryText .= "{$pArr['pQuantita']}";
		$queryText .= ')';
		
		//writeLog('InsUpdRicchezze', $queryText);
		try{			
			$ADnD_Db->performQuery($queryText);
			$ADnD_Db->closeConnection();
			return 'true';
		} catch(Exception $e) {
			return $e->getMessage();
		}
	}

	function InsUpdAbilitaDeiLadri($pArr){
		global $ADnD_Db;
		$queryText = 'CALL InsUpdAbilitaDeiLadri(';
		$queryText .= "{$pArr['idPersonaggio']},";
		$queryText .= "{$pArr['pIdAbilitaladri']},";
		$queryText .= "{$pArr['pBase']},";
		$queryText .= "{$pArr['pRazza']},";
		$queryText .= "{$pArr['pDestr']},";
		$queryText .= "{$pArr['pArm']},";
		$queryText .= "{$pArr['pTratti']},";
		$queryText .= "{$pArr['pOggetti']},";
		$queryText .= "{$pArr['pLivello']},";
		$queryText .= "{$pArr['pSpeciale']}";
		$queryText .= ')';
		
		//writeLog('InsUpdAbilitaDeiLadri', $queryText);
		try{			
			$ADnD_Db->performQuery($queryText);
			$ADnD_Db->closeConnection();
			return 'true';
		} catch(Exception $e) {
			return $e->getMessage();
		}
	}

	function ChkInsPgIncantesimo($pArr){
		global $ADnD_Db;
		$queryText = 'SELECT ChkInsPgIncantesimo(';
		$queryText .= "{$pArr['idPersonaggio']},";
		$queryText .= "'{$pArr['pNome']}',";
		$queryText .= "{$pArr['pIdIncantesimo']},";
		$queryText .= "{$pArr['pLivello']},";
		$queryText .= "'{$pArr['pComponenti']}',";
		$queryText .= "'{$pArr['pDurata']}',";
		$queryText .= "'{$pArr['pRaggio']}',";
		$queryText .= "'{$pArr['pTiroSalvezza']}',";
		$queryText .= "{$pArr['pVelocita']},";
		$queryText .= "'{$pArr['pEffetto']}'";
		$queryText .= ') as result';
		//writeLog('ChkInsPgIncantesimo', $queryText);

		try{			
			$temp = $ADnD_Db->performQuery($queryText)->fetch_assoc();
			$result = $temp['result'];
			//writeLog('check', $result);
			$ADnD_Db->closeConnection();
			return $result;
		} catch(Exception $e) {
			return $e->getMessage();
		}	
	}

	function DelPgIncantesimo($pArr){
		global $ADnD_Db;
		$queryText = 'CALL DelPgIncantesimo(';
		$queryText .= "{$pArr['idPersonaggio']},";
		$queryText .= "'{$pArr['pNomeIncantesimo']}'";
		$queryText .= ')';
		//writeLog('DelPgIncantesimo', $queryText);

		try{			
			$ADnD_Db->performQuery($queryText);
			$ADnD_Db->closeConnection();
			return "true";
		} catch(Exception $e) {
			return $e->getMessage();
		}	
	}

	function UpdEquipaggiamento($pArr){
		global $ADnD_Db;
		$queryText = 'CALL UpdEquipaggiamento(';
		$queryText .= "{$pArr['idPersonaggio']},";
		$queryText .= "'{$pArr['pEquipaggiamento']}'";
		$queryText .= ')';
		//writeLog('UpdPuntiFerita', $queryText);

		try{			
			$ADnD_Db->performQuery($queryText);
			$ADnD_Db->closeConnection();
			return 'true';
		} catch(Exception $e) {
			return $e->getMessage();
		}	
	}

	function DelPersonaggioByChange($pArr){
		global $ADnD_Db;
		$queryText = 'CALL DelPersonaggioByChange(';
		$queryText .= "{$pArr['idPersonaggio']}";
		$queryText .= ')';
		//writeLog('DelPersonaggioByChange', $queryText);

		try{			
			$ADnD_Db->performQuery($queryText);
			$ADnD_Db->closeConnection();
			return "true";
		} catch(Exception $e) {
			return $e->getMessage();
		}	
	}

	function DelPersonaggio($pArr){
		global $ADnD_Db;
		$queryText = 'CALL DelPersonaggio(';
		$queryText .= "{$pArr['idPersonaggio']}";
		$queryText .= ')';
		//writeLog('DelPersonaggio', $queryText);

		try{			
			$ADnD_Db->performQuery($queryText);
			$ADnD_Db->closeConnection();
			return "true";
		} catch(Exception $e) {
			return $e->getMessage();
		}	
	}
?>