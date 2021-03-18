<?php

/****** S T R A T E G Y    P A T T E R N *******/

// Занятия
abstract class Lesson
{
    // Длительность занятия
    private int $duration;

    // Тип оплаты
    private CostStrategy $costStrategy;

    public function __construct(int $duration, CostStrategy $costStrategy)
    {
        $this->duration = $duration; 
        
        // Передается выбранный тип оплаты TimedCostStrategy или FixedCostStrategy
        $this->costStrategy = $costStrategy; 
    }

    public function Cost() : int
    {
        // Полиморфизм. Вызывается метод Cost() у выбранного типа оплаты 
        // TimedCostStrategy или FixedCostStrategy
        return $this->costStrategy->Cost($this);
    }

    public function ChargeType() : string
    {
        // Полиморфизм. Вызывается метод ChargeType() у выбранного типа оплаты 
        // TimedCostStrategy или FixedCostStrategy
        return $this->costStrategy->ChargeType();
    }

    public function getDuration() : int
    {
        return $this->duration;
    }
}

// Лекции
class Lecture extends Lesson
{
}

// Семинары
class Seminar extends Lesson
{
}

// Вместо реализации методов Cost() и ChargeType() 
// в каждом дочернем классе Lesson мы реализуем их в отдельном классе 
// и не дублируем код в каждом дочернем классе Lesson
abstract class CostStrategy
{
    abstract public function Cost(Lesson $lesson) : int;
    abstract public function ChargeType() : string;
}

// Расчет стоимости по времени
class TimedCostStrategy extends CostStrategy
{
    public function Cost(Lesson $lesson) : int
    {
        return $lesson->getDuration() * 5;
    }

    public function ChargeType() : string
    {
        return "Почасовая оплата";
    }
}

// Расчет фиксированной стоимости
class FixedCostStrategy extends CostStrategy
{
    public function Cost(Lesson $lesson) : int
    {
        return 30;
    }

    public function ChargeType() : string
    {
        return "Фиксированная ставка";
    }
}

// 
// Пример использования классов 
//

$lessons[] = new Seminar(4, new TimedCostStrategy());
$lessons[] = new Lecture(4, new FixedCostStrategy());

foreach($lessons as $lesson) {
    print "Оплата за занятие {$lesson->cost()}. ";
    print "Тип оплаты: {$lesson->chargeType()}<br>";
}