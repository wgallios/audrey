<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

$versions = $this->config->item('versions');

$majorVersion = $versions[count($versions) - 1][0];
$minorVersion = $versions[count($versions) - 1][1];
?>

      <hr>


    <?php if ($this->session->userdata('logged_in') == true) : ?>
    <div id='iframe-container'>
      <iframe id='asnp-domain' src='http://asnp.co/hub/setdomain/<?=urlencode($_SERVER['SERVER_NAME'])?>'></iframe>
      <iframe id='asnp-cookies' src='http://asnp.co/hub/readcookies'></iframe>
    </div>
    <?php endif; ?>

    <footer>
        <p>&copy; William Gallios <?=date("Y")?></p>
        <p>Powered by: <a href='http://asnp.co' target='_blank'>Audrey Social Network Platform</a></p>
        <p>Version: <?=$majorVersion?>.<?=$minorVersion?></p>
    </footer>

    </div><!--/.fluid-container-->

  </body>
</html>
