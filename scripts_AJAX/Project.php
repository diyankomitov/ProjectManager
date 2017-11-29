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
    var $isComplete;
    var $deadline;

    public function __construct($id, $class, $name, $description, $createDateString, $isComplete, $deadline){
        $this->id = $id;
        $this->class = $class;
        $this->name = $name;
        $this->description = $description;
        $this->createDate = $this->dateStringToDate($createDateString);
        $this->isComplete= $isComplete;
        $this->deadline = $deadline;
    }

    private function dateStringToDate($createDateString){

    }

//<<<<<<< HEAD:Project.php
//    public function buildHTMLMessage(){
//        $string =
//                "<div class=\"projectWrapper\" onclick='/*openProjectHere*/'>
//                    <div class=\"projectClass\">
//                        <h2>$this->class</h2>
//                    </div>
//                    <div class=\"projectName\">
//                        <p>$this->name</p>
//                    </div>
//                </div>";
//=======


    //This function returns the div for this project
    public function buildNavHTML(){
        $id = $this->id;
        $string = "<div onclick='projects_openProject($id)'>
                       <div class=\"projectClass\">
                           <h2>$this->class</h2>
                       </div>
                       <div class=\"projectName\">
                           <p>$this->name</p>
                       </div>
                   </div>";
        return $string;
    }

    public function buildInfoHTML(){
        $id = $this->id;

        $buttons ="<input id='addUserText' type='text' />
                   <button onclick='projects_addUser(document.getElementById(\"addUserText\").value)'>Add User</button>";
        $info = "<p> Class : " . $this->class . "</p>
                 <p> Project Name : " . $this->name . "</p>
                 <p> Description : " . $this->description . "</p>
                 <p> Deadline : " . $this->deadline . "</p>";

        return [ $buttons, $info ];
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