<?

class gladiatorParams extends Params {

    // раскладки
    // Основная, Фриспины
    public $reels = array(
        // Основная игра
        array(
            array(3,9,0,8,6,3,7,2,9,1,6,4,7,2,9,3,5,2,6,4,5,10,11,8,9,4,10,0,8,2,10,1,5,4,7,11,10,3,9,10),
            array(5,0,8,2,6,3,7,4,9,6,1,8,7,2,9,4,5,12,6,4,5,10,11,7,8,4,10,6,8,2,7,1,5,3,7,12,10,3,9,8),
            array(0,9,8,12,6,3,7,10,9,2,6,8,7,3,9,10,5,12,6,4,5,10,11,8,9,4,5,6,1,7,10,2,5,8,7,12,10,3,7,8),
            array(5,0,9,8,6,3,7,10,9,2,6,8,7,4,9,1,5,2,6,4,5,10,11,8,5,4,10,6,12,7,10,2,5,6,7,12,10,3,9,8),
            array(5,0,8,2,6,3,7,2,9,6,1,8,7,2,9,1,5,3,6,4,5,10,11,8,4,9,3,6,4,7,10,2,5,4,7,0,10,3,8,1),
        ),
        // Coliseum
        array(
            array(3,9,0,8,6,3,7,2,9,1,6,4,7,2,9,3,5,2,6,4,5,10,11,8,9,4,10,0,8,2,10,1,5,4,7,11,10,3,9,10),
            array(5,0,8,2,6,3,7,4,9,6,1,8,7,2,9,4,5,12,6,4,5,10,11,7,8,4,10,6,8,2,7,1,5,3,7,12,10,3,9,8),
            array(0,9,8,12,6,3,7,10,9,2,6,8,7,3,9,10,5,12,6,4,5,10,11,8,9,4,5,6,1,7,10,2,5,8,7,12,10,3,7,8),
            array(5,0,9,8,6,3,7,10,9,2,6,8,7,4,9,1,5,2,6,4,5,10,11,8,5,4,10,6,12,7,10,2,5,6,7,12,10,3,9,8),
            array(5,0,8,2,6,3,7,2,9,6,1,8,7,2,9,1,5,3,6,4,5,10,11,8,4,9,3,6,4,7,10,2,5,4,7,0,10,3,8,1),
        ),
    );
    // Символы
    public $symbols = array(
        // J
        'J' => array(8),
        // 9
        'N' => array(10),
        // Helmet
        'W' => array(12),
        // 10
        'T' => array(9),
        // Q
        'Q' => array(7),
        // Scatter
        'S' => array(11),
        // Black warrior
        'F' => array(4),
        // Old man
        'D' => array(2),
        // Ukutanui borodach
        'E' => array(3),
        // Woman
        'C' => array(1),
        // K
        'K' => array(6),
        // Top man
        'B' => array(0),
        // A
        'A' => array(5),
    );
    // Вайлд
    public $wild = array(12);
    // Скаттер
    public $scatter = array(11);
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(
        '2' => 1,
        '3' => 4,
        '4' => 20,
        '5' => 100,
    );
    // Выигрышные линии
    public $winLines = array(
        array(1,1,1,1,1),
        array(0,0,0,0,0),
        array(2,2,2,2,2),
        array(0,1,2,1,0),
        array(2,1,0,1,2),
        array(1,0,0,0,1),
        array(1,2,2,2,1),
        array(0,0,1,2,2),
        array(2,2,1,0,0),
        array(1,2,1,0,1),
        array(1,0,1,2,1),
        array(0,1,1,1,0),
        array(2,1,1,1,2),
        array(0,1,0,1,0),
        array(2,1,2,1,2),
        array(1,1,0,1,1),
        array(1,1,2,1,1),
        array(0,0,2,0,0),
        array(2,2,0,2,2),
        array(0,2,2,2,0),
        array(2,0,0,0,2),
        array(1,2,0,2,1),
        array(1,0,2,0,1),
        array(0,2,0,2,0),
        array(2,0,2,0,2),
    );
    // Выплачивать только максимальный выигрыш на линии
    public $payOnlyHighter = true;
    // настройка ставок
	public $currency = 'USD';

	public $denominations = array(0.01,0.02,0.03,0.04,0.05,0.1,0.25,0.5,1,2,3,4,5,6,7,8,9,10);
    public $lang = 'en';
    public $flash_scale_exactfit = 1;
    // Выплаты
    public $winPay = array(
        array('symbol'=> 'B', 'count'=> 5, 'multiplier'=> 5000.00),
        array('symbol'=> 'C', 'count'=> 5, 'multiplier'=> 1000.00),
        array('symbol'=> 'B', 'count'=> 4, 'multiplier'=> 500.00),
        array('symbol'=> 'D', 'count'=> 5, 'multiplier'=> 350.00),
        array('symbol'=> 'E', 'count'=> 5, 'multiplier'=> 250.00),
        array('symbol'=> 'F', 'count'=> 5, 'multiplier'=> 250.00),
        array('symbol'=> 'C', 'count'=> 4, 'multiplier'=> 250.00),
        array('symbol'=> 'A', 'count'=> 5, 'multiplier'=> 200.00),
        array('symbol'=> 'K', 'count'=> 5, 'multiplier'=> 200.00),
        array('symbol'=> 'Q', 'count'=> 5, 'multiplier'=> 120.00),
        array('symbol'=> 'J', 'count'=> 5, 'multiplier'=> 120.00),
        array('symbol'=> 'T', 'count'=> 5, 'multiplier'=> 75.00),
        array('symbol'=> 'N', 'count'=> 5, 'multiplier'=> 75.00),
        array('symbol'=> 'D', 'count'=> 4, 'multiplier'=> 75.00),
        array('symbol'=> 'B', 'count'=> 3, 'multiplier'=> 75.00),
        array('symbol'=> 'E', 'count'=> 4, 'multiplier'=> 60.00),
        array('symbol'=> 'F', 'count'=> 4, 'multiplier'=> 60.00),
        array('symbol'=> 'A', 'count'=> 4, 'multiplier'=> 50.00),
        array('symbol'=> 'K', 'count'=> 4, 'multiplier'=> 50.00),
        array('symbol'=> 'C', 'count'=> 3, 'multiplier'=> 50.00),
        array('symbol'=> 'Q', 'count'=> 4, 'multiplier'=> 40.00),
        array('symbol'=> 'J', 'count'=> 4, 'multiplier'=> 40.00),
        array('symbol'=> 'D', 'count'=> 3, 'multiplier'=> 25.00),
        array('symbol'=> 'T', 'count'=> 4, 'multiplier'=> 20.00),
        array('symbol'=> 'N', 'count'=> 4, 'multiplier'=> 20.00),
        array('symbol'=> 'E', 'count'=> 3, 'multiplier'=> 20.00),
        array('symbol'=> 'F', 'count'=> 3, 'multiplier'=> 20.00),
        array('symbol'=> 'A', 'count'=> 3, 'multiplier'=> 15.00),
        array('symbol'=> 'K', 'count'=> 3, 'multiplier'=> 15.00),
        array('symbol'=> 'Q', 'count'=> 3, 'multiplier'=> 10.00),
        array('symbol'=> 'J', 'count'=> 3, 'multiplier'=> 10.00),
        array('symbol'=> 'T', 'count'=> 3, 'multiplier'=> 8.00),
        array('symbol'=> 'N', 'count'=> 3, 'multiplier'=> 8.00),
        array('symbol'=> 'B', 'count'=> 2, 'multiplier'=> 8.00),
        array('symbol'=> 'C', 'count'=> 2, 'multiplier'=> 7.00),
    );

    // Multiple - множитель ставки в бонусе
    // rand - шанс выпадения определенного множителя. 0 отвечает за множитель "1" и их больше всего
    // то есть шанс, что выпадет множитель 1 больше всего.
    public $helmetBonus = array(
        'multiple' => array(1, 3, 5),
        'alias' => array('B', 'S', 'G'),
        'rand' => array(
            0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,
            1,1,1,1,1,
            2,
        ),
    );

    // fsCount - количество фриспинов, которые могут быть в ячейке
    // fsCountRand - шанс выпадения определенного количество фриспинов
    // multiple - список множителей
    // multipleRand - шанс выпадения определенного множителя
    // extraWildChance - шанс(1 к числу) того, что выпадет дополнительный вайлд. То есть при значении "50" шанс будет 1 к 50
    // extraWildChance напрямую зависит от extraScatterChance. Если выпадает скаттер, то тогда может выпасть wild.
    // Получается, что при шанса скаттера 1 к 5, и вайлда 1 к 10 - итоговый шанс вайлда 1 к 50
    // extraScatterChance - шанс(1 к числу) того, что выпадет дополнительный скаттер
    public $coliseumBonus = array(
        'fsCount' => array(4,5,6,7,8,9,10),
        'fsCountRand' => array(
            0,0,0,0,0,0,0,
            1,1,1,1,1,1,
            2,2,2,2,2,
            3,3,3,3,
            4,4,4,
            5,5,
            6,
        ),
        'multiple' => array(0,1,2,3,4,5),
        'multipleRand' => array(
            0,0,0,0,0,0,
            1,1,1,1,1,
            2,2,2,2,
            3,3,3,
            4,4,
            5,
        ),
        'extraWildSymbols' => array('J','N','T','Q','F','D','E','C','K','B','A'),
        'extraWildChance' => 10,
        'extraScatterSymbols' => array('J','N','T','Q','F','D','E','C','K','B','A'),
        'extraScatterChance' => 10,
    );

}