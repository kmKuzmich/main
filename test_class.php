<?php
    // �������� ����� � �������������
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

    // ������ ��������� ������
    $demo = new DemoClass('a', 'b', 'c');
    // ������� ��������� ������
    echo $demo->getSecret();
    // ������ 'my secret string' ���������,
    // ���� �� � ���� �� ����������������
?>