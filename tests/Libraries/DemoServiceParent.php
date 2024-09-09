<?php

namespace Tests\Libraries {

    class DemoServiceParent
    {
        use DemoServiceTrait;

        public string $parentProperty = 'parent property value';

        public function parentMessage(): string
        {
            return 'I am coming from the parent class!';
        }
    }
}
