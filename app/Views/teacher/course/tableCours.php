
<a class="btnAddCourse" href="./course/add-cours.php"><button>Ajoute un cours</button></a>
          <div class="horizontal-container">
            <div class="horizontal-scroll">
                <?php
               
                 foreach($cours as $cour): ?>
                <div class="card">
                    <a href="">
                    <img src="<?php echo $cour['phto_interface'] ?>" alt="<?php echo $cour['titre'] ?>" class="card-image">
                    </a> 
                    <div class="card-content">
                        <h3 class="category-name"><?php echo $cour['titre'] ?></h3>
                        <p class="category-name"> Categorie: <?php echo $cour['Categorie_nom'] ?></p>
                        <p class="category-description"><?php echo $cour['description'] ?></p>
                        <?php if ($_SESSION['user_role'] == 2){?>  
                        <p class="status">status : <?php  
                            if($cour['estPublie']==0){
                                echo '<span class="En-attente">En attente</span>';
                            }else{
                               
                                echo '<span class="Publie">Publie</span>';
                            }
                        ?> </p>
                        <p class="price">Prix : <?php echo $cour['price'] ?> DH</p>
                       
                        <a href="">Updet</a>
                       <?php  }else {?>
                        <?php if ($cour['estPublie']!=0){?>
                            <a href="../../Models/StatusCours.php?action=Dpublie&id=<?php echo $cour['id']; ?>">DPublie</a>

                        <?php } else {  ?>
                          
                            <a href="../../Models/StatusCours.php?action=publie&id=<?php echo $cour['id']; ?>">Publie</a>

                        <?php } ?> 
                       <?php } ?>
                       <a href="">Delete</a>
                    </div>
                </div>
                <?php endforeach ?>
             </div>
         </div>
 <style>
        /* Conteneur principal pour centrer le contenu */
        .horizontal-container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        padding: 20px;
        box-sizing: border-box;
        }
        .Publie{
            color: green;
        }
        .En-attente{
        
            color: red;
        }

        /* Conteneur pour le défilement horizontal */
        .horizontal-scroll {
        display: flex;
        gap: 20px;
        overflow-x: auto;
        padding: 10px;
        max-width: 90%;
        background-color: #f5f5f5;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        scroll-behavior: smooth;
        }

        /* Style des cartes */
        .card {
        flex: 0 0 auto;
        width: 250px;
        background-color: #ffffff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        }

        .card:hover {
        transform: scale(1.05);
        }

        /* Style pour l'image de la carte */
        .card-image {
        width: 100%;
        height: 150px;
        object-fit: cover;
        }

        /* Contenu de la carte */
        .card-content {
        padding: 15px;
        text-align: center;
        }

        .category-name {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        margin: 10px 0 5px;
        }

        .category-description {
        font-size: 14px;
        color: #666;
        margin-bottom: 10px;
        }

        .teacher-name {
        font-size: 14px;
        color: #444;
        font-style: italic;
        margin-bottom: 10px;
        }

        .price {
        font-size: 16px;
        font-weight: bold;
        color: #007bff;
        }
</style>