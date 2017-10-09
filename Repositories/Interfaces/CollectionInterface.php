<?php
/**
 * Words Tree Collection Interface
 *
 * Savio Resende <savio@savioresende.com.br>
 */

namespace Repositories\Interfaces;

interface CollectionInterface
{

    /**
     * Load in the current object the Traversable input (array)
     *
     * @param Traversable|array
     * @return void
     */
    public function loadTraversable( $traversable );

}