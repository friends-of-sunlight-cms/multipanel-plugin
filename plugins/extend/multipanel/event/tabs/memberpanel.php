<?php

use Sunlight\Router;
use Sunlight\Template;
use Sunlight\User;

return function (array $args) {

    $config = $this->getConfig();

    $userdata = User::$data;
    $groupdata = User::$group;

    // user profile
    if (User::isLoggedIn()) {

        $args['hide_first_multi_label'] = true;

        $avatar = User::renderAvatar([
            'avatar' => $userdata['avatar'],
            'username' => $userdata['username'],
            'publicname' => $userdata['publicname'],
        ]);

        $name = User::getDisplayName();
        $group = '<span class="text-icon">'
            . (($groupdata['icon'] != '') ? '<img src="' . _e(Router::path('images/groupicons/' . $groupdata['icon'])) . '" alt="icon" class="icon">' : '')
            . (($groupdata['color'] !== '')
                ? '<span style="color:' . $groupdata['color'] . ';">' . $groupdata['title'] . '</span>'
                : $groupdata['title'])
            . '</span>';

        $compactMode = $config['mp_compact_mode'] ? ' compact' : '';
        $msgCount = User::getUnreadPmCount();

        $profileContent = _buffer(function () use ($config, $avatar, $name, $group, $compactMode, $msgCount) { ?>
            <div class="user-detail<?= $compactMode ?>">
                <div class="user-avatar"><?= $avatar ?></div>
                <div class="user-info">
                    <div class="user-name"><?= $name ?></div>
                    <div class="user-group"><?= $config['mp_show_usergroup'] ? $group : '' ?></div>
                </div>
            </div>
            <?php if ($config['mp_show_unread_messages']): ?>
                <div class="user-messages<?= $compactMode ?>">
                    <?= ($msgCount > 0 ? '<a href="' . _e(Router::module('messages')) . '">' : '') ?>
                    <?= _lang('multipanel.hcm.messages', ['%msgcount%' => $msgCount]) ?>
                    <?= ($msgCount > 0 ? '</a>' : '') ?>
                </div>
            <?php endif; ?>
        <?php });

        $args['items']['profile'] = [
            'label' => _lang('multipanel.hcm.profile'),
            'content' => $profileContent,
        ];
    }

    // user menu
    $args['items']['menu'] = [
        'label' => _lang('multipanel.hcm.menu'),
        'content' => Template::userMenu(),
    ];
};
