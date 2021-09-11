<?php
session_start();

$title = 'Liste des séries';
require_once 'includes/header.php';
require_once 'models/database.php';
require_once 'models/seriesModel.php';
require_once 'controllers/seriesListController.php';
?>
<div class="container">
    <div class="row mt-5">
        <div class="col-12 mt-4 text-center">
            <h1>Liste des séries</h1>
            <p>Un pannel de contrôle pour toutes vos séries</p>
        </div>
    </div>
    <div class="row text-center mt-4">
        <div class="col-12">
            <table class="table table-secondary table-sm table-hover table-bordered table-striped align-middle">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Synopsis</th>
                        <th scope="col">Créateur(s)</th>
                        <th scope="col">Année</th>
                        <th scope="col">Statut</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Voir</th>
                        <th scope="col">Modifier</th>
                        <th scope="col">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($seriesList as $seriesDetails) {
                    ?>
                        <tr>
                            <td><?= $seriesDetails->id ?></td>
                            <td><?= $seriesDetails->title ?></td>
                            <td><?= $seriesDetails->synopsis ?></td>
                            <td><?= $seriesDetails->creators ?></td>
                            <td><?= $seriesDetails->year ?></td>
                            <td><?= $seriesDetails->status ?></td>
                            <td><?= $seriesDetails->photo ?></td>
                            <td><button type="button" href="patientProfile.php?id=<?= $seriesDetails->id ?>" class="btn btn-primary"><i class="bi bi-eye"></i></button></td>
                            <td><a href="updateSeries.php?id=<?= $seriesDetails->id ?>"><button type="button" class="btn btn-warning"><i class="bi bi-gear"></i></button></a></td>
                            <td><button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteSeriesModal" data-bs-id="<?= $seriesDetails->id ?>" data-bs-title="<?= $seriesDetails->title ?>"><i class="fas fa-trash"></i></button> <!-- tu peux passer des données à ta modal avec les data-bs-truc -->
                            </td>
                        </tr>

                    <?php } ?>
                    <div class="modal fade" id="deleteSeriesModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Souhaitez-vous vraiment supprimer cette série ?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <form method="post" action="seriesList.php">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label"></label>
                                            <p id="series"></p>
                                            <input type="hidden" class="form-control" name="idRecipient" id="idRecipient" />
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-danger">Confirmer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>