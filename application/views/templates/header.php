<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php include_once 'headinclude.php'; ?>
    <?=$headscript?>

<?php
    $this->functions->renderJsUserid();
?>

  </head>

  <body<?php if (!empty($onload)) echo " onload=\"{$onload}\""; ?>>

    <?php include_once 'navbar.php' ?>

    <div class="container-fluid">

    <?php include_once 'alert.php' ?>

