<div class="container-fluid mt--7">
    <div class="row mt-5">
        <div class="col">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Paiements encaissés</strong>
                    </div>
                    <div class="table-stats order-table ov-h">
                        <table class="table ">
                            <thead>
                            <tr>
                                <th class="serial">#</th>
                                <th>Payé par </th>
                                <th>Identifiant unique</th>
                                <th>Periode</th>
                                <th>Montant</th>
                                <th>Mode de paiement</th>
                                <th>Numero de cheque</th>
                                <th>Organisme</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                                if(empty($paiements)){
                                    ?>
                                    <tr>
                                        <td class="serial"></td>
                                        <td><span class="name">Aucun paiement</span></td>
                                        <td> <?=$_SESSION['id']?></td>
                                        <td></td>
                                    </tr>
                                    <?php
                                }

                                else{
                                    $i = 1;
                                    foreach ($paiements as $paiement) {
                                    ?>
                                    <tr>
                                        <td class="serial"><?=$i?></td>
                                        <td><span class="name"><?=$paiement->payeur?></span></td>
                                        <td><span class="name"><?=$paiement->infoID?></span></td>
                                        <td><span class="name"><?=$paiement->periode?></span></td>
                                        <td><span class="name"><?=$paiement->montant?></span></td>
                                        <?php
                                            if($paiement->type) {
                                        ?>
                                                <td><span class="name">Espèce</span></td>
                                                <td><span class="name">Néant</span></td>
                                        <?php
                                            }
                                            else{
                                        ?>
                                            <td><span class="name">Chèque</span></td>
                                                <td><span class="name"><?=$paiement->ChequeREF?></span></td>
                                        <?php
                                            }foreach($organismes as $organisme){
                                                if($paiement->organeREF==$organisme->idOrganisme)
                                        ?>
                                                    <td><span class="name"><?=$organisme->nom?></span></td>
                                        <?php
                                            }
                                        ?>
                                        <td><span class="name"><?=$paiement->datePaiement?></span></td>
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