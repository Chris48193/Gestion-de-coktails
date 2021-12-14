<section class="h-100 gradient-form" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <!-- Voici la description de la recettes à afficher -->
        <?php
            if(isset($_POST['title'])&&isset($_POST['like'])&&isset($_POST['index'])&&isset($_POST['img'])&&isset($_POST['preparation'])&&isset($_POST['ingredients'])&&isset($_POST['id'])) {
				 echo makeCoktail($_POST['title'],$_POST['like'],$_POST['index'],$_POST['img'],$_POST['preparation'],$_POST['ingredients'],$_POST['id']);
				 echo "<h1>Dosage des ingrédients : </h1></br>" .urldecode($_POST['ingredients'])."</br></br>";
				 echo "<h1>Comment préparer le cocktail : </h1></br>" .urldecode($_POST['preparation']);
            } else {
                echo "Problème d'affichage";
            }
		?>
    </div>
</section>