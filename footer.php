    <footer>
      <div class="container">
        <hr>
        <div class="row">
          <div class="column">
            <p><?= bloginfo('name') ?></p>
            <span>© 2022 - <?= date('Y') ?> | Victor Andeloci</span>
          </div>
          <div class="column">
            <p>Project P. - v<?= PP_VERSION ?></p>
            <span>Development by <a href="https://github.com/victorandeloci" target="_blank" rel="nofollow noreferrer">@victorandeloci</a></span>
          </div>
        </div>
      </div>
    </footer>
    <?php wp_footer(); ?>
  </body>
</html>
