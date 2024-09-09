<?php

namespace ContainerFactory\Contracts {

    interface ContainerInstance
    {
	    /**
	     * Mounts a service to a container
	     *
	     * @param array $services
	     *
	     * @return void
	     */
	    public function mount(array $services = []): void;

	    /**
	     * Resets a container
	     *
	     * @return void
	     */
	    public function reset(): void;

	    /**
	     * Destroys a container
	     *
	     * @return void
	     */
	    public function destroy(): void;
    }
}
