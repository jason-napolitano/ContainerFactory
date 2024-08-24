<?php

namespace Tests\Libraries {

    class DemoService extends DemoServiceParent
    {
        public string $libraryProperty = 'library property value';

        public function get(): string
        {
            return 'hello, world!';
        }
    }
}
