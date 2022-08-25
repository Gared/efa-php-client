<?php
declare(strict_types=1);

namespace Gared\EFA\Request;

interface RequestInterface
{
    public function getDefaultParameters(): array;
}