<?php

use Phalcon\Mvc\Model;

class Cities extends Model
{
    /**
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length = 11, nullanle = false)
     */
    public $id;

    /**
     * @var string
     * @Column(type="string", length = 45, nullanle = false)
     */
    public $name;

    /**
     * @var decimal
     * @Column(type="decimal", nullanle = false)
     */
    public $lat;

    /**
     * @var decimal
     * @Column(type="decimal", nullanle = false)
     */
    public $lon;

    /**
     * @var datetime
     * @Column(type="datetime", nullanle = false)
     */
    public $date;
}