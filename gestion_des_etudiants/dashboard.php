<?php
require "pdoclasses.php";
session_start();

// Vérification de l'authentification
if(!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

$userManager = new UtilisateurManager();
$currentUser = $userManager->getUserById($_SESSION['user']['id']);
$isAdmin = $currentUser->isAdmin();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Students Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .dashboard-header {
            background: linear-gradient(135deg,rgb(200, 149, 255) 0%,rgb(7, 175, 175) 100%);
            color: white;
            padding: 3rem 0;
        }
        .feature-card {
            transition: transform 0.3s;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(5, 155, 255, 0.1);
        }
        .feature-card:hover {
            transform: translateY(-5px);
        }
        .admin-badge {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
        }
    </style>
</head>
<body>
    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-graduation-cap me-2"></i> Students Management System
            </a>
            <div class="navbar-nav ms-auto">
                <span class="navbar-text me-3">
                    Connecté en tant que: <strong><?= htmlspecialchars($currentUser->getUsername()) ?></strong>
                    <?php if($isAdmin): ?>
                        <span class="badge bg-danger ms-2">Admin</span>
                    <?php endif; ?>
                </span>
                <a class="nav-link" href="<?= $isAdmin ? 'liste_etudiants_admin.php' : 'liste_etudiants.php' ?>">
                    <i class="fas fa-users me-1"></i> Étudiants
                </a>
                <a class="nav-link" href="<?= $isAdmin ? 'liste_sections_admin.php' : 'liste_sections.php' ?>">
                    <i class="fas fa-layer-group me-1"></i> Sections
                </a>
                <a class="nav-link text-danger" href="logout.php">
                    <i class="fas fa-sign-out-alt me-1"></i> Déconnexion
                </a>
            </div>
        </div>
    </nav>

    <header class="dashboard-header text-center mb-5">
        <div class="container">
            <h1 class="display-4">Bienvenue, <?= htmlspecialchars($currentUser->getUsername()) ?>!</h1>
            <?php if($isAdmin): ?>
                <p class="lead">Vous avez accès aux fonctionnalités d'administration</p>
            <?php else: ?>
                <p class="lead">Espace de consultation des étudiants et sections</p>
            <?php endif; ?>
        </div>
    </header>

    <main class="container">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            <div class="col">
                <div class="card feature-card h-100 text-center p-3 position-relative">
                    <?php if($isAdmin): ?>
                        <span class="admin-badge" title="Accès admin">
                            <i class="fas fa-crown"></i>
                        </span>
                    <?php endif; ?>
                    <i class="bi bi-houses-fill fa-3x text-primary mb-3"></i>
                    <h5>Gestion des sections</h5>
                    <p class="text-muted"><?= $isAdmin ? 'CRUD complet' : 'Consultation seule' ?></p>
                    <a href="<?= $isAdmin ? 'liste_sections_admin.php' : 'liste_sections.php' ?>" class="stretched-link"></a>
                </div>
            </div>
            <div class="col">
                <div class="card feature-card h-100 text-center p-3 position-relative">
                    <?php if($isAdmin): ?>
                        <span class="admin-badge" title="Accès admin">
                            <i class="fas fa-crown"></i>
                        </span>
                    <?php endif; ?>
                    <i class="fas fa-users fa-3x text-primary mb-3"></i>
                    <h5>Gestion des étudiants</h5>
                    <p class="text-muted"><?= $isAdmin ? 'CRUD complet' : 'Consultation seule' ?></p>
                    <a href="<?= $isAdmin ? 'liste_etudiants_admin.php' : 'liste_etudiants.php' ?>" class="stretched-link"></a>
                </div>
            </div>
            
           
           
            
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>