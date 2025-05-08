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
                    Organisme ajouté
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
                                <h2 class="mb-0">Ajouter un organisme</h2>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form role="form" method="post" action="addingOrganisme">

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
                                            <label class="form-control-label" for="input-first-name">Numéro de compte</label>
                                            <input type="number" id="compte" name="compte" class="form-control form-control-alternative" placeholder="Numéro de compte" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Agence du compte</label>
                                            <input type="text" id="agence" name="agence" class="form-control form-control-alternative" placeholder="Agence du compte" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Clé du compte</label>
                                            <input type="number" id="cle" name="cle" class="form-control form-control-alternative" placeholder="Clé du compte" required>
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
                        <strong class="card-title">Liste des organismes</strong>
                    </div>
                    <div class="table-stats order-table ov-h">
                        <table class="table ">
                            <thead>
                            <tr>
                                <th class="serial">#</th>
                                <th>Nom</th>
                                <th>Numéro de Compte</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            if(empty($organismes)){
                                ?>
                                <tr>
                                    <td class="serial"></td>
                                    <td><span class="name">Aucun Organisme</span></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <?php
                            }

                            else{
                                $i = 1;
                                foreach ($organismes as $organisme) {
                                    ?>
                                    <tr>
                                        <td class="serial"><?=$i?></td>
                                        <td><span class="name"><?=$organisme->nom?></span></td>
                                        <td><span class="name"><?=$organisme->agence."-".$organisme->noCompte."-".$organisme->cle?></span></td>
                                        <td>
                                            <a href="modifOrgan?id=<?=$organisme->idOrganisme;?>"><button type="button" class="btn btn-secondary">Modifier</button></a>
                                            <a href="deletingOrgan?action=del&id=<?=$organisme->idOrganisme;?>"><button type="button" class="btn btn-danger">Supprimer</button></a>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
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