<?

class rockyParams extends Params {

    // раскладки
    // Главная, Фриспины
    public $reels = array(
        // раскладка для главной игры
        array(
            array(2,5,10,0,10,8,4,6,3,5,6,3,4,1,0,2,1,11,10,7,5,6,8,7,6,7,1,9,12,5,1,9,4,6,3,10,3,7,1,9),
            array(2,9,5,7,4,10,4,6,9,3,10,11,5,7,9,10,2,0,9,3,10,4,5,7,4,6,2,0,9,3,10,3,7,1,8,2,6,8,1,7),
            array(7,2,8,5,9,4,1,6,10,1,10,4,3,8,5,9,4,10,6,0,1,10,9,11,2,8,7,3,8,5,9,4,10,7,9,3,2,8,3,6),
            array(9,4,3,9,7,5,6,1,0,8,4,9,3,7,5,6,2,1,0,8,4,9,3,7,5,6,8,2,10,6,8,4,9,11,7,5,6,8,10,7),
            array(4,8,3,6,5,10,0,2,9,4,10,2,4,6,3,0,5,10,7,1,9,11,4,8,3,6,5,10,6,1,14,4,8,3,10,4,7,10,6,5),
        ),
        // FS
        array(
            array(2,5,10,0,10,8,4,6,3,5,6,3,4,1,0,2,1,13,10,7,5,6,8,7,6,7,1,9,5,1,9,4,6,3,10,3,7,1,9),
            array(2,9,5,7,4,10,4,6,9,3,10,13,5,7,9,10,2,0,9,3,10,4,5,7,4,6,2,0,9,3,10,3,7,1,8,2,6,8,1,7),
            array(7,2,8,5,9,4,1,6,10,1,10,4,3,8,5,9,4,10,6,0,1,10,9,13,2,8,7,3,8,5,9,4,10,7,9,3,2,8,3,6),
            array(9,4,3,9,7,5,6,1,0,8,4,9,3,7,5,6,2,1,0,8,4,9,3,7,5,6,8,2,10,6,8,4,9,13,7,5,6,8,10,7),
            array(4,8,3,6,5,10,0,2,9,4,10,2,4,6,3,0,5,10,7,1,9,13,4,8,3,6,5,10,6,1,4,8,3,10,4,7,10,6,5),
        ),

    );
    // Символы
    public $symbols = array(
        // Лысый
        'G' => array(4),
        // O
        'O' => array(7),
        // Nigga
        'D' => array(1),
        // R
        'R' => array(6),
        // K
        'K' => array(9),
        // Woman
        'H' => array(5),
        // Эрокез
        'F' => array(3),
        // Y
        'Y' => array(10),
        // Дольф
        'E' => array(2),
        // C
        'C' => array(8),
        // Scatter
        'S' => array(11, 13),
        // Wild
        'W' => array(0),
        // Bonus Left
        'B' => array(12, 14),
        // Black Scatter
    );
    // Вайлд
    public $wild = array(0);
    // Скаттер
    public $scatter = array(11, 13);
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(
        '2' => 1,
        '3' => 5,
        '4' => 10,
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
        array('symbol'=> 'W', 'count'=> 5, 'multiplier'=> 10000.00),
        array('symbol'=> 'D', 'count'=> 5, 'multiplier'=> 1000.00),
        array('symbol'=> 'W', 'count'=> 4, 'multiplier'=> 1000.00),
        array('symbol'=> 'E', 'count'=> 5, 'multiplier'=> 800.00),
        array('symbol'=> 'F', 'count'=> 5, 'multiplier'=> 500.00),
        array('symbol'=> 'G', 'count'=> 5, 'multiplier'=> 300.00),
        array('symbol'=> 'H', 'count'=> 5, 'multiplier'=> 300.00),
        array('symbol'=> 'R', 'count'=> 5, 'multiplier'=> 250.00),
        array('symbol'=> 'O', 'count'=> 5, 'multiplier'=> 200.00),
        array('symbol'=> 'C', 'count'=> 5, 'multiplier'=> 150.00),
        array('symbol'=> 'K', 'count'=> 5, 'multiplier'=> 100.00),
        array('symbol'=> 'Y', 'count'=> 5, 'multiplier'=> 100.00),
        array('symbol'=> 'D', 'count'=> 4, 'multiplier'=> 80.00),
        array('symbol'=> 'E', 'count'=> 4, 'multiplier'=> 50.00),
        array('symbol'=> 'F', 'count'=> 4, 'multiplier'=> 50.00),
        array('symbol'=> 'W', 'count'=> 3, 'multiplier'=> 50.00),
        array('symbol'=> 'G', 'count'=> 4, 'multiplier'=> 40.00),
        array('symbol'=> 'H', 'count'=> 4, 'multiplier'=> 40.00),
        array('symbol'=> 'D', 'count'=> 3, 'multiplier'=> 40.00),
        array('symbol'=> 'R', 'count'=> 4, 'multiplier'=> 30.00),
        array('symbol'=> 'E', 'count'=> 3, 'multiplier'=> 30.00),
        array('symbol'=> 'O', 'count'=> 4, 'multiplier'=> 25.00),
        array('symbol'=> 'C', 'count'=> 4, 'multiplier'=> 25.00),
        array('symbol'=> 'F', 'count'=> 3, 'multiplier'=> 25.00),
        array('symbol'=> 'K', 'count'=> 4, 'multiplier'=> 20.00),
        array('symbol'=> 'Y', 'count'=> 4, 'multiplier'=> 20.00),
        array('symbol'=> 'G', 'count'=> 3, 'multiplier'=> 20.00),
        array('symbol'=> 'H', 'count'=> 3, 'multiplier'=> 20.00),
        array('symbol'=> 'R', 'count'=> 3, 'multiplier'=> 15.00),
        array('symbol'=> 'O', 'count'=> 3, 'multiplier'=> 10.00),
        array('symbol'=> 'C', 'count'=> 3, 'multiplier'=> 10.00),
        array('symbol'=> 'K', 'count'=> 3, 'multiplier'=> 5.00),
        array('symbol'=> 'Y', 'count'=> 3, 'multiplier'=> 5.00),
    );

    // multiple - множитель
    // alias: W - победа, L - поражение, K - нокаут
    // rnd - шанс выпадения определенного исхода боя.
    public $knockOutBonus = array(
        'multiple' => 3,
        'alias' => array('W', 'L', 'K'),
        'rnd' => array(
            0,0,0,0,0,0,0,0,
            1,1,1,1,
            2,2,
        ),
    );

}