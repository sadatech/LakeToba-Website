<?php
namespace ElatedListing\Lib;

/**
 * interface PostTypeInterface
 * @package ElatedListing\Lib;
 */
interface PostTypeInterface {
    /**
     * @return string
     */
    public function getBase();

    /**
     * Registers custom post type with WordPress
     */
    public function register();
}