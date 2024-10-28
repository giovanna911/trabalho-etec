<?php
            include 'config.php';
            include DBAPI;
            if (!isset($_SESSION)) session_start(); 
            include(HEADER_TEMPLATE);
        ?>
        <h1>Criadores | <b class="text-primary">Desenvolvedores de enfermagem</b></h1>
        <hr>
        <div class="container-index">
            <div class="container mt-2">
                <div class="d-flex justify-content-evenly criadores-faixa-card">
                    <!-- Card 1 -->
                    <div class="col-md-4">
                        <div class="card">
                            <img src="criadores/giovanna.jpeg" class="card-img-top" alt="Card Image">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">Giovanna Marina Henrique</h5>
                                <p class="card-text text-secondary border-bottom ">Enfermeira Top</p>
                                <p class="card-text text-dark">Giovanna é uma das nossas melhores enfermeiras daqui do hospita, porém, em tempos vagos ela aprende programação.</p>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="https://www.instagram.com/henrique_gihh/" class="btn btn-secondary mr-2"><i class="fa-brands fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <style>
                        .text-link {
                            display: flex;
                            justify-content: center;
                            align-items: center;
                        }

                        @media (max-width: 1200px) {
                            .links-criadores {
                                display: none;
                            }
                        }
                        

                        @media (max-width: 750px) {
                            .links-criadores {
                                display: block;
                            }
                        }

                        @media (max-width: 900px) {
                            .criadores-faixa-card {
                                flex-wrap: wrap;
                                gap: 1rem;
                            }

                        }
                    </style>
                    <!-- Card 2 -->
                    <div class="col-md-4">
                        <div class="card">
                            <img src="criadores/hariadny.jpeg" class="card-img-top" alt="Card Image">
                            <div class="card-body">
                            <h5 class="card-title fw-bold">Hariadny Tacachsc</h5>
                                <p class="card-text text-secondary border-bottom ">Enfermeira Top</p>
                                <p class="card-text text-dark">Hariadny é uma das nossas melhores enfermeiras daqui do hospita, porém, em tempos vagos ela aprende programação.</p>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="https://www.instagram.com/itsharytacachsc/" class="btn btn-secondary mr-2"><i class="fa-brands fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include(FOOTER_TEMPLATE); ?>