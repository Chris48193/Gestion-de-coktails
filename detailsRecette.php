<section class="h-100 gradient-form" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <!-- Voici la description de la recettes à afficher -->
        <?php
            if(isset($_POST['preparation'])) {
                echo $_POST['preparation'];
            } else {
                echo "Aucune preparation à afficher";
            }
        ?>
    </div>
</section>