<?php
if (!empty($this->params->pass[0]) && $this->params->pass[0] == 1):
    echo json_encode($reclamations);
else:
    echo json_encode(count($reclamations));
endif;