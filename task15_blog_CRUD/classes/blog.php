<?php
 require 'database.php';

class Blog{

    public $title;
    public $content;
    public $image;



    public function __construct($title,$content,$image)
    {
        $this->$title;
        $this->$content;
        $this->$image;
    }



    public function create(){
       $dbCon = new DataBase;

       $sql  = "insert into blog (title,content,image) values ('$this->title', '$this->content', '$this->image')";
       $result = $dbCon->DoQuery($sql);

       return $result;

    }

    public function edit($id){
        $dbCon = new DataBase;
 
        $sql  = "update blog set title = '$this->title' ,   content = '$this->content' , image = '$this->image'  where id = $id";
        $result = $dbCon->DoQuery($sql);
 
        return $result;
 
     }

   
    

    


}


?>