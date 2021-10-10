<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <title>SeriesTrackr - <?= $title ?></title>
</head>

<!-- Si on se trouve sur la page index alors on ne fait rien, sinon on applique la classe signInBody -->

<body <?= $_SERVER['PHP_SELF'] == 'ProjetTP/login.php' || 'ProjetTP/register.php' ?: 'class="signInBody"'; ?>>
    <!--Début de la navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">SeriesTracker</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="newsFeedPage.php">Actualités</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="seriesPage.php">Séries</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="newsFeedPage.php">Contact</a>
                    </li>
                    <?php if (isset($_SESSION['idRoles'])) {
                        if ($_SESSION['idRoles'] == 1) { ?>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="adminPage.php">Dashboard</a>
                            </li>
                    <?php }
                    } ?>
                </ul>
                <form class="d-flex me-lg-3">
                    <input class="form-control me-2" type="search" placeholder="Ex : Glee" aria-label="Search">
                    <button class="btn btn-outline-secondary" type="submit">Chercher</button>
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                            <?php if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) { ?>
                                <li><a class="dropdown-item" href="login.php">Se connecter</a></li>
                                <li><a class="dropdown-item" href="register.php">S'inscrire</a></li>
                            <?php } ?>
                            <?php if (!empty($_SESSION['username']) && !empty($_SESSION['id'])) { ?>
                                <li><a class="dropdown-item" href="userProfile.php">Mon profil</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="controllers/logoutController.php">Se déconnecter</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--Fin de la navbar-->