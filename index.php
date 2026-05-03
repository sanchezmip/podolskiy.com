<?php
echo "<h1>Лабораторная работа 15</h1>";

interface AreaInterface
{
    public function getArea(): float;
}

abstract class Figure implements AreaInterface
{
    protected float $area;
    protected string $color;
    protected int $sidesCount;

    abstract public function infoAbout(): string;
}

class Rectangle extends Figure
{
    private float $a;
    private float $b;
    protected int $sidesCount = 4;

    public function __construct(float $a, float $b, string $color = "red")
    {
        $this->a = $a;
        $this->b = $b;
        $this->color = $color;
        $this->area = $this->getArea();
    }

    public function getArea(): float
    {
        return $this->a * $this->b;
    }

    public function infoAbout(): string
    {
        return "Это класс прямоугольника. У него {$this->sidesCount} стороны.";
    }
}

class Square extends Figure
{
    private float $a;
    protected int $sidesCount = 4;

    public function __construct(float $a, string $color = "blue")
    {
        $this->a = $a;
        $this->color = $color;
        $this->area = $this->getArea();
    }

    public function getArea(): float
    {
        return $this->a * $this->a;
    }

    public function infoAbout(): string
    {
        return "Это класс квадрата. У него {$this->sidesCount} стороны.";
    }
}

class Triangle extends Figure
{
    private float $a;
    private float $b;
    private float $c;
    protected int $sidesCount = 3;

    public function __construct(float $a, float $b, float $c, string $color = "green")
    {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
        $this->color = $color;
        $this->area = $this->getArea();
    }

    public function getArea(): float
    {
        $p = ($this->a + $this->b + $this->c) / 2;
        return sqrt($p * ($p - $this->a) * ($p - $this->b) * ($p - $this->c));
    }

    public function infoAbout(): string
    {
        return "Это класс треугольника. У него {$this->sidesCount} стороны.";
    }
}

echo "<h2>Прямоугольники</h2>";
$rect1 = new Rectangle(5, 10);
$rect2 = new Rectangle(3, 7);

echo $rect1->infoAbout() . "<br>";
echo "Площадь: " . $rect1->getArea() . "<br><br>";

echo $rect2->infoAbout() . "<br>";
echo "Площадь: " . $rect2->getArea() . "<br><br>";

echo "<h2>Квадраты</h2>";
$square1 = new Square(4);
$square2 = new Square(6);

echo $square1->infoAbout() . "<br>";
echo "Площадь: " . $square1->getArea() . "<br><br>";

echo $square2->infoAbout() . "<br>";
echo "Площадь: " . $square2->getArea() . "<br><br>";

echo "<h2>Треугольники</h2>";
$triangle1 = new Triangle(3, 4, 5);
$triangle2 = new Triangle(5, 5, 6);

echo $triangle1->infoAbout() . "<br>";
echo "Площадь: " . $triangle1->getArea() . "<br><br>";

echo $triangle2->infoAbout() . "<br>";
echo "Площадь: " . $triangle2->getArea() . "<br>";
?>