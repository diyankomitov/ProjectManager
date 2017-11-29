<?php
/**
 * Created by IntelliJ IDEA.
 * User: E
 * Date: 14/11/2017
 * Time: 22:09
 */

class Message {

    var $id;
    var $creatorId;
    var $messageBody;
    var $createDate;

    public function __construct($id, $creatorId, $messageBody, $createDateString){
        $this->id = $id;
        $this->creatorId = $creatorId;
        $this->messageBody = nl2br(wordwrap(htmlentities($messageBody),30, "\n", true));
        $this->createDate = $this->dateStringToDate($createDateString);
    }

    private function dateStringToDate($createDateString){

    }

    //This function returns the chat bubble for this message.
    //If the current user is not the creator of this message, it returns the correct type of bubble.
    public function buildHTML($userId){
        $class = $this->creatorId === $userId ? "chatMessage myMessage" : "chatMessage otherMessage";
        $string = "
                    <div class='chatMessageWrapper'>
                        <div class='$class'>
                            <p> $this->messageBody </p>
                        </div>
                    </div> 
                  ";
        return $string;
    }

    public function getId(){
        return $this->id;
    }

    public function getCreatorId(){
        return $this->creatorId;
    }

    public function getMessageBody(){
        return $this->messageBody;
    }

    public function getCreateDate(){
        return $this->createDate;
    }
}