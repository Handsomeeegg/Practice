<?php include_once __DIR__ . "/includes/head/head-min.php"?>;

<body>
  <div id="colorlib-page">
    <aside id="colorlib-aside" role="complementary" class="js-fullheight">
      <nav id="colorlib-main-menu" role="navigation">
        <?php include_once __DIR__ . '/init/init.php'; 
        echo $initMenu->htmlMenu($menuArray); ?> 
      </nav>
    </aside> 
    <div id="colorlib-main">
      <section class="ftco-about img ftco-section ftco-no-pt ftco-no-pb" id="about-section">
        <div class="container-fluid px-0">
          <div class="row d-flex mt-5">
            <div class="col-md-6 d-flex align-items-center">
              <div class="text px-4 pt-5 pt-md-0 px-md-4 pr-md-5 ftco-animate">
                <h2 class="mb-4">I'm <span>Andrea Moore</span> a Scotish Blogger &amp; Explorer</h2>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a
                  paradisematic country, in which roasted parts of sentences fly into your mouth. It is a paradisematic
                  country, in which roasted parts of sentences fly into your mouth.</p>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div><!-- END COLORLIB-MAIN -->
  </div><!-- END COLORLIB-PAGE -->
  <?php include_once __DIR__ . '/includes/pre-loader.php';?>
  <?php include_once __DIR__ . '/includes/script/inc/base.inc.php';?>
</body>
</html>