<?php

namespace Tests\Libraries {

	use ContainerFactory\Contracts\MountableInterface;

	class DemoServiceParent implements MountableInterface
    {
        use DemoServiceTrait;

        public string $parentProperty = 'parent property value';

        public function parentMessage(): string
        {
            return 'I am coming from the parent class!';
        }
    }
}
