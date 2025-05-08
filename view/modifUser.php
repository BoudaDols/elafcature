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
                <h2 class="mb-0">Compte Utilisateur</h2>
              </div>
            </div>
          </div>

          <div class="card-body">
            <form role="form" method="post" action="modifyingUser?action=edit&id=<?=$infos->idUtilisateur;?>">
              
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">Nom</label>
                      <input type="text" id="nom" name="nom" class="form-control form-control-alternative" placeholder="Nom" value="<?=$infos->nom?>" required>
                    </div>
                  </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-username">Prénom</label>
                            <input type="text" id="prenom" name="prenom" class="form-control form-control-alternative" placeholder="Prénom" value="<?=$infos->prenom?>" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-first-name">Nom d'utilisateur</label>
                      <input type="text" id="username" name="username" class="form-control form-control-alternative" placeholder="Nom d'utilisateur" value="<?=$infos->username;?>" required>
                    </div>
                  </div>

                  <div class="col-lg-6">
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
              
              <button type="submit" class="btn btn-primary my-4">Modifier</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>