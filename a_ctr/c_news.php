<?php

//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);



include '../a_ctr/c_pdoconnect.php';
include 'c_pdoconnect.php';
include '../addons/php-upload-multi/src/class.upload.php';
include '../addons/php_rutils/myclass/class-get-time-distance.php';


class ExchangeMessages {

    private $form = "Идентификатор формы";
    private $status = "Статус";
    private $method = "Метод получения данных";
    private $dataIn = "Данные";
    private $id = "Идентификатор сообщения в базе";
    private $dataReq = 'Дата внесения в базу';
    private $type = 'Тип формы';
    private $name;
    private $subject;
    private $message;
    // загрузка изображений.
    private $dir_dest;
    private $dir_pics;
    private $files;
    private $def_dir_pics;
    // получение страниц новостей
    private $page;
    private $between;
    private $filter;
    

    public function sendToDb($form, $status, $method, $dataIn, PDO $pdo) {

        $this->form = $form;
        $this->status = $status;
        $this->method = $method;
        $this->dataIn = $dataIn;

        $data = $this->dataIn;
        $id = 'null';
        $dateReq = date('Y-m-d H:i:s');
        $type = $this->form;
        $status = $this->status;
        $form = $this->form;

        //определение типа формы
        if ($form == 'connections')  {

            //данные текстовых форм
            $theme = $data['theme'];
            $name = $data['name'];
            $email = $data['email'];
            $phone = $data['phone'];
            $message = $data['message'];


            $query = "INSERT INTO `messages`(
            `id`,
            `dateReq`,
            `theme`,
            `name`,
            `email`,
            `phone`,           
            `message`,
            `status`
            ) VALUES (
            :id,
            :dateReq,
            :theme,
            :name,
            :email,
            :phone,          
            :message,
            :status);";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':dateReq', $dateReq, PDO::PARAM_STR);
            $stmt->bindParam(':theme', $theme, PDO::PARAM_STR);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);           
            $stmt->bindParam(':message', $message, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            $stmt->execute();
        } elseif ($form == 'interview') {
            // данные чек боксов
            $inter1 = $data['interview-1'];
            $inter2 = $data['interview-2'];
            $inter3 = $data['interview-3'];

            $query = "INSERT INTO `interviews`(
            `id`,
            `dateReq`,
            `inter1`,
            `inter2`,
            `inter3`,
            `type`,
            `message`,
            `status`            
            ) VALUES (
            :id,
            :dateReq,
            :inter1,
            :inter2,
            :inter3,        
            :type,           
            :message,
            :status);";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':dateReq', $dateReq, PDO::PARAM_STR);
            $stmt->bindParam(':inter1', $inter1, PDO::PARAM_STR);
            $stmt->bindParam(':inter2', $inter2, PDO::PARAM_STR);
            $stmt->bindParam(':inter3', $inter3, PDO::PARAM_STR);
            $stmt->bindParam(':type', $type, PDO::PARAM_STR);
            $stmt->bindParam(':message', $message, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            $stmt->execute();
        }
        
        elseif (($form == 'base') || 
                ($form == 'extend') ||
                ($form == 'teacher')) {
            
            $first_name = $data['first_name'];
            $second_name = $data['second_name'];
            $third_name = $data['third_name'];
            $phone = $data['text'];
            $email = $data['email'];
            $plan = $data['form'];
            
          $query = "INSERT INTO `order`(
            `id`,
            `dateReq`,
            `firstname`,
            `secondname`,
            `thirdname`,
            `email`,
            `phone`,
            `message`,
            `status`
            ) VALUES (
            :id,
            :dateReq,
            :firstname,
            :secondname,
            :thirdname,        
            :email,           
            :phone,
            :message,
            :status);";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':dateReq', $dateReq, PDO::PARAM_STR);
            $stmt->bindParam(':firstname', $first_name, PDO::PARAM_STR);
            $stmt->bindParam(':secondname', $second_name, PDO::PARAM_STR);
            $stmt->bindParam(':thirdname', $third_name, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
            $stmt->bindParam(':message', $plan, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            $stmt->execute();
            
    }
    
    elseif ($form === 'addnews') {
     
         //данные текстовых форм
            $idUser = '2';
            $subject = $data['post']['subject'];                   
            $date = date('Y-m-d', strtotime($data['post']['date']));

            $theme = $data['post']['theme'];
            $message = $data['post']['message'];
            $image = '1';           
            if (empty($data['files'])) {
                $image = '0';
            }
            
            $query = "INSERT INTO `news`(
            `id`,
            `idUser`,
            `dateReq`,
            `subject`,
            `date`,
            `theme`,
            `image`,
            `message`,
            `status`
            ) VALUES (
            :id,
            :idUser,
            :dateReq,
            :subject,
            :date,
            :theme,
            :image,
            :message,
            :status);";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':idUser', $idUser, PDO::PARAM_STR);
            $stmt->bindParam(':dateReq', $dateReq, PDO::PARAM_STR);           
            $stmt->bindParam(':subject', $subject, PDO::PARAM_STR);
            $stmt->bindParam(':date', $date, PDO::PARAM_STR);
            $stmt->bindParam(':theme', $theme, PDO::PARAM_STR);
            $stmt->bindParam(':image', $image, PDO::PARAM_STR);
            $stmt->bindParam(':message', $message, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            $stmt->execute();   
}
        
    }

    public function getLastId($status, PDO $pdo) {

        //вносятся наименование формы и статус сообщения для выборки
        $this->status = $status;
        $this->dataReq;
        $this->name;
        $this->subject;
        $this->type;
        $this->message;
        $this->status;


        $query = "SELECT
                id                 
              FROM `news`                  
              WHERE                               
                status = '$this->status'                       
              ORDER BY ID 
              DESC
              LIMIT 1;";

        $stmt = $pdo->query($query);
        $row = $stmt->fetch();
        if (empty($row)) {
            return $row = 'данных нет';
        }
        return $row['id'];
    }
    
    
   public function getLastIdMessage($status, PDO $pdo) {

        //вносятся наименование формы и статус сообщения для выборки
        $this->status = $status;
        $this->dataReq;
        $this->name;
        $this->subject;
        $this->type;
        $this->message;
        $this->status;


        $query = "SELECT
                id                 
              FROM `messages`                  
              WHERE                               
                status = '$this->status'                       
              ORDER BY ID 
              DESC
              LIMIT 1;";

        $stmt = $pdo->query($query);
        $row = $stmt->fetch();
        if (empty($row)) {
            return $row = 'данных нет';
        }
        return $row['id'];
    }

    public function getMessage($id, PDO $pdo) {
        $this->id = $id;

        $query = "SELECT
                *                 
              FROM `news`                  
              WHERE               
                id = '$this->id'                               
              LIMIT 1;";

        $stmt = $pdo->query($query);
        $row = $stmt->fetch();
        if (empty($row)) {
            return $question = 'данных нет';
        }
        return $row;
    }
    
    public function getMessageQuestion($id, PDO $pdo) {
        $this->id = $id;

        $query = "SELECT
                *                 
              FROM `messages`                  
              WHERE               
                id = '$this->id'                               
              LIMIT 1;";

        $stmt = $pdo->query($query);
        $row = $stmt->fetch();
        if (empty($row)) {
            return $question = 'данных нет';
        }
        return $row;
    }
    
    public function getZabutoCalendarData(PDO $pdo) {
        
        $query = "SELECT
                *                 
              FROM `news`;";
        
        $stmt = $pdo->query($query);
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($row)) {
            return $question = 'данных нет';
        }
        
            //  "date":"2015-09-26",
            //  "badge":true,
            //  "title":"Сегодня",
            //  "body":"<p class=\"lead\">ААКАК<\/p><p>АКААКАКА<\/p>",   
            //  "footer":"Вот такие пироги",
            //  "classname":"purple-event"
        foreach ($row as &$data) {
            //заполняем тему сообщения
            switch ($data['theme']) {
            case 1: $data['theme'] = 'спектакль';  break;          
            case 2: $data['theme'] = 'за кадром';  break;
            case 3: $data['theme'] = 'мероприятие';  break;
            case 4: $data['theme'] = 'галерея ++';  break;
             }
             
             if ($data['theme'] == 'галерея ++') {
                 $data['subject'] = 'Обновления в галерее';
                 $data['message'] = '';
             }
       
        
        $data['badge'] = 'true';
        $data['body'] = '<span class="news-status bg-purple pull-right">'.$data['theme'].'</span><p class="lead">'.$data['subject'].'</p><p>'.$data['message'].'</p>';
        $data['footer'] = '<button type="button" class="btn btn-modal-footer" data-dismiss="modal">Закрыть</button>';
        $data['classname'] = '';
        $data['title'] = 'на '.$data['date'];
        
         }
         
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($row);
    }

    

    public function getAllMessage($page, $between, $filter, PDO $pdo) {
        $this->filter = $filter;
        $this->page = $page;
        $this->between = $between;
        $start = abs($this->page*$this->between);
              
        $query = "SELECT
                *                 
              FROM `news`            
              ORDER BY `id` DESC
              LIMIT $start , $this->between;";
        
        
        $stmt = $pdo->query($query);
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($row)) {
            return $question = 'данных нет';
        }
        
        /*prepare array for next view
         *     id, userId, dateReq, subject, date, theme, image, message, status  
         *   {{:theme}}
         *   {{:subject}}
         *   {{:thumb-img}}
         *   {{:message}}
         *   {{:views}}
         *   {{:time-ago}}
         * 
         */       
        $fromTime = null; //now
        $accuracy = RUtils::ACCURACY_MINUTE; //years, months, days, hours, minutes
        foreach ($row as &$data) {
            //заполняем тему сообщения
            switch ($data['theme']) {
            case 1: $data['theme'] = 'спектакль';  break;          
            case 2: $data['theme'] = 'за кадром';  break;
            case 3: $data['theme'] = 'мероприятие';  break;
            case 4: $data['theme'] = 'галерея ++';  break;
             }
            // времени назад
            $ago = RUtils::dt()->distanceOfTimeInWords($data['dateReq'], $fromTime, $accuracy) ;            
            
            //$data['ago'] = substr($ago, 0, strpos($ago, ",")) ." назад";
          
            
          $pattern = "/([0-9]+) ([а-я]+)/u";
          preg_match($pattern,$ago,$matches);
          $tostring = $matches[0];
          $data['ago'] = ($tostring.' назад');
            
            
            
            
        

//  subject, message, views!!!! - no,
            if ($data['theme'] == 'галерея ++') {
                
                $data['shmessage'] = 'Новые фотографии в галерее';
                $data['message'] = '';
                $data['subject'] = 'Обновления';
                
            }
            
            else {
                $data['shmessage'] = mb_strimwidth($data['message'], 0, 170,'...');
            }       
            //получим ссылки на фотографию
            if ($data['image'] == '0') {
                $data['image'] = 'img/logo2.png';
                $data['thumb'] = 'img/logo2.png';
            }
            else {
                $data['image'] = 'img/news/'.$data['id'].'/';
                $scandir = scandir('../'.$data['image']);
                $data['image'] = $scandir[2];
                $data['thumb'] = 'img/news/'.$data['id'].'/tmb/'.$data['image'];
                $data['image'] = 'img/news/'.$data['id'].$data['image'];
            }          
        }               
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($row);
    }

    

    public function uploadImg($dir_dest,$dir_pics,$files, PDO $pdo) {
        $this->dir_dest = $dir_dest;
        $this->dir_pics = $dir_pics;
        $this->status = 'записано';
        $this->files = $files;
        $this->def_dir_pics = 'img/def/1.jpg';
       
        
        $upload = new ExchangeMessages;
        $id = $upload ->getLastId($this->status, $pdo);
        $message = $upload->getMessage($id, $pdo);
        if ($message['image'] !== '1') {
            return $this->def_dir_pics;           
        } else {
           
            $this->dir_dest = $this->dir_dest.'/'.$id;

            foreach ($files as $key => $value) {
                 $add = new Upload($value);
                 if ($add->uploaded) {
                    $name =  sha1(mt_rand(1, 9999) . $add->file_dst_name . uniqid()) . time();
                    $add->file_new_name_body =  $name;                 
                    $add->process($this->dir_dest);
                    
                    $add->image_resize = true;
                                    
                    if($add->image_dst_x > ($add->image_dst_y)) {
                        $add->image_ratio_crop      = true;
                        $add->image_x = 200;
                        $add->image_y = 150;
                        
                    } elseif ($add->image_dst_y > ($add->image_dst_x)) {
                        $add->image_ratio_crop      = true;
                        $add->image_x = 100;
                        $add->image_y = 150;
                    } 
                    $add->file_new_name_body = $name;
                    $add->process($this->dir_dest."/tmb");                        
                }
                $add ->clean();
            }           
        }        
          $data = array('files' => 'Ваша новость опубликована');
          echo json_encode($data);       
    }

    public function sendAdminMessage($theme, $status, $dataIn, PDO $pdo) {

        $this->dataIn = $dataIn;
        $this->theme = $theme;
        $this->status = $status;
    
        $id = $dataIn;
        
        if($theme == 'согласование') {
             $tokken = '123321';            
        }
        
        elseif ($theme == 'ознакомление') {
         $tokken = '343454';
        }              
        // заполнение массива ссылок на скрипт подтверждения
        // должен содержать гет массив 
        // ид иконки  
        // ид сообщения
        // ид процесса к фильтру задач

        $uri = 'https://nebesa.me/ordim/a_vie/content/elements/mailtoadmin.php?tokken=' . $tokken . '&id=' . $id;
        $mess = file_get_contents($uri);
        $subject = $theme;
        $to = 'post@aurus.me';


        $headers = "Content-type: text/html; charset=UTF-8 \r\n";
        $headers .= "From: Сайт театра <zakaz@kraftikum.com>\r\n";
        mail($to, $subject, $mess, $headers);

        $query = "UPDATE `messages`
                  SET `status`= '$this->status'
                  WHERE id= $id";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
    }

    public function acceptAdminMessage($id, $icon, PDO $pdo) {
        $this->id = $id;
        $this->icon = $icon;
        $this->status = 'согласовано';

        $query = "UPDATE `messages`
                  SET `icon`= '$this->icon',
                      `status` = '$this->status'
                  WHERE id= $this->id";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
    }

}
?>

