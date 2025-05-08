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