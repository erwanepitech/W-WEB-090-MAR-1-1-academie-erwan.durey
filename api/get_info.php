<?php
require_once('connect.php');

class GetInfo extends connect{
    
    private $id;
    private $follow_id;
    private $tweet_id;
    private $session_message_id;
    private $message_id;

    public function __construct(){
        parent::__construct();
    }

    public function __set($name, $value){
        $this->$name = $value;
    }    
    
    public function __get($name){
        return $this->$name;
    }
    
    public function PageAccueil(){
        $bV = $this->connection-> prepare("SELECT follower_id FROM Follow
        INNER JOIN User ON Follow.user_id=User.id
        WHERE User.id=:id");
        $bV->bindValue('id', $this->id, PDO::PARAM_STR);
        $bV->execute();
        $res = $bV->fetchAll(PDO::FETCH_ASSOC);

        $arr_user=[];
        for($i=0;$i<count($res);$i++){
            array_push($arr_user,$res[$i]['follower_id']);
        }
        $id_follow = implode(',',$arr_user);

        $bV = $this->connection-> prepare("SELECT User.id, User.user_name, Tweet.id, content, img, post_date 
        FROM User INNER JOIN Tweet ON User.id=Tweet.user_id
        WHERE User.id IN (:id) ORDER BY post_date DESC");
        $bV->bindValue('id', $id_follow, PDO::PARAM_STR);
        $bV->execute();
        $result = $bV->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

}

$tweet = new GetInfo();
$tweet->id = 1;
var_dump(json_encode($tweet->PageAccueil()));
?>