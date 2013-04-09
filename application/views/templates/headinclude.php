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

    <script type='text/javascript' src='/public/js/jquery-1.9.1.min.js'></script>
    <script type='text/javascript' src='/public/bootstrap2.3/js/bootstrap.min.js'></script>
    <link href="/public/bootstrap2.3/css/bootstrap.min.css" rel="stylesheet">

    <script type='text/javascript' src="/min/?f=public/js/global.js<?=$this->config->item('min_debug')?>&amp;<?=$this->config->item('min_version')?>"></script>


    <link type="text/css" href="/public/jqueryui1.10.1/css/audrey/jquery-ui-1.10.1.custom.min.css" rel="Stylesheet" />
    <script type="text/javascript" src="/public/jqueryui1.10.1/js/jquery-ui-1.10.1.custom.min.js"></script>


    <link rel="stylesheet" type="text/css" href="/min/?f=public/css/main.css<?=$this->config->item('min_debug')?>&amp;<?=$this->config->item('min_version')?>" />
    <link href="/public/bootstrap2.3/css/bootstrap-responsive.css" rel="stylesheet">


    <script type="text/javascript" src="http://asnp.co/public/js/asnp.js"></script>

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

    <script type="text/javascript">
        asnp.domain = "<?=$this->settings->item('domain')?>";
    </script>
    <?php endif; ?>

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


    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="/public/bootstrap2.3/js/html5shiv.js"></script>
    <![endif]-->






