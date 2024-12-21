<?php

namespace App\Transformers;

abstract class ParentTransformer
{
    abstract public function transform(mixed $object);
}
