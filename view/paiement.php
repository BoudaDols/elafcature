<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row">
                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show" <?=$warning_state1?>>
                    <span class="badge badge-pill badge-danger">Failed</span>
                    Echec de paiement. Reessayer!!!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="sufee-alert alert with-close alert-primary alert-dismissible fade show" <?=$warning_state2?>>
                    <span class="badge badge-pill badge-primary">Success</span>
                    Paiement effectué
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
                                <h2 class="mb-0">Paiement</h2>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form role="form" method="post" action="addingPaiement">

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name" id="labelAgence">Facture de </label>
                                        <select class="form-control" name="organisme" id="organisme" >
                                            <?php
                                                $i = 1;
                                                foreach ($organismes as $organisme) {
                                            ?>
                                            <option value=<?=$organisme->idOrganisme;?>><?=$organisme->nom;?></option>
                                            <?php
                                                $i++;
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Nom du payeur</label>
                                            <input type="text" id="nom" name="nom" class="form-control form-control-alternative" placeholder="Nom et prénom(s)" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Numero de police</label>
                                            <input type="text" id="police" name="police" class="form-control form-control-alternative" placeholder="Numero de police" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Montant</label>
                                            <input type="number" id="montant" name="montant" class="form-control form-control-alternative" placeholder="Montant" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Date limite de paiement</label>
                                            <input type="date" id="date" name="date" class="form-control form-control-alternative" placeholder="Date" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Mode de règlement</label>
                                            <select class="form-control" name="type" id="type" >
                                                <option value='C'>Chèque</option>
                                                <option value='espece'>Espèce</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name" id='labelCheque'>Numero de cheque</label>
                                            <input type="number" id="numCheq" name="numCheq" class="form-control form-control-alternative" placeholder="Chèque">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <label class="form-control-label" for="input-first-name">Période</label>
                                        <input type="text" id="periode" name="periode" class="form-control form-control-alternative" placeholder="Période" required>
                                    </div>
                                </div>
                            </div>

                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-5">
                                
                                    </div>
                                </div>
                            </div>
                            


                            <button type="submit" class="btn btn-success btn-lg btn-block">Payer</button>
                        </form>

                        <script>
                            var elt = document.getElementById('type');
                            var selectAffiche = document.getElementById('numCheq');
                            var labelAffiche = document.getElementById('labelCheque');

                            elt.addEventListener('change', function () {
                                console.log('value => '+this.value);
                                if(this.value=="espece"){
                                    selectAffiche.style.visibility = 'hidden';
                                    labelAffiche.style.visibility = 'hidden';
                                }
                                else{
                                    selectAffiche.style.visibility = '';
                                    labelAffiche.style.visibility = '';
                                }
                            })
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>