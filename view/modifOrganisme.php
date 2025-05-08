<!-- Dark table -->
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
	    <div class="header-body">
            <div class="row">
              <div class="alert alert-danger alert-dismissable" <?=$warning_state1;?> >
                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
                Echec. Reéssayer!!
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
              <div class="col-8">
                <h2 class="mb-0">Organisme</h2>
              </div>
            </div>
          </div>

          <div class="card-body">
            <form role="form" method="post" action="modifingOrgan?action=edit&id=<?=$infos->idOrganisme;?>">

                <div class="pl-lg-4">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">Nom</label>
                                <input type="text" id="nom" name="nom" class="form-control form-control-alternative" placeholder="Nom" value="<?=$infos->nom;?>" required>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-control-label" for="input-first-name">Numéro de compte</label>
                                <input type="number" id="compte" name="compte" class="form-control form-control-alternative" placeholder="Numéro de compte" value="<?=$infos->noCompte;?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-control-label" for="input-first-name">Agence du compte</label>
                                <input type="text" id="agence" name="agence" class="form-control form-control-alternative" placeholder="Agence du compte"  value="<?=$infos->agence;?>" required>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-control-label" for="input-first-name">Clé du compte</label>
                                <input type="number" id="cle" name="cle" class="form-control form-control-alternative" placeholder="Clé du compte" value="<?=$infos->cle;?>" required>
                            </div>
                        </div>
                    </div>
                </div>
              
              <button type="submit" class="btn btn-primary my-4">Modifier</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>