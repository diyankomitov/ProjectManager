<?php
/**
 * Created by IntelliJ IDEA.
 * User: E
 * Date: 18/11/2017
 * Time: 00:14
 */

class Project {

    var $id;
    var $class;
    var $name;
    var $description;
    var $createDate;
    var $deadline;
    var $isComplete;

    public function __construct($id, $class, $name, $description, $createDateString, $deadline, $isComplete){
        $this->id = $id;
        $this->class = $class;
        $this->name = $name;
        $this->description = $description;
        $this->createDate = $this->dateStringToDate($createDateString);
        $this->deadline = $deadline;
        $this->isComplete= $isComplete;
    }

    private function dateStringToDate($createDateString){

    }

    public function buildHTMLMessage(){
        $id = $this->id;
        $string = "<div onclick='projects_openProject($id);'>
                        <hr>
                        <p>$this->class : $this->name</p>
                        <hr>
                    </div>";
        return $string;
    }

    public function getId(){
        return $this->id;
    }

    public function getClass(){
        return $this->class;
    }

    public function getName(){
        return $this->name;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getCreateDate(){
        return $this->createDate;
    }

    public function getDeadline(){
        return $this->deadline;
    }

    public function getIsCompleted(){
        return $this->isComplete;
    }
}