<?php

namespace SunlightExtend\Multipanel;

use Sunlight\Plugin\Action\ConfigAction as BaseConfigAction;

class ConfigAction extends BaseConfigAction
{
    public function getConfigLabel(string $key): string
    {
        return _lang('multipanel.config.' . $key);
    }
}