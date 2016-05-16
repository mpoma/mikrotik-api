<?php

namespace MikrotikAPI\Commands\Queues;

use MikrotikAPI\Talker\Talker,
    MikrotikAPI\Util\SentenceUtil;

/**
 * Description of Queues
 *
 * @author      Marcelo Poma
 * @copyright   Copyright (c) 2016, Marcelo Poma.
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category	Libraries
 */
class Queues {

    /**
     *
     * @var type array
     */
    private $talker;

    function __construct(Talker $talker) {
        $this->talker = $talker;
    }

    /**
     * This method is used to add the simple queue
     * @param type $address string
     * @param type $interface string
     * @param type $comment string
     * @return type array
     */
    public function add($param) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/queue/simple/add");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $this->talker->send($sentence);
        return "Sucsess";
    }

    /**
     * This method is used to display all simple queue
     * @return type array
     * 
     */
    public function getAll() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/queue/simple/getall");
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No simple queue To Set, Please Your Add simple queue";
        }
    }


    /**
     * This method is used to display one target simple queue
     * @return type array
     * 
     */
    public function getTarget($target) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/queue/simple/getall");
        $sentence->where("target", "=", $target."/32");
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return null;
        }
    }



    /**
     * This method is used to activate simple queue by id
     * @param type $id is not an array
     * @return type array
     * 
     * 
     */
    public function enable($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/queue/simple/enable");
        $sentence->where(".id", "=", $id);
        $enable = $this->talker->send($sentence);
        return "Sucsess";
    }

    /**
     * This method is used to disable simple queue by id
     * @param type $id string 
     * @return type array
     * 
     * 
     */
    public function disable($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/queue/simple/disable");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return "Sucsess";
    }

    /**
     * This method is used to remove the simple queue by id
     * @param type $id is not an array
     * @return type array
     * 
     */
    public function delete($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/queue/simple/remove");
        $sentence->where(".id", "=", $id);
        $enable = $this->talker->send($sentence);
        return "Sucsess";
    }

    /**
     * This method is used to set or edit by id
     * @param type $param array
     * @return type array
     * 
     */
    public function set($param, $id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/queue/simple/set");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return "Sucsess";
    }

    /**
     * This method is used to display one simple queue 
     * in detail based on the id
     * @param type $id not string
     * @return type array
     * 
     */
    public function detail_address($id) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/queue/simple/print");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No simple queue With This id = " . $id;
        }
    }

}
