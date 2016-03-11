<?php
    // объ€вили класс с конструктором
    class DemoClass
    {
        private $a;
        private $b;
        private $c;
        private $d;

        public function __construct($a, $b, $c)
        {
            $this->a = $a;
            $this->b = $b;
            $this->c = $c;
            $this->d = 'my secret string';
        }

        public function getSecret()
        {
            return $this->d;
        }
    }

    // создаЄм экземпл€р класса
    $demo = new DemoClass('a', 'b', 'c');
    // выводим секретную строку
    echo $demo->getSecret();
    // строка 'my secret string' выводитс€,
    // хот€ мы еЄ €вно не инициализировали
?>