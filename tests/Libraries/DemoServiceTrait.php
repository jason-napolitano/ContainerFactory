<?php

namespace Tests\Libraries {

	trait DemoServiceTrait
	{
		public string $message = 'property message';

		public function traitMessage(): string
		{
			return 'I am coming from a trait!';
		}
	}
}