<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row">
                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show" <?=$warning_state1?>>
                    <span class="badge badge-pill badge-danger">Failed</span>
                    Echec d'ajout. Reessayer!!!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="sufee-alert alert with-close alert-primary alert-dismissible fade show" <?=$warning_state2?>>
                    <span class="badge badge-pill badge-primary">Success</span>
                    Utilisateur ajouté
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt--7">
    <div class="row mt-5">
        <div class="col">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h2 class="mb-0">Compte Utilisateur</h2>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form role="form" method="post" action="addingUser">

                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Nom</label>
                                            <input type="text" id="nom" name="nom" class="form-control form-control-alternative" placeholder="Nom" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Prénom(s)</label>
                                            <input type="text" id="prenom" name="prenom" class="form-control form-control-alternative" placeholder="Prénom(s)" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Nom d'utilisateur</label>
                                            <input type="text" id="userName" name="userName" class="form-control form-control-alternative" placeholder="Nom d'utilisateur" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Droit</label>
                                            <select class="form-control" name="droit" id="droit">
                                                <option value="caissier">Caissier</option>
                                                <option value="chef caisse">Chef de caisse</option>
                                                <option value="administrateur">Administrateur</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary my-4">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Liste des utilisateurs</strong>
                    </div>
                    <div class="table-stats order-table ov-h">
                        <table class="table ">
                            <thead>
                            <tr>
                                <th class="serial">#</th>
                                <th>Nom</th>
                                <th>Nom d'utulisateur</th>
                                <th>Role</th>
                                <th>Etat</th>
                                <th>Bloqué</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $i = 1;
                                foreach ($users as $user) {
                                    ?>
                                    <tr>
                                        <td class="serial"><?=$i?></td>
                                        <td><span class="name"><?=$user->nom." ".$user->prenom?></span></td>
                                        <td><span class="product"><?=$user->username;?></span></td>
                                        <td><span class="name"><?=$user->droit?></span></td>
                                        <td><span class="name"><?=$user->etat?></span></td>
                                        <td>
                                            <?php
                                                if($user->isBlocked) {
                                                    ?>
                                                    <span class="name">Oui</span>
                                                    <?php
                                                }
                                                else {
                                                ?>
                                                <span class="name">Non</span>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="modifUser?id=<?=$user->idUtilisateur;?>"><button type="button" class="btn btn-secondary">Modifier</button></a>
                                            <?php
                                            if($user->isBlocked) {
                                                ?>
                                                <a href="initUser?action=init&id=<?=$user->idUtilisateur;?>"><button type="button" class="btn btn-success">Débloquer</button></a>
                                                <?php
                                            }
                                            else {
                                                ?>
                                                <a href="initUser?action=bloc&id=<?=$user->idUtilisateur;?>"><button type="button" class="btn btn-warning">Bloquer</button></a>
                                                <?php
                                            }
                                            ?>
                                            <a href="deletingUser?action=del&id=<?=$user->idUtilisateur;?>"><button type="button" class="btn btn-danger">Supprimer</button></a>
                                        </td>
                                    </tr>
                            <?php
                                    $i++;
                                }
                            ?>
                            </tbody>
                        </table>
                    </div> <!-- /.table-stats -->
                </div>
            </div>
        </div>
    </div>
</div>