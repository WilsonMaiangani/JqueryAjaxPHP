<?php
if (isset($_REQUEST) && !empty($_REQUEST['data'])) {
 $data = (object) $_REQUEST['data'];
 $nomeFilme  = $data->nomeFilme;
 echo '200';
}
