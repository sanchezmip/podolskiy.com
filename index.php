<?php
echo "<h1>Лабораторная работа 13</h1>";

class Worker
{
    private $name;
    private $age;
    private $salary;

    public function __construct($name, $age, $salary)
    {
        $this->name = $name;
        $this->age = $age;
        $this->salary = $salary;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function getSalary()
    {
        return $this->salary;
    }

    private function checkAge($age)
    {
        return $age >= 18;
    }

    public function setAge($age)
    {
        if ($this->checkAge($age)) {
            $this->age = $age;
            echo "Возраст изменен на $age<br>";
        } else {
            echo "Вам работать в нашей компании еще рано<br>";
        }
    }
}

$worker1 = new Worker("Иван Петров", 25, 50000);
$worker2 = new Worker("Мария Сидорова", 30, 70000);

echo "<h2>Информация о работниках</h2>";
echo "Работник 1: " . $worker1->getName() . ", возраст: " . $worker1->getAge() . ", зарплата: " . $worker1->getSalary() . "<br>";
echo "Работник 2: " . $worker2->getName() . ", возраст: " . $worker2->getAge() . ", зарплата: " . $worker2->getSalary() . "<br>";

$sumSalary = $worker1->getSalary() + $worker2->getSalary();
$sumAge = $worker1->getAge() + $worker2->getAge();
echo "<h2>Суммы</h2>";
echo "Сумма зарплат: $sumSalary<br>";
echo "Сумма возрастов: $sumAge<br>";

echo "<h2>Сумма зарплат через getSalary</h2>";
echo "Сумма зарплат: " . ($worker1->getSalary() + $worker2->getSalary()) . "<br>";

echo "<h2>Проверка setAge</h2>";
echo "Текущий возраст Ивана: " . $worker1->getAge() . "<br>";
$worker1->setAge(20);
echo "Новый возраст Ивана: " . $worker1->getAge() . "<br>";
$worker1->setAge(16);
echo "Возраст после попытки установить 16: " . $worker1->getAge() . "<br>";

echo "<h2>Проверка возраста через setAge</h2>";
echo "Устанавливаем возраст 25 для Марии: ";
$worker2->setAge(25);
echo "Устанавливаем возраст 15 для Марии: ";
$worker2->setAge(15);
echo "Итоговый возраст Марии: " . $worker2->getAge() . "<br>";
?>
