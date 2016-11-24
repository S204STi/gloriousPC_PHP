<!DOCTYPE html>
  <html>

  <head>
    <title>GLORIOUS PC</title>
    <meta charset="UTF-8">
    <meta name="description" content="Buy Personal Computer Parts">
    <meta name="keywords" content="Keyboards, GPU, Graphic Cards, Video Cards, PC, Computer, Repair, Parts">
    <meta name="author" content="Jeff Schreiner">

    <!-- If the css and other pages do not work set this base tag to match site nesting -->
    <base href="/glorious/">
    <link rel="apple-touch-icon" sizes="180x180" href="server/src/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="server/src/images/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="server/src/images/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="server/src/images/manifest.json">
    <link rel="shortcut icon" href="server/src/images/favicon.ico">
    <meta name="msapplication-config" content="server/src/images/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="server/src/css/font-awesome.min.css">
    <link rel="stylesheet" href="server/src/css/site.css">

  </head>

  <body>
    <header>
      <!--Page Container keeps the site from getting too wide-->
      <div class="container content">
        <?php include(APP_ROOT . 'server/view/topbar.php'); ?>
      </div>

      <!--Navigation Bar-->
      <nav>
        <div class="container">
          <?php include(APP_ROOT . 'server/view/navbar.php'); ?>
        </div>
      </nav>
    </header>

    <main>
      <div class="container content">