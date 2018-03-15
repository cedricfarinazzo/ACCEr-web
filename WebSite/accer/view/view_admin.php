<?php
ob_start();
if (!$connected || ($user->rank() != "admin" && $user->rank() != "webmaster")) {
	header("location: ?p=accueil");
	exit();
}

if (isset($_POST["promote-user-admin"]) && $user->rank() != "user") {
	if (isset($_POST["id_user"]) && (int)$_POST["id_user"] > 0) {
		if ($user->promote((int)$_POST["id_user"])) {
			$success = "L'utilisateur est désormais administrateur!";
		} else {
			$error = "L'utilisateur n'existe pas ou vous n'avez pas les droits pour cette action!";
		}		
	}
}

if (isset($_POST["retrograde-user-admin"]) && $user->rank() == "webmaster") {
	if (isset($_POST["id_user"]) && (int)$_POST["id_user"] > 0) {
		if ($user->degrade((int)$_POST["id_user"])) {
			$success = "L'utilisateur a été dégradé!";
		} else {
			$error = "L'utilisateur n'existe pas ou vous n'avez pas les droits pour cette action!";
		}		
	}
}

if (isset($_POST["deco-user-admin"]) && $user->rank() == "webmaster") {
	if (isset($_POST["id_user"]) && (int)$_POST["id_user"] > 0) {
		$id_user = (int)$_POST["id_user"];
		$req_deco = $db->prepare("DELETE FROM authsess WHERE ID_user = ?");
		$b = $req_deco->execute(array($id_user));
		if ($b) {
			$success = "L'utilisateur a été déconnecté!";
		} else {
			$error = "L'utilisateur n'existe pas ou vous n'avez pas les droits pour cette action!";
		}		
	}
}

if (isset($_POST["deco-long-user-admin"]) && $user->rank() == "webmaster") {
	if (isset($_POST["id_user"]) && (int)$_POST["id_user"] > 0) {
		$id_user = (int)$_POST["id_user"];
		$req_deco = $db->prepare("DELETE FROM authcookieremember WHERE ID_user = ?");
		$b = $req_deco->execute(array($id_user));
		if ($b) {
			$success = "L'utilisateur a été déconnecté du système de connexion persistente!";
		} else {
			$error = "L'utilisateur n'existe pas ou vous n'avez pas les droits pour cette action!";
		}		
	}
}

$chat = new ChatManager($db);
if (isset($_POST["admin-remove-chat"])) {
	if (isset($_POST["chat-remove"]) && $_POST["chat-remove"] == "on") {
		if ($chat->RemoveAll()) {
			$success = "Les messages de la discution instantannée ont bien été supprimé.";
		}
	}
}

if (isset($_POST["admin-maintenance"]) && !is_maintenance()) {
	if (isset($_POST["maintenance-switch"]) && $_POST["maintenance-switch"] == "on") {
		$possiblevalue = array("1","5","10","15","30","45","60","120","1440");
		if (in_array($_POST["tps_maintenance"], $possiblevalue)) {
			$tps = (int)$_POST["tps_maintenance"];
			$result = StartMaintenance($tps);
			if ($result != false) {
				$success = "Maintenance activée ! Votre code d'arrêt : ".$result;
			}
		} else {
			$error = "Veuillez choisir un temps de maintenance pour cette action!";
		}
	}
}

if (isset($_POST["admin-maintenance-stop"])) {
	if (isset($_POST["pass-stop-maintenance"]) && !empty($_POST["pass-stop-maintenance"])) {
		if (DeleteMaintenance($_POST["pass-stop-maintenance"])) {
			$success = "Maintenance terminée !";
		} else {
			$error = "Code d'arrêt invalide!";
		}
	} else {
		$error = "Veuillez saisir le code d'arrêt pour arreter les maintenance!";
	}
}

$tasks = new ShadowMinerProgressManager($db);
if (isset($_POST["del-task-admin"])) {
	if (isset($_POST["id"]) && (int)$_POST["id"] > 0) {
		$id_task = (int)$_POST["id"];
		if ($tasks->remove($id_task)) {
			$success = "La tâche a été supprimé!";
		} else {
			$error = "La tâche n'existe pas ou vous n'avez pas les droits pour cette action!";
		}		
	}
}

if (isset($_POST["up-task-admin"])) {
	if (isset($_POST["id"]) && (int)$_POST["id"] > 0 && isset($_POST["status"]) && (int)$_POST["status"] >= 0) {
		$id_task = (int)$_POST["id"];
		$status = (int)$_POST["status"];
		if (0 <= $status && $status <= 100) {
			if ($tasks->update($id_task, $status)) {
				$success = "La tâche a été mis à jour!";
			} else {
				$error = "La tâche n'existe pas ou vous n'avez pas les droits pour cette action!";
			}	
		} else {
			$error = "Le pourcentage de la tâche doit être compris entre 0 et 100!";
		}
	}
}


$req_user_list = $user->GetUserList();
$req_user_connected = $db->query("SELECT * FROM authsess");
$req_user_connected_long = $db->query("SELECT * FROM authcookieremember");

$req_all_tasks = $tasks->GetAllTask();
$request = ob_get_contents();
ob_clean();

ob_start();
?>

	<h2 class="center">Administration</h2>
	<div class="divider"></div>
	<br/>
	
	<?php if (isset($success)) { ?>
		<div class="success card-panel green darken-2 center-align">
		<?= $success; ?>
		</div>
		<div class="divider"></div>
		<br/>
	<?php } ?>
	
	<?php if (isset($error)) { ?>
		<div class="error card-panel red darken-1 center-align">
		<?= $error; ?>
		</div>
		<div class="divider"></div>
		<br/>
	<?php } ?>
	
	<h3 class="center">Listes des utilisateurs</h3>
	<div class="user-list">
		<table class="bordered highlight centered responsive-table">
			<caption style="font-weight: bold;">User - count : <?= $req_user_list->rowCount();?></caption>
			<thead style="font-weight: bold;">
				<tr>
					<td>ID</td>
					<td>Firtname</td>
					<td>Name</td>
					<td>Email</td>
					<td>Description</td>
					<td>Avatar id</td>
					<td>Date register</td>
					<td>Rank</td>
					<td>Action</td>
				</tr>
			</thead>
			<tfoot style="font-weight: bold;">
				<tr>
					<td>ID</td>
					<td>Firtname</td>
					<td>Name</td>
					<td>Email</td>
					<td>Description</td>
					<td>Avatar id</td>
					<td>Date register</td>
					<td>Rank</td>
					<td>Action</td>
				</tr>
			</tfoot>
			<tbody>
				<?php while($u = $req_user_list->fetch()) { ?>
				<tr>
					<td><?= $u->ID(); ?></td>
					<td><?= $u->firstname(); ?></td>
					<td><?= $u->name(); ?></td>
					<td><?= $u->email(); ?></td>
					<td><?= $u->description(); ?></td>
					<td><?= $u->avatar_path();?></td>
					<td><?= $u->date_register(); ?></td>
					<td><?= $u->rank();?></td>
					<td>
						<div class="row">
							<form action="?p=admin" method="post">
								<input hidden name="id_user" value="<?= $u->ID(); ?>" />
								<?php if ($user->rank() == "webmaster" && $user->ID() != $u->ID()) { ?>
									<button class="btn waves-effect waves-light" type="submit" name="promote-user-admin" style="margin: 0px 0px 10px 0px" onclick="return confirm('Promouvoir l'utilisateur?');"> 
										Promouvoir
									</button>
									<button class="btn waves-effect waves-light" type="submit" name="retrograde-user-admin" onclick="return confirm('Promouvoir l'utilisateur?');" >
										Dégrader
									</button>
								<?php } 
								if ($user->rank() == "admin" && $u->rank() == "user" && $user->ID() != $u->ID()) { ?>
									<button class="btn waves-effect waves-light" type="submit" name="promote-user-admin" onclick="return confirm('Promouvoir l'utilisateur?');" >
										Promouvoir
									</button>
								<?php } ?>
							</form>
						</td>
					</div>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	
	<div class="divider"></div>
	<br/>
	<h3 class="center">liste des utilisateurs connectés</h3>
	<div class="user-connected-list">
		<table class="bordered highlight centered responsive-table">
			<caption style="font-weight: bold;">authsess - count : <?= $req_user_connected->rowCount();?></caption>
			<thead style="font-weight: bold;">
				<tr>
					<td>ID</td>
					<td>ID_user</td>
					<td>IP</td>
					<td>expire</div>
					<td>Action</td>
				</tr>
			</thead>
			<tfoot style="font-weight: bold;">
				<tr>
					<td>ID</td>
					<td>ID_user</td>
					<td>IP</td>
					<td>expire</div>
					<td>Action</td>
				</tr>
			</tfoot>
			<tbody>
				<?php while($data = $req_user_connected->fetch()) { ?>
					<tr>
						<td><?= $data["ID"]; ?></td>
						<td><?= $data["ID_user"]; ?></td>
						<td><?= $data["IP"]; ?></td>
						<td><?= $data["expire"]; ?></td>
						<td>
							<form action="?p=admin" method="post">
								<input hidden name="id_user" value="<?= $data["ID_user"]; ?>" />
								<?php if ($user->rank() == "webmaster" && $user->ID() != $data["ID_user"]) { ?>
									<button class="btn waves-effect waves-light" type="submit" name="deco-user-admin" style="margin: 0px 0px 10px 0px" onclick="return confirm('Promouvoir l'utilisateur?');"> 
										Déconnecter
									</button>
								<?php } ?>
							</form>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>		
	</div>
	
	<div class="divider"></div>
	<br/>
	<h3 class="center">liste des utilisateurs connectés à long terme</h3>
	<div class="user-connected-long-list">
		<table class="bordered highlight centered responsive-table">
			<caption style="font-weight: bold;">authcookieremember - count : <?= $req_user_connected_long->rowCount();?></caption>
			<thead style="font-weight: bold;">
				<tr>
					<td>ID</td>
					<td>ID_user</td>
					<td>expire</div>
					<td>Action</td>
				</tr>
			</thead>
			<tfoot style="font-weight: bold;">
				<tr>
					<td>ID</td>
					<td>ID_user</td>
					<td>expire</div>
					<td>Action</td>
				</tr>
			</tfoot>
			<tbody>
				<?php while($data = $req_user_connected_long->fetch()) { ?>
					<tr>
						<td><?= $data["ID"]; ?></td>
						<td><?= $data["ID_user"]; ?></td>
						<td><?= $data["expire"]; ?></td>
						<td>
							<form action="?p=admin" method="post">
								<input hidden name="id_user" value="<?= $data["ID_user"]; ?>" />
								<?php if ($user->rank() == "webmaster" && $user->ID() != $data["ID_user"]) { ?>
									<button class="btn waves-effect waves-light" type="submit" name="deco-long-user-admin" style="margin: 0px 0px 10px 0px" onclick="return confirm('Promouvoir l'utilisateur?');"> 
										Déconnecter
									</button>
								<?php } ?>
							</form>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>		
	</div>
	
	<div class="divider"></div>
	<br/>
	<h3 class="center">Shadow Miner</h3>
	<div class="shadow-miner">
		<div>
			<h4 class="center">Progression du projet</h4>
			<br/>
			<div class="task">
				<table class="bordered highlight responsive-table">
					<caption style="font-weight: bold;">Progress - count : <?= $req_all_tasks->rowCount();?></caption>
					<thead style="font-weight: bold;">
						<tr>
							<td>ID</td>
							<td>titre</td>
							<td>description</td>
							<td>état (en %)</td>
							<td>changer l'état</td>
							<td>supprimer</td>
						</tr>
					</thead>
					<tfoot style="font-weight: bold;">
						<tr>
							<td>ID</td>
							<td>titre</td>
							<td>description</td>
							<td>etat (en %)</td>
														<td>changer l'état</td>
							<td>supprimer</td>
						</tr>
					</tfoot>
					<tbody>
						<?php while($t = $req_all_tasks->fetch()) { ?>
							<tr>
								<td><?= $t->ID(); ?></td>
								<td><?= $t->titre(); ?></td>
								<td><?= $t->description(); ?></td>
								<td>
									<span class="center"><?= $t->etat(); ?> %</span> 
									<br/>
									<div class="progress">
										<div class="determinate" style="width: <?= $t->etat(); ?>%"></div>
									</div>
								</td>
								<td>
									<form action="?p=admin" method="post">
										<input hidden name="id" value="<?= $t->ID(); ?>" />
											<div class="input-field col s12">
												<input id="status" name="status" type="number"  value="<?= $t->etat(); ?>" class="validate">
												<label for="status">pourcentage</label>
											</div>
										<button class="btn waves-effect waves-light" type="submit" name="up-task-admin" style="margin: 0px 0px 10px 0px" onclick="return confirm('Promouvoir l'utilisateur?');"> 
											actualiser
										</button>
									</form>
								</td>	
								<td>
									<form action="?p=admin" method="post">
										<input hidden name="id" value="<?= $t->ID(); ?>" />
										<button class="btn waves-effect waves-light" type="submit" name="del-task-admin" style="margin: 0px 0px 10px 0px" onclick="return confirm('Promouvoir l'utilisateur?');"> 
											Supprimer
										</button>
									</form>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
	<div class="divider"></div>
	<br/>
	<h3 class="center">Discussion instantannée</h3>
	<div class="chat">
		<form action="?p=admin" method="post">
			<div class="switch row center-align">
				<i class="material-icons">delete_forever</i>
				Vider la discution instantannée :   
				<label>
					Off
				<input type="checkbox" name="chat-remove" class="validate">
				<span class="lever"></span>
					On
				</label>
			</div>
			<br/>
			<div class="row center-align">
				<button class="btn waves-effect waves-light" type="submit" name="admin-remove-chat" value="Valider les informations" >
					Valider
					<i class="material-icons right">send</i>
				</button>
			</div>
		</form>
	</div>
	
	<div class="divider"></div>
	<br/>
	<h3 class="center">Maintenance du site</h3>
	<div class="maintenance">	
		<?php if (is_maintenance()) { ?>
			<h5 class="center">Désactiver la Maintenance</h5>
			<form action="?p=admin" method="post">
				<div class="row">
					<div class="input-field col s12">
						<input id="mdp" name="pass-stop-maintenance" type="password" class="validate"/>
						<label class="active" for="mdp">Mot de passe</label>
					</div>
				</div>
				<div class="row center-align">
					<button class="btn waves-effect waves-light" type="submit" name="admin-maintenance-stop" value="Valider les informations" >
						Valider
						<i class="material-icons right">send</i>
					</button>
				</div>
			</form>
		<?php } else { ?>
			 <h5 class="center">Activer la Maintenance</h5>
			 <form action="?p=admin" method="post">
				<div class="switch row center-align">
					Activer la maintenance du site  
					<label>
						Off
					<input type="checkbox" name="maintenance-switch" class="validate">
					<span class="lever"></span>
						On
					</label>
				</div>
				<div class="input-field col s12">
					<select name="tps_maintenance">
						<option value="" disabled selected>Choisissez le temps de la maintenance</option>
						<option value="1">1 minutes</option>
						<option value="5">5 minutes</option>
						<option value="10">10 minutes</option>
						<option value="15">15 minutes</option>
						<option value="30" >30 minutes</option>
						<option value="45">45 minutes</option>
						<option value="60">1 heure</option>
						<option value="120" >2 heures</option>
						<option value="1440">1 jour </option>
					</select>
					<label>Temps de maintenance</label>
				</div>
				<div class="row center-align">
					<button class="btn waves-effect waves-light" type="submit" name="admin-maintenance" value="Valider les informations" >
						Valider
						<i class="material-icons right">send</i>
					</button>
				</div>
			</form>
		
		<?php } ?>
	</div>
	
<?php
$content = ob_get_contents();
ob_clean();