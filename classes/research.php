<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $root = dirname(__FILE__, 2);
    include $root.'/include/database.php';
    // include $root."/classes/qr.php";
    include_once $root.'/include/qrcode.php';

    class Research {

        public $id;
        public $abstract;
        public $title;
        public $authors;
        public $method;
        public $qr_code_link;
        public $QRPREFIX="DFS::";

        function get_researches () {
            $db = new DB();
            $db->connect();

            $sql = "select * from researches where deleted_at is null;";

            $result=$db->fetch($sql);
            $db->close();
            $data = [];

            while($row = $result->fetch_assoc()) {
                $data[]=$row;
            }
            
            return $data;
        }

        function get_research() {
            $db = new DB();
            $db->connect();

            $sql = "select * from researches where deleted_at is null and id = ?;";

            $stmt = $db->prepare($sql);
            $id = $this->id;

            // reset id
            $this->id=0;

            $stmt->bind_param('i', $id);

            $stmt->execute();

            $result = $stmt->get_result();
            $db->close();
            // return $result;
            if ($result)
            {
                // it return number of rows in the table.
                if ($result->num_rows > 0)
                    {
                        $row = $result->fetch_assoc();
                        $this->id = $row['id'];
                        $this->abstract = $row['abstract'];
                        $this->title = $row['title'];
                        $this->authors = $row['authors'];
                        $this->method = $row['method'];
                        $this->qr_code_link = $row['qr_code_link'];
                    }
                // close the result.
                // mysqli_free_result($result);
            }
        }


        function Save(){
            $db = new DB();
            $db->connect();

            $sql = "
            insert into researches 
                (
                    abstract,
                    title,
                    authors,
                    method,
                    qr_code_link,
                    created_at
                )
            values
                (
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    now()
                )
            ;";
            $stmt = $db->db->prepare($sql);
            $stmt->bind_param('sssss', $this->abstract,$this->title,$this->authors,$this->method,$this->qr_code_link);

            $stmt->execute();

            $stmt->close();
            $this->id = $db->get_last_id();
            $this->generateQRCode();

            $db->close();

        }

        function Update(){
            // remember fields
            $db = new DB();
            $db->connect();

            $sql = "
            update researches set
                abstract=?,
                title=?,
                authors=?,
                method=?,
                qr_code_link=?
            where id = ?
            ;";
            $stmt = $db->prepare($sql);
            $stmt->bind_param('sssssi', $this->abstract,$this->title,$this->authors,$this->method,$this->qr_code_link,$this->id);

            $stmt->execute();

            $stmt->close();

            $db->close();
        }

        function delete(){
            $db = new DB();
            $db->connect();
            
            $sql = "
            update researches set
                deleted_at = now()
            where id = ?
            ;";
            $stmt = $db->prepare($sql);
            $stmt->bind_param('i', $this->id);

            $stmt->execute();

            $stmt->close();

            $db->close();
        }
        
        function generateQRCode() {
            $root = dirname(__FILE__, 2);
            $tempDir = $root."/upload/";
            $filename=$this->id.".png";
            
            $qr = new QRCode();
            $qr->setErrorCorrectLevel(QR_ERROR_CORRECT_LEVEL_L);
            $qr->setTypeNumber(4);
            $qr->addData(base64_encode($this->QRPREFIX.$this->id));
            $qr->make();
            $image = $qr->createImage(4);
            imagepng($image,$tempDir.$filename,3);
            $this->qr_code_link = "/upload/".$filename;
            
            $this->Update();
        }
    }
?>