<?

class kitty_glitterParams extends Params {
    public $reels = array(
        array(
            array(4,5,2,7,3,8,4,9,3,5,9,4,6,3,9,4,8,2,5,7,3,9,7,4,5,1,9,4,7,3,5,7,4,9,7,3,9,5,3,9,1,8,3,6,2,5,4,7,3,8,1,6,7,),
            array(2,8,7,1,8,9,51,8,9,4,4,9,7,3,3,8,51,5,1,9,3,3,5,8,51,6,8,4,4,7,9,51,6,0,7,2,6,0,9,1,8,6,51,5,6,2,2,6,5,0,6,8,4,4,8,6,3,3,9,7,0,0,6,2,8,9,2,8,6,),
            array(9,51,6,5,1,1,7,51,9,5,3,3,5,9,0,7,2,5,0,9,4,4,8,6,51,7,9,2,2,7,6,2,9,5,51,8,9,0,0,6,8,3,6,8,4,4,7,8,1,7,3,3,8,7,1,8,4,6,1,8,3,7,6,),
            array(2,5,4,6,2,7,51,9,4,7,3,5,4,8,1,7,51,5,1,6,0,5,8,3,3,7,9,2,7,5,0,7,1,8,51,5,2,6,7,4,9,8,2,6,3,3,9,5,4,4,6,2,8,3,6,1,9,),
            array(8,6,3,9,8,4,6,1,7,4,5,1,9,5,3,6,2,5,4,9,6,2,7,4,9,2,7,1,9,7,2,8,6,1,9,7,4,6,9,1,8,3,5,1,8,3,7,5,4,6,5,0,7,5,3,8,7,4,5,3,7,4,),
        ),
        array(
            array(6,1,8,2,5,1,7,4,9,3,6,4,9,1,7,4,5,3,7,5,2,9,3,8,1,6,3,5,8,1,7,4,9,2,5,4,7,3,5,1,6,3,7,1,8,3,9,1,8,4,9,8,2,6,5,3,6,5,4,9,6,2,5,7,2,8,6,4,8,6,2,5,8,4,9,6,3,8,4,5,2,6,3,8,7,4,9,3,7,),
            array(1,6,4,9,0,8,51,6,9,1,1,6,9,2,6,9,1,7,5,2,9,3,3,9,51,5,0,9,4,4,8,3,9,6,1,9,6,3,3,5,7,51,5,2,2,8,3,3,6,0,0,5,4,4,5,8,0,6,7,1,8,4,4,6,0,7,4,6,0,0,5,7,3,5,8,2,2,8,1,7,51,8,7,1,5,8,0,0,7,2,5,3,7,5,),
            array(5,51,6,7,0,0,8,9,3,3,7,2,2,9,1,7,9,0,5,9,0,8,7,4,8,7,3,5,1,6,9,4,8,7,51,8,2,7,3,8,7,2,8,6,3,5,9,2,6,9,2,6,8,3,6,0,9,2,8,6,51,9,5,1,1,8,3,7,51,8,9,4,8,0,6,4,4,8,0,0,9,4,7,51,9,5,3,3,9,8,0,6,5,4,8,1,7,5,4,4,6,1,9,3,5,8,2,2,6,8,4,7,1,6,0,),
            array(9,3,6,9,2,6,8,3,6,5,0,7,5,51,9,6,1,9,5,4,8,5,51,7,9,1,6,51,9,7,1,9,7,51,6,8,4,9,7,4,6,7,3,8,4,9,7,4,4,8,7,3,9,7,1,5,9,0,6,7,4,9,8,3,5,4,7,0,5,3,7,9,51,7,8,0,6,9,2,8,6,2,5,6,2,9,51,7,6,3,3,7,51,8,2,5,7,2,6,4,7,9,2,5,8,2,),
            array(102,9,4,5,7,102,5,7,3,5,102,3,5,8,1,102,8,1,9,8,102,9,8,1,5,102,1,5,4,7,9,102,7,9,1,7,8,3,6,7,2,6,102,2,6,9,4,102,9,4,6,7,2,6,7,3,5,102,3,5,0,6,8,102,6,8,4,6,8,3,5,9,4,),
        ),
    );

    public $reelConfig = array(3,3,3,3,3);

    public $symbols = array(
        'b01' => array(51),
        's01' => array(1),
        's02' => array(2),
        's03' => array(3),
        's04' => array(4),
        's05' => array(5),
        's06' => array(6),
        's07' => array(7),
        's08' => array(8),
        's09' => array(9),
        'w01' => array(0),
        'w02' => array(102),
    );
    // Вайлд
    public $wild = array(0, 102);

    public $blockWildsOnReel = true;
    public $blockWildReels = array(0);

    // Скаттер
    public $scatter = array(51);
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(
        '3' => 3,
    );

    public $winLines = array(
        // 1
        array(1,1,1,1,1),
        array(0,0,0,0,0),
        array(2,2,2,2,2),
        array(0,1,2,1,0),
        // 5
        array(2,1,0,1,2),
        array(0,0,1,0,0),
        array(2,2,1,2,2),
        array(1,2,2,2,1),
        array(1,0,0,0,1),
        // 10
        array(0,1,1,1,0),
        array(2,1,1,1,2),
        array(0,1,0,1,0),
        array(2,1,2,1,2),
        array(1,0,1,0,1),
        // 15
        array(1,2,1,2,1),
        array(1,1,0,1,1),
        array(1,1,2,1,1),
        array(0,2,0,2,0),
        array(2,0,2,0,2),
        // 20
        array(1,0,2,0,1),
        array(1,2,0,2,1),
        array(0,0,2,0,0),
        array(2,2,0,2,2),
        array(0,2,2,2,0),
        // 25
        array(2,0,0,0,2),
        array(0,2,1,2,0),
        array(2,0,1,0,2),
        array(0,0,1,2,2),
        array(2,2,1,0,0),
        // 30
        array(1,0,1,2,1),
    );

    public $payOnlyHighter = true;
    // настройка ставок
	public $currency = 'USD';

	public $defaultCoinsCount = 30;

    public $denominations = array(1,2,3,5,10,20,30,50,100,200,300,500,1000,2000,3000,5000,10000,20000,30000,50000,100000);
    public $lang = 'en';
    public $flash_scale_exactfit = 1;

    public $winPay = array(
        array('symbol'=> 's01', 'count'=> 3, 'multiplier'=> 50),
        array('symbol'=> 's01', 'count'=> 4, 'multiplier'=> 300),
        array('symbol'=> 's01', 'count'=> 5, 'multiplier'=> 1000),
        array('symbol'=> 's02', 'count'=> 3, 'multiplier'=> 40),
        array('symbol'=> 's02', 'count'=> 4, 'multiplier'=> 200),
        array('symbol'=> 's02', 'count'=> 5, 'multiplier'=> 750),
        array('symbol'=> 's03', 'count'=> 3, 'multiplier'=> 30),
        array('symbol'=> 's03', 'count'=> 4, 'multiplier'=> 125),
        array('symbol'=> 's03', 'count'=> 5, 'multiplier'=> 400),
        array('symbol'=> 's04', 'count'=> 3, 'multiplier'=> 20),
        array('symbol'=> 's04', 'count'=> 4, 'multiplier'=> 100),
        array('symbol'=> 's04', 'count'=> 5, 'multiplier'=> 300),
        array('symbol'=> 's05', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> 's05', 'count'=> 4, 'multiplier'=> 30),
        array('symbol'=> 's05', 'count'=> 5, 'multiplier'=> 125),
        array('symbol'=> 's06', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> 's06', 'count'=> 4, 'multiplier'=> 20),
        array('symbol'=> 's06', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> 's07', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> 's07', 'count'=> 4, 'multiplier'=> 20),
        array('symbol'=> 's07', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> 's08', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> 's08', 'count'=> 4, 'multiplier'=> 20),
        array('symbol'=> 's08', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> 's09', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> 's09', 'count'=> 4, 'multiplier'=> 20),
        array('symbol'=> 's09', 'count'=> 5, 'multiplier'=> 100),
    );
}