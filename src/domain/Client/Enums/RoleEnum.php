<?php

namespace Domain\Client\Enums;

use Shared\Traits\EnumHelper;

enum RoleEnum: string
{
    use EnumHelper;
    case ADMIN = 'admin';
    case AUTHOR = 'author';
    case USER = 'user';

    public static function getRolesPermissions(): array
    {
        return [
            self::ADMIN->value => [
                PermissionEnum::USER_VIEW_ANY->value,
                PermissionEnum::USER_CREATE->value,
                PermissionEnum::USER_UPDATE->value,
                PermissionEnum::USER_DELETE->value,
                PermissionEnum::CATEGORY_VIEW_ANY->value,
                PermissionEnum::CATEGORY_CREATE->value,
                PermissionEnum::CATEGORY_UPDATE->value,
                PermissionEnum::CATEGORY_DELETE->value,
                PermissionEnum::TAG_VIEW_ANY->value,
                PermissionEnum::TAG_CREATE->value,
                PermissionEnum::TAG_UPDATE->value,
                PermissionEnum::TAG_DELETE->value,
                PermissionEnum::ARTICLE_VIEW->value,
                PermissionEnum::ARTICLE_APPROVE->value,
                PermissionEnum::ARTICLE_DELETE->value,
            ],
            self::AUTHOR->value => [
                PermissionEnum::ARTICLE_VIEW->value,
                PermissionEnum::ARTICLE_CREATE->value,
                PermissionEnum::ARTICLE_UPDATE->value,
                PermissionEnum::ARTICLE_DELETE->value,
            ],
            self::USER->value => [
                PermissionEnum::ARTICLE_VIEW
            ]
        ];
    }
}
