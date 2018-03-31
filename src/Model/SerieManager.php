<?php
/**
 * Created by PhpStorm.
 * User: aragorn
 * Date: 29/03/18
 * Time: 12:04
 */

namespace Model;

class SerieManager extends AbstractManager
{
    const TABLE = 'serie';

    /**
     * SerieManager constructor.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
