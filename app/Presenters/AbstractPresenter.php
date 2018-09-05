<?php

namespace App\Presenters;

use App\Interfaces\PresenterInterface;

/**
 * Class AbstractPresenter.
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 *
 * @category Presenter
 *
 * @see https://github.com/andrewdyer/slim3-restful-api-web-seed
 */
abstract class AbstractPresenter implements PresenterInterface
{
    /** @var object */
    private $data;

    /**
     * @param mixed $data
     */
    public function __construct($data)
    {
        $this->data = (object) $data;
    }

    /**
     * @return array
     */
    public function present(): array
    {
        return $this->format($this->data);
    }
}
