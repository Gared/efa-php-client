<?php
declare(strict_types=1);

namespace Gared\EFA\Normalizer;

use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class PointsNormalizer extends ObjectNormalizer
{
    /**
     * @inheritDoc
     */
    public function denormalize($data, $type, $format = null, array $context = [])
    {
        $data['stopFinder']['points'] = array_values($data['stopFinder']['points']);
        return parent::denormalize($data, $type, $format, $context);
    }

    /**
     * @inheritDoc
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return isset($data['stopFinder']['points']['point']) && parent::supportsDenormalization($data, $type, $format);
    }
}