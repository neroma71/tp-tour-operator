<?php
session_start();

// Mot de passe à vérifier
$motDePasseAttendu = "admin123"; // Changez ceci par votre mot de passe réel

// Vérifiez si l'utilisateur est déjà authentifié
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    // L'utilisateur est déjà authentifié, redirigez-le vers la page d'administration
    header("Location: admin.php");
    exit();
}

// Vérifiez si le formulaire de connexion a été soumis
if (isset($_POST['connexion'])) {
    $motDePasseSoumis = $_POST['mot_de_passe'];

    // Vérifiez si le mot de passe soumis correspond au mot de passe attendu
    if ($motDePasseSoumis === $motDePasseAttendu) {
        // Authentification réussie, stockez un indicateur de connexion en session
        $_SESSION['authenticated'] = true;
        // Redirigez l'utilisateur vers la page d'administration
        header("Location: admin.php");
        exit();
    } else {
        echo "Mot de passe incorrect. Veuillez réessayer.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Mettez ici vos balises meta et autres éléments d'en-tête -->
    <title>Page de connexion</title>
</head>
<body>
    <!-- Formulaire de connexion -->
    <h1>Connexion à la page d'administration</h1>
    <form method="post" action="">
        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required>
        <input type="submit" name="connexion" value="Connexion">
    </form>
</body>
</html>
