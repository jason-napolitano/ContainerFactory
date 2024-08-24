<?php

namespace Tests\Libraries {

	class DemoService extends DemoServiceParent
    {
		public string $property = 'property value';

        public function get(): string
        {
            return 'hello, world!';
        }
    }
}
