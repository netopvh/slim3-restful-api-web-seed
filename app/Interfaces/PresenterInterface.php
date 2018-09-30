<?php

namespace App\Interfaces;

/**
 * Interface PresenterInterface.
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 *
 * @category Interface
 *
 * @see https://github.com/andrewdyer/slim3-restful-api-web-seed
 */
interface PresenterInterface
{
    /**
     * Format the data into an normalised array, without having to modify the
     * original source.
     *
     * @param object $data
     *
     * @return array
     */
    public function format($data): array;
}
