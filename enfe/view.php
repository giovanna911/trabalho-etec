<?php 
	include("functions.php"); 
    if (!isset($_SESSION)) session_start(); 
	view($_GET['id']);
    include(HEADER_TEMPLATE);
?>

            
                <header>
                    <h2>Enfermeiros</h2>
                    <hr>
                </header>

                <div class="card" style="width: 18rem;">
                    <?php 
                        if(!empty($enfermeiros['foto'])) {
                            echo "<img src=\"fotos/" . $enfermeiros['foto'] ."\" class=\" p-1 mb-1 bg-body rounded card-img-top\" width=\"300px\">";
                        } else {
                            echo "<img src=\"fotos/semimagem.png\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"300px\">";
                        }
                    ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $enfermeiros['nome']; ?></h5>
                        <ul class="">
                            <li class="">Endereço: <?php echo $enfermeiros['endereco']; ?></li>
                            <li class="">COREN: <?php echo $enfermeiros['COREN']; ?></li>
                        </ul>
                        <button class="btn btn-light border rounded-0 mb-2 w-100" disabled><?php echo formatadata($enfermeiros['DataNasc'], "d/m/Y "); ?></button>
                        
                        <div class="row">

                        </div><a href="edit.php?id=<?php echo $enfermeiros['id']; ?>" class="btn btn-secondary  rounded-1 btn-editar">
                            <i class="fa-solid fa-notes-medical"></i> Editar
                        </a>

                        <a href="index.php" class="btn btn-light rounded-1">
                            <i class="fa-solid fa-chevron-left"></i> Voltar
                        </a>
                            <style>
                                .btn-editar {
                                    width: 65%;
                                }

                                @media (max-width: 900px) {
                                    .card {
                                        margin: 0 auto;
                                    }
                                }
                            </style>
                        </div>
                    </div>
                </div>

                
           
            
                        
                    
            <?php clear_messages(); ?> 

<?php include(FOOTER_TEMPLATE); ?>