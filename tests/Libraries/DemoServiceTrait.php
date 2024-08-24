<?php

namespace Tests\Libraries {

    trait DemoServiceTrait
    {
        public string $traitProperty = 'trait property value';

        public function traitMessage(): string
        {
            return 'I am coming from a trait!';
        }
    }
}
