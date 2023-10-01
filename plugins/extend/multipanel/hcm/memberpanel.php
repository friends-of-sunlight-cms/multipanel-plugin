<?php

use Sunlight\Hcm;

return function () {
    return Hcm::run('multipanel', [true, 'memberpanel']);
};
