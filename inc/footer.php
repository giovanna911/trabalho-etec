            <hr>
        </main> <!-- /container -->
        <footer class="container">
        <?php $hoje = new DateTime("now", new DateTimeZone("America/Sao_Paulo")); ?>
            <p>&copy;2023 a <?php echo $hoje -> format("Y"); ?> - Projeto PW - Giovanna Henrique & Hariadny Tacachsc</p>
        </footer>
        <script src="<?php echo BASEURL; ?>js/jquery-3.7.0.min.js"></script>
        <!-- 
        <script src="<?php echo BASEURL; ?>js/popper.min.js"></script>
        <script src="<?php echo BASEURL; ?>js/bootstrap/bootstrap.min.js"></script>
        <script src="<?php echo BASEURL; ?>js/bootstrap/bootstrap.js"></script>
        -->
        <script src="<?php echo BASEURL; ?>js/awsome/all.min.js"></script>
        <script src="<?php echo BASEURL; ?>js/bootstrap/bootstrap.bundle.min.js"></script>
        <script src="<?php echo BASEURL; ?>js/main.js"></script>
    </body>

</html>