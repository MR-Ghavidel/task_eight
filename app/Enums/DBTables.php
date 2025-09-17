<?php

namespace App\Enums;

enum DBTables: string
{
    case USERS = 'users';

    case BROKERS = 'brokers';

    case PROPERTIES = 'properties';

    case IMAGES = 'images';

    case PROPERTY_IMAGES = 'property_images';

    case PROPERTY_FEATURES = 'property_features';

    case COMMENTS = 'comments';

    case PROPERTY_VIEWS = 'property_views';

    case REACTIONS = 'reactions';
}
