<?php

namespace Tests\Libraries {

	use ContainerFactory\Contracts\InjectableInterface;

	class DemoServiceParent implements InjectableInterface
    {
        use DemoServiceTrait;

        public string $parentProperty = 'parent property value';

        public function parentMessage(): string
        {
            return 'I am coming from the parent class!';
        }
    }
}
