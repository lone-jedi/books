<?php

    class ShopProduct
    {
        private int $id           = 0;
        private string $title     = '';
        private string $firstName = '';
        private string $mainName  = '';
        private float $price      = 0;
        
        public function __construct(string $title, string $firstName, 
                                    string $mainName, float $price)
        {
            $this->title     = $title;
            $this->firstName = $firstName;
            $this->mainName  = $mainName;
            $this->price     = $price;
        }

        public function setId(int $id) : void
        {
            $this->id = $id;
        }

        public function __toString()
        {
            return "
            <b>Id:</b> {$this->id}<br>
            <b>Title:</b> {$this->title}<br>
            <b>First name:</b> {$this->firstName}<br>
            <b>Main name:</b> {$this->mainName}<br>
            <b>Price:</b> {$this->price}
            ";
        }
        
        /*
        * Get instance BookProduct or CdProduct from DataBase
        * @param int $id Id row
        * @param PDO $pdo PDO Instance
        */
        public static function getInstance(int $id, \PDO $pdo) : ShopProduct
        {
            $stmt   = $pdo->prepare("SELECT * FROM `products` WHERE id=?");
            $result = $stmt->execute([$id]);
            $row    = $stmt->fetch();

            if(empty($row))
            {
                return null;
            }

            if($row['type'] == "book") {
                $product = new BookProduct(
                    $row['title'],
                    $row['firstname'],
                    $row['mainname'],
                    (float) $row['price'],
                    (int) $row['numpages']
                );
            } else if($row['type'] == "cd") {
                $product = new CdProduct(
                    $row['title'],
                    $row['firstname'],
                    $row['mainname'],
                    (float) $row['price'],
                    (int) $row['playlenght']
                );
            } else {
                $product   = new ShopProduct(
                    $row['title'],
                    $row['firstname'] ?? "",
                    $row['mainname'],
                    (float) $row['price'],
                );
            }
            $product->setId((int) $row['id']);
            return $product;
        }
    }

    class BookProduct extends ShopProduct
    {
        private int $numPages = 0;

        public function __construct(string $title, string $firstName, 
                                    string $mainName, float $price, int $numPages)
        {
            parent::__construct($title, $firstName, $mainName, $price);
            $this->numPages = $numPages;
        }

        public function __toString()
        {
            return parent::__toString() . "
            <br>
            <b>Num pages:</b> {$this->numPages}
            ";
        }
    }

    class CdProduct extends ShopProduct
    {
        private int $playLength = 0;

        public function __construct(string $title, string $firstName, 
                                    string $mainName, float $price, int $playLength)
        {
            parent::__construct($title, $firstName, $mainName, $price);
            $this->playLength = $playLength;
        }

        public function __toString()
        {
            return parent::__toString() . "
            <br>
            <b>Play length:</b> {$this->playLength}
            ";
        }
    }
