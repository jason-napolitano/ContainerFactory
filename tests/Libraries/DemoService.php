<?php

namespace Tests\Libraries {

    class DemoService extends DemoServiceParent
    {
        public string $libraryProperty = 'library property value';

        public function get(): string
        {
            return 'I am coming from the library class!';
        }
    }
}
