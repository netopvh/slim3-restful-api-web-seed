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
     * @param object $data
     *
     * @return array
     */
    public function format($data): array;
}
