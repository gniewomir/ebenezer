<?php

declare(strict_types=1);

namespace Enraged\Ebenezer\Domain\Asset;

enum AssetTypeEnum: string
{
    case CASH = 'cash';

    case GENERIC_BANK_ACCOUNT = 'generic bank account';

    case ING_BANK_ACCOUNT = 'ING bank account';

    case GENERIC_REAL_ESTATE = 'generic real estate';

    case GENERIC_BROKER_ACCOUNT = 'generic broker account';

    case ETORO_BROKER_ACCOUNT = 'etoro broker account';

    case MBANK_BROKER_ACCOUNT = 'mBank broker account';

    case MBANK_IKE_BROKER_ACCOUNT = 'mBank IKE broker account';

    case GENERIC_ITEM = 'generic item';
}
