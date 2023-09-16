  <?php 
  $nomePagina = basename($_SERVER['PHP_SELF']);
  $nameclass = str_replace('.php', '', $nomePagina);
  if ($nomePagina != 'login.php' && $nomePagina != 'register.php' && $nomePagina != 'admin-dash.php') : ?>
    <footer id="footer" class="bg-primary py-3 text-white">
      <div class="container footer-bottom clearfix">
        <div class="copyright">
          &copy; Copyright <strong>Danilo Calabrese</strong>. All Rights Reserved
        </div>
        <div class="credits">Designed by <a href="https://danilocalabrese.it" target="_blank" class="text-warning"><b>Danilo Calabrese</b></a></div>
      </div>
    </footer>
    <?php endif; ?>
    
    <!-- Script -->
    <?php 
      footerScripts();

      menuMobile();
    ?>
  </body>
</html>