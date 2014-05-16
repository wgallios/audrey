<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?=$this->functions->getSiteTitle()?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- ONLY FOR DEV - REMOVE FOR LIVE //-->
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">

    <script type='text/javascript' src='/public/js/jquery-1.11.1.min.js'></script>
    <script type="text/javascript" src="/public/bootstrap3.1.1/js/bootstrap.min.js"></script>
    <link type="text/css" href="/public/bootstrap3.1.1/css/bootstrap.min.css" rel="Stylesheet" />

    <script type='text/javascript' src="/min/?f=public/js/global.js<?=$this->config->item('min_debug')?>&amp;<?=$this->config->item('min_version')?>"></script>


    <link type="text/css" href="/public/jqueryui1.10.1/css/audrey/jquery-ui-1.10.1.custom.min.css" rel="Stylesheet" />
    <script type="text/javascript" src="/public/jqueryui1.10.1/js/jquery-ui-1.10.1.custom.min.js"></script>


    <link rel="stylesheet" href="/public/font-awesome-4.1.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="/min/?f=public/css/main.css<?=$this->config->item('min_debug')?>&amp;<?=$this->config->item('min_version')?>" />


    <!-- <script type='text/javascript' src="/min/?f=public/js/asnp.js<?=$this->config->item('min_debug')?>&amp;<?=$this->config->item('min_version')?>"></script> -->

    <?php if (class_exists('CI_DB')) :

    $gaid = $this->settings->item('googleAnalyticsID');

    if (!empty($gaid))
    {
        echo <<< EOS

<script type="text/javascript">

var _gaq = _gaq || [];
_gaq.push(['_setAccount', '{$gaid}']);
_gaq.push(['_trackPageview']);

(function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();

</script>
EOS;
    }
?>

    <?php endif; ?>

<?php
    if ($this->session->userdata('logged_in') == true) $userid = "&amp;userid=" . $this->session->userdata('userid');
?>

    <script type="text/javascript" id='asnp-script' src="http://asnp.co/public/js/asnp.js?domain=<?=$_SERVER['HTTP_HOST']?><?=$userid?>"></script>
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }

      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }
      }
    </style>





