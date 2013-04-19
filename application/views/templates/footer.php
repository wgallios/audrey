<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

$versions = $this->config->item('versions');

$majorVersion = $versions[count($versions) - 1][0];
$minorVersion = $versions[count($versions) - 1][1];
?>

      <hr>

    <div id='iframe-container'>
      <iframe id='asnp-domain' src='http://asnp.co/hub/setdomain/<?=urlencode('williamgallios.com')?>'></iframe>
      <iframe id='asnp-cookies' src='http://asnp.co/hub/readcookies'></iframe>
    </div>

    <footer>
        <p>&copy; William Gallios <?=date("Y")?></p>
        <p>Powered by: <a href='http://asnp.co' target='_blank'>Audrey Social Network Platform</a></p>
        <p>Version: <?=$majorVersion?>.<?=$minorVersion?></p>
    </footer>

    </div><!--/.fluid-container-->

  </body>
</html>
