<?php
require_once("./utils/db_connect.php"); 
require_once("./utils/loadClass.php");

$manager = new TourOperateurRepository($bdd);

$destinations = $manager->getAllDestinations();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container-fluid">
        <header>
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <h1>Comparo.FR</h1>
        </header>
        <div class="background">

        </div>
        <section>
            <div class="row justify-content-center affichage">
                <h2>Les destinations du moment ! </h2>
                <?php foreach ($destinations as $destination) : ?>
                    <a href="liste.php?location=<?php echo $destination->getLocation(); ?>" class="col-3 m-3" style="background:url('<?php echo $destination->getImg(); ?>')top center no-repeat; background-size:cover;">
                        <p class="dest">Destination : <?php echo $destination->getLocation(); ?></p>
                        <p class="prix">Prix <?php echo $destination->getPrice(); ?> €</p>
                    </a>
                <?php endforeach; ?>

            </div>
        </section>
    </div>
    <footer>fdsfd</footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script>
            let bg = document.querySelector('.background');
            window.addEventListener('scroll', ()=>{
                bg.style.backgroundPositionY = -window.scrollY / 1.5 + 'px';
            });
        </script>
</body>

</html>